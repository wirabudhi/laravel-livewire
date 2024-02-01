<div class="p-2 bg-white border border-slate-200">
    <table class="table-auto w-full">
        <tbody>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Id</td>
                <td class="border px-4 py-2">{{ $id }}</td>
            </tr>
            @if ($row->foto)
                <tr>
                    <td class="border px-4 py-2 text-sm font-semibold">Foto</td>
                    <td class="border px-4 py-2">
                        <img src="{{ asset('storage/' . $row->foto) }}" alt="Foto" class="w-32 h-32 object-cover">
                    </td>
                </tr>
            @endif
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nama</td>
                <td class="border px-4 py-2">{{ $row->nama }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Nim</td>
                <td class="border px-4 py-2">{{ $row->nim }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Email</td>
                <td class="border px-4 py-2">{{ $row->user->email }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Jurusan</td>
                <td class="border px-4 py-2">{{ $row->jurusan }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Alamat</td>
                <td class="border px-4 py-2">{{ $row->alamat }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">No hp</td>
                <td class="border px-4 py-2">{{ $row->no_hp }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2 text-sm font-semibold">Created at</td>
                <td class="border px-4 py-2">{{ $row->created_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
