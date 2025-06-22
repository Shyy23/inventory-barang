<div
    id="deleteUnitModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="deleteUnitContainerModal"
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
                    Hapus Unit Barang
                </h3>
                <button
                    id="closeUnitDeleteModal"
                    class="text-[--text-clr] transition-colors hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                id="deleteUnitForm"
                action="{{ route("item-units.destroy") }}"
                method="POST"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("DELETE")

                <div class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto">
                    @foreach ($units as $unit)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="item-units[]"
                                        value="{{ $unit->unit_id }}"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Pilih unit ini
                                    </span>
                                </label>
                            </div>

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
                                        <h4 class="text-lg font-semibold">
                                            {{ $unit->unit_name }}
                                        </h4>
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
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button
                        id="deleteUnitButton"
                        type="submit"
                        class="rounded bg-[--red-2-clr] px-4 py-2 text-[--text-clr] hover:opacity-90"
                    >
                        Hapus Unit Terpilih
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
