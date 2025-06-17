@extends("layouts.app")
@push("styles")
    <style>
        .loading {
            position: relative;
        }
        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 1);
        }
    </style>
@endpush

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
