<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ListCommercials extends Component
{

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

        ]);

        $user = new User();
        $user->name = $this->user['name'];
        $user->email = $this->user['email'];
        $user->password = $this->user['password'];
        $user->password = Hash::make($this->user['password']);

        $user->save();




        $this->dispatchBrowserEvent('close_modal', ['id' => 'store_User']);
        $this->reset('user');
        $this->emit('refreshComponent');
    }
}
