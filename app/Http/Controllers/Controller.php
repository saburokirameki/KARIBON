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

        return [
            'count_notice_user' => $count_notice_user,
            'count_noticed_user' => $count_noticed_user,
        ];
    }
}
