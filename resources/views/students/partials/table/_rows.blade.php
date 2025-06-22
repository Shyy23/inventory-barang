@foreach ($students as $student)
    <tr class="border-b border-[--border-clr] hover:bg-[--container-clr]">
        <td class="px-4 py-2">{{ $student->nomor_urut }}</td>
        <td class="px-4 py-2">{{ $student->nisn }}</td>
        <td class="px-4 py-2">{{ $student->student_name }}</td>
        <td
            class="gender-student px-4 py-2"
            data-gender="{{ $student->gender ?? "unknown" }}"
        >
            <i class="fas gender-icon" data-tooltip=""></i>
        </td>
        <td
            class="cursor-pointer px-4 py-2 hover:text-[--primary-clr] hover:underline"
            onclick="copyPhoneNumber('{{ $student->phone_number }}')"
            title="Klik untuk copy"
        >
            {{ $student->phone_number }}
        </td>
        <td class="px-4 py-2">{{ $student->address }}</td>
    </tr>
@endforeach
