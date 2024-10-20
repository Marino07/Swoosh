<?php

namespace App\Livewire\Swiper;

use App\Models\User;
use App\Models\Swipe;
use Livewire\Component;
use Livewire\Attributes\On;

class Swiper extends Component
{
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

        // return null if user is already swiped
        if(auth()->user()->hasSwiped($user)){
            return null;
        }

        Swipe::create([
            'user_id' => auth()->id(),
            'swiped_user_id' => $user->id,
            'type' => $type
        ]);


    }

    public function render()
    {

        $users = User::limit(10)->whereNotSwiped()->where('id','<>',auth()->id())->get();
        return view('livewire.swiper.swiper',['users' => $users]);
    }
}
