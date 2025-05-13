<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{
   protected $fillable = ['name','skill','bio'];

    /** @use HasFactory<\Database\Factories\NinjaFactory> */
    use HasFactory;
}
