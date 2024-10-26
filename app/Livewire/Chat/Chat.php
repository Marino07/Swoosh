<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;

class Chat extends Component
{
    public $chat; // from web.php route parameter
    public $conversation;
    public $receiver;

    public function mount(){
        abort_unless(auth()->check(), 403);
        $this->conversation = Conversation::findOrFail($this->chat);

        $belongsToConversation = auth()->user()->conversations()
                                ->where('id', $this->conversation->id)
                                ->exists();
        abort_unless($belongsToConversation, 403);

        //get receiver
        $this->receiver = $this->conversation->getReceiver();
    }
    public function render()
    {
        return view('livewire.chat.chat');
    }
}
