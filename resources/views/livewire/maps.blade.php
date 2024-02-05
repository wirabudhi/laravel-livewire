<div>
    <div>
        <form wire:submit.prevent="submitForm">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mb-4">
                        <label for="exampleFormControlInput1"
                            class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Enter Nama" wire:model="nama">
                        @error('nama')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput7"
                            class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
                        <input type="file" id="foto" wire:model.live="foto" x-ref="foto" class="w-full"
                            x-on:change="
                            photoName = $refs.foto.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.foto.files[0]);
                        " />
                        @error('foto')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Tempatkan peta Anda di sini -->


                    <!-- Tombol untuk mendapatkan lokasi saat ini -->
                    <button type="button" wire:click="getCurrentLocation"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Get Current Location
                    </button>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button id="storeButton" type="submit"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Store
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button wire:click="closeModal()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Close
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@script
    <script>
        $wire.on('getLocation', () => {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    $wire.dispatch('locationFetched', {
                        position: [position.coords.latitude, position.coords.longitude]
                    });
                    console.log(position.coords.latitude, position.coords.longitude);
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        })
    </script>
@endscript
