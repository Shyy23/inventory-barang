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
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show register form

    public function showRegisterForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed'

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
            ]);
        }
         

        Auth::login($user);
        return redirect('/dashboard'); 
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
            return redirect('/login')->withErrors(['error' => 'Authentication failed']);
        }

        $user = User::updateOrCreate(
            ['email'=>$socialUser->getEmail()],
            [
                'name'=> $socialUser->name,
                'provider'=>$provider,
                'provider_id'=>$socialUser->getId(),
                'password'=>bcrypt(Str::random(24)),
            ]
            );

            if(!$user->wasRecentlyCreated){
                $user->update(['name'=>$user->name ?? $socialUser->getName()]);
            } else {
                $user->update(['password'=>Hash::make(uniqid())]);
            }

        Auth::login($user);
        return redirect('/dashboard');
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
}
