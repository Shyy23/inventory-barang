<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Reset password</title>

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
    <body class="bg-[--body-clr]">
        <div
            x-data="passwordReset()"
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
                        class="w-atuo mb-4 flex items-center text-[--primary-clr] hover:text-[--primary-hover-clr]"
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

                    <div
                        class="mx-auto max-w-md rounded bg-[--container-clr] p-8 shadow"
                    >
                        <h1 class="mb-6 text-2xl font-bold text-[--text-clr]">
                            Reset Password
                        </h1>

                        <!-- Step 1: Email Input -->
                        <div
                            x-show="step === 1"
                            x-transition:enter.duration.300ms
                        >
                            <form @submit.prevent="sendCode">
                                <div class="flex gap-2">
                                    <input
                                        type="email"
                                        name="email"
                                        x-model="email"
                                        placeholder="Email"
                                        class="inputModalLogin mb-4 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 text-[--text-clr] outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                                        required
                                    />
                                    <button
                                        type="submit"
                                        class="modal-btn h-fit rounded border border-transparent bg-[--primary-clr] p-2 px-4 font-semibold text-[--text-clr] transition-shadow"
                                        :disabled="isSending"
                                    >
                                        <span x-show="!isSending">
                                            Kirim
                                        </span>
                                        <span x-show="isSending">
                                            Mengirim...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Step 2: Code Verification -->
                        <div
                            x-show="step === 2"
                            x-transition:enter.duration.300ms
                        >
                            <form
                                @submit.prevent="verifyCode"
                                class="text-[--text-clr]"
                            >
                                <input
                                    type="text"
                                    x-model="code"
                                    placeholder="Kode Verifikasi"
                                    class="inputModalLogin mb-4 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                                    required
                                />
                                <button
                                    class="modal-btn w-full rounded border border-transparent bg-[--primary-clr] p-2 font-semibold text-[--text-clr] transition-shadow"
                                >
                                    Verifikasi Kode
                                </button>
                            </form>
                        </div>

                        <!-- Step 3: New Password -->
                        <div
                            x-show="step === 3"
                            x-transition:enter.duration.300ms
                        >
                            <form
                                @submit.prevent="resetPassword"
                                class="text-[--text-clr]"
                            >
                                <input
                                    type="password"
                                    x-model="password"
                                    placeholder="Password Baru"
                                    class="inputModalLogin mb-4 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                                    required
                                />
                                <input
                                    type="password"
                                    x-model="password_confirmation"
                                    placeholder="Konfirmasi Password"
                                    class="inputModalLogin mb-4 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                                    required
                                />
                                <button
                                    class="modal-btn w-full rounded border border-transparent bg-[--primary-clr] p-2 font-semibold text-[--text-clr] transition-shadow"
                                >
                                    Reset Password
                                </button>
                            </form>
                        </div>
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
        <!-- Tambahkan Alpine.js -->
        <script>
            window.routes = {
                resetPassword: {!! json_encode(route("password.reset")) !!},
                sendResetCode:
                    {!! json_encode(route("password.send-code")) !!},
                verifyCode: {!! json_encode(route("password.verify-code")) !!},
            };
        </script>
        <!-- Alpine.js harus di load SEBELUM script Anda -->
        <script
            defer
            src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.8/cdn.min.js"
        ></script>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="{{ asset("js/alertHandler.js") }}"></script>
        <script src="{{ asset("js/password-reset.js") }}"></script>
    </body>
</html>
