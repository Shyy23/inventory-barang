<section
    class="scrollbar card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
>
    @if ($categories->isEmpty())
        <div class="grid h-screen w-full place-items-center">
            <h3 class="text-2xl font-bold text-[--text-clr]">
                No Categories Found
            </h3>
        </div>
    @else
        <div
            class="grid h-screen w-max auto-cols-[minmax(180px,1fr)] grid-flow-col grid-rows-3 gap-4 p-4"
        >
            <!-- Semua 16 Card -->
            @foreach ($categories as $category)
                <article
                    class="card-category shadow-card relative flex aspect-square h-full cursor-pointer select-none flex-col items-center justify-between rounded-lg bg-[--body-clr] p-4 transition-transform duration-500 hover:-translate-y-2"
                >
                    <header
                        class="w-full border-b border-[--border-clr] pb-1 text-center"
                    >
                        <h3 class="text-md font-semibold">
                            {{ $category->category_name }}
                        </h3>
                    </header>
                    <section
                        class="flex w-full justify-center gap-1 text-center"
                    >
                        <ul>
                            @forelse ($category->items as $item)
                                <li>
                                    <a
                                        class="text-[--text-clr] transition-colors hover:text-[--primary-clr]"
                                        href="{{ route("items.show", ["item" => $item->slug_item]) }}"
                                    >
                                        {{ $item->item_name }}
                                    </a>
                                </li>
                            @empty
                                <li>Tidak ada item</li>
                            @endforelse
                        </ul>
                    </section>
                    <footer
                        class="w-full border-t border-[--border-clr] pt-1 text-center"
                    >
                        <p class="badge">
                            Jumlah Item :
                            <span>{{ $category->items->count() }}</span>
                        </p>
                    </footer>
                </article>
            @endforeach
        </div>
    @endif
</section>
