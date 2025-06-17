<div
    id="rightEdit"
    class="scrollbar hidden max-h-[70vh] space-y-4 overflow-y-auto"
    data-form-id="infoEdit"
>
    @foreach ($units as $index => $unit)
        <div
            class="unit-card rounded-lg bg-[--container-clr] p-4 opacity-50 shadow transition-opacity"
            data-unit-id="{{ $unit->unit_id }}"
        >
            <div class="mb-4 flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="units[{{ $unit->unit_id }}][selected]"
                        class="unit-checkbox bg-transparent shadow-sm"
                        form="infoEdit"
                    />
                    <span class="select-none">Edit unit ini</span>
                </label>
                <span class="select-none text-sm text-[--secondary-clr]">
                    ID: {{ $unit->unit_id }}
                </span>
            </div>

            <input
                type="hidden"
                name="units[{{ $unit->unit_id }}][unit_id]"
                value="{{ $unit->unit_id }}"
                form="infoEdit"
            />

            <div class="mb-4">
                <label class="mb-2 block font-semibold">Nama Unit</label>
                <input
                    type="text"
                    name="units[{{ $unit->unit_id }}][unit_name]"
                    value="{{ $unit->unit_name }}"
                    class="w-full rounded border border-transparent bg-[--body-clr] p-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    form="infoEdit"
                />
            </div>

            <div class="mb-4">
                <label class="mb-2 block font-semibold">Status</label>
                <select
                    name="units[{{ $unit->unit_id }}][unit_status]"
                    class="w-full cursor-pointer rounded border border-transparent bg-[--body-clr] p-2 outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr] sm:text-sm"
                    form="infoEdit"
                >
                    @foreach (["available", "borrowed", "maintenance"] as $status)
                        <option
                            value="{{ $status }}"
                            {{ $unit->unit_status == $status ? "selected" : "" }}
                        >
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <div
                    class="relative h-[10rem] w-[10rem] overflow-hidden rounded"
                >
                    @if ($unit->unit_image && file_exists(public_path($unit->unit_image)))
                        <img
                            src="{{ asset($unit->unit_image) }}"
                            class="unit-image-preview h-full w-full object-contain opacity-75 transition-opacity hover:opacity-100"
                        />
                        <input
                            type="file"
                            name="units[{{ $unit->unit_id }}][unit_image]"
                            accept="image/*"
                            class="unit-image-input absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                            form="infoEdit"
                        />
                        <div
                            class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
                        >
                            <i
                                class="fas fa-arrow-up-from-bracket text-3xl text-white"
                            ></i>
                        </div>
                    @else
                        <img
                            src="https://placehold.co/160"
                            class="unit-image-preview h-full w-full object-contain opacity-75 transition-opacity hover:opacity-100"
                        />
                        <input
                            type="file"
                            name="units[{{ $unit->unit_id }}][unit_image]"
                            accept="image/*"
                            class="unit-image-input absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                            form="infoEdit"
                        />
                        <div
                            class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/30"
                        >
                            <i
                                class="fas fa-arrow-up-from-bracket text-3xl text-white"
                            ></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
