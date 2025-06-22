<div
    id="infoClassModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="infoClassContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <article
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <header
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">{{ $class->class_name }}</h3>
                <button
                    id="closeInfoClassModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </header>
            <!-- Modal Content -->
            <div id="modal-content" class="flex flex-col gap-y-3 py-4">
               

                <!-- Tampilkan pesan jika belum ada wali kelas -->
                @if (!$homeroom_teacher_class)
                    <div class="text-center text-gray-500 py-4">
                        Belum ada wali kelas
                    </div>
                @else
                <h3>Data Wali Kelas</h3>
                    <div class="flex items-center gap-2">
                        <span>Nama :</span>
                        <span>{{ $homeroom_teacher_class->teacher_name }}</span>
                        <i class="fas {{ $homeroom_teacher_class->gender === 'F' ? 'fa-venus' : 'fa-mars' }}"></i>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>Contact :</span>
                        <span
                            class="cursor-pointer hover:text-[--primary-clr] hover:underline"
                            onclick="copyPhoneNumber('{{ $homeroom_teacher_class->phone_number }}')"
                            title="Klik untuk copy"
                        >
                            {{ $homeroom_teacher_class->phone_number }}
                        </span>
                        <i class="fas fa-phone"></i>
                    </div>
                @endif
            </div>
            <!-- Modal Footer -->
            <footer
                class="border-t border-[--border-clr] pt-3 text-sm text-gray-500"
            >
                {{ $class->class_location }}
            </footer>
        </article>
    </div>
</div>
