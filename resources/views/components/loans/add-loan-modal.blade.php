<div
    id="loanModal"
    class="fixed inset-0 z-50 hidden overflow-y-auto transition-all duration-300"
>
    <div
        class="grid min-h-screen grid-cols-1 place-items-center p-4 text-center"
    >
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/50 transition-opacity"></div>

        <!-- Modal Container -->
        <div
            id="loanModalContainer"
            class="scrollbar inline-block max-h-[90vh] w-full max-w-4xl transform overflow-hidden rounded-lg bg-[--container-clr] text-left align-middle text-[--text-clr] shadow-xl transition-all"
        >
            <!-- Modal Header -->
            <div
                class="mx-12 mt-6 flex items-center justify-between border-b border-[--border-clr] pb-4"
            >
                <h3 class="text-xl font-bold">Form Peminjaman</h3>
                <button id="closeLoanModal" class="hover:text-[--red-2-clr]">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div
                class="{{ $item->item_type == "unit" ? "grid grid-cols-2 gap-4" : "" }} overflow-hidden p-6"
            >
                <form
                    id="loanForm"
                    action="{{ route("loans.store") }}"
                    method="POST"
                    class="{{ $item->item_type == "unit" ? "px-6" : "p-6" }} mx-auto w-full max-w-4xl text-[--text-clr]"
                >
                    @csrf

                    <!-- Step 1 -->
                    <div
                        id="step1"
                        class="{{ $item->item_type == "unit" ? "flex flex-col" : "grid grid-cols-2" }} gap-4"
                    >
                        <div>
                            <label class="mb-2 block" for="loanInputNisn">
                                Nama Peminjam
                            </label>
                            <select
                                name="nisn"
                                id="loanInputNisn"
                                required
                                class="input-form w-full cursor-pointer border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                            >
                                <option value="" disabled selected>
                                    Pilih Siswa
                                </option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->nisn }}">
                                        {{ $student->student_name }}
                                        ({{ $student->nisn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Item Details -->

                        <input
                            id="loanItemInputId"
                            type="hidden"
                            name="item_id"
                            data-stock="{{ $item->stock }}"
                            value="{{ $item->item_id }}"
                        />

                        <!-- Item Qantity -->

                        @if ($item->item_type == "unit")
                            <input
                                type="hidden"
                                name="item_quantity"
                                id="loanInputQuantity"
                                min="1"
                                required
                                value="1"
                            />
                        @else
                            <div>
                                <label
                                    class="mb-2 block"
                                    for="loanInputQuantity"
                                >
                                    Jumlah
                                </label>
                                <input
                                    type="number"
                                    name="item_quantity"
                                    id="loanInputQuantity"
                                    placeholder="Masukkan Jumlah yang ingin dipinjam"
                                    min="1"
                                    required
                                    value="{{ $item->item_type == "unit" ? 1 : "" }}"
                                    class="input-form w-full border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                                />
                            </div>
                        @endif
                        <div>
                            <label class="mb-2 block" for="loanInputDesc">
                                Deskripsi Peminjaman
                            </label>
                            <textarea
                                name="loan_description"
                                id="loanInputDesc"
                                placeholder="mohon deskripsikan mengapa dan berapa lama waktu yang dibutuhkan"
                                rows="3"
                                class="input-form w-full border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                            ></textarea>
                        </div>

                        <!-- Loan Type -->
                        <div>
                            <label class="mb-2 block" for="loanType">
                                Jenis Peminjaman
                            </label>
                            <select
                                id="loanType"
                                required
                                name="loan_type"
                                class="input-form w-full cursor-pointer border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                            >
                                <option value="" disabled selected>
                                    Pilih Jenis Peminjaman
                                </option>
                                <option value="individu">
                                    Peminjaman Individu
                                </option>
                                <option value="kelas">Peminjaman Kelas</option>
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
                                class="absolute bottom-0 z-10 ml-auto block w-[11.25rem] rounded-lg border-2 border-[--green-3-clr] bg-transparent px-6 py-2 text-[--green-3-clr] transition hover:bg-[--green-3-clr] hover:text-[--text-clr] hover:opacity-90"
                            >
                                Pinjam Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 (Class Loan) -->
                    <div id="step2" class="hidden grid-cols-2 gap-4">
                        <div>
                            <label class="mb-2 block" for="loanInputKelas">
                                Kelas
                            </label>
                            <select
                                name="class_id"
                                id="loanInputKelas"
                                class="input-form w-full cursor-pointer border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                            >
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->class_id }}">
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block" for="loanInputMapel">
                                Mata Pelajaran
                            </label>
                            <select
                                name="subject_id"
                                id="loanInputMapel"
                                class="input-form w-full cursor-pointer border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                            >
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}">
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input
                            type="hidden"
                            name="item_type"
                            id="loanItemType"
                            value="{{ $item->item_type }}"
                            data-type="{{ $item->item_type }}"
                        />
                        <div class="col-span-2 mt-8 flex justify-between">
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
                                class="ml-auto w-[11.25rem] rounded-lg border-2 border-[--green-3-clr] bg-transparent px-6 py-2 text-[--green-3-clr] transition hover:bg-[--green-3-clr] hover:text-[--text-clr] hover:opacity-90"
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                @if ($item->item_type == "unit")
                    <div
                        id="container-unit-items"
                        class="scrollbar h-full max-h-[400px] overflow-y-auto p-6 pr-2"
                    >
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($units as $unit)
                                <label
                                    class="unit-card block cursor-pointer transition-transform hover:translate-y-[-2px]"
                                >
                                    <input
                                        type="radio"
                                        name="unit_data"
                                        value="{{ json_encode($unit) }}"
                                        class="peer hidden"
                                        required
                                        @if($unit->unit_status != 'available') disabled @endif
                                    />
                                    <div
                                        class="{{ $unit->unit_status != "available" ? "pointer-events-none opacity-50" : "" }} shadow-in relative rounded-lg border border-transparent bg-[--body-clr] p-4 transition-all hover:border-[--primary-clr] peer-checked:border-[--primary-clr] peer-checked:ring-2 peer-checked:ring-[--primary-clr]"
                                    >
                                        <div class="flex items-stretch gap-4">
                                            <!-- Gambar Unit -->
                                            <div class="shrink-0">
                                                @if ($unit->unit_image && file_exists(public_path($unit->unit_image)))
                                                    <img
                                                        src="{{ asset($unit->unit_image) }}"
                                                        alt="{{ $unit->unit_name }}"
                                                        class="h-20 w-20 rounded-lg object-cover"
                                                    />
                                                @else
                                                    <div
                                                        class="flex h-20 w-20 items-center justify-center rounded-lg bg-gray-100"
                                                    >
                                                        <i
                                                            class="fas fa-cube text-2xl text-gray-400"
                                                        ></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Detail Unit -->
                                            <div
                                                class="relative flex w-full justify-between"
                                            >
                                                <div
                                                    class="growflex-col flex flex-col items-start justify-center"
                                                >
                                                    <h4
                                                        class="text-lg font-semibold"
                                                    >
                                                        {{ $unit->unit_name }}
                                                    </h4>
                                                    <span
                                                        class="hidden text-sm text-[--text-clr]"
                                                    >
                                                        {{ $unit->unit_id }}
                                                    </span>
                                                    <span
                                                        class="text-sm text-[--secondary-clr]"
                                                    >
                                                        Item:
                                                        {{ $unit->item_name }}
                                                    </span>
                                                </div>
                                                <span
                                                    class="{{ $unit->unit_status == "damaged" ? "bg-[--red-2-clr]" : ($unit->unit_status == "available" ? "bg-[--green-2-clr]" : "bg-[--primary-clr]") }} self-start rounded-full px-3 py-1 text-center text-[--text-clr]"
                                                >
                                                    {{ $unit->unit_status }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Indicator Pilihan -->
                                        <div
                                            class="absolute right-4 top-4 hidden text-[--primary-clr] peer-checked:block"
                                        >
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hidden Inputs untuk Data Terpilih -->
                    <input
                        type="hidden"
                        name="unit_id"
                        form="loanForm"
                        id="selectedUnitId"
                        required
                    />
                @endif
            </div>
        </div>
    </div>
</div>
