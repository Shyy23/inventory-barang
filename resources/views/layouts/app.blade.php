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

    <body class="font-n leading-[1.5rem]">
        <div id="app" class="min-h-dvh bg-[--body-clr] text-[--text-clr]">
            <!--========== SIDEBAR START ==========-->
            @include("layouts.navigation")
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
                <div class="content__heading mb-8">
                    <h3
                        class="mb-2 mt-0 font-nunito text-[calc(1.3rem+.6vw)] font-bold"
                    >
                        @yield("page title", "Inventory Statistik")
                    </h3>
                </div>
                @yield("content")
            </main>
            <!--========== FOOTER START ==========-->
            <footer
                id="footer"
                class="footer mt-auto bg-[--container-clr] px-[5rem] text-[--text-clr]"
            >
                <div
                    id="footer-top "
                    class="grid grid-cols-12 gap-4 border-b-2 border-[--border-2-clr] py-6"
                >
                    <div id="footer-top-left " class="col-span-3 p-4">
                        <div class="title mb-3">
                            <h3
                                class="font-audioWide text-[1.25rem] font-bold text-[--primary-clr]"
                            >
                                Inventory Barang
                            </h3>
                        </div>
                        <div
                            class="desc text-justify text-[.5rem] font-medium leading-4"
                        >
                            <p>
                                Kami menyediakan layanan
                                <span class="text-[--primary-clr]">
                                    <em>Inventory</em>
                                    Barang
                                </span>
                                di jurusan
                                <span class="text-[--primary-clr]">
                                    <abbr
                                        title="Pengembangan Perangkat Lunak & Gim"
                                        class="border-none"
                                    >
                                        PPLG
                                    </abbr>
                                </span>
                                dengan tujuan mempermudah pengelolaan aset
                                secara efisien dan transparan.
                            </p>
                            <p>
                                Melalui sistem yang kami kembangkan, kami
                                berharap dapat mendukung kelancaran operasional
                                serta meningkatkan akuntabilitas dalam
                                penggunaan barang.
                            </p>
                        </div>
                    </div>
                    <div
                        id="footer-top-right"
                        class="col-span-8 grid grid-cols-1 gap-4 p-4 md:grid-cols-12"
                    >
                        <!-- INFORMASI -->
                        <div class="info__inventory col-span-12 md:col-span-4">
                            <div class="title mb-3">
                                <h3
                                    class="text-[1rem] font-bold text-[--primary-clr]"
                                >
                                    INFORMASI
                                </h3>
                            </div>
                            <ul class="space-y-1">
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Periksa Barang
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Status Stock Barang
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Kategori Barang
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Kondisi Barang
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Riwayat Peminjaman
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- TOOLS -->
                        <div class="info__tool col-span-12 md:col-span-4">
                            <div class="title mb-3">
                                <h3
                                    class="text-[1rem] font-bold text-[--primary-clr]"
                                >
                                    TOOLS
                                </h3>
                            </div>
                            <ul class="space-y-1">
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Tambah Stock
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Update Status
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Generate Laporan
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                    >
                                        Manajemen User
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- PERUSAHAAN & BANTUAN -->
                        <div
                            class="info__lainnya col-span-12 space-y-6 md:col-span-4"
                        >
                            <!-- PERUSAHAAN -->
                            <div class="company">
                                <div class="title mb-3">
                                    <h3
                                        class="text-[1rem] font-bold text-[--primary-clr]"
                                    >
                                        SMKN 4 PADALARANG
                                    </h3>
                                </div>
                                <div
                                    class="text-[.5rem] leading-4 text-[--text-2-clr]"
                                >
                                    <p>Jl. Raya Padalarang No.451.</p>
                                    <p>
                                        Kertajaya, Kec. Padalarang, Kabupaten
                                        Bandung Barat
                                    </p>
                                    <p>Jawa Barat 40553</p>
                                    <p class="mt-2">
                                        <span class="font-semibold">
                                            Jurusan RPL:
                                        </span>
                                        <br />
                                        Rekayasa Perangkat Lunak - Pengembangan
                                        sistem informasi dan aplikasi
                                    </p>
                                </div>
                            </div>

                            <!-- BANTUAN -->
                            <div class="help">
                                <div class="title mb-3">
                                    <h3
                                        class="text-[1rem] font-bold text-[--primary-clr]"
                                    >
                                        BANTUAN
                                    </h3>
                                </div>
                                <ul class="leading-4">
                                    <li>
                                        <a
                                            href="#"
                                            class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                        >
                                            Laporkan Bug
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="#"
                                            class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                        >
                                            Panduan Penggunaan
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="#"
                                            class="block text-[.5rem] font-medium text-[--text-2-clr] transition hover:text-[--primary-clr]"
                                        >
                                            FAQ
                                        </a>
                                    </li>
                                    <li>
                                        <div
                                            class="mt-2 text-[.5rem] text-[--text-2-clr]"
                                        >
                                            <p>Layanan Service:</p>
                                            <p class="font-semibold">
                                                inventory@smkn4pdl.sch.id
                                            </p>
                                            <p>(022) 6865XXX</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
            <!--========== FOOTER END ==========-->
            <!--========== MAIN CONTENT END ==========-->
        </div>
        <!-- Main Js -->
        <script
            src="{{ asset("js/main.js") }}"
            type="text/javascript"
            defer
        ></script>
    </body>
</html>
