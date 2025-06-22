@extends("layouts.app")
@push("styles")
    
@endpush

@section("title", "Manage Kategori")
@section("page title", "Manage Kategori")
@section("breadcrumbs")
    @php
        $breadcrumbs = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            ["text" => "Categories"],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbs" />
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <!-- Menu Helper -->
        @include("categories.partials._menu-helper")
        <!-- Category List -->
        @include("categories.partials._category-list")

        <!-- Modal -->
        @include("categories.partials.modal._add-modal")
        @include("categories.partials.modal._delete-modal")
        @include("categories.partials.modal._edit-modal")
    </div>
@endsection

@push("scripts")
<script>
        window.Laravel = {
            routes: {
                categoriesIndex: '{{ route("categories.index") }}',
            },
        };
    </script>
    <script
        type="module"
        src="{{ asset("js/module/manage-categories.js") }}"
    ></script>
@endpush
