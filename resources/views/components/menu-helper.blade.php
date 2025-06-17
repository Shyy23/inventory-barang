@props([
    "asideClass" => "",
    "scrollableFilter" => false,
])

<aside
    class="{{ $asideClass }} relative order-1 flex h-screen w-[150px] flex-col overflow-hidden rounded-lg bg-[--container-clr] lg:w-[250px]"
>
    <!-- Tools Group -->
    <div
        class="tools-group flex flex-col gap-4 border-b-2 border-[--border-2-clr] p-4 pb-4"
    >
        {{ $tools }}
    </div>

    <!-- Filtering Group (optional) -->
    @if (isset($filtering))
        <div class="filtering relative mt-4 flex flex-col rounded-lg px-4">
            {{ $filtering }}
        </div>
    @endif

    <!-- Clear Button -->
    <div
        class="clear absolute bottom-0 z-10 mt-auto flex w-full justify-center overflow-hidden bg-[--container-clr] p-4"
    >
        {{ $clearButton }}
    </div>
</aside>
