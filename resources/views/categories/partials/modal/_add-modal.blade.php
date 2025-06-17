<div
    id="addCategoryModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="addCategoryContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Tambah Kategori</h3>
                <button
                    id="closeCategoryModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("categories.store") }}"
                method="POST"
                id="addCategoryForm"
                class="scrollbar mt-4 grid max-h-[80vh] grid-cols-[1fr_auto] items-center justify-center gap-4 overflow-y-auto px-4 pb-4"
            >
                @csrf
                <div class="input-group flex w-full flex-col gap-2">
                    <label for="addCategoryName">Nama Kategori :</label>
                    <input
                        type="text"
                        name="category_name"
                        id="addCategoryName"
                        class="input-form mt-1 block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                        placeholder="Masukkan Kategori"
                    />
                </div>
                <div class="h-full max-h-[42px] self-end">
                    <button
                        type="submit"
                        class="flex h-full items-center rounded-md border border-[--green-2-clr] bg-transparent px-6 text-center text-sm font-medium text-[--green-2-clr] transition-colors hover:bg-[--green-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--green-2-clr] focus:ring-offset-2"
                    >
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
