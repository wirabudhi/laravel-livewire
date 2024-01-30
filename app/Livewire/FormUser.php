<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FormUser extends ModalComponent
{
    public $user, $user_id, $name, $email, $password, $password_confirmation;

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
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
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
        }
    }
}
