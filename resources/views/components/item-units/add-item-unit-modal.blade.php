<div
    id="tambah-unit-modal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div class="flex min-h-screen items-center justify-center">
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
                    onclick="closeModal('tambah-unit-modal')"
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
                        class="mt-1 block w-full rounded-md border border-[--border-clr] bg-[--body-clr] px-3 py-2 focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih barang</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->item_id }}">
                                {{ $item->item_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

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
                        class="mt-1 block w-full rounded-md border border-[--border-clr] bg-[--body-clr] px-3 py-2 focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan nama unit"
                    />
                </div>

                <!-- Gambar Unit -->
                <div>
                    <label
                        for="unit_image"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Gambar Unit
                    </label>
                    <input
                        type="file"
                        name="unit_image"
                        id="unit_image"
                        accept="image/*"
                        class="mt-1 block w-full bg-[--body-clr] text-sm text-[--text-clr] file:mr-4 file:rounded-md file:border-0 file:bg-[--primary-clr] file:px-4 file:py-2 file:font-semibold file:text-[--text-clr] hover:file:bg-[--primary-hover-clr]"
                    />
                    <!-- Preview Gambar -->
                    <div id="image-preview-container" class="mt-2 hidden">
                        <img
                            id="image-unit-preview"
                            class="max-h-[200px] max-w-[200px] rounded-md"
                            alt="Preview"
                        />
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-4 pt-4">
                    <button
                        type="button"
                        onclick="closeModal('tambah-unit-modal')"
                        class="inline-flex items-center rounded-md border border-[--border-clr] bg-white px-4 py-2 text-sm font-medium text-[--text-clr] hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[--primary-clr] focus:ring-offset-2"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-[--primary-clr] focus:ring-offset-2"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
