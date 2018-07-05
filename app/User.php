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
        // Is the user already "want"?
        $exist = $this->is_having($bookId);

        if ($exist) {
            // remove "want"
            \DB::delete("DELETE FROM book_user WHERE user_id = ? AND book_id = ?", [\Auth::id(), $bookId]);
        } else {
            // do nothing
            return false;
        }
    }

    public function is_having($bookIdOrCode)
    {
        if (is_numeric($bookIdOrCode)) {
            $book_id_exists = $this->books()->where('book_id', $bookIdOrCode)->exists();
            return $book_id_exists;
        } else {
            $book_code_exists = $this->books()->where('code', $bookIdOrCode)->exists();
            return $book_code_exists;
        }
    }
}
