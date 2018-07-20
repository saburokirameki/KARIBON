<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Controllers\Controller;

use App\Book;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('updated_at', 'desc')->paginate(300);
        
        // 検索するテキスト取得
        $search = Request::get('s');
        $query = Book::query();
       
        // 検索するテキストが入力されている場合のみ
        if(!empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }
        $data = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('welcome', [
            'books' => $books,
            'data' => $data,
            'search' => $search,
        ]);

    }
    
}