<div
    class="modal-enter fixed inset-0 hidden bg-black/50"
    id="authModal"
    x-data="{ activeTab: 'login' }"
    x-cloak
>
    <div class="flex min-h-screen items-center justify-center">
        <div
            id="containerModal"
            class="container-modal w-96 rounded-lg bg-[--container-clr] p-8"
        >
            <!-- Tabs Group & Close Button -->
            <div
                class="mb-4 flex justify-between border-b-2 border-[--body-clr]"
            >
                <div class="auth-group">
                    <button
                        @click="activeTab = 'login'"
                        :class="{ 'border-b-2 border-[--primary-clr] text-[--primary-clr]': activeTab === 'login' }"
                        class="px-4 py-2 font-semibold"
                    >
                        Login
                    </button>
                    <button
                        @click="activeTab = 'register'"
                        :class="{ 'border-b-2 border-[--primary-clr] text-[--primary-clr]': activeTab === 'register' }"
                        class="px-4 py-2 font-semibold"
                    >
                        Register
                    </button>
                </div>

                <button
                    class="close transition-colors hover:text-[--primary-clr]"
                    id="close-modal-btn"
                    x-on:click="closeModal()"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Login Form -->
            <div x-show="activeTab === 'login'">
                <form
                    action="{{ route("login.submit") }}"
                    method="POST"
                    id="loginForm"
                >
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
                            <span
                                class="bg-[--container-clr] px-2 text-sm text-gray-500"
                            >
                                atau login dengan
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <a
                            href="{{ route("social.redirect", "google") }}"
                            class="social-link flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all"
                        >
                            <img
                                src="{{ asset("assets/icons/google.png") }}"
                                class="h-6 w-6"
                                alt="Google"
                            />
                            <span>Google</span>
                        </a>
                        <a
                            href="{{ route("social.redirect", "github") }}"
                            class="social-link flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all"
                        >
                            <img
                                src="{{ asset("assets/icons/github.png") }}"
                                class="h-6 w-6"
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
                </div>
            </div>

            <!-- Register Container -->
            <div class="flex flex-col" x-show="activeTab === 'register'">
                <!-- Register Form -->
                <div
                    class="step-1 register-content w-full translate-y-0 transform opacity-100 transition-all duration-300 ease-out"
                >
                    <form
                        action="{{ route("register.submit") }}"
                        method="POST"
                        id="initialRegisterForm"
                    >
                        @csrf
                        <input
                            type="text"
                            name="name"
                            id="nameRegister"
                            placeholder="Nama Lengkap"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <input
                            type="email"
                            name="email"
                            id="emailRegister"
                            placeholder="Email"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <input
                            type="password"
                            name="password"
                            id="passwordRegister"
                            placeholder="Password"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <button
                            class="modal-btn w-full rounded bg-[--primary-clr] p-2 text-[--text-clr] transition-shadow"
                            id="daftarButton"
                            type="button"
                        >
                            Daftar
                        </button>
                    </form>

                    <!-- Social Register -->
                    <div class="mt-4">
                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div
                                    class="w-full border-t border-gray-300"
                                ></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span
                                    class="bg-[--container-clr] px-2 text-sm text-gray-500"
                                >
                                    atau daftar dengan
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a
                                href="{{ route("social.redirect", "google") }}"
                                class="social-link flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all"
                            >
                                <img
                                    src="{{ asset("assets/icons/google.png") }}"
                                    class="h-6 w-6"
                                    alt="Google"
                                />
                                <span>Google</span>
                            </a>
                            <a
                                href="{{ route("social.redirect", "github") }}"
                                class="social-link flex w-full items-center justify-center gap-3 rounded bg-[--body-clr] p-2 text-sm font-medium text-[--text-clr] transition-all"
                            >
                                <img
                                    src="{{ asset("assets/icons/github.png") }}"
                                    class="h-6 w-6"
                                    alt="Github"
                                />
                                <span>Github</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Student Form -->
                <div
                    class="step-2 StudentForm hidden w-full translate-y-4 transform opacity-0 transition-all duration-300 ease-out"
                >
                    <button
                        type="button"
                        id="backButton"
                        class="mb-4 text-sm text-[--primary-clr] hover:underline"
                    >
                        ← Kembali ke Form Awal
                    </button>
                    <form action="" id="studentForm" class="space-y-2">
                        <input
                            type="text"
                            name="nisn"
                            placeholder="NISN"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <input
                            type="text"
                            name="student_name"
                            id="student_name"
                            placeholder="Nama Siswa"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <select
                            name="gender"
                            id="Jenis Kelamin"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                        >
                            <option value="">Jenis Kelamin</option>
                            <option value="M">Laki-Laki</option>
                            <option value="F">Perempuan</option>
                        </select>
                        <select
                            name="class_id"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        >
                            <option value="">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->class_id }}">
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                        <input
                            type="text"
                            name="phone_number"
                            placeholder="Nomor Telepon"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <input
                            type="text"
                            name="address"
                            placeholder="Alamat"
                            class="inputModalLogin mb-2 w-full rounded border-2 border-transparent bg-[--body-clr] p-2 outline-none hover:border-[--shadow-input-clr] focus:border-[--shadow-input-clr]"
                            required
                        />
                        <button
                            type="submit"
                            class="modal-btn w-full rounded border border-transparent bg-[--primary-clr] p-2 font-semibold text-[--text-clr] transition-shadow"
                        >
                            Daftar
                        </button>
                    </form>
                    <button
                        type="button"
                        id="guestButton"
                        class="modal-btn mt-2 w-full rounded border border-transparent bg-[--body-clr] p-2 font-semibold text-[--text-clr] transition-shadow"
                    >
                        Lanjutkan sebagai Guest
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
