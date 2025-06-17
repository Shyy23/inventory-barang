<section
    class="scrollbar card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
>
    @if ($locations->isEmpty())
        <div class="grid h-screen w-full place-items-center">
            <h3 class="text-2xl font-bold text-[--text-clr]">
                No Locations Found
            </h3>
        </div>
    @else
        <div
            class="grid h-screen w-max auto-cols-[minmax(180px,1fr)] grid-flow-col grid-rows-3 gap-4 p-4"
        >
            @foreach ($locations as $location)
                <a
                    href="{{
                        $location->type === "class"
                            ? route("classes.index")
                            : route("items.index")
                    }}"
                    class="no-underline"
                >
                    <article
                        class="card-location shadow-card relative flex aspect-square h-full cursor-pointer select-none flex-col items-center justify-between rounded-lg bg-[--body-clr] p-4 transition-transform duration-500 hover:-translate-y-2"
                    >
                        <!-- Isi card tetap sama -->
                        <header
                            class="w-full border-b border-[--border-clr] pb-1 text-center"
                        >
                            <h3 class="text-md font-semibold">
                                {{ $location->location_name }}
                            </h3>
                        </header>
                        <section
                            class="flex w-full justify-center gap-1 text-center"
                        >
                            <ul>
                                @if ($location->object_names)
                                    @php
                                        $objectNames = explode(",", $location->object_names);
                                        $slugObjects = explode(",", $location->slug_objects);
                                    @endphp

                                    @foreach ($objectNames as $index => $objectName)
                                        <li>
                                            <span
                                                class="text-[--text-clr] transition-colors hover:text-[--primary-clr]"
                                            >
                                                {{ trim($objectName) }}
                                            </span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Tidak Ada Object Terkait</li>
                                @endif
                            </ul>
                        </section>
                        <footer
                            class="w-full border-t border-[--border-clr] pt-1 text-center"
                        >
                            <p>{{ $location->type }}</p>
                        </footer>
                    </article>
                </a>
            @endforeach
        </div>
    @endif
</section>
