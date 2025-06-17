<x-menu-helper asideClass="py-4">
    @slot("tools")
        <form
            action="{{ route("classes.index") }}"
            method="GET"
            class="search-group relative w-full"
        >
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    placeholder="Cari Class"
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
                id="showClassModal"
                color="green"
                icon="fas fa-plus text-xl"
                text="Tambah"
                class="px-4 py-3"
            />

            <x-button-menu
                id="showEditClassModal"
                color="primary"
                icon="fas fa-edit text-xl"
                text="Edit"
                class="px-4 py-3"
            />

            <x-button-menu
                id="showDeleteClassModal"
                color="red"
                icon="fas fa-trash text-xl"
                text="Hapus"
                class="px-4 py-3"
            />
        </x-button-group>
        <!-- Pagination Start -->
        <div id="pagination-wrapper">
            <x-pagination
                :paginator="$classes"
                RouteName="classes.index"
                :RouteParams="request()->except('page')"
            />
        </div>
        <!-- Pagination End -->
    @endslot

    @slot("filtering")
    <form
        id="filterLevelClassForm"
        method="GET"
        action="{{ route("classes.index") }}"
    >
        <div
            id="selectionFilter"
            class="scrollbar relative grid max-h-[200px] grid-cols-2 gap-4 overflow-y-auto pb-[5vh] pr-2"
        >
            @foreach ($levels as $level)
                <div
                    class="check-group relative max-h-10 cursor-pointer overflow-hidden"
                >
                    <input
                        type="checkbox"
                        name="levels[]"
                        id="level{{ $loop->index }}"
                        value="{{ $level }}"
                        class="category-checkbox peer absolute inset-0 h-full w-full appearance-none rounded-lg border-2 border-[--border-clr] transition-all duration-300 ease-in-out checked:border-[--primary-hover-clr] checked:bg-[--primary-clr] hover:border-[--primary-clr]"
                        {{ in_array($level, (array) request("levels")) ? "checked" : "" }}
                    />
                    <label
                        for="level{{ $loop->index }}"
                        class="relative z-10 grid h-full w-full cursor-pointer select-none place-items-center bg-transparent p-2 text-center text-[--border-clr] transition-all duration-300 ease-in-out peer-checked:text-[--text-clr]"
                    >
                        <span class="text-[.75rem] font-medium">
                            {{ $level }}
                        </span>
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Optional Submit Button -->
        <button type="submit" class="hidden">Submit</button>
    </form>
    @endSlot

    @slot("clearButton")
        <button
            class="w-full rounded-lg bg-[--primary-clr] px-4 py-2 text-sm font-medium text-white transition-all duration-300 hover:bg-[--primary-hover-clr]"
            type="button"
            id="clearFilterLevelSelection"
        >
            Clear
        </button>
    @endslot
</x-menu-helper>
