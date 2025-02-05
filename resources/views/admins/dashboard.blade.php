@extends("layouts.app")
@section("title", "Dashboard Inventory")
@section("content")
    <div class="container mx-auto p-4">
        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Card Jumlah Siswa -->
            <div class="flex items-center rounded-lg bg-white p-6 shadow-md">
                <div class="rounded-full bg-blue-100 p-3">
                    <i class="fas fa-users text-2xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Jumlah Siswa</h3>
                    <p class="text-gray-600">{{ $jumlahSiswa }}</p>
                </div>
            </div>

            <!-- Card Jumlah Barang -->
            <div class="flex items-center rounded-lg bg-white p-6 shadow-md">
                <div class="rounded-full bg-green-100 p-3">
                    <i class="fas fa-boxes text-2xl text-green-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Jumlah Barang</h3>
                    <p class="text-gray-600">{{ $jumlahBarang }}</p>
                </div>
            </div>

            <!-- Card Jumlah Pinjaman Tertunda -->
            <div class="flex items-center rounded-lg bg-white p-6 shadow-md">
                <div class="rounded-full bg-yellow-100 p-3">
                    <i
                        class="fas fa-exclamation-triangle text-2xl text-yellow-500"
                    ></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Pinjaman Tertunda</h3>
                    <p class="text-gray-600">{{ $jumlahPinjamanTertunda }}</p>
                </div>
            </div>

            <!-- Card Jumlah Barang Masih Dipinjam -->
            <div class="flex items-center rounded-lg bg-white p-6 shadow-md">
                <div class="rounded-full bg-red-100 p-3">
                    <i class="fas fa-box-open text-2xl text-red-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Barang Dipinjam</h3>
                    <p class="text-gray-600">{{ $jumlahBarangDipinjam }}</p>
                </div>
            </div>
        </div>

        <!-- Highlight Barang -->
        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Card Barang Baru Dipinjam -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <img
                    src="{{ asset("path/to/image.jpg") }}"
                    alt="Barang Baru Dipinjam"
                    class="h-32 w-full rounded-lg object-cover"
                />
                <h3 class="mt-4 text-lg font-semibold">Barang Baru Dipinjam</h3>
                <p class="text-gray-600">
                    Nama Barang: {{ $barangBaruDipinjam->nama }}
                </p>
                <p class="text-gray-600">
                    Stok: {{ $barangBaruDipinjam->stok }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $barangBaruDipinjam->deskripsi }}
                </p>
            </div>

            <!-- Card Barang Sering Dipinjam -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <img
                    src="{{ asset("path/to/image.jpg") }}"
                    alt="Barang Sering Dipinjam"
                    class="h-32 w-full rounded-lg object-cover"
                />
                <h3 class="mt-4 text-lg font-semibold">
                    Barang Sering Dipinjam
                </h3>
            </div>

            <!-- Card Barang Stok Mau Habis -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <img
                    src="{{ asset("path/to/image.jpg") }}"
                    alt="Barang Stok Mau Habis"
                    class="h-32 w-full rounded-lg object-cover"
                />
                <h3 class="mt-4 text-lg font-semibold">
                    Barang Stok Mau Habis
                </h3>
                <p class="text-gray-600">
                    Nama Barang: {{ $barangStokMauHabis->nama }}
                </p>
                <p class="text-gray-600">
                    Stok: {{ $barangStokMauHabis->stok }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $barangStokMauHabis->deskripsi }}
                </p>
            </div>

            <!-- Card Barang Stok Terbanyak -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <img
                    src="{{ asset("path/to/image.jpg") }}"
                    alt="Barang Stok Terbanyak"
                    class="h-32 w-full rounded-lg object-cover"
                />
                <h3 class="mt-4 text-lg font-semibold">
                    Barang Stok Terbanyak
                </h3>
                <p class="text-gray-600">
                    Nama Barang: {{ $barangStokTerbanyak->nama }}
                </p>
                <p class="text-gray-600">
                    Stok: {{ $barangStokTerbanyak->stok }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $barangStokTerbanyak->deskripsi }}
                </p>
            </div>
        </div>

        <!-- Chart Batang -->
        <div class="mb-8 rounded-lg bg-white p-6 shadow-md">
            <h3 class="mb-4 text-lg font-semibold">Stok Barang</h3>
            <canvas id="barangChart"></canvas>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="rounded-lg bg-white p-6 shadow-md">
            <h3 class="mb-4 text-lg font-semibold">Aktivitas Terbaru</h3>
            <ul>
                @foreach ($aktivitasTerbaru as $aktivitas)
                    <li class="mb-2">
                        <span class="text-gray-600">
                            {{ $aktivitas->deskripsi }}
                        </span>
                        <span class="text-sm text-gray-400">
                            {{ $aktivitas->created_at->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('barangChart').getContext('2d');
        const barangChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: 'Stok Barang',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
@endsection
