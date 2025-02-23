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
                <div class="social-group-login flex justify-center gap-2">
                    <div class="mt-4 text-center">
                        <a
                            href="{{ route("social.redirect", "google") }}"
                            class="social-login-icon block rounded bg-[--text-clr] p-2 text-center text-[--text-clr]"
                        >
                            <img
                                src="{{ asset("assets/icons/google.png") }}"
                                alt=""
                                class="w-8"
                            />
                        </a>
                    </div>
                    <div class="mt-4 text-center">
                        <a
                            href="{{ route("social.redirect", "github") }}"
                            class="social-login-icon block rounded bg-[--text-clr] p-2 text-center text-[--text-clr]"
                        >
                            <img
                                src="{{ asset("assets/icons/github.png") }}"
                                alt=""
                                class="w-8"
                            />
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
