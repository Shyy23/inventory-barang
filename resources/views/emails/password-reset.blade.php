<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reset Password</title>

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif
    </head>
    <body>
        <div class="container m-[0_auto] max-w-[600px] p-5">
            <h2>Permintaan Reset Password</h2>
            <p>Gunakan kode berikut untuk mereset password Anda:</p>
            <div class="code text-2xl font-bold text-[--primary-clr]">
                {{ $code }}
            </div>
            <p>Kode ini akan kadaluwarsa dalam 30 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </div>
    </body>
</html>
