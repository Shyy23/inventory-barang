@extends("layouts.app")
@section("title", "Manage Barang")
@section("page title", "Manage Barang")
@section("breadcrumbs")
    <ol
        class="grid grid-flow-col items-center justify-end gap-2 text-sm font-medium"
    >
        <!-- Item 1 -->
        <li>
            <a
                href="{{ route("admin.dashboard") }}"
                class="breadcrumb-item text-[1rem] text-[--primary-clr] transition-colors duration-300 hover:text-[--primary-hover-clr]"
            >
                Dashboard
            </a>
        </li>
        <!-- Separator -->
        <li class="px-1 text-center">
            <i
                class="fa-solid fa-angle-right relative text-[.85rem] text-gray-500"
            ></i>
        </li>
        <!-- Active Item -->
        <li>
            <a
                href="#"
                class="breadcrumb-item text-[1rem] text-[--border-2-clr]"
            >
                Items
            </a>
        </li>
    </ol>
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <section
            class="category-select order-1 h-screen w-[150px] rounded-lg bg-[--container-clr] p-4 lg:w-[250px]"
        >
            <div class="tools border-b-2 border-[--border-2-clr] pb-2">
                <div class="grid gap-6 p-4">
                    <form
                        action="{{ route("items.index") }}"
                        method="GET"
                        class="search-group relative"
                    >
                        <div class="relative">
                            <input
                                type="text"
                                name="search"
                                placeholder="Cari Barang"
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
                    <div
                        class="tambah cursor-pointer rounded-lg border-2 border-[--green-3-clr] bg-transparent p-4 text-center font-semibold text-[--green-3-clr] transition-all duration-[.3s] ease-in-out hover:bg-[--green-3-clr] hover:text-[--text-clr]"
                    >
                        <a href="{{ route("items.create") }}" class="">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Barang</span>
                        </a>
                    </div>
                    <div class="relative" id="dropdown-container">
                        <!-- Hidden checkbox -->
                        <input
                            type="checkbox"
                            id="dropdown-toggle"
                            class="peer hidden"
                        />

                        <!-- Toggle Button -->
                        <label
                            for="dropdown-toggle"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded-lg border-2 border-[--primary-clr] bg-transparent p-4 text-center font-semibold text-[--primary-clr] transition-all duration-[.3s] ease-in-out hover:bg-[--primary-clr] hover:text-[--text-clr]"
                        >
                            <i class="fa-solid fa-file"></i>
                            <span>Print</span>
                            <i
                                class="fas fa-caret-down ml-2 transition-transform peer-checked:rotate-180"
                            ></i>
                        </label>

                        <!-- Dropdown Menu -->
                        <div
                            class="invisible absolute z-10 mt-2 w-full origin-top rounded-lg bg-[--container-clr] opacity-0 shadow-lg transition-all duration-200 peer-checked:visible peer-checked:opacity-100"
                        >
                            <div class="space-y-2 p-2">
                                <a
                                    href="{{ route("items.export.pdf") }}?{{ http_build_query(request()->all()) }}"
                                    class="flex items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--primary-clr] hover:text-white"
                                >
                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </a>
                                <a
                                    href="{{ route("items.export.excel") }}?{{ http_build_query(request()->all()) }}"
                                    class="flex items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--primary-clr] hover:text-white"
                                >
                                    <i class="fas fa-file-excel"></i>
                                    Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="pagination grid w-full grid-cols-[1fr] items-center gap-4"
                    >
                        <!-- Page Numbers Container -->
                        <div class="mx-auto flex justify-center gap-4">
                            @php
                                $currentPage = $items->currentPage();
                                $lastPage = $items->lastPage();
                                $start = max(1, $currentPage - 1);
                                $end = min($lastPage, $currentPage + 1);

                                //Adjust if near the start
                                if ($currentPage <= 3) {
                                    $end = min(5, $lastPage);
                                }

                                //Adjust if near the end
                                if ($currentPage >= $lastPage - 2) {
                                    $start = max($lastPage - 4, 1);
                                }

                                $leftJumpPage = max(1, $currentPage - 2);
                                $rightJumPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if ($start > 1)
                                <a
                                    href="{{ $items->url(1) }}&{{ http_build_query(request()->except("page")) }}"
                                    class="{{ 1 == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                                >
                                    1
                                </a>
                                @if ($start > 2)
                                    <a
                                        href="{{ $items->url($leftJumpPage) }}&{{ http_build_query(request()->except("page")) }}"
                                        class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                                    >
                                        ...
                                    </a>
                                @endif
                            @endif

                            @foreach (range($start, $end) as $page)
                                <a
                                    href="{{ $items->url($page) }}&{{ http_build_query(request()->except("page")) }}"
                                    class="{{ $page == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                                >
                                    {{ $page }}
                                </a>
                            @endforeach

                            @if ($end < $lastPage)
                                @if ($end < $lastPage - 1)
                                    <a
                                        href="{{ $items->url($rightJumPage) }}&{{ http_build_query(request()->except("page")) }}"
                                        class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                                    >
                                        ...
                                    </a>
                                @endif

                                <a
                                    href="{{ $items->url($lastPage) }}&{{ http_build_query(request()->except("page")) }}"
                                    class="{{ $lastPage == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                                >
                                    {{ $lastPage }}
                                </a>
                            @endif
                        </div>
                        <div class="NextPrev grid grid-cols-2 gap-2">
                            <!-- Previous Page -->
                            <a
                                href="{{ $items->previousPageUrl() }}&{{ http_build_query(request()->except("page")) }}"
                                class="{{ $items->onFirstPage() ? "invisible" : "" }} rounded-full border-2 border-[--primary-clr] p-2 text-center font-semibold text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
                            >
                                <i class="fa-solid fa-angle-left"></i>
                                <span>Prev</span>
                            </a>
                            <!-- Next Page -->
                            <a
                                href="{{ $items->nextPageUrl() }}&{{ http_build_query(request()->except("page")) }}"
                                class="{{ $items->hasMorePages() ? "" : "invisible" }} rounded-full border-2 border-[--primary-clr] p-2 text-center font-semibold text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
                            >
                                <span>Next</span>
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filtering relative mt-4 flex flex-col rounded-lg p-2">
                <!-- Bagian Selection Filter -->
                <form
                    id="filterForm"
                    method="GET"
                    action="{{ route("items.index") }}"
                >
                    <div
                        class="selection-filter relative grid max-h-[200px] flex-1 grid-cols-2 gap-4 overflow-y-auto pr-2"
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
                    <div class="clear bottom-0 mt-auto p-4">
                        <button
                            class="w-full rounded-lg bg-[--primary-clr] px-4 py-2 text-sm font-medium text-white transition-all duration-300 hover:bg-[--primary-hover-clr]"
                            type="button"
                            onclick="clearFilters()"
                        >
                            Clear
                        </button>
                    </div>
                </form>

                <!-- Bagian Clear Button -->
            </div>
        </section>
        <!-- Container utama untuk scroll -->
        @include("items.partials.items-list", ["items" => $items])
    </div>
@endsection

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filterForm');
            const itemsContainer = document.querySelector('.card-items-scroll');

            // Handle checkbox change
            document
                .querySelectorAll('.category-checkbox')
                .forEach((checkbox) => {
                    checkbox.addEventListener('change', async () => {
                        await applyFilters();
                        updateURL();
                    });
                });

            // Handle Clear Button
            window.clearFilters = async () => {
                document
                    .querySelectorAll('.category-checkbox')
                    .forEach((cb) => (cb.checked = false));
                await applyFilters();
                updateURL(true);
            };

            async function applyFilters() {
                try {
                    const formData = new FormData(filterForm);
                    const params = new URLSearchParams(formData).toString();

                    // Tampilkan loading state
                    itemsContainer.classList.add('loading');

                    const response = await fetch(
                        `{{ route("items.index") }}?${params}`,
                        {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                Accept: 'application/json', // Minta response JSON
                            },
                        },
                    );

                    if (!response.ok)
                        throw new Error('Network response was not ok');

                    const data = await response.json(); // Parse sebagai JSON

                    // Update items
                    itemsContainer.innerHTML = data.html;

                    // Update checkboxes state
                    document
                        .querySelectorAll('.category-checkbox')
                        .forEach((checkbox) => {
                            checkbox.checked = data.checks.includes(
                                checkbox.value,
                            );
                        });
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    itemsContainer.classList.remove('loading');
                }
            }

            function updateURL(clear = false) {
                const params = new URLSearchParams(new FormData(filterForm));
                if (clear) params.delete('categories[]');

                const url = new URL(window.location);
                url.search = params.toString();
                history.replaceState(null, '', url.toString());
            }
        });

        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('dropdown-toggle');
            if (!e.target.closest('.relative')) {
                dropdown.checked = false;
            }
        });
    </script>
@endpush
