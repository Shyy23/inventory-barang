@extends("layouts.app")
@section("title", "Dashboard Inventory")
@section("content")
    <!-- Body of Content -->
    <div class="page__content">
        <section class="wrapper mx-1 mt-0 grid grid-cols-12 gap-3">
            <!-- Stat of Highlight Item -->
            <div class="highlight__item col-span-12 pr-4 lg:col-span-9">
                <div class="highlight-count mb-9 grid grid-cols-12 gap-3">
                    <!-- Card Start -->
                    <div class="col-span-6 px-1 md:col-span-6 lg:col-span-3">
                        <div
                            class="card rounded-xl bg-[--container-clr] text-[--text-clr] shadow-lg"
                        >
                            <div class="card__body p-6">
                                <div class="card__content grid grid-cols-12">
                                    <div
                                        class="icon__card col-span-4 mb-2 grid w-full justify-start lg:col-span-12 xl:col-span-12 2xl:col-span-5"
                                    >
                                        <div
                                            class="icon__stats flex h-12 w-12 items-center justify-center rounded-lg bg-[--blue-clr]"
                                        >
                                            <i
                                                class="fa-solid fa-graduation-cap text-xl text-white"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="card_info grid md:col-span-8 lg:col-span-12 xl:col-span-12 2xl:col-span-7"
                                    >
                                        <h6
                                            class="text-sm font-semibold text-[--secondary-clr]"
                                        >
                                            Jumlah Siswa
                                        </h6>
                                        <h6
                                            class="font-extrabold text-[--text-clr]"
                                        >
                                            {{ $jumlahSiswa ?? "Na" }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card End  -->
                    <!-- Card Start -->
                    <div class="col-span-6 px-1 md:col-span-6 lg:col-span-3">
                        <div
                            class="card rounded-xl bg-[--container-clr] text-[--text-clr] shadow-lg"
                        >
                            <div class="card__body p-6">
                                <div class="card__content grid grid-cols-12">
                                    <div
                                        class="icon__card col-span-4 mb-2 grid w-full justify-start lg:col-span-12 xl:col-span-12 2xl:col-span-5"
                                    >
                                        <div
                                            class="icon__stats flex h-12 w-12 items-center justify-center rounded-lg bg-[--purple-clr]"
                                        >
                                            <i
                                                class="fa-solid fa-box text-xl text-white"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="card_info grid md:col-span-8 lg:col-span-12 xl:col-span-12 2xl:col-span-7"
                                    >
                                        <h6
                                            class="text-sm font-semibold text-[--secondary-clr]"
                                        >
                                            Jumlah Barang
                                        </h6>
                                        <h6
                                            class="font-extrabold text-[--text-clr]"
                                        >
                                            {{ $jumlahBarang ?? "Na" }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card End  -->
                    <!-- Card Start -->
                    <div class="col-span-6 px-1 md:col-span-6 lg:col-span-3">
                        <div
                            class="card rounded-xl bg-[--container-clr] text-[--text-clr] shadow-lg"
                        >
                            <div class="card__body p-6">
                                <div class="card__content grid grid-cols-12">
                                    <div
                                        class="icon__card col-span-4 mb-2 grid w-full justify-start lg:col-span-12 xl:col-span-12 2xl:col-span-5"
                                    >
                                        <div
                                            class="icon__stats flex h-12 w-12 items-center justify-center rounded-lg bg-[--green-clr]"
                                        >
                                            <i
                                                class="fa-solid fa-clipboard-check text-xl text-white"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="card_info grid md:col-span-8 lg:col-span-12 xl:col-span-12 2xl:col-span-7"
                                    >
                                        <h6
                                            class="text-sm font-semibold text-[--secondary-clr]"
                                        >
                                            Jumlah Pinjaman
                                        </h6>
                                        <h6
                                            class="font-extrabold text-[--text-clr]"
                                        >
                                            {{ $jumlahBarangDipinjam ?? "Na" }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card End  -->
                    <!-- Card Start -->
                    <div class="col-span-6 px-1 md:col-span-6 lg:col-span-3">
                        <div
                            class="card rounded-xl bg-[--container-clr] text-[--text-clr] shadow-lg"
                        >
                            <div class="card__body p-6">
                                <div class="card__content grid grid-cols-12">
                                    <div
                                        class="icon__card col-span-4 mb-2 grid w-full justify-start lg:col-span-12 xl:col-span-12 2xl:col-span-5"
                                    >
                                        <div
                                            class="icon__stats flex h-12 w-12 items-center justify-center rounded-lg bg-[--red-clr]"
                                        >
                                            <i
                                                class="fa-solid fa-circle-exclamation text-xl text-white"
                                            ></i>
                                        </div>
                                    </div>
                                    <div
                                        class="card_info grid md:col-span-8 lg:col-span-12 xl:col-span-12 2xl:col-span-7"
                                    >
                                        <h6
                                            class="text-sm font-semibold text-[--secondary-clr]"
                                        >
                                            Pinjaman Tertunda
                                        </h6>
                                        <h6
                                            class="font-extrabold text-[--text-clr]"
                                        >
                                            {{ $jumlahPinjamanTertunda ?? "Na" }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card End  -->
                </div>
                <!-- Stat of Highlight Stock Start-->
                <div class="highlight__stock grid grid-cols-12">
                    <!-- Chart Start -->
                    <div
                        class="card__chart relative col-span-12 mb-[2.2rem] grid rounded-xl bg-[--container-clr] p-4 text-[--text-clr] shadow-lg"
                    >
                        <div class="card__header p-2">
                            <h4 class="text-[1.2rem] font-bold">Stok Barang</h4>
                        </div>
                        <div
                            class="card__body col-span-12 whitespace-normal break-words p-4"
                        >
                            <canvas
                                id="chartStockBarang"
                                class="min-h-[315px]"
                            ></canvas>
                        </div>
                    </div>

                    <!-- Chart End -->
                </div>
                <!-- Stat of Highlight Stock End-->

                <!-- Latest Loan  Start -->
                <div class="highlight__product grid grid-cols-12">
                    <div
                        id="card__loan__stat "
                        class="relative col-span-12 mb-[2.2rem] grid rounded-xl bg-[--container-clr] p-4 text-[--text-clr] shadow-lg"
                    >
                        <div class="card__header mb-4 p-2">
                            <h4 class="text-[1.2rem] font-bold">
                                Peminjaman Terbaru
                            </h4>
                        </div>
                        <div class="card__body col-span-12 grid">
                            <table class="grid w-full">
                                <thead class="p-4 text-[--text-clr]">
                                    <tr
                                        class="grid grid-cols-4 border-b-2 border-[--text-clr] p-2"
                                    >
                                        <th class="col-span-1 text-start">
                                            Peminjam
                                        </th>
                                        <th class="col-span-1 text-start">
                                            Nama Barang
                                        </th>
                                        <th class="col-span-1 text-start">
                                            Waktu Peminjaman
                                        </th>
                                        <th class="col-span-1 text-start">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    id="aktivitasTerbaru"
                                    class="grid gap-4 p-4 text-[--text-clr]"
                                >
                                    @foreach ($aktivitasTerbaru as $aktivitas)
                                        <tr
                                            class="grid grid-cols-4 border-b border-[rgba(255,255,255,.2)] p-2"
                                        >
                                            <td class="col-span-1 text-start">
                                                {{ $aktivitas->student_name }}
                                            </td>
                                            <td class="col-span-1 text-start">
                                                {{ $aktivitas->item_name }}
                                            </td>
                                            <td class="col-span-1 text-start">
                                                {{ $aktivitas->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="col-span-1 text-start">
                                                <div
                                                    class="status__icon d-inline-block group relative cursor-pointer"
                                                    data-status="{{ $aktivitas->loan_status }}"
                                                >
                                                    <i
                                                        class="fas"
                                                        data-tooltip=""
                                                    ></i>
                                                    <span class="pl-1">
                                                        {{ $aktivitas->loan_status }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Latest Loan  End -->
            </div>
            <!-- Stat of Highlight User -->
            <div
                class="highlight__user col-span-12 gap-4 space-y-6 lg:col-span-3"
            >
                <div
                    class="card__profile rounded-xl bg-[--container-clr] text-[--text-clr] shadow-lg"
                >
                    <div class="p-6">
                        <div class="grid grid-cols-12 items-center gap-4">
                            <!-- Avatar Section -->
                            <div class="col-span-1 lg:col-span-4">
                                <div
                                    class="h-[60px] w-[60px] overflow-hidden rounded-full"
                                >
                                    <img
                                        src="{{ asset("assets/images/app/school.png") }}"
                                        alt="pp"
                                        class="h-full w-full object-contain"
                                    />
                                </div>
                            </div>

                            <!-- Profile Info -->
                            <div
                                class="col-span-11 ml-4 space-y-1 lg:col-span-8 lg:ml-2"
                            >
                                <h5
                                    class="text-start text-lg font-semibold tracking-tight lg:text-[1rem] lg:leading-5"
                                >
                                    SMKN 4 Padalarang
                                </h5>
                                <h6
                                    class="text-sm font-medium text-[--text-clr]"
                                >
                                    Inventory Barang PPLG
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stat Category Start -->
                <div
                    class="rounded-xl bg-[--container-clr] p-6 text-[--text-clr] shadow-lg"
                >
                    <!-- Card -->
                    <div class="grid items-center">
                        <!-- Card header -->
                        <div class="mb-4 p-2">
                            <h4 class="text-[1.2rem] font-bold">
                                Kategori Barang
                            </h4>
                        </div>
                        <!-- Card Body -->
                        <div class="p-4">
                            <div
                                id="chart-container"
                                class="relative w-[200px]"
                            >
                                <canvas id="categoryPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Category End -->
                <!-- Pending Info Start -->
                <div
                    class="rounded-xl bg-[--container-clr] p-6 text-[--text-clr] shadow-lg"
                >
                    <div class="grid items-center gap-4">
                        <!-- card header -->
                        <div class="mb-4 p-2">
                            <h4 class="text-lg font-bold lg:text-[1rem]">
                                Peminjaman tertunda
                            </h4>
                        </div>
                        <!-- card body -->
                        <div class="grid gap-4">
                            @foreach ($pinjamanTertunda as $pinjaman)
                                <!-- card content start-->
                                <div
                                    class="grid grid-cols-5 border-b border-[rgba(255,255,255,.2)] pb-2"
                                >
                                    <h3
                                        class="col-span-2 text-sm font-semibold"
                                    >
                                        {{ $pinjaman->item_name }}
                                    </h3>
                                    <p
                                        class="col-span-1 pr-2 text-end text-sm font-semibold"
                                    >
                                        {{ $pinjaman->item_quantity }}
                                    </p>
                                    <p
                                        class="col-span-2 text-center text-sm font-semibold text-[rgba(255,255,255,.2)]"
                                    >
                                        {{ $pinjaman->loan_date->diffForHumans() }}
                                    </p>
                                </div>
                                <!-- card content end-->
                            @endforeach

                            <button
                                class="my-2 rounded-md border-2 border-[--primary-clr] bg-[--transparent] p-4 text-[--primary-clr] shadow-lg hover:bg-[--primary-clr] hover:text-[--text-clr]"
                            >
                                <a href="#" class="text-sm font-bold">
                                    Approve Peminjaman
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Pending Info End -->
                <!-- Data Stock Item Darurat Start -->
                <div
                    class="rounded-xl bg-[--container-clr] p-6 text-[--text-clr] shadow-lg"
                >
                    <div class="grid items-center gap-4">
                        <!-- card header -->
                        <div class="mb-4 p-2">
                            <h4 class="text-lg font-bold lg:text-[1rem]">
                                Stock Darurat
                            </h4>
                        </div>
                        <!-- card body -->
                        <div class="stock-info-item grid gap-4">
                            @foreach ($barangStokMauHabis as $barang)
                                <!-- card content start-->
                                <div
                                    class="grid grid-cols-4 border-b border-[rgba(255,255,255,.2)] pb-2"
                                >
                                    <h3
                                        class="col-span-2 text-sm font-semibold"
                                    >
                                        {{ $barang->item_name }}
                                    </h3>
                                    <p
                                        class="col-span-1 pr-2 text-end text-sm font-semibold"
                                    >
                                        {{ $barang->stock }}
                                    </p>
                                    <!-- Untuk Stok Barang -->
                                    <div
                                        class="item-stock"
                                        data-stock="{{ $barang->stock }}"
                                    >
                                        <i
                                            class="fas icon-stock"
                                            data-tooltip=""
                                        ></i>
                                    </div>
                                </div>
                                <!-- card content end-->
                            @endforeach

                            <button
                                class="my-2 rounded-md border-2 border-[--red-2-clr] bg-[--transparent] p-4 text-[--red-2-clr] shadow-lg hover:bg-[--red-2-clr] hover:text-[--text-clr]"
                            >
                                <a href="#" class="text-sm font-bold">
                                    Tambah Stock
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Data Stock Item Darurat End -->
                <!-- Data Jumlah Siswa Start -->
                <div
                    class="rounded-xl bg-[--container-clr] p-6 text-[--text-clr] shadow-lg"
                >
                    <div class="grid items-center gap-4">
                        <!-- card header -->
                        <div class="mb-4 p-2">
                            <h4 class="text-lg font-bold lg:text-[1rem]">
                                Data Jumlah Siswa
                            </h4>
                        </div>
                        <!-- card body -->
                        <div class="grid gap-4">
                            @foreach ($jumlahSiswaKelas as $siswa)
                                <!-- card content start-->
                                <div
                                    class="grid grid-cols-4 border-b border-[rgba(255,255,255,.2)] pb-2"
                                >
                                    <h3
                                        class="col-span-2 text-sm font-semibold"
                                    >
                                        {{ $siswa->class_name }}
                                    </h3>
                                    <p
                                        class="col-span-1 pr-2 text-end text-sm font-semibold"
                                    >
                                        {{ $siswa->total }}
                                    </p>
                                    <p
                                        class="col-span-1 text-center text-sm font-semibold text-[rgba(255,255,255,.2)]"
                                    >
                                        <i
                                            class="fas fa-user text-[--green-clr]"
                                        ></i>
                                    </p>
                                </div>
                                <!-- card content end-->
                            @endforeach

                            <button
                                class="my-2 rounded-md border-2 border-[--green-3-clr] bg-[--transparent] p-4 text-[--green-3-clr] shadow-lg hover:bg-[--green-3-clr] hover:text-[--text-clr]"
                            >
                                <a href="#" class="text-sm font-bold">
                                    Lihat Kelas
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Data Jumlah Siswa End -->
            </div>
        </section>
    </div>

    @push("scripts")
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
        <script src="{{ asset("js/utility/Chart.js") }}"></script>
    @endpush
@endsection
