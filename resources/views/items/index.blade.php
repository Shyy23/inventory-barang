@extends("layouts.app")
@section("title", "Manage Barang")
@section("page title", "Manage Barang")
@section("breadcrumbs")
    @php
        $breadcrumbs = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            ["text" => "Items"],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbs" />
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <!-- Menu Helper -->
        @include("items.partials._menu-helper")
        <!-- Container utama untuk scroll -->
        @include("items.partials.items-list", ["items" => $items])
    </div>
@endsection

@push("scripts")
    <script>
        window.Laravel = {
            routes: {
                itemsIndex: '{{ route("items.index") }}',
            },
        };
    </script>
    <script
        type="module"
        src="{{ asset("js/module/manage-item.js") }}"
    ></script>
@endpush
