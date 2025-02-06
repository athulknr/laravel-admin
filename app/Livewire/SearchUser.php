<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $term = "";

    public function render()
    {
        sleep(1);
        $users = User::search($this->term)->paginate(10);

        $data = [
            'users' => $users,
        ];

        return view('livewire.search-user', $data);
    }
}
