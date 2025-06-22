<x-menu-helper asideClass="py-4">
    @slot("tools")
        <!-- Search Form -->
        <form
            action="{{ route("items.index") }}"
            method="GET"
            class="search-group relative"
        >
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    placeholder="Cari Barang"
                    class="w-full rounded-lg border-2 border-[--border-2-clr] bg-transparent py-3 pl-4 pr-12 text-[--text-clr] transition-all duration-300 focus:border-[--primary-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr]"
                    value="{{ request("search") }}"
                />
                <!-- Sertakan parameter kategori yang aktif -->
                @if (request()->has("categories"))
                    @foreach (request()->input("categories") as $category)
                        <input
                            type="hidden"
                            name="categories[]"
                            value="{{ $category }}"
                        />
                    @endforeach
                @endif

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
        <x-button-group>
            <!-- Dropdown Tambah -->
            <x-button-menu
                dropdown="true"
                caret="true"
                id="tambah-google"
                color="green"
                icon="fas fa-plus"
                text="Tambah"
            >
                <div class="space-y-2 p-2">
                    <button
                        id="openItemModal"
                        class="flex w-full items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--green-3-clr] hover:text-white"
                    >
                        <i class="fas fa-box"></i>
                        Tambah Barang
                    </button>
                    <button
                        id="openUnitModal"
                        class="flex w-full items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--green-3-clr] hover:text-white"
                    >
                        <i class="fas fa-cube"></i>
                        Tambah Unit
                    </button>
                </div>
            </x-button-menu>

            <!-- Dropdown Print -->
            <x-button-menu
                dropdown="true"
                caret="true"
                id="dropdown-toggle"
                color="primary"
                icon="fa-solid fa-file"
                text="Print"
            >
                <div class="space-y-2 p-2">
                    <a
                        id="export-pdf"
                        data-base-url="{{ route("items.export.pdf") }}"
                        href="{{ route("items.export.pdf") }}?{{ http_build_query(request()->all()) }}"
                        class="flex items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--primary-clr] hover:text-white"
                    >
                        <i class="fas fa-file-pdf"></i>
                        PDF
                    </a>
                    <a
                        id="export-excel"
                        href="#"
                        data-base-url="{{ route("items.export.excel") }}"
                        class="flex items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--primary-clr] hover:text-white"
                    >
                        <i class="fas fa-file-excel"></i>
                        Excel
                    </a>
                </div>
            </x-button-menu>
        </x-button-group>
        <!-- Pagination Start -->
        <div id="pagination-wrapper">
            <x-pagination
                :paginator="$items"
                RouteName="items.index"
                :queryParams="request()->except('page')"
            ></x-pagination>
        </div>
    @endslot

    <!-- Pagination End -->
    @slot("filtering")
        <form id="filterForm" method="GET" action="{{ route("items.index") }}">
            <div
                id="selectionFilter"
                class="scrollbar relative grid max-h-[200px] grid-cols-2 gap-4 overflow-y-auto pb-[5vh] pr-2"
            >
                @foreach ($categories as $category)
                    <div
                        class="check-group relative max-h-10 cursor-pointer overflow-hidden"
                    >
                        <input
                            type="checkbox"
                            name="categories[]"
                            id="category{{ $category->category_id }}"
                            value="{{ $category->category_name }}"
                            class="category-checkbox peer absolute inset-0 h-full w-full appearance-none rounded-lg border-2 border-[--border-clr] transition-all duration-300 ease-in-out checked:border-[--primary-hover-clr] checked:bg-[--primary-clr] hover:border-[--primary-clr]"
                            {{ in_array($category->category_name, (array) request("categories")) ? "checked" : "" }}
                        />
                        <label
                            for="category{{ $category->category_id }}"
                            class="relative z-10 grid h-full w-full cursor-pointer select-none place-items-center bg-transparent p-2 text-center text-[--border-clr] transition-all duration-300 ease-in-out peer-checked:text-[--text-clr]"
                        >
                            <span class="text-[.75rem] font-medium">
                                {{ $category->category_name }}
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
        </form>
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

<!--============a MODAL ================-->
<!-- Tambah Barang -->
@include("components.items.add-item-modal")
<!-- Modal Tambah Unit -->
@include("components.item-units.add-item-unit-modal")
