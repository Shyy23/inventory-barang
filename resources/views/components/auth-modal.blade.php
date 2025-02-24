<!-- Login -->
<div class="modal-enter fixed inset-0 hidden bg-black/50" id="authModal">
    <div class="flex min-h-screen items-center justify-center">
        <div
            id="containerModal"
            class="container-modal w-96 rounded-lg bg-[--container-clr] p-8"
        >
            <!-- Tabs -->
            <div class="mb-4 flex justify-between border-b">
                <div class="auth-group">
                    <button
                        @click="activeTab='login'"
                        :class="{'border-b-2 border-[--primary-clr]': activeTab === 'login'}"
                        class="px-4 py-2 font-semibold"
                    >
                        Login
                    </button>
                    <button
                        @click="activeTab='register'"
                        :class="{'border-b-2 border-[--primary-clr]' : activeTab === 'register'}"
                        class="px-4 py-2 font-semibold"
                    >
                        Register
                    </button>
                </div>

                <button
                    class="close transition-colors hover:text-[--primary-clr]"
                    id="close-modal-btn"
                    onclick="closeModal()"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Login Form -->
            <div x-show="activeTab === 'login'">
                <form action="{{ route("login") }}" method="POST">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                    />
                    <button
                        class="modal-btn w-full rounded border border-transparent bg-[--primary-clr] p-2 font-semibold text-[--text-clr] transition-shadow"
                    >
                        Login
                    </button>
                </form>

                <!-- Social Login -->
                <div class="mt-4">
                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-[--container-clr] px-2 text-sm text-gray-500">
                                atau login dengan
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <a
                            href="{{ route("social.redirect", "google") }}"
                            class="flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all social-link "
                        >
                            <img
                                src="{{ asset("assets/icons/google.png") }}"
                                class="w-6 h-6"
                                alt="Google"
                            />
                            <span>Google</span>
                        </a>
                        <a
                            href="{{ route("social.redirect", "github") }}"
                            class="flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all social-link "
                        >
                            <img
                                src="{{ asset("assets/icons/github.png") }}"
                                class="w-6 h-6"
                                alt="Github"
                            />
                            <span>Github</span>
                        </a>
                    </div>
                </div>

                <!-- Login Halaman Terpisah -->
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("password.request") }}"
                        class="text-sm text-[--primary-clr] hover:underline"
                    >
                        Lupa Password?
                    </a>
                    <span class="mx-2">|</span>
                    <a
                        href="{{ route("register") }}"
                        class="text-sm text-[--primary-clr] hover:underline"
                    >
                        Daftar Via Halaman
                    </a>
                </div>
            </div>

            <!-- Register Form -->
            <div class="" x-show="activeTab === 'register'">
                <form action="{{ route("register") }}" method="POST">
                    @csrf
                    <input
                        type="text"
                        name="name"
                        placeholder="Nama Lengkap"
                        class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                    />
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                    />
                    <button
                        class="modal-btn w-full rounded bg-[--primary-clr] p-2 text-[--text-clr] transition-shadow"
                    >
                        Daftar
                    </button>
                </form>

                <!-- Social Register -->
                <div class="mt-4">
                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-[--container-clr] px-2 text-sm text-gray-500">
                                atau daftar dengan
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <a
                            href="{{ route("social.redirect", "google") }}"
                            class="flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all social-link "
                        >
                            <img
                                src="{{ asset("assets/icons/google.png") }}"
                                class="w-6 h-6"
                                alt="Google"
                            />
                            <span>Google</span>
                        </a>
                        <a
                            href="{{ route("social.redirect", "github") }}"
                            class="flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all social-link "
                        >
                            <img
                                src="{{ asset("assets/icons/github.png") }}"
                                class="w-6 h-6"
                                alt="Github"
                            />
                            <span>Github</span>
                        </a>
                    </div>
                </div>

                <!-- Link Halaman Terpisah -->
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("login") }}"
                        class="text-sm text-[--primary-clr] hover:underline"
                    >
                        Login Via Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>