@extends("layouts.app")
@section("content")
    <div class="mx-auto max-w-6xl bg-[--body-clr] p-6 text-[--text-clr]">
        <!-- Edit & Delete Buttons -->
        <div class="mb-6 flex justify-end gap-2">
            <button
                id="editToggle"
                class="rounded-lg bg-[--primary-clr] p-2 text-[--text-clr] transition hover:opacity-90"
            >
                <i class="fas fa-edit"></i>
            </button>
            <!-- Delete button tetap sama -->
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <!-- Bagian Kiri - Gambar -->
            <div
                class="group aspect-square overflow-hidden rounded-lg shadow-lg"
            >
                <!-- Display Mode -->
                <div id="imageDisplay">
                    <img
                        src="{{ asset($item->image) }}"
                        alt="{{ $item->item_name }}"
                        class="w-full object-contain"
                    />
                </div>

                <!-- Edit Mode -->
                <div id="imageEdit" class="hidden h-full w-full">
                    <div class="relative h-full w-full">
                        <img
                            id="imagePreview"
                            src="{{ asset($item->image) }}"
                            class="h-full w-full object-contain"
                        />
                        <input
                            type="file"
                            name="image"
                            id="imageInput"
                            class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                            accept="image/*"
                        />
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
                        <!-- Status badge tetap sama -->
                    </div>

                    <!-- Info lainnya tetap sama -->
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
                        <label class="mb-2 block">Nama Item</label>
                        <input
                            type="text"
                            name="item_name"
                            value="{{ $item->item_name }}"
                            class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                            required
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-2 block">Kategori</label>
                            <input
                                type="text"
                                name="category_name"
                                value="{{ $item->category_name }}"
                                class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                required
                            />
                        </div>

                        <div>
                            <label class="mb-2 block">Lokasi</label>
                            <input
                                type="text"
                                name="location_name"
                                value="{{ $item->location_name }}"
                                class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                                required
                            />
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block">Stok</label>
                        <input
                            type="number"
                            name="stock"
                            value="{{ $item->stock }}"
                            min="0"
                            class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                            required
                        />
                    </div>

                    <div>
                        <label class="mb-2 block">Deskripsi</label>
                        <textarea
                            name="description"
                            rows="3"
                            class="w-full rounded border border-[--border-2-clr] bg-[--body-clr] p-2 text-[--text-clr]"
                        >
{{ $item->description }}</textarea
                        >
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button
                            type="button"
                            onclick="toggleEditMode(false)"
                            class="rounded-lg bg-[--red-clr] px-4 py-2"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="rounded-lg bg-[--green-clr] px-4 py-2"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bagian Kanan - Tombol Buka Modal -->
            <div
                id="borrowSection"
                class="rounded-lg bg-[--container-clr] bg-opacity-50 p-4"
            >
                <!-- Tombol pinjam tetap sama -->
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Toggle edit mode
        function toggleEditMode(enable) {
            const displayElements = [
                document.getElementById('imageDisplay'),
                document.getElementById('infoDisplay'),
                document.getElementById('borrowSection'),
            ];

            const editElements = [
                document.getElementById('imageEdit'),
                document.getElementById('infoEdit'),
            ];

            displayElements.forEach(
                (el) => (el.style.display = enable ? 'none' : 'block'),
            );
            editElements.forEach(
                (el) => (el.style.display = enable ? 'block' : 'none'),
            );
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
    </script>
@endpush
