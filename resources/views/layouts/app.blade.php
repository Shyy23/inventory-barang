<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <!--===== Meta Tag =====-->
        <meta charset="UTF-8" />
        <meta name="keywords" content="Web Inventory, Manajemen Barang, RPL " />
        <meta
            name="description"
            content="Inventory Barang jurusan RPL SMKN 4 Padalarang"
        />
        <meta name="author" content="Syahrul Hidayatulloh" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--===== Title =====-->
        <title>@yield("title", "Inventory-barang")</title>

        <!--===== Favicon =====-->
        <link
            rel="shortcut icon"
            href="{{ asset("assets/icons/default.ico") }}"
            type="image/x-icon"
        />

        <!--===== ICON CDN =====-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js"></script>

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif
    </head>

    <body class="font-poppins leading-[1.5rem]">
        <div
            id="app"
            class="grid min-h-dvh grid-cols-[auto_1fr] bg-[--body-clr] text-[--text-clr]"
        >
            <!--========== SIDEBAR START ==========-->
            @include("layouts.navigation")
            <!--========== SIDEBAR END ==========-->
            <!--========== MAIN CONTENT START ==========-->
            <main id="main" class="main p-[30px_7%]">
                @yield("content")
            </main>
            <!--========== MAIN CONTENT END ==========-->
            <!--========== FOOTER START ==========-->
            <footer id="footer" class="footer"></footer>
            <!--========== FOOTER END ==========-->
        </div>
        <!-- Main Js -->
        <script
            src="{{ asset("js/main.js") }}"
            type="text/javascript"
            defer
        ></script>
    </body>
</html>
