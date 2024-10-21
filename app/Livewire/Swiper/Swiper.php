<?php

namespace App\Livewire\Swiper;

use App\Models\SwipeMatch;
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

        $swipe = Swipe::create([
            'user_id' => auth()->id(),
            'swiped_user_id' => $user->id,
            'type' => $type
        ]);

        //check if type is superlike or swipe right

        if($type =='up' || $type == 'right'){
            $authUserId = auth()->id();
            $swipedUserId = $user->id;


            // check if swiped user also swiped on authenticated user

            $matchingSwipe = Swipe::where('user_id',$swipedUserId)
                                ->where('swiped_user_id',$authUserId)
                                ->whereIn('type',['right','up'])->first();
            if($matchingSwipe){
                SwipeMatch::create([
                    'swipe_id_1' => $swipe->id,
                    'swipe_id_2' => $matchingSwipe->id
                ]);
                $this->dispatch('match-found');
            }

            //show match found


        }




    }

    public function render()
    {

        $users = User::limit(10)->whereNotSwiped()->where('id','<>',auth()->id())->get();
        return view('livewire.swiper.swiper',['users' => $users]);
    }
}
