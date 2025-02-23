@extends("layouts.app")
@push("styles")
    <style>
        input,
        textarea,
        select {
            min-height: 42px;
            box-shadow:
                4px 4px 4px var(--shadow-input-clr) inset,
                -3px -3px 3px var(--shadow-input-clr) inset;
        }
        textarea {
            max-height: 150px;
        }
        .edit-overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .edit-mode .group:hover .edit-overlay {
            opacity: 1;
        }

        #infoDisplay {
            transition: filter 0.3s ease;
        }

        .edit-mode #infoDisplay {
            filter: blur(2px);
            pointer-events: none;
            user-select: none;
        }
        ,
        /* Memastikan input file selalu dapat diklik */
        #imageInput {
            z-index: 10; /* Pastikan input file berada di atas elemen lain */
            cursor: pointer;
        }

        /* Efek overlay saat mode edit */
        .edit-overlay {
            display: none; /* Sembunyikan secara default */
        }

        .group:hover .edit-overlay {
            display: flex; /* Tampilkan saat hover */
        }

        /* Styling untuk preview gambar */
        #imagePreview {
            transition: opacity 0.3s ease;
        }

        .edit-mode #imagePreview:hover {
            opacity: 1; /* Efek hover pada gambar */
        }
        button[type='submit'] {
            text-shadow:
                2px 2px 2px var(--body-clr),
                1px -1px 4px var(--body-clr);
        }
    </style>
@endpush

@section("title", "Manage Barang")
@section("page title", "Manage Barang")
@section("breadcrumbs")
    <ol
        class="grid grid-flow-col items-center justify-end gap-2 text-sm font-medium"
    >
        <!-- Item 1 -->
        <li>
            <a
                href="{{ route("admin.dashboard") }}"
                class="breadcrumb-item text-[1rem] text-[--primary-clr] transition-colors duration-300 hover:text-[--primary-hover-clr]"
            >
                Dashboard
            </a>
        </li>
        <!-- Separator -->
        <li class="px-1 text-center">
            <i
                class="fa-solid fa-angle-right relative text-[.85rem] text-[--primary-clr]"
            ></i>
        </li>
        <!-- Active Item -->
        <li>
            <a
                href="{{ route("items.index") }}"
                class="breadcrumb-item text-[1rem] text-[--primary-clr]"
            >
                Items
            </a>
        </li>
        <!-- Separator -->
        <li class="px-1 text-center">
            <i
                class="fa-solid fa-angle-right relative text-[.85rem] text-[--border-2-clr]"
            ></i>
        </li>
        <!-- Active Item -->
        <li>
            <a
                href="#"
                class="breadcrumb-item text-[1rem] text-[--border-2-clr]"
            >
                {{ $item->item_name }}
            </a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="mx-auto max-w-6xl bg-[--body-clr] p-6 text-[--text-clr]">
        <!-- Edit & Delete Buttons -->
        <div class="mb-6 flex justify-end gap-2">
            <button
                id="editToggle"
                class="rounded-lg bg-[--primary-clr] p-2 transition hover:opacity-90"
            >
                <i class="fas fa-edit text-[--text-clr]"></i>
            </button>
            <form
                action="{{ route("items.destroy", $item->item_id) }}"
                method="POST"
            >
                @csrf
                @method("DELETE")
                <button
                    type="submit"
                    class="rounded-lg bg-[--red-2-clr] p-2 text-[--text-clr] transition hover:opacity-90"
                >
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <!-- Bagian Kiri - Gambar -->
            <div
                class="group relative aspect-square overflow-hidden rounded-lg shadow-lg"
            >
                <!-- Display Mode -->
                <div id="imageDisplay" class="h-full w-full">
                    <img
                        src="{{ asset($item->image) }}"
                        alt="{{ $item->item_name }}"
                        class="h-full w-full object-contain"
                    />
                    <div
                        class="edit-overlay absolute inset-0 hidden items-center justify-center bg-black/50 transition-all"
                    >
                        <i
                            class="fas fa-arrow-up-from-bracket pointer-events-none text-3xl text-white"
                        ></i>
                    </div>
                </div>
                <!-- Edit Mode -->
                <div id="imageEdit" class="hidden h-full w-full">
                    <div class="relative h-full w-full">
                        <img
                            id="imagePreview"
                            src="{{ asset($item->image) }}"
                            class="h-full w-full object-contain opacity-75 transition-opacity hover:opacity-100"
                        />
                        <input
                            type="file"
                            name="image"
                            id="imageInput"
                            class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                            accept="image/*"
                        />
                        <div
                            class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
                        >
                            <i
                                class="fas fa-arrow-up-from-bracket text-3xl text-white"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Tengah - Deskripsi -->
            <div class="space-y-4">
                <!-- Display Mode -->
                <div id="infoDisplay">
                    <div class="flex items-center gap-2">
                        <span class="text-lg font-bold">
                            {{ $item->item_name }}
                        </span>
                        <!-- Status Badge -->
                        <span
                            class="status-detail select-none rounded-full px-3 py-1 text-sm font-semibold text-[--text-clr]"
                            style="
                                background-color: {{ $item->status === "available" ? "var(--green-2-clr)" : "var(--red-2-clr)" }};
                            "
                        >
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>

                    <div class="space-y-2 text-[--text-2-clr]">
                        <div class="flex gap-2">
                            <span class="font-semibold">Kategori:</span>
                            <span>{{ $item->category_name }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-semibold">Lokasi:</span>
                            <span>{{ $item->location_name }}</span>
                        </div>
                        @if ($units->count() > 0)
                            <div class="flex gap-2">
                                <span class="font-semibold">Total Unit:</span>
                                <span>{{ $units->count() }}</span>
                            </div>
                        @endif

                        <div class="flex gap-2">
                            <span class="font-semibold">Stok Tersedia:</span>
                            <span>{{ $item->stock }}</span>
                        </div>
                    </div>

                    <div class="pt-4 text-[--text-2-clr]">
                        <p class="text-sm opacity-90">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>

                <!-- Edit Mode -->
                <form
                    id="infoEdit"
                    action="{{ route("items.update", $item->item_id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="hidden space-y-4"
                >
                    @csrf
                    @method("PUT")

                    <div>
                        <input
                            type="text"
                            name="item_name"
                            value="{{ $item->item_name }}"
                            class="w-full rounded border-2 border-[--primary-clr] bg-transparent p-2 font-bold text-[--text-clr]"
                            required
                        />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <select
                            name="category_id"
                            class="w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                        >
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->category_id }}"
                                    {{ $category->category_name == $item->category_name ? "selected" : "" }}
                                >
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <select
                            name="location_id"
                            class="w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                        >
                            @foreach ($locations as $location)
                                <option
                                    value="{{ $location->location_id }}"
                                    {{ $location->location_name == $item->location_name ? "selected" : "" }}
                                >
                                    {{ $location->location_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <input
                            type="number"
                            name="stock"
                            value="{{ $item->stock }}"
                            min="0"
                            class="w-full rounded border border-[--border-clr] bg-transparent p-2 text-[--text-clr]"
                            required
                        />
                    </div>

                    <div>
                        <textarea
                            name="description"
                            rows="3"
                            class="w-full rounded border border-[--border-clr] bg-transparent p-2 text-[--text-clr]"
                        >
{{ $item->description }}</textarea
                        >
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button
                            type="button"
                            onclick="toggleEditMode(false)"
                            class="rounded-lg bg-[--red-2-clr] px-4 py-2"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="rounded-lg bg-[--green-2-clr] px-4 py-2"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- Bagian Kanan - Tombol Buka Modal -->
            <div
                class="grid grid-cols-1 grid-rows-[1fr_auto] justify-between rounded-lg bg-[--container-clr] bg-opacity-50 p-4"
            >
                <img
                    src="{{ asset("assets/svg/loan.svg") }}"
                    alt="image loan"
                    class="mb-4 aspect-square w-[12rem] self-center justify-self-center text-center"
                />
                <button
                    onclick="showLoanModal()"
                    class="max-h-[42px] self-end rounded-lg border-2 border-[--primary-clr] bg-transparent py-2 text-[--primary-clr] transition-colors hover:border-[--primary-hover-clr] hover:bg-[--primary-clr] hover:text-[--text-clr] hover:opacity-90"
                >
                    Buat Peminjaman
                </button>
            </div>
        </div>
        <!-- Modal Peminjaman -->
        <div
            id="loanModal"
            class="fixed inset-0 z-50 hidden overflow-y-auto transition-all duration-300"
        >
            <div
                class="flex min-h-screen items-center justify-center p-4 text-center"
            >
                <!-- Overlay -->
                <div class="fixed inset-0 bg-black/50 transition-opacity"></div>

                <!-- Modal Container -->
                <div
                    id="loanModalContainer"
                    class="inline-block max-h-[90vh] w-full max-w-2xl transform overflow-hidden overflow-y-auto rounded-lg bg-[--body-clr] text-left align-middle text-[--text-clr] shadow-xl transition-all"
                >
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 pb-0">
                        <h3 class="text-xl font-bold">Form Peminjaman</h3>
                        <button
                            onclick="closeLoanModal()"
                            class="hover:text-[--primary-clr]"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6">
                        <form
                            action="#"
                            method="POST"
                            class="mx-auto max-w-4xl bg-[--body-clr] p-6 text-[--text-clr]"
                        >
                            @csrf

                            <!-- Step 1 -->
                            <div
                                id="step1"
                                class="grid grid-cols-2 items-center gap-4"
                            >
                                <!-- NISN Pemohon -->
                                <div>
                                    <label class="mb-2 block">
                                        Nama Peminjam
                                    </label>
                                    <select
                                        name="nisn"
                                        required
                                        class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    >
                                        <option value="">Pilih Siswa</option>
                                        @foreach ($students as $student)
                                            <option
                                                value="{{ $student->nisn }}"
                                            >
                                                {{ $student->full_name }}
                                                ({{ $student->nisn }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Return Time -->
                                <div>
                                    <label class="mb-2 block">
                                        Waktu Pengembalian
                                    </label>
                                    <input
                                        type="time"
                                        name="return_time"
                                        required
                                        class="w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    />
                                </div>

                                <!-- Item Details -->

                                <input
                                    type="hidden"
                                    name="item_id"
                                    value="{{ $item->item_id }}"
                                />

                                @if ($units->isNotEmpty())
                                    <!-- Periksa apakah ada data -->
                                    <div>
                                        <label class="mb-2 block">Unit</label>
                                        <select
                                            name="unit_id"
                                            required
                                            class="w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                        >
                                            <option value="">Pilih Unit</option>
                                            @foreach ($units as $unit)
                                                <option
                                                    value="{{ $unit->unit_id }}"
                                                >
                                                    {{ $unit->unit_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div>
                                    <label class="mb-2 block">Jumlah</label>
                                    <input
                                        type="number"
                                        name="item_quantity"
                                        min="1"
                                        required
                                        class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    />
                                </div>

                                <div>
                                    <label class="mb-2 block">
                                        Deskripsi Peminjaman
                                    </label>
                                    <textarea
                                        name="loan_description"
                                        rows="3"
                                        class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    ></textarea>
                                </div>

                                <!-- Loan Type -->
                                <div>
                                    <label class="mb-2 block">
                                        Jenis Peminjaman
                                    </label>
                                    <select
                                        id="loanType"
                                        required
                                        class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    >
                                        <option value="">
                                            Pilih Jenis Peminjaman
                                        </option>
                                        <option value="individu">
                                            Peminjaman Individu
                                        </option>
                                        <option value="kelas">
                                            Peminjaman Kelas
                                        </option>
                                    </select>
                                </div>

                                <div
                                    class="relative col-span-2 mt-8 flex justify-center pt-4"
                                >
                                    <button
                                        type="button"
                                        id="nextBtn"
                                        class="absolute bottom-0 z-0 hidden w-[11.25rem] rounded-lg border-2 border-[--primary-clr] bg-transparent px-6 py-2 text-[--primary-clr] transition hover:border-[--primary-hover-clr] hover:bg-[--primary-clr] hover:text-[--text-clr] hover:opacity-90"
                                    >
                                        Next
                                    </button>

                                    <button
                                        type="submit"
                                        id="submitIndividu"
                                        class="absolute bottom-0 z-10 ml-auto w-[11.25rem] rounded-lg border-2 border-[--green-2-clr] bg-transparent px-6 py-2 text-[--green-2-clr] transition hover:bg-[--green-2-clr] hover:text-[--text-clr] hover:opacity-90"
                                    >
                                        Pinjam Sekarang
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2 (Class Loan) -->
                            <div id="step2" class="hidden grid-cols-2 gap-4">
                                <div>
                                    <label class="mb-2 block">Kelas</label>
                                    <select
                                        name="class_id"
                                        class="w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    >
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($classes as $class)
                                            <option
                                                value="{{ $class->class_id }}"
                                            >
                                                {{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="mb-2 block">
                                        Mata Pelajaran
                                    </label>
                                    <select
                                        name="subject_id"
                                        class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                    >
                                        <option value="">
                                            Pilih Mata Pelajaran
                                        </option>
                                        @foreach ($subjects as $subject)
                                            <option
                                                value="{{ $subject->subject_id }}"
                                            >
                                                {{ $subject->subject_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div
                                    class="col-span-2 mt-8 flex justify-between"
                                >
                                    <button
                                        type="button"
                                        id="prevBtn"
                                        class="hover:text-[--text-clr]s w-[11.25rem] rounded-lg border-2 border-[--primary-clr] bg-transparent px-6 py-2 text-[--primary-clr] transition hover:border-[--primary-hover-clr] hover:bg-[--primary-clr] hover:text-[--text-clr] hover:opacity-90"
                                    >
                                        Previous
                                    </button>

                                    <button
                                        type="submit"
                                        id="submitKelas"
                                        class="ml-auto w-[11.25rem] rounded-lg border-2 border-[--green-2-clr] bg-transparent px-6 py-2 text-[--green-2-clr] transition hover:bg-[--green-2-clr] hover:text-[--text-clr] hover:opacity-90"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Fungsi untuk menampilkan modal
        function showLoanModal() {
            const modal = document.getElementById('loanModal');
            const container = document.getElementById('loanModalContainer');
            modal.classList.remove('hidden');
            setTimeout(() => {
                container.classList.add(
                    'opacity-100',
                    'scale-100',
                    'translate-y-0',
                );
            }, 50);
        }

        // Fungsi untuk menutup modal
        function closeLoanModal() {
            const modal = document.getElementById('loanModal');
            const container = document.getElementById('loanModalContainer');

            container.classList.remove(
                'opacity-100',
                'scale-100',
                'translate-y-0',
            );
            setTimeout(() => {
                modal.classList.add('hidden');
                // Reset form ke step 1
                document.getElementById('step2').classList.add('hidden');
                document.getElementById('step1').classList.remove('hidden');
                document.getElementById('submitIndividu').style.display =
                    'block';
            }, 300);
        }

        // Tutup modal ketika klik di luar
        window.onclick = function (event) {
            const modal = document.getElementById('loanModal');
            if (event.target === modal) {
                closeLoanModal();
            }
        };

        // Toggle edit mode
        function toggleEditMode(enable) {
            const container = document.querySelector('body');
            const displayElements = document.querySelectorAll(
                '#imageDisplay, #infoDisplay',
            );
            const editElements = document.querySelectorAll(
                '#imageEdit, #infoEdit',
            );

            if (enable) {
                container.classList.add('edit-mode');
                displayElements.forEach((el) => (el.style.display = 'none'));
                editElements.forEach((el) => (el.style.display = 'block'));
            } else {
                container.classList.remove('edit-mode');
                displayElements.forEach((el) => (el.style.display = 'block'));
                editElements.forEach((el) => (el.style.display = 'none'));
            }
        }

        // Handle edit button click
        document.getElementById('editToggle').addEventListener('click', () => {
            toggleEditMode(true);
        });

        // Image preview handler
        document
            .getElementById('imageInput')
            .addEventListener('change', function (e) {
                const reader = new FileReader();
                reader.onload = function () {
                    document.getElementById('imagePreview').src = reader.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            });
        document.addEventListener('DOMContentLoaded', function () {
            const loanType = document.getElementById('loanType');
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const submitIndividu = document.getElementById('submitIndividu');

            loanType.addEventListener('change', function () {
                if (this.value === 'kelas') {
                    nextBtn.style.display = 'block';
                    submitIndividu.style.display = 'none';
                    nextBtn.style.zIndex = 10;
                } else {
                    nextBtn.style.display = 'none';
                    submitIndividu.style.display = 'block';
                    submitIndividu.style.zIndex = 0;
                }
            });

            nextBtn.addEventListener('click', function () {
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                step2.classList.add('grid');
            });

            prevBtn.addEventListener('click', function () {
                step2.classList.remove('grid');
                step2.classList.add('hidden');
                step1.classList.remove('hidden');
            });

            // Stock validation
            document
                .querySelector('input[name="item_id"]')
                .addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const maxStock = selectedOption.getAttribute('data-stock');
                    document.querySelector('input[name="item_quantity"]').max =
                        maxStock;
                });
        });
    </script>
@endpush
