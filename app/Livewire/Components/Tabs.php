<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Tabs extends Component
{
    public $matches;
    public function mount(){
        $this->matches = auth()->user()->matches;
    }


    //get all matches for auth user

    public function render()
    {
        return view('livewire.components.tabs');
    }
}
