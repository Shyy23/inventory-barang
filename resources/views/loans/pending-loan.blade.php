@extends("layouts.app")
@push("styles")
    
@endpush

@section("title", "Manage Pending Loan")

@section("page title", "Pending Loan")
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
                Pending Loan
            </a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($loans as $loan)
                <div
                    class="rounded-lg border border-[--border-clr] bg-[--container-clr] p-6 shadow-sm"
                >
                    <!-- Header Card -->
                    <div class="border-b border-[--border-clr] pb-4">
                        <h3 class="text-lg font-semibold text-[--text-clr]">
                            {{ $loan->item_name }}
                        </h3>
                        <p class="text-sm text-[--text-2-clr]">
                            {{ $loan->unit_name }}
                        </p>
                    </div>

                    <!-- Body Card -->
                    <div class="space-y-3 py-4">
                        <div class="flex justify-between">
                            <span class="text-sm text-[--text-2-clr]">
                                Peminjam:
                            </span>
                            <span class="text-sm text-[--text-clr]">
                                {{ $loan->student_name }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm text-[--text-2-clr]">
                                Jumlah:
                            </span>
                            <span class="text-sm text-[--text-clr]">
                                {{ $loan->item_quantity }}
                            </span>
                        </div>

                        @if ($loan->class_name)
                            <div class="flex justify-between">
                                <span class="text-sm text-[--text-2-clr]">
                                    Kelas:
                                </span>
                                <span class="text-sm text-[--text-clr]">
                                    {{ $loan->class_name }}
                                </span>
                            </div>
                        @endif

                        @if ($loan->subject_name)
                            <div class="flex justify-between">
                                <span class="text-sm text-[--text-2-clr]">
                                    Mata Pelajaran:
                                </span>
                                <span class="text-sm text-[--text-clr]">
                                    {{ $loan->subject_name }}
                                </span>
                            </div>
                        @endif

                        <div class="flex justify-between">
                            <span class="text-sm text-[--text-2-clr]">
                                Tanggal Pinjam:
                            </span>
                            <span class="text-sm text-[--text-clr]">
                                {{ $loan->loan_date->format("d M Y H:i") }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm text-[--text-2-clr]">
                                Batas Kembali:
                            </span>
                            <span class="text-sm text-[--text-clr]">
                                {{ $loan->return_time->format("H:i") }}
                            </span>
                        </div>

                        <div class="mt-3">
                            <p class="text-sm text-[--text-2-clr]">
                                Deskripsi:
                            </p>
                            <p class="text-sm text-[--text-clr]">
                                {{ $loan->loan_description ?? "-" }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div
                        class="flex items-center justify-between border-t border-[--border-clr] pt-4"
                    >
                        <div class="flex items-center gap-2">
                            <span
                                class="@if ($loan->loan_status === "pending")
                                    bg-yellow-100
                                    text-yellow-800
                                @elseif ($loan->loan_status === "approved")
                                    bg-green-100
                                    text-green-800
                                @else
                                    bg-red-100
                                    text-red-800
                                @endif self-start rounded px-2 py-1 text-sm"
                            >
                                {{ strtoupper($loan->loan_status) }}
                            </span>
                            <form
                                action="{{ route("loans.approve", $loan->loan_id) }}"
                                method="POST"
                            >
                                @csrf
                                @method("PUT")
                                <button
                                    type="submit"
                                    class="rounded bg-green-500 px-3 py-1 text-sm text-white hover:bg-green-600"
                                >
                                    Approve
                                </button>
                            </form>

                            <form
                                action="{{ route("loans.reject", $loan->loan_id) }}"
                                method="POST"
                            >
                                @csrf
                                @method("DELETE")
                                <button
                                    type="submit"
                                    class="rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600"
                                >
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-[--text-2-clr]">
                        Tidak ada peminjaman tertunda
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push("scripts")
    
@endpush
