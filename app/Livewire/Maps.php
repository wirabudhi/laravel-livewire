<?php

namespace App\Livewire;

use App\Models\Maps as ModelsMaps;
use GeoIp2\Record\Location as RecordLocation;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class Maps extends ModalComponent
{
    use WithFileUploads;

    public $maps, $nama, $foto, $latitude, $longitude, $position, $regionName;

    public function render()
    {
        return view('livewire.maps');
    }

    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Jarak dalam kilometer

        return $distance;
    }


    private function resetCreateForm()
    {
        $this->nama = '';
        $this->foto = null;
        $this->latitude = '';
        $this->longitude = '';
    }

    public function getCurrentLocation()
    {
        $this->dispatch('getLocation');
    }

    #[On('locationFetched')]
    public function locationFetched($position)
    {
        $this->latitude = $position[0];
        $this->longitude = $position[1];
    }

    public function submitForm()
    {
        $allowedDistance = 10; // Batasan jarak dalam kilometer
        $targetLatitude = -6.175237378357099;
        $targetLongitude = 106.82708539645158;

        $distance = $this->calculateDistance($this->latitude, $this->longitude, $targetLatitude, $targetLongitude);

        if ($distance > $allowedDistance) {
            session()->flash('flash.banner', 'Jarakan terlalu jauh dari target');
            session()->flash('flash.bannerStyle', 'danger');

            $this->redirect('/dashboard');
        } else {

            $this->validate([
                'nama' => 'required',
                'foto' => 'nullable|image|max:10240', // 1MB Max
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            // If foto is not null, store it, otherwise set to null
            $fotoPath = $this->foto ? $this->foto->store('public/foto') : null;

            // Simpan data ke database
            ModelsMaps::create([
                'nama' => $this->nama,
                'foto' => $fotoPath,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);

            $this->closeModalWithEvents([
                'message' => 'Data berhasil disimpan',
            ]);
            $this->resetCreateForm();
        }
    }
}
