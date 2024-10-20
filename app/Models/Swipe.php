<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swipe extends Model
{
    /** @use HasFactory<\Database\Factories\SwipeFactory> */
    use HasFactory;
    protected $guarded = [];
    public function users (){
        return $this->belongsTo(User::class);
    }

    /* Representing user who was swiped */
    function swipedUser(){
        return $this->belongsTo(User::class,'swiped_user_id');
    }

    public function isSuperLike() : bool{
        return $this->type == 'up';
    }

    public function match(){
        return $this->hasOne(Swipe::class,'swipe_id_1')->orWhere('swipe_id_2',$this->getKey());
    }


}
