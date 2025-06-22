<section
    class="scrollbar card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
>
    @if ($classes->isEmpty())
        <div class="grid h-screen w-full place-items-center">
            <h3 class="text-2xl font-bold text-[--text-clr]">
                No Locations Found
            </h3>
        </div>
    @else
        <div
            class="grid h-screen w-max auto-cols-[minmax(180px,1fr)] grid-flow-col grid-rows-3 gap-4 p-4"
        >
            <!-- Semua 16 Card -->
            @foreach ($classes as $class)
                <a
                    href="{{ route("classes.students", ["slug_class" => $class->slug_class]) }}"
                >
                    <article
                        class="card-location shadow-card relative flex aspect-square h-full cursor-pointer select-none flex-col items-center justify-between rounded-lg bg-[--body-clr] p-4 transition-transform duration-500 hover:-translate-y-2"
                    >
                        <header
                            class="w-full border-b border-[--border-clr] pb-1 text-center"
                        >
                            <h3 class="text-md font-semibold">
                                {{ $class->class_name }}
                            </h3>
                        </header>
                        <section
                            class="flex w-full justify-center gap-1 text-center"
                        >
                            <span
                                class="transition-colors hover:text-[--primary-clr]"
                            >
                                {{ $class->student_count > 0 ? $class->student_count . " siswa" : "Tidak ada siswa" }}
                            </span>
                        </section>
                        <footer
                            class="w-full border-t border-[--border-clr] pt-1 text-center"
                        >
                            <p>{{ $class->class_location }}</p>
                        </footer>
                    </article>
                </a>
            @endforeach
        </div>
    @endif
</section>
