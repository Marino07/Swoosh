<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\SwipeMatch;
use App\Models\Conversation;

class Tabs extends Component
{
    public $conversations;
    public $matches;
    protected $listeners = ['new-message-created' => '$refresh', 'upt' => 'loadData'];
    public function loadData()
    {
        $this->matches = auth()->user()->matches;
        $this->conversations = auth()->user()->conversations()->latest('updated_at')->get();
    }

    public function mount(){
        $this->loadData();
    }

    public function createConversation(SwipeMatch $match){

        $receiver = $match->swipe1->user_id == auth()->id() ? $match->swipe2->user_id : $match->swipe1->user_id;

       $conversation = Conversation::updateOrCreate([  'match_id' => $match->id,],[
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver,
        ]);
        $this->redirect(route('chat', $conversation->id));

    }


    //get all matches for auth user

    public function render()
    {
        return view('livewire.components.tabs');
    }
}
