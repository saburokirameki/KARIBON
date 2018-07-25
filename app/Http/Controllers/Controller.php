<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_notice_user = $user->notice_user()->count();
        $count_noticed_user = $user->noticed_user()->count();
        
        ////////////////////////////////
        //Yujiの趣味（フォロー機能）
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        $count_have_books = $user->books()->count();

        return [
            'count_notice_user' => $count_notice_user,
            'count_noticed_user' => $count_noticed_user,
            
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_have_books' => $count_have_books,
        ];
    }
}
