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

@section("title", "Manage Siswa")
@section("page title", "Manage Siswa")
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

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <!-- List -->
        @include("students.partials._student-list")
        <!-- Menu Helper -->
        @include("students.partials._menu-helper")
        <!-- Modals -->
        @include("students.partials.modals._edit")
        @include("students.partials.modals._delete")
        @include("students.partials.modals._info-class")
    </div>
@endsection

@push("scripts")
    <script>
        window.Laravel = {
            routes: {
                studentsIndex:
                    '{{ route("classes.students", ["slug_class" => $class->slug_class]) }}',
            },
        };
    </script>
    <script src="{{ asset("js/function/clipboard.js") }}"></script>
    <script
        type="module"
        src="{{ asset("js/module/manage-students.js") }}"
    ></script>
@endpush
