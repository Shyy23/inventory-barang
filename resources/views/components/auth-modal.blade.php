<!-- Login -->
<div class="modal-enter fixed inset-0 hidden bg-black/50" id="authModal">
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-96 rounded-lg bg-white p-8">
            <!-- Tabs -->
            <div class="mb-4 flex border-b">
                <button
                    @click="activeTab='login'"
                    :class="{'border-b-2 border-blue-500': activeTab === 'login'}"
                    class="px-4 py-2 font-medium"
                >
                    Login
                </button>
                <button
                    @click="activeTab='register'"
                    :class="{'border-b-2 border-blue-500' : activeTab === 'register'}"
                    class="px-4 py-2 font-medium"
                >
                    Register
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
                        class="mb-2 w-full rounded border p-2"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="mb-4 w-full rounded border p-2"
                    />
                    <button class="w-full rounded bg-blue-500 p-2 text-white">
                        Login
                    </button>
                </form>

                <!-- Social Login -->
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("social.redirect", "google") }}"
                        class="block rounded bg-red-600 p-2 text-center text-white"
                    >
                        Login Dengan Google
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("social.redirect", "github") }}"
                        class="block rounded bg-gray-800 p-2 text-center text-white"
                    >
                        Login Dengan Github
                    </a>
                </div>

                <!-- Login Halaman Terpisah -->
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("password.request") }}"
                        class="text-sm text-blue-500 hover:underline"
                    >
                        Lupa Password?
                    </a>
                    <span class="mx-2">|</span>
                    <a
                        href="{{ route("register") }}"
                        class="text-sm text-blue-500 hover:underline"
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
                        class="mb-2 w-full rounded border p-2"
                    />
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="mb-2 w-full rounded border p-2"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="mb-2 w-full rounded border p-2"
                    />
                    <button class="w-full rounded bg-blue-500 p-2 text-white">
                        Daftar
                    </button>
                </form>

                <!-- Link Halaman Terpisah -->
                <div class="mt-4 text-center">
                    <a
                        href="{{ route("login") }}"
                        class="text-sm text-blue-500 hover:underline"
                    >
                        Login Via Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
