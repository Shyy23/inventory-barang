<section
    class="scrollbar card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
>
    @if ($items->isEmpty())
        <div class="grid h-screen w-full place-items-center">
            <h3 class="text-2xl font-bold text-[--text-clr]">No Items Found</h3>
        </div>
    @else
        <div
            class="grid h-screen w-max auto-cols-[minmax(180px,1fr)] grid-flow-col grid-rows-3 gap-4 p-4"
        >
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

                        @if ($item->image && file_exists(public_path($item->image)))
                            <img
                                src="{{ asset($item->image) }}"
                                class="h-full w-full rounded-lg object-contain"
                                alt="
                        item-image"
                            />
                        @else
                            <div
                                class="flex h-full w-full items-center justify-center bg-white text-5xl text-[--text-clr]"
                            >
                                <i class="fas fa-cube"></i>
                            </div>
                        @endif

                        <div
                            class="item-stock absolute order-1 flex w-full grid-cols-2 items-center justify-center gap-2 bg-[--container-card-clr] p-4 text-center font-semibold text-[--text-clr] transition-all duration-300"
                            data-stock="{{ $item->stock }}"
                        >
                            <p>Stock: {{ $item->stock }}</p>
                            <i class="fas icon-stock" data-tooltip=""></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>
