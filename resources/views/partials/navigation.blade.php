<nav
    id="sidebar"
    class="fixed top-0 z-[100] box-border h-screen w-[250px] self-start overflow-hidden text-nowrap border-r border-solid border-line bg-[--container-clr] p-[5px_1em] transition-all duration-[300ms] ease-in-out"
>
    <ul>
        <li>
            <span class="logo font-audioWide">Inventory</span>
            <button
                id="close-btn"
                class="ml-auto cursor-pointer rounded-[.5em] p-[1em] text-[--primary-clr]"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
            <button
                onclick="toggleSidebar()"
                id="toggle-btn"
                class="ml-auto cursor-pointer rounded-[.5em] p-[1em]"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0"
                >
                    <path
                        d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"
                    />
                </svg>
            </button>
        </li>
        <li>
            <a href="{{ route('home') }}">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0"
                >
                    <path
                        d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"
                    />
                </svg>
                <span class="font-medium">Home</span>
            </a>
        </li>
        <li class="active">
            <a href="{{ route("admin.dashboard") }}">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0"
                >
                    <path
                        d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z"
                    />
                </svg>

                <span class="font-medium">Dashboard</span>
            </a>
        </li>
        <li>
            <button
                onclick="toggleSubMenu(this)"
                class="dropdown__btn w-full cursor-pointer border-none bg-none text-left"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"
                    />
                </svg>
                <span class="font-medium">Manage User</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"
                    />
                </svg>
            </button>
            <ul
                class="sub__menu grid grid-rows-[0fr] transition-all duration-[300ms] ease-in-out"
            >
                <div class="overflow-hidden">
                    <li><a href="#" class="pl-[2em_!important]">Siswa</a></li>
                    <li><a href="#" class="pl-[2em_!important]">Guru</a></li>
                    <li>
                        <a href="#" class="pl-[2em_!important]">Detail Guru</a>
                    </li>
                </div>
            </ul>
        </li>
        <li>
            <button
                onclick="toggleSubMenu(this)"
                class="dropdown__btn w-full cursor-pointer border-none bg-none text-left"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-80 92L160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11Zm200-528 77-44-237-137-78 45 238 136Zm-160 93 78-45-237-137-78 45 237 137Z"
                    />
                </svg>
                <span class="font-medium">Manage Barang</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"
                    />
                </svg>
            </button>
            <ul
                class="sub__menu grid grid-rows-[0fr] transition-all duration-[300ms] ease-in-out"
            >
                <div class="overflow-hidden">
                    <li>
                        <a
                            href="{{ route("items.index") }}"
                            class="pl-[2em_!important]"
                        >
                            Barang
                        </a>
                    </li>
                    <li>
                        <a href="#" class="pl-[2em_!important]">Kategori</a>
                    </li>
                    <li><a href="#" class="pl-[2em_!important]">Lokasi</a></li>
                </div>
            </ul>
        </li>
        <li>
            <button
                onclick="toggleSubMenu(this)"
                class="dropdown__btn w-full cursor-pointer border-none bg-none text-left"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M480-120q-138 0-240.5-91.5T122-440h82q14 104 92.5 172T480-200q117 0 198.5-81.5T760-480q0-117-81.5-198.5T480-760q-69 0-129 32t-101 88h110v80H120v-240h80v94q51-64 124.5-99T480-840q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-480q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-120Zm112-192L440-464v-216h80v184l128 128-56 56Z"
                    />
                </svg>
                <span class="font-medium">Peminjaman</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0 transition-all duration-[200ms] ease-in-out"
                >
                    <path
                        d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"
                    />
                </svg>
            </button>
            <ul
                class="sub__menu grid grid-rows-[0fr] transition-all duration-[300ms] ease-in-out"
            >
                <div class="overflow-hidden">
                    <li>
                        <a href="#" class="pl-[2em_!important]">
                            Riwayat Peminjaman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loans.delayed-loans') }}"} class="pl-[2em_!important]">
                            Peminjaman Tertunda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loans.monitoring') }}" class="pl-[2em_!important]">
                            Detail Peminjaman
                        </a>
                    </li>
                    <li>
                        <a href="#" class="pl-[2em_!important]">
                            Peminjaman Kelas
                        </a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
    <!-- Bottom section -->
    <ul
        class="absolute bottom-0 box-border flex w-[220px] flex-col self-end overflow-hidden"
    >
        <li></li>
        <li class="order-1">
            <a href="#">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                    class="shrink-0"
                >
                    <path
                        d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"
                    />
                </svg>
                <span class="font-medium">Setting</span>
            </a>
        </li>
        <li class="">
            <form action="{{ route("logout") }}" method="POST" class="w-full">
                @csrf
                <button
                    id="logout"
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-md text-[--text-clr]"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="24px"
                        viewBox="0 -960 960 960"
                        width="24px"
                        fill="currentColor"
                        class="shrink-0"
                    >
                        <path
                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"
                        />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </li>
        <li class="">
            <a href="#">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 -960 960 960"
                    width="24px"
                    fill="#e8eaed"
                >
                    <path
                        d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z"
                    />
                </svg>

                <span class="font-medium">Theme</span>
            </a>
        </li>
    </ul>
</nav>
