<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class FormUser extends ModalComponent
{
    use WithFileUploads;

    public $user, $user_id, $name, $email, $password, $password_confirmation, $photo_profile_path;

    public function render()
    {
        return view('livewire.form-user');
    }

    private function resetCreateForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->photo_profile_path = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'photo_profile_path' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($this->photo_profile_path) {
            $photoPath = $this->photo_profile_path->store('profile-photos', 'public');
        }

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile_photo_path' => $photoPath,
        ]);
        dd($this->user_id, $this->name, $this->email, $this->password, $this->password_confirmation, $this->photo_profile_path, $photoPath);

        // session()->flash('message', $this->user ? 'Student updated.' : 'Student created.');
        $this->closeModalWithEvents([
            UserTable::class => 'userUpdated',
        ]);
        $this->resetCreateForm();
    }

    public function mount($rowId = null)
    {
        if (!is_null($rowId)) {
            $user = User::findOrFail($rowId);
            $this->user_id = $rowId;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->photo_profile_path = $user->photo_profile_path;
        }
    }
}
