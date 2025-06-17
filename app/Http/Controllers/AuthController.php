<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Traits\Loggable;
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
    use Loggable;
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $this->logSecurityEvent('login_attempt', 'info', false, $request->email, null);
        if (Auth::attempt($credentials)) {
            $this->logSecurityEvent('login_success', 'info', true, $request->email, null);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        } else {
            $this->logSecurityEvent('login_failed', 'warning', false, $request->email, null);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->with('error', 'Invalid credentials');
    }

    public function register(Request $request)
    {
        $this->logSecurityEvent('registration_attempt', 'info', false, $request->email, null);

        try {
            $isGuest = $request->has('is_guest');

            $userData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6'
            ]);

            if (!$isGuest) {
                $request->validate([
                    'nisn',
                    'student_name' => 'required|max:255',
                    'gender' => 'required|in:F,M',
                    'class_id' => 'required|exists:classes,class_id',
                    'phone_number' => 'required',
                    'address' => 'required'
                ]);
            }

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => $isGuest ? 'guest' : 'student'
            ]);

            if (!$isGuest) {
                Student::create([
                    'nisn' => $request->nisn,
                    'name' => $request->student_name,
                    'gender' => $request->gender,
                    'class_id' => $request->class_id,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'user_id' => $user->user_id
                ]);
            }

            Auth::login($user);
            $this->logSecurityEvent('registarion_success', 'info', true, $request->email, null);

            return redirect()->route('admin.dashboard')->with('success', 'Registrasi berhasil!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->logSecurityEvent('registration_failed', 'warning', false, $request->email, null);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors() // Kirimkan semua error validasi
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
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
            $this->logSecurityEvent('login_attempt', 'info', false, $socialUser->getEmail(), null);

        } catch (\Exception $e) {
            $this->logSecurityEvent('login_failed', 'warning', false, $socialUser->getEmail(), null);
            return redirect('/')->withErrors(['error' => 'Authentication failed'])->with('error', 'Autentication failed');

        }

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->name ?? $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getId(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(24)),
            ]
        );

        if (!$user->wasRecentlyCreated) {
            $user->update(['name' => $user->name ?? $socialUser->getName() ?? $socialUser->getNickname() ?? $socialUser->getId()]);
        } else {
            $user->update(['password' => Hash::make(uniqid())]);
        }

        Auth::login($user);
        $this->logSecurityEvent('login_success', 'info', true, $socialUser->getEmail(), null);
        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        ;
    }

    public function showForgotPasswordForm()
    {
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
        // Ambil informasi pengguna sebelum logout
        $userEmail = Auth::user() ? Auth::user()->email : 'Guest';
        // Hapus sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus cookie sesi jika ada
        $cookie = \Cookie::forget('laravel_session');

        // Logging aktivitas logout
        $this->logSecurityEvent('logout', 'info', true, $userEmail, null);

        // Tambahkan header untuk mencegah caching
        return redirect('/')->withCookie($cookie)->with('success', 'Berhasil Logout');
    }
}
