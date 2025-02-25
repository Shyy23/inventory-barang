<div
    id="loanModal"
    class="fixed inset-0 z-50 hidden overflow-y-auto transition-all duration-300"
>
    <div class="flex min-h-screen items-center justify-center p-4 text-center">
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
                    action="{{ route("loans.store") }}"
                    method="POST"
                    class="mx-auto max-w-4xl bg-[--body-clr] p-6 text-[--text-clr]"
                >
                    @csrf

                    <!-- Step 1 -->
                    <div id="step1" class="grid grid-cols-2 items-center gap-4">
                        <!-- NISN Pemohon -->
                        <div>
                            <label class="mb-2 block">Nama Peminjam</label>
                            <select
                                name="nisn"
                                required
                                class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                            >
                                <option value="">Pilih Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->nisn }}">
                                        {{ $student->student_name }}
                                        ({{ $student->nisn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Return Time -->
                        <div>
                            <label class="mb-2 block">Waktu Pengembalian</label>
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
                                        <option value="{{ $unit->unit_id }}">
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
                            <label class="mb-2 block">Jenis Peminjaman</label>
                            <select
                                id="loanType"
                                required
                                name="loan_type"
                                class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                            >
                                <option value="">Pilih Jenis Peminjaman</option>
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
                                class="absolute bottom-0 z-10 ml-auto w-[11.25rem] rounded-lg border-2 border-[--green-3-clr] bg-transparent px-6 py-2 text-[--green-3-clr] transition hover:bg-[--green-3-clr] hover:text-[--text-clr] hover:opacity-90"
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
                                    <option value="{{ $class->class_id }}">
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block">Mata Pelajaran</label>
                            <select
                                name="subject_id"
                                class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                            >
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}">
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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
            </div>
        </div>
    </div>
</div>
