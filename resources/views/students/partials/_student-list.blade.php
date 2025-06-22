<section
    class="wrapper student-list-item grid min-h-screen grid-rows-[auto_1fr] gap-4 text-[--text-clr]"
>
    <!-- Header -->
    <header class="flex justify-between rounded-t-lg bg-[--container-clr] p-4">
        <h2 class="text-xl font-semibold">Daftar Siswa</h2>
        <button
            class="info flex cursor-pointer items-center justify-center gap-4 text-lg font-semibold text-[--title-clr] transition-colors hover:text-[--primary-clr]"
            type="button"
            id="showInfoClassModal"
        >
            <span class="">{{ $class->class_name }}</span>
            <i class="fas fa-circle-info"></i>
        </button>
    </header>

    <!-- Tabel dengan Scroll Vertikal -->
    <div
        class="scrollbar max-h-[80vh] overflow-x-hidden overflow-y-scroll rounded-lg shadow-md"
    >
        <table
            class="min-w-full table-auto border-collapse bg-[--body-clr] text-left"
        >
            <!-- Header Tabel -->
            <thead class="sticky top-0 z-10 bg-[--container-clr]">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2">No</th>
                    <th class="px-4 py-2">NISN</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2">
                        <i class="fa-solid fa-venus-mars"></i>
                    </th>
                    <th class="px-4 py-2">No Telepon</th>
                    <th class="px-4 py-2">Alamat</th>
                </tr>
            </thead>

            <!-- Body Tabel -->
            <tbody class="student-list">
                @include("students.partials.table._rows")
            </tbody>
        </table>
    </div>
</section>
