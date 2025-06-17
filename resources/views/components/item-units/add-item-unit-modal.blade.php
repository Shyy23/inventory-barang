<div id="addUnitModal" class="modal-enter-add fixed inset-0 hidden bg-black/50">
    <div
        id="addUnitContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Header Modal -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold text-[--title-clr]">
                    Tambah Unit Barang
                </h3>
                <button
                    id="closeUnitModal"
                    class="text-[--text-clr] transition-colors hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Tambah Unit -->
            <form
                action="{{ route("item-units.store") }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-4 space-y-4"
                id="addUnitForm"
            >
                @csrf

                <!-- Pilih Barang -->
                <div>
                    <label
                        for="item_id"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Pilih Barang
                    </label>
                    <select
                        name="item_id"
                        id="item_id"
                        required
                        class="mt-1 block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih barang</option>
                        @foreach ($selectedUnitItems as $item)
                            <option value="{{ $item->item_id }}">
                                {{ $item->item_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- item name -->
                <input type="hidden" name="item_name" id="item_name_hidden" />

                <!-- Nama Unit -->
                <div>
                    <label
                        for="unit_name"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Nama Unit
                    </label>
                    <input
                        type="text"
                        name="unit_name"
                        id="unit_name"
                        required
                        class="mt-1 block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan nama unit"
                    />
                </div>

                <!-- Gambar Unit-->
                <div class="col-span-1">
                    <label
                        for="itemAddImageUnitInput"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Gambar Unit Barang
                    </label>

                    <!-- Container Preview dengan ID baru -->
                    <div
                        class="relative mt-1 h-[100px] w-[100px] overflow-hidden rounded"
                    >
                        <!-- Input File -->
                        <input
                            type="file"
                            name="unit_image"
                            id="itemAddImageUnitInput"
                            accept="image/*"
                            class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                        />
                        <!-- Preview Gambar -->
                        <img
                            id="itemAddImageUnitPreview"
                            src="https://placehold.co/100"
                            alt="Preview Gambar"
                            class="h-full w-full cursor-pointer object-contain opacity-75 transition-opacity hover:opacity-100"
                        />

                        <!-- Overlay Icon -->
                        <div
                            class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
                        >
                            <i
                                class="fas fa-arrow-up-from-bracket text-3xl text-white"
                            ></i>
                        </div>
                    </div>
                </div>
                <!-- Tombol Aksi -->
                <div class="flex justify-center pt-4">
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-[--primary-clr] bg-transparent px-6 py-2 text-sm font-medium text-[--text-clr] hover:bg-[--primary-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr] focus:ring-offset-2"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
