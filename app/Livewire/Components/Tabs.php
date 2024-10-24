<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\SwipeMatch;
use App\Models\Conversation;

class Tabs extends Component
{
    public $conversations;
    public $matches;
    public function mount(){
        $this->matches = auth()->user()->matches;
        $this->conversations = auth()->user()->conversations;
    }

    public function createConversation(SwipeMatch $match){

        $receiver = $match->swipe1->user_id == auth()->id() ? $match->swipe2->user_id : $match->swipe1->user_id;

        Conversation::updateOrCreate([  'match_id' => $match->id,],[
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver,
        ]);

    }


    //get all matches for auth user

    public function render()
    {
        return view('livewire.components.tabs');
    }
}
