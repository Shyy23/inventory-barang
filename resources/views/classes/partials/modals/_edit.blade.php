<div
    id="editClassModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="editClassContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Edit Kelas</h3>
                <button
                    id="closeEditClassModal"
                    class="hover:text-[--red-2-clr]"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Edit -->
            <form
                action="{{ route("classes.update") }}"
                method="POST"
                id="editClassForm"
                class="mt-4 space-y-4"
            >
                @csrf
                @method("PUT")

                <div
                    class="scrollbar max-h-[60vh] space-y-4 overflow-y-auto pb-4"
                >
                    @foreach ($classes as $class)
                        <div
                            class="unit-card rounded-lg bg-[--body-clr] p-4 shadow"
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <label class="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="classes[{{ $class->class_id }}][selected]"
                                        value="1"
                                        class="unit-checkbox bg-transparent shadow-sm"
                                    />
                                    <span class="select-none">
                                        Edit Kelas ini
                                    </span>
                                </label>
                            </div>

                            <div class="flex flex-col gap-4">
                                <!-- Level -->
                                <select
                                    name="classes[{{ $class->class_id }}][level]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr]"
                                >
                                    <option value="">Pilih Tingkat</option>
                                    @foreach ($levels as $level)
                                        <option
                                            value="{{ $level }}"
                                            {{ $class->level == $level ? "selected" : "" }}
                                        >
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Jurusan -->
                                <select
                                    name="classes[{{ $class->class_id }}][major]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr]"
                                >
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($majors as $major)
                                        <option
                                            value="{{ $major }}"
                                            {{ $class->major === $major ? "selected" : "" }}
                                        >
                                            {{ $major }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- ABC -->
                                <select
                                    name="classes[{{ $class->class_id }}][abc_id]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr]"
                                >
                                    <option value="">Pilih ABC</option>
                                    @foreach ($abcs as $id => $name)
                                        <option
                                            value="{{ $id }}"
                                            {{ $class->abc_name == $name ? "selected" : "" }}
                                        >
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Lokasi -->
                                <select
                                    name="classes[{{ $class->class_id }}][location_id]"
                                    class="input-form block w-full rounded-md border border-transparent bg-[--body-clr] px-3 py-2 outline-none focus:border-[--primary-clr]"
                                >
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($locations as $id => $name)
                                        <option
                                            value="{{ $id }}"
                                            {{ $class->class_location == $name ? "selected" : "" }}
                                        >
                                            {{ $name }}
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
                        id="editClassButton"
                        class="rounded-md border border-[--primary-clr] bg-transparent px-4 py-2 text-sm font-medium text-[--primary-clr] hover:bg-[--primary-clr] hover:text-[--text-clr]"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
