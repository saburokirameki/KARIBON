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
        'name', 'password', 'home',
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
        return $this->belongsToMany(Book::class)->withTimestamps();
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
            \DB::delete("DELETE FROM book_user WHERE user_id = ? AND book_id = ?", [$this->id, $bookId]);
            return true;
        } else {
           return false;
        }
        
    }


    public function is_having($bookIdOrCode)
    {
        if (strlen($bookIdOrCode)>9) {
            $book_code_exists = $this->books()->where('code', $bookIdOrCode)->exists();
            return $book_code_exists;
        } else {
            $book_id_exists = $this->books()->where('book_id', $bookIdOrCode)->exists();
            return $book_id_exists;
        }

    }
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
}
