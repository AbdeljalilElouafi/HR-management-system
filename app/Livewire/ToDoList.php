<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\Todo;

class ToDoList extends Component
{


    use WithPagination;

    #[Rule('required|min:3|max:50')]

    public $name;

    public function create(){

        $validate= $this->ValidateOnly('name');
        Todo::create($validate);

    }




    public function render()
    {
        return view('livewire.to-do-list');
    }
}
