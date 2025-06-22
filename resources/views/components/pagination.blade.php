@props([
    "paginator",
    "routeName" => null,
    "routeParams" => [],
    "queryParams" => [],
])

@if ($paginator->hasPages())
    <div
        {{ $attributes->merge(["class" => "pagination grid w-full grid-cols-[1fr] items-center gap-4"]) }}
    >
        <!-- Page Numbers Container -->
        <div class="mx-auto flex justify-center gap-4">
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $start = max(1, $currentPage - 1);
                $end = min($lastPage, $currentPage + 1);

                // Adjust if near the start
                if ($currentPage <= 3) {
                    $end = min(5, $lastPage);
                }

                // Adjust if near the end
                if ($currentPage >= $lastPage - 2) {
                    $start = max($lastPage - 4, 1);
                }
            @endphp

            {{-- First Page --}}
            @if ($start > 1)
                <a
                    href="{{ $routeName ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => 1])) : $paginator->url(1) }}"
                    class="{{ $currentPage == 1 ? "text-[--primary-clr]" : "text-[--border-2-clr]" }}"
                >
                    1
                </a>

                {{-- Left Ellipsis --}}
                @if ($start > 2)
                    <a
                        href="{{ $routeName ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => max(1, $currentPage - 2)])) : $paginator->url(max(1, $currentPage - 2)) }}"
                        class="text-[--border-2-clr]"
                    >
                        ...
                    </a>
                @endif
            @endif

            {{-- Page Numbers --}}
            @foreach (range($start, $end) as $page)
                <a
                    href="{{ $routeName ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => $page])) : $paginator->url($page) }}"
                    class="{{ $page == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }}"
                >
                    {{ $page }}
                </a>
            @endforeach

            {{-- Last Page --}}
            @if ($end < $lastPage)
                {{-- Right Ellipsis --}}
                @if ($end < $lastPage - 1)
                    <a
                        href="{{ $routeName ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => min($lastPage, $currentPage + 2)])) : $paginator->url(min($lastPage, $currentPage + 2)) }}"
                        class="text-[--border-2-clr]"
                    >
                        ...
                    </a>
                @endif

                <a
                    href="{{ $routeName ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => $lastPage])) : $paginator->url($lastPage) }}"
                    class="{{ $page == $lastPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }}"
                >
                    {{ $lastPage }}
                </a>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="NextPrev grid grid-cols-2 gap-2">
            {{-- Previous --}}
            <a
                href="{{ $paginator->previousPageUrl() ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => $paginator->currentPage() - 1])) : "#" }}"
                class="{{ $paginator->onFirstPage() ? "invisible" : "" }} rounded-full border-2 border-[--primary-clr] p-2 text-center font-semibold text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
            >
                <i class="fa-solid fa-angle-left"></i>
                <span>Prev</span>
            </a>

            {{-- Next --}}
            <a
                href="{{ $paginator->nextPageUrl() ? route($routeName, $routeParams) . "?" . http_build_query(array_merge($queryParams, ["page" => $paginator->currentPage() + 1])) : "#" }}"
                class="{{ ! $paginator->hasMorePages() ? "invisible" : "" }} rounded-full border-2 border-[--primary-clr] p-2 text-center font-semibold text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
            >
                <span>Next</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
    </div>
@else
    {{-- Tampilan Ketika Tidak Ada Halaman --}}
    <div class="mt-4 text-center text-sm text-[--secondary-clr]">
        Semua data sudah ditampilkan.
    </div>
@endif
