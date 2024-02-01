<?php

namespace App\Livewire;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class MahasiswaForm extends ModalComponent
{
    use WithFileUploads;

    public $mahasiswa, $mahasiswa_id, $nama, $nim, $email, $jurusan, $alamat, $no_hp, $foto, $user_id, $existingFoto;

    public function render()
    {
        $users = User::all();
        return view('livewire.mahasiswa-form', compact('users'));
    }

    private function resetCreateForm()
    {
        $this->nama = '';
        $this->nim = '';
        $this->email = '';
        $this->jurusan = '';
        $this->alamat = '';
        $this->no_hp = '';
        $this->foto = null;
        $this->user_id = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'nim' => 'required|min:3',
            'email' => 'required|email|unique:mahasiswas,email,' . $this->mahasiswa_id,
            'jurusan' => 'required|min:3',
            'alamat' => 'required|min:3',
            'no_hp' => 'required|min:3',
            'foto' => 'nullable|image|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($this->mahasiswa_id) {
            $mahasiswa = Mahasiswa::find($this->mahasiswa_id);
            $mahasiswa->update([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'email' => $this->email,
                'jurusan' => $this->jurusan,
                'alamat' => $this->alamat,
                'no_hp' => $this->no_hp,
                'user_id' => $this->user_id,
            ]);

            // Only update the foto if a new photo was uploaded
            if ($this->foto) {
                if ($mahasiswa->foto) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }
                $fotoPath = $this->foto->store('mahasiswa-photos', 'public');
                $mahasiswa->update(['foto' => $fotoPath]);
            }
        } else {
            $fotoPath = $this->foto ? $this->foto->store('mahasiswa-photos', 'public') : null;
            Mahasiswa::create([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'email' => $this->email,
                'jurusan' => $this->jurusan,
                'alamat' => $this->alamat,
                'no_hp' => $this->no_hp,
                'user_id' => $this->user_id,
                'foto' => $fotoPath,
            ]);
        }

        session()->flash('message', $this->mahasiswa ? 'Student updated.' : 'Student created.');
        $this->closeModalWithEvents([
            MahasiswaTable::class => 'mahasiswaUpdated',
        ]);
        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        if (!is_null($rowId)) {
            $mahasiswa = Mahasiswa::findOrFail($rowId);
            $this->mahasiswa_id = $rowId;
            $this->nama = $mahasiswa->nama;
            $this->nim = $mahasiswa->nim;
            $this->email = $mahasiswa->email;
            $this->jurusan = $mahasiswa->jurusan;
            $this->alamat = $mahasiswa->alamat;
            $this->no_hp = $mahasiswa->no_hp;
            $this->user_id = $mahasiswa->user_id;
            if ($mahasiswa->foto) {
                $this->existingFoto = $mahasiswa->foto;
            }
        }
    }
}
