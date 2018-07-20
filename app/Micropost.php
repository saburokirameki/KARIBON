<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
   protected $fillable = ['content','book_id', 'user_id'];

   
    
     public function book()
    {
        return $this->belongsTo(Book::class)->withPivot('content');
    }
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
