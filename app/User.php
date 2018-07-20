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
    
     public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
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
    
    //借りた人が貸す人にbelongs
    public function notice_user()
    {
        return $this->belongsToMany(User::class, 'notice', 'user_id', 'notice_id')->withPivot('book_id')->withTimestamps();
    }
    //貸す人が借りる人にbelongs
    public function noticed_user()
    {
        return $this->belongsToMany(User::class, 'notice', 'notice_id', 'user_id')->withPivot('book_id')->withTimestamps();
    }
    
    // 借りたいよ通知を送る瞬間（借りたい人が緑ボタンを押す瞬間）
    public function notice($userId)
    {
        // confirm if already following
        $exist = $this->is_noticing($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // do nothing if already following
            return false;
        } else {
            // follow if not following
            $this->notice_user()->attach($userId);
            return true;
        }
    }
    // 借りたい通知を取り消す瞬間（借りたい人がやっぱりやめるボタンを押す瞬間）
    public function dont_notice($userId)
    {
        // confirming if already following
        $exist = $this->is_noticing($userId);
        // confirming that it is not you
        $its_me = $this->id == $userId;
    
    
        if ($exist && !$its_me) {
            // stop following if following
            $this->notice_user()->detach($userId);
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    // 借りたいよ通知を送った状態（借りたい人が緑ボタンを押した状態）
    public function is_noticing($userId) {
        return $this->notice_user()->where('notice_id', $userId)->exists();
    }
    // 借りたいよ通知を受け取った状態（貸す側が通知を見ている状態）
    public function is_noticed($userId) {
        return $this->noticed_user()->where('user_id', $userId)->exists();
    }
    
    
}
