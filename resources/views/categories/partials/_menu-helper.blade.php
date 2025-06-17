<x-menu-helper asideClass="py-4">
    @slot("tools")
        <!-- Search Form -->
        <form
            action="{{ route("categories.index") }}"
            method="GET"
            class="search-group relative w-full"
        >
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    placeholder="Cari Kategori"
                    class="w-full rounded-lg border-2 border-[--border-2-clr] bg-transparent py-3 pl-4 pr-12 text-[--text-clr] transition-all duration-300 focus:border-[--primary-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                    value="{{ request("search") }}"
                />
                <button
                    type="submit"
                    class="absolute right-0 top-0 flex h-full items-center justify-center rounded-r-lg bg-transparent px-4 text-center transition-all duration-300 hover:bg-[--primary-hover-clr]"
                >
                    <i
                        class="fa-solid fa-magnifying-glass text-lg text-[--text-clr]"
                    ></i>
                </button>
            </div>
        </form>
        <x-button-group spacing="4">
            <x-button-menu
                id="showCategoryModal"
                color="green"
                icon="fas fa-plus text-xl"
                text="Tambah"
                class="px-4 py-3"
            />

            <x-button-menu
                id="showEditCategoryModal"
                color="primary"
                icon="fas fa-edit text-xl"
                text="Edit"
                class="px-4 py-3"
            />
            <x-button-menu
                id="showDeleteCategoryModal"
                color="red"
                icon="fas fa-trash text-xl"
                text="Hapus"
                class="px-4 py-3"
            />
        </x-button-group>

        <!-- Pagination Start -->
        <x-pagination
            :paginator="$categories"
            RouteName="categories.index"
            :RouteParams="['search' => request('search')]"
        />
        <!-- Pagination End -->
    @endslot

    @slot("clearButton")
        <button
            class="w-full rounded-lg bg-[--primary-clr] px-4 py-2 text-sm font-medium text-white transition-all duration-300 hover:bg-[--primary-hover-clr]"
            type="button"
            id="clearFilterSelection"
        >
            Clear
        </button>
    @endslot
</x-menu-helper>
