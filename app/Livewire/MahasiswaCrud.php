<?php

namespace App\Livewire;

use App\Models\Mahasiswa;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MahasiswaCrud extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
    }

    public function setSortBy($sortByField)
    {

        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        return view(
            'livewire.mahasiswa-crud',
            [
                'mahasiswas' => Mahasiswa::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
