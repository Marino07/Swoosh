<?php

namespace App\Livewire\Swiper;

use App\Models\User;
use App\Models\Swipe;
use Livewire\Component;
use App\Models\SwipeMatch;
use Livewire\Attributes\On;
use App\Models\Conversation;
use Livewire\Attributes\Locked;

class Swiper extends Component
{
    #[Locked]
    public $currentMatchId;

    #[Locked]
    public $swipedUserId;
    #[On('swipedright')] //this will trigger func below
    public function swipedRight(User $user){
        abort_unless(auth()->check(),401);
        if($user != null){
            $this->createSwipe($user,'right');
            //create swipe right
        }
    }
    #[On('swipedleft')] //this will trigger func below
    public function swipedLeft(User $user){
        abort_unless(auth()->check(),401);
        if($user != null){
            $this->createSwipe($user,'left');
            //create swipe right
        }
    }

    #[On('swipedup')] //this will trigger func below
    public function swipedUp(User $user){
        abort_unless(auth()->check(),401);
        if($user != null){
            $this->createSwipe($user,'up');
            //create swipe right
        }
    }
    protected function createSwipe($user,$type){
        $this->reset(['swipedUserId','currentMatchId']);

        // return null if user is already swiped
        if(auth()->user()->hasSwiped($user)){
            return null;
        }

        $swipe = Swipe::create([
            'user_id' => auth()->id(),
            'swiped_user_id' => $user->id,
            'type' => $type
        ]);

        //check if type is superlike or swipe right

        if($type =='up' || $type == 'right'){
            $authUserId = auth()->id();
            $this->swipedUserId = $user->id;


            // check if swiped user also swiped on authenticated user

            $matchingSwipe = Swipe::where('user_id',$this->swipedUserId)
                                ->where('swiped_user_id',$authUserId)
                                ->whereIn('type',['right','up'])->first();
            if($matchingSwipe){
                $match = SwipeMatch::create([
                    'swipe_id_1' => $swipe->id,
                    'swipe_id_2' => $matchingSwipe->id
                ]);
                $this->dispatch('match-found');
                $this->currentMatchId = $match->id;
            }

            //show match found


        }



    }
    public function createConversation(){
        $conversation = Conversation::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->swipedUserId,
            'match_id' =>  $this->currentMatchId,
        ]);

        $this->dispatch('close-match-modal');

        $this->reset(['swipedUserId','currentMatchId']);
        $this->redirect(route('chat', $conversation->id));
    }

    public function render()
    {

        $users = User::limit(10)->whereNotSwiped()->where('id','<>',auth()->id())->get();
        return view('livewire.swiper.swiper',['users' => $users]);
    }
}
