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
        <title>Inventory Barang</title>

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

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif

        @stack("styles")
    </head>

    <body class="font-n leading-[1.5rem]">
        <div id="app" class="min-h-dvh bg-[--body-clr] text-[--text-clr]">
            <header
                class="header flex select-none items-center justify-between px-[5rem] pb-5 pt-10 align-middle"
                id="header"
            >
                <abbr
                    class="font-audioWide text-[1.4rem] font-bold"
                    title="Pengembangan Perangkat Lunak & Gim"
                >
                    PPLG
                </abbr>

                <h3 class="font-nunito text-[1.4rem] font-bold uppercase">
                    Inventory Barang
                </h3>
                <div class="group-auth grid grid-cols-2 gap-2">
                    <div x-data="{ activeTab: 'login' }">
                        <button
                            onclick="showAuthModal('login')"
                            class="w-[80px] rounded-md border border-[--primary-clr] p-2 font-semibold text-[--primary-clr] transition-colors hover:border-[--border-2-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
                        >
                            Login
                        </button>
                        @include("components/auth-modal")
                    </div>
                    <div x-data="{ activeTab: 'register' }">
                        <button
                            class="w-[80px] rounded-md border border-[--primary-hover-clr] bg-[--primary-clr] p-2 font-semibold text-[--text-clr] transition-colors hover:border-[--border-2-clr]"
                            onclick="showAuthModal('register')"
                        >
                            Register
                        </button>
                        @include("components/auth-modal")
                    </div>
                </div>
            </header>
            <!--========== MAIN CONTENT START ==========-->
            <main
                id="main"
                class="main flex min-h-screen w-full flex-col gap-10 p-8"
            >
                @yield("content")
            </main>
            <footer class="bg-[--container-clr] px-[5rem]">
                <div id="footer-bottom" class="grid grid-cols-12 py-6">
                    <div
                        id="copyright-group"
                        class="col-span-8 grid grid-cols-[auto_1fr]"
                    >
                        <h3 class="font-audioWide text-[1.25rem] font-bold">
                            Shyy
                        </h3>
                        <p class="self-end pl-4 text-xs font-medium">
                            Copyright © 2025 Syahrul Hidayatulloh. All Right
                            Reserved
                        </p>
                    </div>
                    <div
                        id="social-brands"
                        class="col-span-4 flex gap-4 justify-self-end"
                    >
                        <a href="#" class="flex items-center justify-center">
                            <i class="fa-brands fa-whatsapp text-[1rem]"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center">
                            <i class="fa-brands fa-instagram text-[1rem]"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center">
                            <i class="fa-brands fa-github text-[1rem]"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="{{ asset("js/auth-modal.js") }}"></script>
        @stack("scripts")
        @if (session("success"))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session("success") }}',
                        confirmButtonColor: '#3085d6',
                        background: '#1a1a1a',
                        color: '#fff',
                    });
                });
            </script>
        @endif

        @if (session("error"))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            html: `@foreach($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                  @endforeach`
                                        });
                                    });

                    history.pushState(null, document.title, location.href);
                    window.addEventListener('popstate', function(event) {
                    history.pushState(null, document.title, location.href);
                    });
            </script>
        @endif
    </body>
</html>
