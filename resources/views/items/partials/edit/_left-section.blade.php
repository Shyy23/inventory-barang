<div id="imageEdit" class="hidden h-full w-full">
    <div class="relative h-full w-full">
        @if ($item->image && file_exists(public_path($item->image)))
            <img
                id="imagePreview"
                src="{{ asset($item->image) }}"
                class="h-full w-full object-contain opacity-75 transition-opacity hover:opacity-100"
            />
            <input
                type="file"
                name="image"
                id="imageInput"
                class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                accept="image/*"
                form="infoEdit"
            />
            <div
                class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
            >
                <i class="fas fa-arrow-up-from-bracket text-3xl text-white"></i>
            </div>
        @else
            <img
                id="imagePreview"
                src="https://placehold.co/215"
                class="h-full w-full object-contain opacity-75 transition-opacity hover:opacity-100"
            />
            <input
                type="file"
                name="image"
                id="imageInput"
                class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                accept="image/*"
                form="infoEdit"
            />
            <div
                class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
            >
                <i class="fas fa-arrow-up-from-bracket text-3xl text-white"></i>
            </div>
        @endif
    </div>
</div>
