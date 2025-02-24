@extends('layouts.app')
@push('styles')
@endpush
@section('title', 'Manage Detail Loan')

@section("page title", "Detail Loan")
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
                Detail Loan
            </a>
        </li>
    </ol>
    @endsection
    @section("content")
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-[--text-clr] mb-6">Monitoring Peminjaman</h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($loans as $loan)
        <div class="rounded-lg border border-[--border-clr] bg-[--container-clr] p-6 shadow-sm">
            <!-- Header -->
            <div class="border-b border-[--border-clr] pb-4">
                <h3 class="text-lg font-semibold text-[--text-clr]">{{ $loan->item_name }}</h3>
                <p class="text-sm text-[--text-2-clr]">{{ $loan->unit_name }}</p>
            </div>

            <!-- Body -->
            <div class="py-4 space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-[--text-2-clr]">Peminjam:</span>
                    <span class="text-sm text-[--text-clr]">{{ $loan->student_name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-sm text-[--text-2-clr]">Jumlah:</span>
                    <span class="text-sm text-[--text-clr]">{{ $loan->item_quantity }}</span>
                </div>

                @if($loan->class_name)
                <div class="flex justify-between">
                    <span class="text-sm text-[--text-2-clr]">Kelas:</span>
                    <span class="text-sm text-[--text-clr]">{{ $loan->class_name }}</span>
                </div>
                @endif

                @if($loan->subject_name)
                <div class="flex justify-between">
                    <span class="text-sm text-[--text-2-clr]">Mata Pelajaran:</span>
                    <span class="text-sm text-[--text-clr]">{{ $loan->subject_name }}</span>
                </div>
                @endif

                <div class="flex justify-between">
                    <span class="text-sm text-[--text-2-clr]">Batas Kembali:</span>
                    <span class="text-sm text-[--text-clr]">{{ $loan->return_time->format('d M Y H:i') }}</span>
                </div>

                <div class="mt-3">
                    <p class="text-sm text-[--text-2-clr]">Waktu Tersisa:</p>
                    <p id="countdown-{{ $loan->loan_id }}" class="text-sm text-[--red-clr] font-medium">
                        Loading...
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-[--border-clr] pt-4">
                <div class="flex justify-between items-center gap-2">
                    <span class="text-sm px-2 py-1 rounded bg-[--green-3-clr] text-[--text-clr]0">
                        BORROWED
                    </span>

                    @if($loan->approved_by)
                    <span class="text-xs text-[--text-2-clr]">
                        Disetujui oleh: {{ $loan->approved_by }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-[--text-2-clr]">Tidak ada peminjaman aktif</p>
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    // Fungsi untuk menghitung countdown
    function updateCountdown(loanId, returnTime) {
        const targetDate = new Date(returnTime).getTime();
        const now = new Date().getTime();
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        let countdownText = '';
        if (distance < 0) {
            countdownText = "Waktu pengembalian telah habis!";
        } else {
            countdownText = `
                ${days} hari 
                ${hours} jam 
                ${minutes} menit 
                ${seconds} detik
            `;
        }

        document.getElementById(`countdown-${loanId}`).innerHTML = countdownText;
    }

    // Inisialisasi countdown untuk setiap peminjaman
    @foreach($loans as $loan)
    setInterval(() => {
        updateCountdown("{{ $loan->loan_id }}", "{{ $loan->return_time->toIso8601String() }}");
    }, 1000);
    @endforeach
</script>
@endpush
@endsection
