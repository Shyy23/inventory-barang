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

@section("title", "Manage Murid")
@section("page title", "Manage Murid")
@section("breadcrumbs")
    @php
        $breadcrumbs = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            [
                "text" => "Class",
                "url" => route("classes.index"),
            ],
            ["text" => $class->class_name],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbs" />
@endsection
