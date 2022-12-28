<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aaa extends Model
{
    use HasFactory;

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }
}