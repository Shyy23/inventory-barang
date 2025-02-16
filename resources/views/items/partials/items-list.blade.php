<section
    class="card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
>
    <div
        class="grid h-screen w-max auto-cols-[minmax(180px,1fr)] grid-flow-col grid-rows-3 gap-4 p-4"
    >
        @if ($items->isEmpty())
            <a
                class="card-item relative aspect-square h-full cursor-pointer select-none rounded-lg bg-white p-4 transition-transform duration-500"
            >
                <!-- Sisi Depan -->
                <div
                    class="card-front backface-hidden absolute left-0 top-0 grid h-full w-full place-items-center overflow-hidden rounded-lg bg-white"
                >
                    <p class="font-semibold text-[--primary-clr]">
                        No Items Found
                    </p>
                </div>
            </a>
        @else
            <!-- Semua 16 Card -->
            @foreach ($items as $item)
                <a
                    href="{{ route("items.show", ["item" => $item->slug_item]) }}"
                    class="card-item relative aspect-square h-full cursor-pointer select-none rounded-lg bg-white p-4 transition-transform duration-500"
                >
                    <!-- Sisi Depan -->
                    <div
                        class="card-front backface-hidden absolute left-0 top-0 grid h-full w-full place-items-center overflow-hidden rounded-lg bg-white"
                    >
                        <div
                            class="card-item-title absolute w-full bg-[--container-card-clr] p-4 text-center font-semibold text-[--text-clr] transition-all duration-300"
                        >
                            <h3>{{ $item->item_name }}</h3>
                        </div>
                        <img
                            src="{{ asset($item->image) }}"
                            class="h-full w-full rounded-lg object-contain"
                            alt="
                        item-image"
                        />
                        <div
                            class="item-stock absolute order-1 flex w-full grid-cols-2 items-center justify-center gap-2 bg-[--container-card-clr] p-4 text-center font-semibold text-[--text-clr] transition-all duration-300"
                            data-stock="{{ $item->stock }}"
                        >
                            <p>Stock: {{ $item->stock }}</p>
                            <i class="fas icon-stock"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</section>
