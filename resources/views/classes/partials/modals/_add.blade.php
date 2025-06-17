<div
    id="addClassModal"
    class="modal-enter-add fixed inset-0 hidden bg-black/50"
>
    <div
        id="addClassContainerModal"
        class="container-modal flex min-h-screen items-center justify-center"
    >
        <div
            class="w-full max-w-md rounded-lg bg-[--container-clr] p-6 shadow-lg"
        >
            <!-- Modal Header -->
            <div
                class="flex justify-between border-b border-[--border-clr] pb-3"
            >
                <h3 class="text-lg font-semibold">Tambah Kelas</h3>
                <button id="closeClassModal" class="hover:text-[--red-2-clr]">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <!-- Form Modal -->
            <form
                action="{{ route("classes.store") }}"
                method="POST"
                id="addClassForm"
                class="scrollbar mt-4 grid max-h-[80vh] grid-cols-[1fr] items-center justify-center gap-4 overflow-y-auto px-4 pb-4"
            >
                @csrf
                <!-- Level -->
                <div class="form-group col-span-2">
                    <label for="level" class="mb-1 block text-sm font-medium">
                        Tingkat
                    </label>
                    <select
                        name="level"
                        id="level"
                        required
                        class="input-form mt-1 block w-full cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>
                            Pilih Tingkat
                        </option>
                        @foreach ($levels as $level)
                            <option
                                value="{{ $level }}"
                                {{ old("level") == $level ? "selected" : "" }}
                            >
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Major -->
                <div class="form-group col-span-2">
                    <label for="major" class="mb-1 block text-sm font-medium">
                        Jurusan
                    </label>
                    <select
                        name="major"
                        id="major"
                        required
                        class="input-form mt-1 block w-full cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>
                            Pilih Jurusan
                        </option>
                        @foreach ($majors as $major)
                            <option
                                value="{{ $major }}"
                                {{ old("major") == $major ? "selected" : "" }}
                            >
                                {{ $major }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- ABC -->
                <div class="form-group col-span-2">
                    <label for="abc_id" class="mb-1 block text-sm font-medium">
                        ABC Group
                    </label>
                    <select
                        name="abc_id"
                        id="abc_id"
                        required
                        class="input-form mt-1 block w-full cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih ABC</option>
                        @foreach ($abcs as $id => $name)
                            <option
                                value="{{ $id }}"
                                {{ old("abc_id") == $id ? "selected" : "" }}
                            >
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location -->
                <div class="form-group col-span-2">
                    <label
                        for="location_id"
                        class="mb-1 block text-sm font-medium"
                    >
                        Lokasi Kelas
                    </label>
                    <select
                        name="location_id"
                        id="location_id"
                        required
                        class="input-form mt-1 block w-full cursor-pointer rounded-md border border-transparent px-3 py-2 shadow-sm outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    >
                        <option value="" disabled selected>Pilih Lokasi</option>
                        @foreach ($locations as $id => $name)
                            <option
                                value="{{ $id }}"
                                {{ old("location_id") == $id ? "selected" : "" }}
                            >
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Tombol Aksi -->
                <div class="h-full max-h-[42px] self-end">
                    <button
                        type="submit"
                        class="flex items-center rounded-md border border-[--green-2-clr] bg-transparent px-6 py-3 text-center text-sm font-medium text-[--green-2-clr] transition-colors hover:bg-[--green-2-clr] hover:text-[--text-clr] focus:outline-none focus:ring-2 focus:ring-[--green-2-clr] focus:ring-offset-2"
                    >
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
