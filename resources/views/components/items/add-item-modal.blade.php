<!-- Modal Tambah Barang -->
<div id="addItemModal" class="modal-enter-add fixed inset-0 hidden bg-black/50">
    <div
        id="addItemContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div class="min-w-[650px] max-w-md rounded-lg bg-[--container-clr] p-6">
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Tambah Barang</h3>
                <button id="closeItemModal" class="hover:text-[--red-2-clr]">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form
                action="{{ route("items.store") }}"
                method="POST"
                enctype="multipart/form-data"
                id="addItemForm"
                class="scrollbar mt-4 grid max-h-[80vh] grid-cols-2 gap-4 overflow-y-auto px-4"
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
                        class="mt-1 block w-full input-form rounded-md border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
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
                        class="mt-1 block w-full input-form cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
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
                        class="mt-1 block w-full input-form cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->location_id }}">
                                {{ $location->location_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Item Type -->
                <div class="col-span-1">
                    <label
                        for="item_type"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Item Type
                    </label>
                    <select
                        name="item_type"
                        id="item_type"
                        required
                        class="mt-1 block input-form w-full cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>
                            Pilih Tipe Item
                        </option>
                        <option value="unit">Unit</option>
                        <option value="consumable">Consumable</option>
                    </select>
                </div>

                <!-- Stok -->
                <div id="itemAddStockContainer" class="col-span-1 hidden">
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
                        class="mt-1 block input-form w-full rounded-md border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
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
                        class="mt-1 block w-full input-form max-h-[150px] rounded-md border border-transparent px-3 py-2 shadow-sm focus:border-[--primary-clr] focus:outline-none focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan deskripsi barang"
                    ></textarea>
                </div>

                <!-- Gambar -->
                <div class="col-span-1">
                    <label
                        for="itemAddImageInput"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Gambar Barang
                    </label>

                    <!-- Container Preview dengan ID baru -->
                    <div
                        class="relative mt-1 h-[100px] w-[100px] overflow-hidden rounded"
                    >
                        <!-- Input File -->
                        <input
                            type="file"
                            name="image"
                            id="itemAddImageInput"
                            accept="image/*"
                            class="absolute input-form inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                        />
                        <!-- Preview Gambar -->
                        <img
                            id="itemAddImagePreview"
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
                <div class="col-span-2 flex justify-center pt-4">
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border-2 border-[--primary-clr] bg-transparent px-6 py-2 text-sm font-semibold text-[--text-clr] hover:border-[--primary-hover-clr] hover:bg-[--primary-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-hover-clr] focus:ring-offset-2"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
