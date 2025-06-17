@props(["items" => []])

<ol
    class="grid grid-flow-col items-center justify-end gap-2 text-sm font-medium"
>
    @foreach ($items as $index => $breadcrumb)
        <li>
            @if ($loop->last)
                {{-- Item aktif (tanpa link) --}}
                <span class="breadcrumb-item text-[1rem] text-[--border-2-clr]">
                    {{ $breadcrumb["text"] }}
                </span>
            @else
                {{-- Item dengan link --}}
                <a
                    href="{{ $breadcrumb["url"] ?? "#" }}"
                    class="breadcrumb-item text-[1rem] text-[--primary-clr] transition-colors duration-300 hover:text-[--primary-hover-clr]"
                >
                    {{ $breadcrumb["text"] }}
                </a>
            @endif
        </li>

        {{-- Separator (kecuali untuk item terakhir) --}}
        @if (! $loop->last)
            <li class="px-1 text-center">
                <i
                    class="fa-solid fa-angle-right {{ $loop->last ? "text-[--border-2-clr]" : "text-[--primary-clr]" }} relative text-[.85rem]"
                ></i>
            </li>
        @endif
    @endforeach
</ol>
