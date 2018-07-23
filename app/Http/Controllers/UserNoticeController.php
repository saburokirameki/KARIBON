<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserNoticeController extends Controller
{
    public function store(Request $request, $id)
    {
        $book_id = $request->book_id;
        \Auth::user()->notice($id, $book_id);
        
        $user = User::find($id);
        
        return view('books.finalgoodluck', ['user'=>$user]);
    }

    public function destroy(Request $reqest, $id)
    {
        $book_id = $reqest->book_id;
        \Auth::user()->dont_notice($id, $book_id);
        return redirect()->back();
    }
}
