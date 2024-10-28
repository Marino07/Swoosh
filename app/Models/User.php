<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Language;
use App\Enums\BasicGroupEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RelationshipGoalsEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'relationship_goals' => RelationshipGoalsEnum::class
    ];


    /**
     * BOOT
     * Listen to events and do actions
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $basics = Basic::all();

            //wants to have children
            $basic = $basics->where('group', BasicGroupEnum::children)->all();
            $user->basics()->attach([1, 7, 8]);

            //zodiac
            $basic = $basics->where('group', BasicGroupEnum::zodiac)->first();
            $user->basics()->attach($basic);


            $user->lifestyles()->attach([rand(1, 3)]);



        });
    }


    function basics()
    {
        return $this->belongsToMany(Basic::class, 'basic_user');

    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'language_user');
    }
    public function lifestyles(): BelongsToMany
    {
        return $this->belongsToMany(Lifestyle::class, 'lifestyle_user');
    }
    public function swipes(): HasMany
    {
        return $this->hasMany(Swipe::class, 'user_id');
    }

    function hasSwiped(User $user, $type = null): bool
    {
        $query = $this->swipes()->where('swiped_user_id', $user);

        if ($type != null) {
            $query->where('type', $type);
        }
        return $query->exists();
    }

    //exclude users who has alreafy been swiped by the auth user
    public function scopeWhereNotSwiped($query)
    {

        return $query->whereNotIn('id', function ($subquery) {
            $subquery->select('swiped_user_id')
                ->from('swipes')
                ->where('user_id', auth()->id());
        });

    }

    public function matches()
    {
        return $this->hasManyThrough(
            SwipeMatch::class, // ciljani model
            Swipe::class, //model preko kojeg dolazimo da matcha za naseg usera
            'user_id',
            'swipe_id_1',
            'id',
            'id'
        )->orWhereHas('swipe2', function ($query) {
            $query->where('user_id', $this->id);
        });
    }

    public function conversations(){
        return $this->hasMany(Conversation::class,'sender_id')->orWhere('receiver_id',$this->id);
    }
    public function unReadMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('read_at', null)->count();
    }


}
