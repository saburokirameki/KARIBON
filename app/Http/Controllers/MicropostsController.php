<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Book;
use \App\Micropost;
use \App\User;

class MicropostsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
       public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:1000',
        ]);
        
        $book_id = $request->book_id;

        $request->user()->microposts()->create([
            'content' => $request->content,
            'book_id' => $request->book_id,
        ]);

        return redirect()->back();
    }
    
    
    
}
