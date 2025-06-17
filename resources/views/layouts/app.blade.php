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
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta
            http-equiv="Cache-Control"
            content="no-cache, no-store, must-revalidate"
        />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack("styles")

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif
    </head>

    <body class="font-n leading-[1.5rem]">
        <div id="app" class="min-h-dvh bg-[--body-clr] text-[--text-clr]">
            <!--========== SIDEBAR START ==========-->
            @include("partials.navigation")
            <div
                class="overlay fixed left-0 top-0 z-[99] h-screen w-full bg-[rgba(0,0,0,.5)]"
                id="overlay"
            ></div>
            <!--========== SIDEBAR END ==========-->
            <!--========== MAIN CONTENT START ==========-->
            <main id="main" class="main flex min-h-screen w-full flex-col p-8">
                <!-- Heading of Content -->
                <header class="page__heading mb-4 flex pb-2" id="header">
                    <div
                        class="menu__btn flex h-[calc(1.2rem+.6vw)] w-[calc(1.2rem+.6vw)] cursor-pointer items-center justify-center"
                        id="menu-btn"
                    >
                        <i class="fa-solid fa-bars text-[calc(1rem+.6vw)]"></i>
                    </div>
                </header>
                <div class="content-heading-group grid grid-cols-[auto_1fr]">
                    <div class="content__heading mb-8">
                        <h3
                            class="mb-2 mt-0 font-nunito text-[calc(1.3rem+.6vw)] font-bold"
                        >
                            @yield("page title", "Inventory Statistik")
                        </h3>
                    </div>
                    <div class="breadcrumb text-end">
                        <nav
                            class="breadcrumb-container"
                            aria-label="Breadcrumb"
                        >
                            @yield("breadcrumbs")
                        </nav>
                    </div>
                </div>

                @yield("content")
            </main>
            <!--========== FOOTER START ==========-->
            @include("partials.footer")
            <!--========== FOOTER END ==========-->
            <!--========== MAIN CONTENT END ==========-->
        </div>
        <!-- Main Js -->
        <script
            src="{{ asset("js/Main.js") }}"
            type="text/javascript"
            defer
        ></script>
        <script src="{{ asset("js/Handler/AlertHandler.js") }}"></script>
        @stack("scripts")
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                    @if(session('success'))
                    SwalHelper.showSuccess({
                        title: "Success!",
                        text: "{{ session('success') }}",
                    });
                    @endif

                    @if(session('info'))
                    SwalHelper.showInfo({
                        title: 'Updated!',
                        text: '{{ session('info') }}',
                    });
                    @endif
                    @if(session('warning'))
                    SwalHelper.showWarning({
                        title: 'Deleted!',
                        text: '{{ session('warning') }}',
                    })
                    @endif
                    @if($errors->any())
                    SwalHelper.showError({
                        title: 'Oops...',
                        html: `@foreach ( $errors->all() as $error )
                        <p>{{ $error }}</p>           
                        @endforeach`,
                    });
                    @endif
                    // Blok kode untuk mencegah kembali setelah submit error
            history.pushState(null, document.title, location.href);
            window.addEventListener('popstate', function(event) {
                history.pushState(null, document.title, location.href);
                });
            });
        </script>
    </body>
</html>
