<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>

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
        <!-- Tambahkan Alpine.js -->
        <script
            defer
            src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.8/cdn.min.js"
        ></script>

        @stack("styles")

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif
        <style>
            input,
            textarea,
            select {
                min-height: 42px;
                box-shadow:
                    4px 4px 4px var(--shadow-input-clr) inset,
                    -3px -3px 3px var(--shadow-input-clr) inset;
            }

            .form-transition {
                transition: all 0.3s ease-in-out;
            }
            .form-enter {
                opacity: 0;
            }
            .form-enter-active {
                opacity: 1;
            }
            .form-leave-active {
                opacity: 0;
            }
        </style>
    </head>
    <body class="bg-[--body-clr]">
        <div
            x-data="{ isLogin: true }"
            class="grid min-h-screen grid-cols-1 md:grid-cols-2"
        >
            <!-- Kolom Kiri - Form -->
            <div class="flex items-center justify-center p-8">
                <div
                    class="relative w-full max-w-md space-y-6 rounded-xl border border-[--border-clr] bg-[--container-clr] p-8"
                >
                    <!-- Tombol Kembali -->
                    <a
                        href="/"
                        class="mb-4 flex items-center text-[--primary-clr] hover:text-[--primary-hover-clr]"
                    >
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"
                            />
                        </svg>
                        Kembali ke Home
                    </a>

                    <!-- Form Login -->
                    <div x-show="isLogin" class="form-transition space-y-6">
                        <h1 class="text-3xl font-bold text-[--text-clr]">
                            Masuk
                        </h1>
                        <form class="space-y-4">
                            <input
                                type="email"
                                placeholder="Email"
                                class="w-full rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] placeholder-[--text-2-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                class="w-full rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] placeholder-[--text-2-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                            />

                            <button
                                type="submit"
                                class="w-full rounded-lg bg-[--primary-clr] px-4 py-3 text-white transition-colors hover:bg-[--primary-hover-clr]"
                            >
                                Masuk
                            </button>
                        </form>

                        <!-- Pemisah dan Social Login -->
                        <div class="space-y-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div
                                        class="w-full border-t border-[--border-clr]"
                                    ></div>
                                </div>
                                <div
                                    class="relative flex justify-center text-sm"
                                >
                                    <span
                                        class="bg-[--container-clr] px-2 text-[--text-2-clr]"
                                    >
                                        atau
                                    </span>
                                </div>
                            </div>

                            <!-- Login Sosial -->
                            <div class="space-y-3">
                                <a
                               href="{{ route("social.redirect", "google") }}"
                                    class="flex w-full items-center justify-center gap-3 rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] transition-colors hover:bg-[--container-clr]"
                                >
                                    <img
                                        src="{{ asset("assets/icons/google.png") }}"
                                        alt="google"
                                        class="aspect-square w-6"
                                    />
                                    <span>Lanjutkan dengan Google</span>
                            </a>

                                <a
                                href="{{ route("social.redirect", "github") }}"
                                    class="flex w-full items-center justify-center gap-3 rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] transition-colors hover:bg-[--container-clr]"
                                >
                                    <img
                                        src="{{ asset("assets/icons/github.png") }}"
                                        alt="github"
                                        class="aspect-square w-5"
                                    />
                                    <span>Lanjutkan dengan GitHub</span>
                        </a>
                            </div>
                        </div>
                    </div>

                    <!-- Form Daftar -->
                    <div x-show="!isLogin" class="form-transition space-y-6">
                        <h1 class="text-3xl font-bold text-[--text-clr]">
                            Daftar
                        </h1>
                        <form class="space-y-4">
                            <input
                                type="text"
                                placeholder="Nama Lengkap"
                                class="w-full rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] placeholder-[--text-2-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                class="w-full rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] placeholder-[--text-2-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                class="w-full rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] placeholder-[--text-2-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                            />

                            <button
                                type="submit"
                                class="w-full rounded-lg bg-[--primary-clr] px-4 py-3 text-white transition-colors hover:bg-[--primary-hover-clr]"
                            >
                                Daftar
                            </button>
                        </form>

                        <!-- Pemisah dan Social Login -->
                        <div class="space-y-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div
                                        class="w-full border-t border-[--border-clr]"
                                    ></div>
                                </div>
                                <div
                                    class="relative flex justify-center text-sm"
                                >
                                    <span
                                        class="bg-[--container-clr] px-2 text-[--text-2-clr]"
                                    >
                                        atau
                                    </span>
                                </div>
                            </div>

                            <!-- Login Sosial -->
                            <div class="space-y-3">
                                <a
                                href="{{ route("social.redirect", "google") }}"
                                    class="flex w-full items-center justify-center gap-3 rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] transition-colors hover:bg-[--container-clr]"
                                >
                                    <img
                                        src="{{ asset("assets/icons/google.png") }}"
                                        alt="google"
                                        class="aspect-square w-6"
                                    />
                                    <span>Lanjutkan dengan Google</span>
                            </a>

                                <a
                                href="{{ route("social.redirect", "github") }}"
                                    class="flex w-full items-center justify-center gap-3 rounded-lg border border-[--border-clr] bg-[--body-clr] p-3 text-[--text-clr] transition-colors hover:bg-[--container-clr]"
                                >
                                    <img
                                        src="{{ asset("assets/icons/github.png") }}"
                                        alt="github"
                                        class="aspect-square w-5"
                                    />
                                    <span>Lanjutkan dengan GitHub</span>
                        </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tautan Toggle Form -->
                    <div class="text-center text-[--text-2-clr]">
                        <template x-if="isLogin">
                            <p>
                                Belum punya akun?
                                <a
                                    @click.prevent="isLogin = false"
                                    href="#"
                                    class="text-[--primary-clr] hover:underline"
                                >
                                    Daftar sekarang
                                </a>
                            </p>
                        </template>
                        <template x-if="!isLogin">
                            <p>
                                Sudah punya akun?
                                <a
                                    @click.prevent="isLogin = true"
                                    href="#"
                                    class="text-[--primary-clr] hover:underline"
                                >
                                    Masuk sekarang
                                </a>
                            </p>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Informasi -->
            <div
                class="relative hidden items-center justify-center overflow-hidden bg-[--container-clr] p-8 md:flex"
            >
                <div class="z-10 max-w-md space-y-8 text-[--text-clr]">
                    <h2
                        class="text-uppercase font-audioWide text-4xl font-bold"
                    >
                        Inventory Barang SMKN 4 Padalarang
                    </h2>
                    <p class="text-[--text-2-clr]">
                        Sistem inventory yang memudahkan pengelolaan barang di
                        Jurusan RPL.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[--green-clr]"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>
                            <span>Pengelolaan Aman</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[--blue-clr]"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                            </div>
                            <span>Fitur Pengelolaan Lengkap</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-[--purple-clr]"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                            </div>
                            <span>Kolaborasi Siswa & Guru</span>
                        </div>
                    </div>
                </div>

                <!-- Efek Gradien -->
                <div
                    class="absolute inset-0 bg-gradient-to-b from-[--glass-clr] to-transparent opacity-20"
                ></div>
            </div>
        </div>

        <!-- Footer -->
        <footer
            class="absolute bottom-0 w-full p-4 text-center text-sm text-[--text-2-clr]"
        >
            © 2025, Syahrul Hidayatulloh
        </footer>
    </body>
</html>
