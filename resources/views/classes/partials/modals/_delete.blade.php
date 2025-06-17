<div
    id="deleteClassModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="deleteClassContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Hapus Kelas</h3>
                <button
                    id="closeDeleteClassModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Hapus -->
            <form
                action="{{ route("classes.destroy") }}"
                method="POST"
                id="deleteClassForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("DELETE")

                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($classes as $class)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="classes[]"
                                        value="{{ $class->class_id }}"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Hapus Kelas ini
                                    </span>
                                </label>
                                <span
                                    class="select-none text-sm text-[--secondary-clr]"
                                >
                                    ID: {{ $class->class_id }}
                                </span>
                            </div>
                            <div
                                class="flex items-stretch justify-between gap-4 text-[--secondary-clr]"
                            >
                                <span>{{ $class->class_name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <button
                        id="deleteClassButton"
                        type="submit"
                        class="rounded-md border border-[--red-2-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--red-2-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr]"
                    >
                        Hapus Kelas Terpilih
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
