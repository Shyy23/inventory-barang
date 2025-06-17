@props([
    "direction" => "vertical",
    "spacing" => "4",
    "border" => false,
])

@php
    $directionClass = $direction === "vertical" ? "flex-col" : "flex-row";
    $spacingClass = "gap-$spacing";
    $borderCLass = $border ? "border-b border-[--border-clr] pb-4" : "";
@endphp

<div
    class="{{ $directionClass }} {{ $spacingClass }} {{ $borderCLass }} flex"
>
    {{ $slot }}
</div>
