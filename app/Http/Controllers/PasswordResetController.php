<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{
    public function  sendResetCode (Request $request){
        $request->validate(['email'=>'required|email']);

        try{
            $user = User::where('email', $request->email)->firstOrFail();

            // Generate 6 digit code
            $code = Str::upper(Str::random(6));

            $user->update([
                'reset_code' => Hash::make($code),
                'reset_code_expires_at' => Carbon::now()->addMinutes(30)
            ]);

            Mail::to($user->email)->send(new  PasswordResetMail($code));

            return response()->json([
                'success' => true,
                'message' => 'Kode verifikasi  telah dikirim ke email Anda'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message'=>'Email tidak terdaftar atau terjadi kesalahan sistem'
            ], 404);
        }
    }

    public function verifyCode(Request $request){
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6'
        ]);

        try{
            $user = User::where('email', $request->email)->where('reset_code_expires_at', '>', now())->firstOrFail();

            if(!Hash::check($request->code, $user->reset_code)){
                throw new \Exception('Kode tidak valid');
            }

            return response()->json(['success'  => true]);

        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Kode tidak valid atau sudah  kadaluarsa'
            ], 422);
        }
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'  => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        try{
            $user = User::where('email', $request->email)->firstOrFail();

            $user->update([
                'password' => Hash::make($request->password),
                'reset_code'=> null,
                'reset_code_expired_at' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message'=> 'Gagal mereset password'
            ], 500);
        }
    }
}
