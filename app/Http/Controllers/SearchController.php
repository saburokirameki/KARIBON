<?php
 
namespace App\Http\Controllers;
 
use App\Book;
 
class SearchController extends Controller
{
    public function getIndex()
    {
        $data = Book::get();
        
        return view('welcome', $data);
    }
}
