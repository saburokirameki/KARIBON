<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNoticeController extends Controller
{
    public function store(Request $request)
    {
        \Auth::user()->notice_user()->create([
            'book_id' => $request->book_id,
        ]);
        
        \Auth::user()->notice($request->notice_id);
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->dont_notice($id);
        return redirect()->back();
    }
}
