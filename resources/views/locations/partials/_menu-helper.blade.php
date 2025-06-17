<x-menu-helper asideClass="py-4">
    @slot("tools")
        <!-- Search Form -->
        <form
            action="{{ route("locations.index") }}"
            method="GET"
            class="search-group relative w-full"
        >
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    placeholder="Cari Lokasi"
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
                id="showLocationModal"
                color="green"
                icon="fas fa-plus text-xl"
                text="Tambah"
                class="px-4 py-3"
            />

            <x-button-menu
                id="showEditLocationModal"
                color="primary"
                icon="fas fa-edit text-xl"
                text="Edit"
                class="px-4 py-3"
            />

            <x-button-menu
                id="showDeleteLocationModal"
                color="red"
                icon="fas fa-trash text-xl"
                text="Hapus"
                class="px-4 py-3"
            />
        </x-button-group>

        <!-- Pagination Start -->
        <div id="pagination-wrapper">
            <x-pagination
                :paginator="$locations"
                RouteName="locations.index"
                :RouteParams="request()->except('page')"
            />
        </div>
        <!-- Pagination End -->
    @endslot

    @slot("filtering")
        <form
            id="filterTypeLocationForm"
            method="GET"
            action="{{ route("locations.index") }}"
        >
            <div class="flex flex-col items-center justify-center gap-4">
                <!-- Radio Item -->
                <label class="inline-flex w-full cursor-pointer items-center">
                    <input
                        type="radio"
                        name="type"
                        value="item"
                        class="peer hidden"
                        {{ request("type") === "item" ? "checked" : "" }}
                    />
                    <div
                        class="w-full rounded-lg border-2 border-[--border-clr] px-4 py-3 text-center font-semibold ring-2 ring-[--border-clr] transition-all duration-300 ease-in-out hover:border-[--primary-clr] hover:text-[--primary-clr] hover:ring-[--primary-clr] peer-checked:border-[--primary-hover-clr] peer-checked:bg-[--primary-clr] peer-checked:ring-[--primary-hover-clr] peer-checked:hover:text-[--text-clr]"
                    >
                        Item
                    </div>
                </label>

                <!-- Radio Class -->
                <label class="inline-flex w-full cursor-pointer items-center">
                    <input
                        type="radio"
                        name="type"
                        value="class"
                        class="peer hidden"
                        {{ request("type") === "item" ? "checked" : "" }}
                    />
                    <div
                        class="w-full rounded-lg border-2 border-[--border-clr] px-4 py-3 text-center font-semibold ring-2 ring-[--border-clr] transition-all duration-300 ease-in-out hover:border-[--primary-clr] hover:text-[--primary-clr] hover:ring-[--primary-clr] peer-checked:border-[--primary-hover-clr] peer-checked:bg-[--primary-clr] peer-checked:ring-[--primary-hover-clr] peer-checked:hover:text-[--text-clr]"
                    >
                        Class
                    </div>
                </label>
            </div>
        </form>
    @endslot

    @slot("clearButton")
        <button
            class="w-full rounded-lg bg-[--primary-clr] px-4 py-2 text-sm font-medium text-white transition-all duration-300 hover:bg-[--primary-hover-clr]"
            type="button"
            id="clearFilterTypeSelection"
        >
            Clear
        </button>
    @endslot
</x-menu-helper>
