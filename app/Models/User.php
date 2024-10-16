<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Language;
use App\Enums\BasicGroupEnum;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RelationshipGoalsEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

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
        'relationship_goals'=>RelationshipGoalsEnum::class
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
            $basic= $basics->where('group',BasicGroupEnum::children)->all() ;
            $user->basics()->attach([1,7,8]);

            //zodiac
            $basic= $basics->where('group',BasicGroupEnum::zodiac)->first() ;
            $user->basics()->attach($basic);

        });
    }


    function basics()  {
        return $this->belongsToMany(Basic::class,'basic_user');

    }

    public function languages() : BelongsToMany{
        return $this->belongsToMany(Language::class,'language_user');
    }
}
