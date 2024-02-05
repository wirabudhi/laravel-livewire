<?php

namespace App\Livewire;

use App\Models\Maps;
use Livewire\Component;

class MapsView extends Component
{
    public $locations;

    public function mount()
    {
        // Mengambil semua lokasi sekali saja dan menyimpannya dalam property 'locations'
        $this->locations = Maps::all();
    }

    public function render()
    {
        // Data 'locations' sudah tersedia melalui property, jadi kita hanya perlu melemparkannya ke view
        return view('livewire.maps-view', ['locations' => $this->locations]);
    }
}
