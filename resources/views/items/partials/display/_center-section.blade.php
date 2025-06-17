<div id="infoDisplay" class="block">
    <div class="flex items-center gap-2">
        <span class="text-lg font-bold">
            {{ $item->item_name }}
        </span>
        <!-- Status Badge -->
        <span
            class="status-detail cursor-pointer select-none rounded-full px-3 py-1 text-sm font-semibold text-[--text-clr]"
            style="
                background-color: {{ $item->status === "available" ? "var(--green-3-clr)" : "var(--red-2-clr)" }};
            "
        >
            {{ ucfirst($item->status) }}
        </span>
    </div>

    <div class="space-y-2 text-[--text-2-clr]">
        <div class="flex gap-2">
            <span class="font-semibold">Kategori:</span>
            <span>{{ $item->category_name }}</span>
        </div>
        <div class="flex gap-2">
            <span class="font-semibold">Lokasi:</span>
            <span>{{ $item->location_name }}</span>
        </div>
        @if ($units->count() > 0)
            <div class="flex gap-2">
                <span class="font-semibold">Total Unit:</span>
                <span>{{ $units->count() }}</span>
            </div>
        @endif

        <div class="flex gap-2">
            <span class="font-semibold">Stok Tersedia:</span>
            <span>{{ $item->stock }}</span>
        </div>
    </div>

    <div class="pt-4 text-[--text-2-clr]">
        <p class="text-sm opacity-90">
            {{ $item->description }}
        </p>
    </div>
</div>
