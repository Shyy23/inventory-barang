<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class CustomAuthenticate extends Middleware
{
    /**
     * Override method redirectTo untuk mengubah tujuan redirect.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika pengguna tidak terotentikasi, arahkan ke halaman utama ('/').
        if (!$request->expectsJson()) {
            return route('home'); // Pastikan route 'home' sudah didefinisikan
        }

        return null;
    }
}