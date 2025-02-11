@extends("layouts.app")
@section("title", "Manage Barang")
@section("page title", "Manage Barang")
@section("breadcrumbs")
    <ol
        class="grid grid-flow-col items-center justify-end gap-2 text-sm font-medium"
    >
        <!-- Item 1 -->
        <li>
            <a
                href="{{ route("admin.dashboard") }}"
                class="breadcrumb-item text-[1rem] text-[--primary-clr] transition-colors duration-300 hover:text-[--primary-hover-clr]"
            >
                Dashboard
            </a>
        </li>
        <!-- Separator -->
        <li class="px-1 text-center">
            <i
                class="fa-solid fa-angle-right relative text-[.85rem] text-gray-500"
            ></i>
        </li>
        <!-- Active Item -->
        <li>
            <a
                href="#"
                class="breadcrumb-item text-[1rem] text-[--border-2-clr]"
            >
                Items
            </a>
        </li>
    </ol>
@endsection

@section("content")
    <div
        class="wrapper grid min-h-screen grid-cols-[1fr_auto] gap-4 text-[--text-clr]"
    >
        <!-- Container utama untuk scroll -->
        <div
            class="card-items-scroll h-screen overflow-x-auto overflow-y-hidden bg-[--container-clr] pb-4"
        >
            <div
                class="grid h-screen w-max auto-cols-[minmax(30%,2fr)] grid-flow-col grid-rows-3 gap-4 rounded-lg p-4"
            >
                <!-- Semua 16 Card -->
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 1
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 2
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 3
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 4
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 5
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 6
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 7
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 8
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 9
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 10
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 11
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 12
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 13
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 14
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 15
                </div>
                <div
                    class="card h-full rounded-lg bg-[--container-card-clr] p-4"
                >
                    Card 16
                </div>
            </div>
        </div>

        <div
            class="category-select w-[150px] rounded-lg bg-[--container-clr] p-4 lg:w-[250px]"
        >
            <div class="tools border-b-2 border-[--border-2-clr] pb-2">
                <div class="grid grid-rows-[auto_1fr] gap-6 p-4">
                    <div
                        class="tambah cursor-pointer rounded-lg border-2 border-[--green-3-clr] bg-transparent p-4 text-center font-semibold text-[--green-3-clr] transition-all duration-[.3s] ease-in-out hover:bg-[--green-3-clr] hover:text-[--text-clr]"
                    >
                        <a href="#" class="">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Barang</span>
                        </a>
                    </div>
                    <div
                        class="cursor-pointer rounded-lg border-2 border-[--primary-clr] bg-transparent p-4 text-center font-semibold text-[--primary-clr] transition-all duration-[.3s] ease-in-out hover:bg-[--primary-clr] hover:text-[--text-clr]"
                    >
                        <i class="fa-solid fa-file"></i>
                        <span>Print Dokumen</span>
                    </div>
                    <div
                        class="pagination grid w-full grid-cols-[auto_1fr_auto] items-center gap-4"
                    >
                        <!-- Left Arrow -->
                        <a
                            href="#"
                            class="rounded-full border-2 border-[--primary-clr] p-2 font-semibold"
                        >
                            <i class="fa-solid fa-angle-left"></i>
                        </a>

                        <!-- Page Numbers Container -->
                        <div class="mx-auto flex justify-center gap-4">
                            <a
                                href="#"
                                class="transition-colors hover:text-[--primary-clr]"
                            >
                                1
                            </a>
                            <a
                                href="#"
                                class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                            >
                                2
                            </a>
                            <a
                                href="#"
                                class="text-[--border-2-clr] transition-colors hover:text-[--primary-clr]"
                            >
                                3
                            </a>
                        </div>

                        <!-- Right Arrow -->
                        <a
                            href="#"
                            class="rounded-full border-2 border-[--primary-clr] p-2 font-semibold"
                        >
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="filtering">p</div>
        </div>
    </div>
@endsection
