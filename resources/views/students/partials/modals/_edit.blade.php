<div
    id="editStudentModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="editStudentContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Edit Siswa</h3>
                <button
                    id="closeEditStudentModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form
                action="{{ route("students.update") }}"
                method="POST"
                id="editStudentForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("PUT")
                <input
                    type="hidden"
                    name="slug_class"
                    value="{{ $class->slug_class }}"
                />
                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($students as $student)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="students[{{ $student->nisn }}][selected]"
                                        value="1"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Edit Kelas {{ $student->student_name }}
                                    </span>
                                </label>
                            </div>
                            <div class="flex flex-col gap-4">
                                <select
                                    name="students[{{ $student->nisn }}][class]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr]"
                                >
                                    @foreach ($classes as $classId => $className)
                                        <option
                                            value="{{ $classId }}"
                                            {{ $student->class_name == $className ? "selected" : "" }}
                                        >
                                            {{ $className }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button
                        type="submit"
                        id="editStudentButton"
                        class="rounded-md border border-[--primary-clr] bg-transparent px-4 py-2 text-center text-sm font-medium text-[--primary-clr] transition-colors hover:bg-[--primary-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--primary-clr] focus:ring-offset-2"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
