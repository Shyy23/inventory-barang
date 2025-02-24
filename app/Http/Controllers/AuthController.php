<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->with('error', 'Invalid credentials');
    }

    // Show register form

    public function showRegisterForm()
    {
        return view('auth.login');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'

        ]);

        try{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
        }catch (\Exception $e){
            return back()->withErrors([
                'email'=>'Gagal membuat akun. Silakan coba lagi'
            ])->with('error', 'Oops! Gagal membuat Akun');
        }
         

        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Login berhasil!');; 
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
        return redirect('/dashboard')->with('success', 'Login berhasil!');;
    }

    public function showForgotPasswordForm(){
        return view('auth.forgot-password');
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
