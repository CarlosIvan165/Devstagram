<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class BuscadorPost extends Component
{
    public $usuario = '';
    public $content = '';


    public function render()
    {
        $username = [];

        if (!empty($this->usuario)) {
            $username = User::where('username', 'like', "%{$this->usuario}%")
                            ->orWhere('email', 'like', "%{$this->usuario}%")
                            ->get();
        }

        return view('livewire.buscador-post', [
            'username' => $username,
        ]);
    }
}
