<div
    id="deleteCategoryModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="deleteCategoryContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Hapus Kategori</h3>
                <button
                    id="closeDeleteCategoryModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("categories.destroy") }}"
                method="POST"
                id="deleteCategoryForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("DELETE")

                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($categories as $category)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="categories[]"
                                        value="{{ $category->category_id }}"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Hapus kategori ini
                                    </span>
                                </label>
                                <span
                                    class="select-none text-sm text-[--secondary-clr]"
                                >
                                    ID: {{ $category->category_id }}
                                </span>
                            </div>
                            <div
                                class="flex items-stretch justify-between gap-4 text-[--secondary-clr]"
                            >
                                <span>{{ $category->category_name }}</span>
                                <span>
                                    Jumlah :
                                    <strong>
                                        {{ $category->items->count() }}
                                    </strong>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button
                        id="deleteCategoryButton"
                        type="submit"
                        class="rounded-md border border-[--red-2-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--red-2-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--red-2-clr] focus:ring-offset-2"
                    >
                        Hapus Category Terpilih
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
