<!-- Modal Tambah Barang -->
<div
    id="tambah-barang-modal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div class="flex min-h-screen items-center justify-center">
        <div class="min-w-[650px] max-w-md rounded-lg bg-[--container-clr] p-6">
            <div class="flex justify-between border-b pb-3">
                <h3 class="text-lg font-semibold">Tambah Barang</h3>
                <button
                    onclick="closeModal('tambah-barang-modal')"
                    class="hover:text-[--primary-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form
                action="{{ route("items.store") }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-4 grid max-h-[80vh] grid-cols-2 gap-4 overflow-y-auto px-4"
            >
                @csrf

                <div class="col-span-1">
                    <label
                        for="item_name"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Nama Barang
                    </label>
                    <input
                        type="text"
                        name="item_name"
                        id="item_name"
                        required
                        class="mt-1 block w-full rounded-md border border-[--text-clr] px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan nama barang"
                    />
                </div>

                <!-- Kategori -->
                <div class="col-span-1">
                    <label
                        for="category_id"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Kategori
                    </label>
                    <select
                        name="category_id"
                        id="category_id"
                        required
                        class="mt-1 block w-full rounded-md border border-[--text-clr] px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>
                            Pilih kategori
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="col-span-1">
                    <label
                        for="location_id"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Lokasi
                    </label>
                    <select
                        name="location_id"
                        id="location_id"
                        required
                        class="mt-1 block w-full rounded-md border border-[--text-clr] px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->location_id }}">
                                {{ $location->location_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stok -->
                <div class="col-span-1">
                    <label
                        for="stock"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Stok
                    </label>
                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        required
                        class="mt-1 block w-full rounded-md border border-[--text-clr] px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan jumlah stok"
                    />
                </div>

                <!-- Deskripsi -->
                <div class="col-span-2">
                    <label
                        for="description"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Deskripsi
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        required
                        rows="3"
                        class="mt-1 block w-full rounded-md border border-[--text-clr] px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan deskripsi barang"
                    ></textarea>
                </div>

                <!-- Gambar -->
                <div class="col-span-1">
                    <label
                        for="image"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Gambar Barang
                    </label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="mt-1 block w-full text-[.875rem] text-[--text-clr] file:mr-4 file:cursor-pointer file:rounded-md file:border-0 file:bg-[--primary-clr] file:px-4 file:py-2 file:font-semibold file:text-[--text-clr] hover:file:bg-[--primary-hover-clr] focus:border-[--primary-clr] focus:ring-[--primary-clr]"
                    />
                    <!-- Preview Gambar -->
                    <div class="mt-2">
                        <img
                            id="image-preview"
                            src="#"
                            alt="Preview Gambar"
                            class="hidden max-h-[100px] max-w-[100px]"
                        />
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="col-span-2 flex justify-end space-x-4 pt-4">
                    <button
                        type="button"
                        onclick="closeModal('tambah-barang-modal')"
                        class="inline-flex items-center rounded-md border border-[--red-2-clr] bg-transparent px-4 py-2 text-sm font-semibold text-[--text-clr] shadow-sm hover:bg-[--red-2-clr] focus:outline-none focus:ring-2 focus:ring-[--red-2-clr] focus:ring-offset-2"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border-2 border-[--primary-clr] bg-transparent px-4 py-2 text-sm font-semibold text-[--text-clr] hover:border-[--primary-hover-clr] hover:bg-[--primary-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-hover-clr] focus:ring-offset-2"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
