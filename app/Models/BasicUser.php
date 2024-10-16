<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicUser extends Model
{
    /** @use HasFactory<\Database\Factories\BasicUserFactory> */
    use HasFactory;

    protected $guarded = [];
}
