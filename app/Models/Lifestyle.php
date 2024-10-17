<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lifestyle extends Model
{
    /** @use HasFactory<\Database\Factories\LifestyleFactory> */
    use HasFactory;
    protected $fillable = ['name'];

   public function users(){
    return $this->belongsToMany(User::class,'lifestyle_user');
   }
}
