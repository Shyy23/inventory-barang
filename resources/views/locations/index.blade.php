@extends("layouts.app")
@section("title", "Manage Lokasi")
@section("page title", "Manage Lokasi")
@section("breadcrumbs")
    @php
        $breadcrumbs = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            ["text" => "Locations"],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbs" />
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        @include("locations.partials._menu-helper")
        @include("locations.partials._location-list")
        <!-- Modal -->
        @include("locations.partials.modals._add")
        @include("locations.partials.modals._delete")
        @include("locations.partials.modals._edit")
    </div>
@endsection

@push("scripts")
    <script>
        window.Laravel = {
            routes: {
                locationsIndex: '{{ route("locations.index") }}',
            },
        };
    </script>
    <script
        type="module"
        src="{{ asset("js/module/manage-locations.js") }}"
    ></script>
@endpush
