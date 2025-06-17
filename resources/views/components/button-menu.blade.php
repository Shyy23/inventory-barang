@props([
    "type" => "button",
    "color" => "primary",
    "icon" => null,
    "text" => "",
    "dropdown" => false,
    "caret" => false,
    "id" => null,
    "class" => "",
])

@php
    // Color Mapping
    $colors = [
        "primary" => [
            "border" => "border-[--primary-clr]",
            "text" => "text-[--primary-clr]",
            "hover" => "hover:bg-[--primary-clr] hover:text-[--text-clr]",
        ],
        "green" => [
            "border" => "border-[--green-3-clr]",
            "text" => "text-[--green-3-clr]",
            "hover" => "hover:bg-[--green-3-clr] hover:text-[--text-clr]",
        ],
        "red" => [
            "border" => "border-[--red-2-clr]",
            "text" => "text-[--red-2-clr]",
            "hover" => "hover:bg-[--red-2-clr] hover:text-[--text-clr]",
        ],
    ];

    $colorClasses = $colors[$color] ?? $colors["primary"];
    $baseClasses = "flex items-center justify-center gap-2 rounded-lg border-2 bg-transparent p-4 text-center font-semibold transition-all duration-300";
@endphp

@if ($dropdown)
    <div class="dropdown relative" id="{{ $id }}-container">
        <input
            type="checkbox"
            id="{{ $id }}"
            class="dropdown-toggle peer hidden"
        />
        <label
            for="{{ $id }}"
            class="{{ $baseClasses }} {{ $colorClasses["border"] }} {{ $colorClasses["text"] }} {{ $colorClasses["hover"] }} {{ $class }} cursor-pointer select-none"
        >
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif

            <span>{{ $text }}</span>
            @if ($caret)
                <i
                    class="fas fa-caret-down ml-2 transition-transform peer-checked:rotate-180"
                ></i>
            @endif
        </label>
        <div
            class="dropdown-menu {{ $colorClasses["border"] }} invisible absolute z-[25] mt-2 w-full origin-top rounded-lg border-2 bg-[--container-clr] opacity-0 shadow-lg transition-all duration-200 peer-checked:visible peer-checked:opacity-100"
        >
            {{ $slot }}
        </div>
    </div>
@else
    <button
        type="{{ $type }}"
        id="{{ $id }}"
        class="{{ $baseClasses }} {{ $colorClasses["border"] }} {{ $colorClasses["text"] }} {{ $colorClasses["hover"] }} {{ $class }}"
    >
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif

        <span>{{ $text }}</span>
    </button>
@endif
