<div
    id="deleteLocationModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="deleteLocationContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Hapus Lokasi</h3>
                <button
                    id="closeDeleteLocationModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("locations.destroy") }}"
                method="POST"
                id="deleteLocationForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("DELETE")
                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($locations as $location)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="locations[]"
                                        value="{{ $location->location_id }}"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Hapus Lokasi ini
                                    </span>
                                </label>
                            </div>
                            <div
                                class="flex items-stretch justify-between gap-4 text-[--secondary-clr]"
                            >
                                <span>{{ $location->location_name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button
                        id="deleteLocationButton"
                        type="submit"
                        class="rounded-md border border-[--red-2-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--red-2-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--red-2-clr] focus:ring-offset-2"
                    >
                        Hapus Lokasi Terpilih
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
