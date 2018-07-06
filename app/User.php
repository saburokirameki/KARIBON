<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_user','user_id','book_id')->withTimestamps();
    }

    public function have($bookId)
    {
        // Is the user already "want"?
        $exist = $this->is_having($bookId);  

        if ($exist) {
            // do nothing
            return false;
        } else {
            // do "want"
            $this->books()->attach($bookId);
            return true;
        }
    }

    public function dont_have($bookId)
    {
        $exist = $this->is_having($bookId);
          
          
    if ($exist) {
        $this->books()->detach($bookId);
        return true;
    } else {
       return false;
    }
        
    }

    public function is_having($bookId)
    {
           return  $this->books()->where('code', $bookId)->exists();
           
    }
}
