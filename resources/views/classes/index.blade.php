@extends("layouts.app")
@section("title", "Manage Kelas")
@section("page title", "Manage Kelas")
@section("breadcrumbs")
    @php
        $breadcrumbs = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            ["text" => "Class"],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbs" />
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <!-- Menu Helper -->
        @include("classes.partials._menu-helper")
        <!-- Container utama untuk scroll -->
        @include("classes.partials._class-list")

        <!-- Modal -->
        @include("classes.partials.modals._add")
        @include("classes.partials.modals._delete")
        @include("classes.partials.modals._edit")
    </div>
@endsection

@push("scripts")
    <script>
        window.Laravel = {
            routes: {
                classesIndex: '{{ route("classes.index") }}',
            },
        };
    </script>
    <script
        type="module"
        src="{{ asset("js/module/manage-classes.js") }}"
    ></script>
@endpush
