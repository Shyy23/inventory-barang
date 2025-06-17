@extends("layouts.app")
@push("styles")
    <style>
        .input-field {
            @apply w-full rounded border border-[--border-clr] bg-[--body-clr] p-2 text-[--text-clr];
        }
        .btn-submit {
            @apply rounded-lg bg-[--green-3-clr] px-4 py-2 text-white transition-colors hover:bg-[--green-4-clr];
        }
        .btn-cancel {
            @apply rounded-lg bg-[--red-2-clr] px-4 py-2 text-white transition-colors hover:bg-[--red-3-clr];
        }
        textarea {
            max-height: 150px;
        }
        #addItemModal input,
        #addItemModal textarea,
        #addItemModal select,
        #addUnitModal input,
        #addUnitModal textarea,
        #addUnitModal select {
            min-height: 42px;
            box-shadow:
                4px 4px 4px var(--shadow-input-clr) inset,
                -3px -3px 3px var(--shadow-input-clr) inset;
            border-radius: .25rem;
            background: var(--body-clr);
            color: var(--text-clr);
         }
        #addItemModal select,
        #addUnitModal select{
            cursor: pointer;
        }
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
