<div>
    <div class="flex items-center justify-between d p-4">
        <div class="flex">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                    placeholder="Search" required="">
            </div>
        </div>

    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'nama',
                        'displayName' => 'Nama',
                    ])
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'nim',
                        'displayName' => 'Nim',
                    ])
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'email',
                        'displayName' => 'email',
                    ])
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'jurusan',
                        'displayName' => 'jurusan',
                    ])
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'alamat',
                        'displayName' => 'alamat',
                    ])
                    @include('livewire.includes.table-sortable-th', [
                        'name' => 'no_hp',
                        'displayName' => 'no_hp',
                    ])
                    <th scope="col" class="px-4 py-3">Last update</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                    <tr wire:key="{{ $mahasiswa->id }}" class="border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->nama }}</th>
                        <td class="px-4 py-3">{{ $mahasiswa->nim }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->email }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->jurusan }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->alamat }}</td>
                        <td class="px-4 py-3">{{ $mahasiswa->no_hp }}</td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button
                                onclick="confirm('Are you sure you want to delete {{ $mahasiswa->name }} ?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $mahasiswa->id }})"
                                class="px-3 py-1 bg-red-500 text-white rounded">X</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="py-4 px-3">
        <div class="flex ">
            <div class="flex space-x-4 items-center mb-3">
                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                <select wire:model.live='perPage'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        {{ $mahasiswas->links() }}
    </div>
</div>
