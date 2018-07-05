<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $fillable = ['code', 'name', 'url', 'image_url'];

}