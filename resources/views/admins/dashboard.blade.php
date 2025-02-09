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
                            <canvas id="myChart" class="min-h-[315px]"></canvas>
                        </div>
                    </div>

                    <!-- Chart End -->
                </div>
                <!-- Stat of Highlight Stock End-->

                <!-- Stat Product where that show in chart Start -->
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
                                <tbody class="grid gap-4 p-4 text-[--text-clr]">
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
                                                    <i class="fas"></i>
                                                    <span
                                                        class="status__tooltip pl-1"
                                                    >
                                                        Dipinjam
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
                <!-- Stat Product where that show in chart End -->
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
                                    class="h-[60px] w-[60px] overflow-hidden rounded-full border-2 border-[--primary-clr]"
                                >
                                    <img
                                        src="{{ asset("assets/images/users/pp.jpg") }}"
                                        alt="pp"
                                        class="h-full w-full object-cover"
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
                                    Syahrul Hidayatulloh
                                </h5>
                                <h6
                                    class="text-sm font-medium text-[--text-clr]"
                                >
                                    @it.s_meshy_y
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delayed Info Start -->
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
                                    class="grid grid-cols-4 border-b border-[rgba(255,255,255,.2)] pb-2"
                                >
                                    <h3
                                        class="col-span-1 text-sm font-semibold"
                                    >
                                        {{ $pinjaman->item_name }}
                                    </h3>
                                    <p
                                        class="col-span-1 pr-2 text-end text-sm font-semibold"
                                    >
                                        {{ $pinjaman->item_quantity }}
                                    </p>
                                    <p
                                        class="col-span-2 text-sm font-semibold text-[rgba(255,255,255,.2)]"
                                    >
                                        {{ $pinjaman->loan_date->diffForHumans() }}
                                    </p>
                                </div>
                                <!-- card content end-->
                            @endforeach

                            <button
                                class="my-2 rounded-md border-2 border-[--primary-clr] bg-[--transparent] p-4 text-[--primary-clr] shadow-lg hover:bg-[--primary-clr] hover:text-[--text-clr]"
                            >
                                <a href="#" class="text-sm font-semibold">
                                    Approve Peminjaman
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Delayed Info End -->
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const stocks = @json($chartData);
        const labels = @json($chartLabels);
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            // Ambil warna dari variabel CSS
            const rootStyles = getComputedStyle(document.documentElement);
            const redColor = rootStyles.getPropertyValue('--red-clr').trim();
            const yellowColor = rootStyles
                .getPropertyValue('--yellow-clr')
                .trim();
            const textColor = rootStyles.getPropertyValue('--text-clr').trim();
            const primaryColor = rootStyles
                .getPropertyValue('--primary-clr')
                .trim();
            // Data dari database (contoh)
            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Stok Barang',
                        data: stocks, // Jumlah stok
                        backgroundColor: function (context) {
                            const value = context.raw; // Ambil nilai stok
                            if (value < 5) {
                                return redColor;
                            } else if (value < 8) {
                                return yellowColor;
                            } else {
                                return primaryColor;
                            }
                        },
                        borderRadius: '.25rem',
                        borderColor: 'transparent', // Warna border batang
                        borderWidth: 1,
                    },
                ],
            };

            // Konfigurasi chart
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: textColor,
                                autoSkip: false,
                                maxRotation: 0, // Rotasi label nama barang
                                minRotation: 0,
                                font: {
                                    size: 10,
                                },
                                callback: function (value, index, values) {
                                    let label = labels[index]; // Ambil teks asli dari labels
                                    return label.split(' ');
                                },
                            },
                            grid: {
                                display: false, // Hilangkan grid vertikal
                            },
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 8, // Hitungan per 8 (8, 16, 24, 32)
                                font: {
                                    size: 12,
                                },
                                callback: function (value) {
                                    return value; // Tampilkan nilai stok
                                },
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)', // Warna garis horizontal
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: false, // Sembunyikan legend
                        },
                        tooltip: {
                            enabled: true, // Aktifkan tooltip
                        },
                    },
                },
            };

            // Inisialisasi chart
            const myChart = new Chart(ctx, config);
        });
    </script>
@endsection
