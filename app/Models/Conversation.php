<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    /** @use HasFactory<\Database\Factories\ConversationFactory> */
    use HasFactory;
    protected $guarded = [];

    function messages():HasMany{
        return $this->hasMany(Message::class);
    }

    function match(){
        return $this->belongsTo(SwipeMatch::class);
    }

    public function getReceiver(){
        if(auth()->id() == $this->sender_id){
            return User::firstWhere('id', $this->receiver_id);
        } else {
            return User::firstWhere('id', $this->sender_id);
        }
    }


}
