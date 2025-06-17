@extends("layouts.app")
@push("styles")
    <style>
        input,
        textarea,
        select {
            min-height: 42px;
            box-shadow:
                4px 4px 4px var(--shadow-input-clr) inset,
                -3px -3px 3px var(--shadow-input-clr) inset;
        }
        textarea {
            max-height: 150px;
        }
        .edit-overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
            display: none;
        }

        .edit-mode .group:hover .edit-overlay {
            opacity: 1;
        }

        #infoDisplay {
            transition: filter 0.3s ease;
        }

        .edit-mode #infoDisplay {
            filter: blur(2px);
            pointer-events: none;
            user-select: none;
        }
        ,
        /* Memastikan input file selalu dapat diklik */
        #imageInput {
            z-index: 10; /* Pastikan input file berada di atas elemen lain */
            cursor: pointer;
        }

        .group:hover .edit-overlay {
            display: flex; /* Tampilkan saat hover */
        }

        /* Styling untuk preview gambar */
        #imagePreview {
            transition: opacity 0.3s ease;
        }

        .edit-mode #imagePreview:hover {
            opacity: 1; /* Efek hover pada gambar */
        }
    </style>
@endpush

@section("title", "Manage Barang")
@section("page title", "Manage Barang")
@section("breadcrumbs")
    @php
        $breadcrumbItems = [
            [
                "text" => "Dashboard",
                "url" => route("admin.dashboard"),
            ],
            [
                "text" => "Items",
                "url" => route("items.index"),
            ],
            [
                "text" => $item->item_name,
                // Tidak perlu url untuk item aktif
            ],
        ];
    @endphp

    <x-breadcrumb :items="$breadcrumbItems" />
@endsection

@section("content")
    <div class="mx-auto max-w-6xl bg-[--body-clr] p-6 text-[--text-clr]">
        <!-- Edit & Delete Buttons -->
        <div class="mb-6 flex justify-end gap-2">
            <button
                id="editToggle"
                class="rounded-lg bg-[--primary-clr] p-2 transition hover:opacity-90"
            >
                <span>Edit</span>
                <i class="fas fa-edit text-[--text-clr]"></i>
            </button>
            @if ($item->item_type == "unit")
                <!-- Delete Button -->
                <div class="dropdown relative" id="deleteDropdownContainer">
                    <input
                        type="checkbox"
                        id="deleteDropdownToggle"
                        class="dropdown-toggle peer hidden"
                    />
                    <label
                        for="deleteDropdownToggle"
                        class="flex h-full cursor-pointer items-center justify-center gap-2 rounded-lg bg-[--red-2-clr] p-2 text-[--text-clr] transition-all duration-[.3s] ease-in-out hover:opacity-90"
                    >
                        <i class="fas fa-trash"></i>
                        <span>Delete</span>
                        <i
                            class="fas fa-caret-down ml-2 transition-transform peer-checked:rotate-180"
                        ></i>
                    </label>

                    <!-- Dropdown Menu -->
                    <div
                        class="dropdown-menu invisible absolute right-0 z-10 mt-2 w-48 origin-top rounded-md border-2 border-[--red-2-clr] bg-[--container-clr] opacity-0 shadow-lg transition-all duration-200 peer-checked:visible peer-checked:opacity-100"
                    >
                        <div class="space-y-2 p-2">
                            <button
                                type="button"
                                id="deleteItemButton"
                                class="flex w-full items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr]"
                            >
                                <i class="fas fa-trash"></i>
                                <span>Hapus Item</span>
                            </button>
                            <button
                                type="button"
                                id="showUnitDeleteModal"
                                class="flex w-full items-center gap-2 rounded-md px-4 py-2 text-[--text-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr]"
                            >
                                <i class="fas fa-cube"></i>
                                <span>Hapus Unit</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Existing Delete Form (Hidden) -->
                <form
                    id="deleteItemForm"
                    action="{{ route("items.destroy", $item->item_id) }}"
                    method="POST"
                    class="hidden"
                >
                    @csrf
                    @method("DELETE")
                </form>

                <!-- Delete Unit Modal -->
                @include("components.item-units.delete-units-modal")
            @else
                <form
                    id="deleteItemForm"
                    action="{{ route("items.destroy", $item->item_id) }}"
                    method="POST"
                >
                    @csrf
                    @method("DELETE")
                    <button
                        type="button"
                        id="deleteItemButton"
                        class="rounded-lg bg-[--red-2-clr] p-2 text-[--text-clr] transition hover:opacity-90"
                    >
                        <i class="fas fa-trash"></i>
                        <span>Delete</span>
                    </button>
                </form>
            @endif
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            <!-- Bagian Kiri - Gambar -->
            <div
                class="group relative aspect-square overflow-hidden rounded-lg shadow-lg"
            >
                <!-- Display Mode -->
                @include("items.partials.display._left-section")
                <!-- Edit Mode -->
                @include("items.partials.edit._left-section")
            </div>

            <!-- Bagian Tengah - Deskripsi -->
            <div class="space-y-4">
                <!-- Display Mode -->
                @include("items.partials.display._center-section")
                <!-- Edit Mode -->
                @include("items.partials.edit._center-section")
            </div>
            <!-- Bagian Kanan - Tombol Buka Modal -->
            <div class="relative grid">
                <!-- Display Mode -->
                @include("items.partials.display._right-section")
                <!-- Edit Mode -->
                @if ($item->item_type == "unit")
                    @include("items.partials.edit._right-section")
                @endif
            </div>
        </div>
        <!-- Modal Peminjaman -->
        @include("components.loans.add-loan-modal")
    </div>

    @push("scripts")
        <script
            type="module"
            src="{{ asset("js/module/manage-detail.js") }}"
        ></script>
    @endpush
@endsection
