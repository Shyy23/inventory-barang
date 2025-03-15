<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->with('error', 'Invalid credentials');
    }






    public function register(Request $request)
    {
        try{
            $isGuest = $request->has('is_guest');

            $userData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6'
            ]);

            if(!$isGuest) {
                $request->validate([
                    'nisn',
                    'student_name' => 'required|max:255',
                    'gender'=>'required|in:F,M',
                    'class_id' => 'required|exists:classes,class_id',
                    'phone_number'=>'required',
                    'address'=>'required'
                ]);
            }

            $user = User::create([
                'name' => $userData['name'],
                'email'=>$userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => $isGuest ? 'guest' : 'student'
            ]);

            if(!$isGuest){
                Student::create([
                    'nisn' => $request->nisn,
                    'name'=>$request->student_name,
                    'gender'=>$request->gender,
                    'class_id'=>$request->class_id,
                    'phone_number' => $request->phone_number,
                    'address'=>$request->address,
                    'user_id'=>$user->user_id
                ]);
            }

            Auth::login($user);
            return redirect()->route('admin.dashboard')->with('success', 'Registrasi berhasil!');
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors() // Kirimkan semua error validasi
            ], 422);
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: '.$e->getMessage()
            ], 500);
        }
        
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

        } catch (\Exception $e) {
            return redirect('/')->withErrors(['error' => 'Authentication failed'])->with('error', 'Autentication failed');
        }

        $user = User::updateOrCreate(
            ['email'=>$socialUser->getEmail()],
            [
                'name'=> $socialUser->name  ?? $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getId(),
                'provider'=>$provider,
                'provider_id'=>$socialUser->getId(),
                'password'=>bcrypt(Str::random(24)),
            ]
            );

            if(!$user->wasRecentlyCreated){
                $user->update(['name'=>$user->name ?? $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getId()]);
            } else {
                $user->update(['password'=>Hash::make(uniqid())]);
            }

        Auth::login($user);
        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');;
    }

    public function showForgotPasswordForm(){
        $classes = DB::table('vclasses')->get();
        return view('auth.forgot-password', compact('classes'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
    
        // Hapus sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Hapus cookie sesi jika ada
        $cookie = \Cookie::forget('laravel_session');
    
        // Tambahkan header untuk mencegah caching
        return redirect('/')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->withCookie($cookie)->with('success', 'Berhasil Logout');
    }
}
