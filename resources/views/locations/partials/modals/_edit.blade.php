<div
    id="editLocationModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="editLocationContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Edit Lokasi</h3>
                <button
                    id="closeEditLocationModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("locations.update") }}"
                method="POST"
                id="editLocationForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("PUT")

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
                                        name="locations[{{ $location->location_id }}][selected]"
                                        value="1"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Edit Lokasi ini
                                    </span>
                                </label>
                                <span
                                    class="select-none text-sm text-[--secondary-clr]"
                                >
                                    ID: {{ $location->location_id }}
                                </span>
                            </div>
                            <div class="flex flex-col gap-4">
                                <input
                                    type="text"
                                    name="locations[{{ $location->location_id }}][location_name]"
                                    value="{{ $location->location_name }}"
                                    data-initial-value="{{ $location->location_name }}"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr]"
                                />
                                <select
                                    name="locations[{{ $location->location_id }}][type]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr]"
                                >
                                    <option
                                        value="item"
                                        {{ $location->type === "item" ? "selected" : "" }}
                                    >
                                        Item
                                    </option>
                                    <option
                                        value="class"
                                        {{ $location->type === "class" ? "selected" : "" }}
                                    >
                                        Class
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button
                        type="submit"
                        id="editLocationButton"
                        class="rounded-md border border-[--primary-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--primary-clr] transition-colors hover:bg-[--primary-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr] focus:ring-offset-2"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
