<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ListCommercials extends Component
{
    public $selected = [];
    public $user = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];
    public function render()
    {
        $commercials =User::where('is_admin', 0)->get();

        return view('livewire.list-commercials', [
            'commercials' => $commercials
        ]);
    }
    public function storeUser()
    {
        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required',
            'user.password' => 'required',
            'user.numero_telephone' => 'required',


        ]);

        $user = new User();
        $user->name = $this->user['name'];
        $user->email = $this->user['email'];
        $user->password = $this->user['password'];
        $user->password = Hash::make($this->user['password']);
        $user->numero_telephone = $this->user['numero_telephone'];

        $user->save();




        $this->dispatchBrowserEvent('close_modal', ['id' => 'addEmployeeModal']);
        $this->reset('user');
        $this->emit('refreshComponent');
    }
    public function deleteSelected()
    {
        User::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->emit('refreshComponent');
    }
}
