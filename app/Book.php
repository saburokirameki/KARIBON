<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $fillable = ['code', 'name', 'url', 'image_url'];
     
     
     public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}