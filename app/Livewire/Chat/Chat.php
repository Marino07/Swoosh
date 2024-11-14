<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;
use App\Livewire\Components\Tabs;
use App\Notifications\MessageNotification;

class Chat extends Component
{
    public $chat; // from web.php route parameter
    public $conversation;
    public $receiver;
    public $body;
    public $loadedMessages;
    public $paginate_var = 12;
    public function listenBroadcastedMessage($event){
        $this->dispatch('scroll-bottom');
        $newMessage = Message::find($event['message_id']);
        // push
        $this->loadedMessages->push($newMessage);

        $newMessage->read_at = now();
        $newMessage->save();
        // refresh chat list
        $this->dispatch('new-message-created');
    }
    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->conversation = Conversation::findOrFail($this->chat);

        $belongsToConversation = auth()->user()->conversations()
                                ->where('id', $this->conversation->id)
                                ->exists();
        abort_unless($belongsToConversation, 401);

        //mark messages as read
        Message::where('conversation_id', $this->conversation->id)
                ->where('receiver_id', auth()->id())
                ->where('read_at', null)
                ->update(['read_at' => now()]);

        //get receiver
        $this->receiver = $this->conversation->getReceiver();

        $this->loadMessages();
    }


    public function sendMessage(){
        abort_unless(auth()->check(), 401);
        $this->validate([
            'body' => 'required|string'
        ]);

        $createdMessage = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver->id,
            'body' => $this->body
        ]);

        $this->reset('body');

        $this->dispatch('scroll-bottom');

        //push message
        $this->loadedMessages->push($createdMessage);

        //update conv model

        $this->conversation->updated_at=now();
        $this->conversation->save();
        //dispatch
        $this->dispatch('upt')->to(Tabs::class);
        $this->dispatch('new-message-created')->to(Tabs::class);

        //broadcasting
        $this->receiver->notify(new MessageNotification($this->receiver,$createdMessage ,$this->conversation));


    }

  #[On('loadMore')]
  public function loadMore()
  {
      $totalMessages = Message::where('conversation_id', $this->conversation->id)->count();

      // Prevent loading more than the total messages
      if ($this->paginate_var < $totalMessages) {
          $this->paginate_var += 10;
          $this->loadMessages();
          $this->dispatch('update-height'); // Update height after loading more
      }
  }

    public function loadMessages(){
        $count = Message::where('conversation_id', $this->conversation->id)
                ->count();
        //skip and query
        $this->loadedMessages = Message::where('conversation_id', $this->conversation->id)
                ->orderBy('created_at', 'desc')
                ->skip($count - $this->paginate_var)
                ->take($this->paginate_var)
                ->get()
                ->reverse();

        return $this->loadedMessages;




    }
    public function render()
    {
        return view('livewire.chat.chat')->layout('layouts.chat-lay');
    }


}
