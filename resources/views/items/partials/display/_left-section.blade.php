<div id="imageDisplay" class="group block h-full w-full cursor-pointer">
    @if ($item->image && file_exists(public_path($item->image)))
        <img
            src="{{ asset($item->image) }}"
            alt="{{ $item->item_name }}"
            class="h-full w-full object-contain transition-transform group-hover:scale-110"
        />
    @else
        <div
            class="flex h-full w-full items-center justify-center bg-white text-5xl text-[--text-clr]"
        >
            <i class="fas fa-cube"></i>
            <img
                src="https://placehold.co/215"
                alt="{{ $item->item_name }}"
                class="hidden h-full w-full object-contain transition-transform group-hover:scale-110"
            />
        </div>
    @endif
</div>
