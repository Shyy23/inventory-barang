<form
    id="infoEdit"
    action="{{ route("items.update", $item->item_id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="hidden space-y-4"
>
    @csrf
    @method("PUT")

    <div>
        <input
            type="text"
            name="item_name"
            value="{{ $item->item_name }}"
            class="w-full rounded border-2 border-[--border-clr] bg-[--container-clr] p-2 font-bold text-[--text-clr] outline-none ring-2 ring-transparent focus:border-[--primary-clr] focus:ring-[--primary-clr]"
            required
        />
    </div>

    <!-- Kategori -->
    <div>
        <select
            name="category_id"
            class="w-full rounded border border-[--border-clr] bg-[--container-clr] p-2 text-[--text-clr] outline-none ring-2 ring-transparent focus:border-[--primary-clr] focus:ring-[--primary-clr]"
        >
            @foreach ($categories as $category)
                <option
                    value="{{ $category->category_id }}"
                    {{ $category->category_name == $item->category_name ? "selected" : "" }}
                >
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Lokasi -->
    <div>
        <select
            name="location_id"
            class="w-full rounded border border-[--border-clr] bg-[--container-clr] p-2 text-[--text-clr] outline-none ring-2 ring-transparent focus:border-[--primary-clr] focus:ring-[--primary-clr]"
        >
            @foreach ($locations as $location)
                <option
                    value="{{ $location->location_id }}"
                    {{ $location->location_name == $item->location_name ? "selected" : "" }}
                >
                    {{ $location->location_name }}
                </option>
            @endforeach
        </select>
    </div>
    <!-- Item  Type -->
    <input
        type="hidden"
        name="item_type"
        value="{{ $item->item_type == "unit" ? "unit" : "consumable" }}"
    />
    <!-- stock -->
    @if ($item->item_type == "consumable")
        <div>
            <input
                type="number"
                name="stock"
                value="{{ $item->stock }}"
                min="0"
                class="w-full rounded border border-[--border-clr] bg-[--container-clr] p-2 text-[--text-clr] outline-none focus:border-[--primary-clr] focus:ring-[--primary-clr]"
                required
            />
        </div>
    @endif

    <!-- Item type -->
    <input type="hidden" name="item_type" value="{{ $item->item_type }}" />

    <!-- description -->
    <div>
        <textarea
            name="description"
            rows="3"
            class="w-full rounded border border-[--border-clr] bg-[--container-clr] p-2 text-[--text-clr] outline-none ring-2 ring-transparent focus:border-[--primary-clr] focus:ring-[--primary-clr]"
        >
{{ $item->description }}</textarea
        >
    </div>

    <!-- Group Btn -->
    <div class="flex gap-4 pt-4">
        <button
            type="button"
            id="closeEditItem"
            class="rounded-lg bg-[--red-2-clr] px-4 py-2"
        >
            Batal
        </button>
        <button
            type="submit"
            class="rounded-lg bg-[--green-3-clr] px-4 py-2"
            id="editBarang"
        >
            Simpan
        </button>
    </div>
</form>
