<div
    id="addLocationModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="addLocationContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Tambah Lokasi</h3>
                <button
                    id="closeLocationModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <!-- Form Modal -->
            <form
                action="{{ route("locations.store") }}"
                method="POST"
                id="addLocationForm"
                class="scrollbar mt-4 grid max-h-[80vh] grid-cols-[1fr] items-center justify-center gap-4 overflow-y-auto px-4 pb-4"
            >
                @csrf
                <div class="input-group flex w-full flex-col gap-2">
                    <label
                        for="addLocationName"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Nama Lokasi :
                    </label>
                    <input
                        type="text"
                        name="location_name"
                        id="addLocationName"
                        class="input-form mt-1 block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan Kategori"
                    />
                </div>
                <div class="input-group flex w-full flex-col gap-2">
                    <label
                        for="location_type"
                        class="block text-sm font-medium text-[--text-clr]"
                    >
                        Location Type
                    </label>
                    <select
                        name="location_type"
                        id="location_type"
                        required
                        class="input-form mt-1 block w-full rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>
                            Pilih Tipe Lokasi
                        </option>
                        <option value="item">Item</option>
                        <option value="class">Class</option>
                    </select>
                </div>
                <div class="h-full max-h-[42px] self-end">
                    <button
                        type="submit"
                        class="flex items-center rounded-md border border-[--green-2-clr] bg-transparent px-6 py-3 text-center text-sm font-medium text-[--green-2-clr] transition-colors hover:bg-[--green-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--green-2-clr] focus:ring-offset-2"
                    >
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
