<div
    id="deleteStudentModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="deleteStudentContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">
                    Hapus Siswa {{ $class->class_name }}
                </h3>
                <button
                    id="closeDeleteStudentModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("students.destroy") }}"
                method="POST"
                id="deleteStudentForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("DELETE")
                <!-- Hidden slug_class untuk redirect -->
                <input
                    type="hidden"
                    name="slug_class"
                    value="{{ $class->slug_class }}"
                />

                <!-- Scrollable List of Students -->
                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($students as $student)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <!-- Checkbox -->
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="students[]"
                                        value="{{ $student->nisn }}"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">Hapus Siswa</span>
                                </label>
                            </div>

                            <!-- Student Name -->
                            <div class="text-[--secondary-clr]">
                                {{ $student->student_name }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2 pt-4">
                    <button
                        id="deleteStudentButton"
                        type="submit"
                        class="rounded-md border border-[--red-2-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--red-2-clr] transition-colors hover:bg-[--red-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--red-2-clr] focus:ring-offset-2"
                    >
                        Hapus Siswa Terpilih
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
