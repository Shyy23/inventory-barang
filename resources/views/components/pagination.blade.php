@props([
    "paginator",
    "routeName" => null,
    "routeParams" => [],
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

                $queryParams = request()->except("page");
            @endphp

            {{-- First Page --}}
            @if ($start > 1)
                <a
                    href="{{ $routeName ? route($routeName, array_merge($routeParams, ["page" => 1], $queryParams)) : $paginator->url(1) }}"
                    class="{{ 1 == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                >
                    1
                </a>

                {{-- Left Ellipsis --}}
                @if ($start > 2)
                    <a
                        href="{{ $routeName ? route($routeName, array_merge($routeParams, ["page" => max(1, $currentPage - 2)], $queryParams)) : $paginator->url(max(1, $currentPage - 2)) }}"
                        class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                    >
                        ...
                    </a>
                @endif
            @endif

            {{-- Page Numbers --}}
            @foreach (range($start, $end) as $page)
                <a
                    href="{{ $routeName ? route($routeName, array_merge($routeParams, ["page" => $page], $queryParams)) : $paginator->url($page) }}"
                    class="{{ $page == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                >
                    {{ $page }}
                </a>
            @endforeach

            {{-- Last Page --}}
            @if ($end < $lastPage)
                {{-- Right Ellipsis --}}
                @if ($end < $lastPage - 1)
                    <a
                        href="{{ $routeName ? route($routeName, array_merge($routeParams, ["page" => min($lastPage, $currentPage + 2)], $queryParams)) : $paginator->url(min($lastPage, $currentPage + 2)) }}"
                        class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                    >
                        ...
                    </a>
                @endif

                <a
                    href="{{ $routeName ? route($routeName, array_merge($routeParams, ["page" => $lastPage], $queryParams)) : $paginator->url($lastPage) }}"
                    class="{{ $lastPage == $currentPage ? "text-[--primary-clr]" : "text-[--border-2-clr]" }} transition-colors hover:text-[--primary-clr]"
                >
                    {{ $lastPage }}
                </a>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="NextPrev grid grid-cols-2 gap-2">
            {{-- Previous --}}
            <a
                href="{{ $paginator->previousPageUrl() . "&" . http_build_query($queryParams) }}"
                class="{{ $paginator->onFirstPage() ? "invisible" : "" }} rounded-full border-2 border-[--primary-clr] p-2 text-center font-semibold text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
            >
                <i class="fa-solid fa-angle-left"></i>
                <span>Prev</span>
            </a>

            {{-- Next --}}
            <a
                href="{{ $paginator->nextPageUrl() . "&" . http_build_query($queryParams) }}"
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
