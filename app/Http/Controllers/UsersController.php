<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Book;

class UsersController extends Controller
{
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $count_have = $user->books()->count();
        $books = \DB::table('books')->join('book_user', 'books.id', '=', 'book_user.book_id')->select('books.*')->where('book_user.user_id', $user->id)->distinct()->paginate(20);
        
        return view('users.show', [
            'user' => $user,
            'books' => $books,
            'count_have' => $count_have,
        ]);
    }
    
    public function ranking()
    {
        $users = \DB::table('book_user')
        ->join('users', 'book_user.user_id', '=', 'users.id')
        ->select('users.id','users.name','users.home', \DB::raw('COUNT(book_user.user_id) as count'))
        ->groupBy('users.id','users.name','users.home')
        ->orderBy('count', 'DESC')
        ->get();
        
        return view('users.ranking', [
            'users' => $users,
        ]);
    }
    
    public function index()
    {
        $users = User::OrderBy('name')->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function home()
    {
        $users = User::OrderBy('home')->get();

        return view('users.home', [
            'users' => $users,
        ]);
    }
    
    public function taikai()
    {
       $user = \Auth::user();
       
        return view('users.taikai',['user'=> $user]);
    }
    
    public function news()
    {
         $users = \DB::table('users')
        ->join('notice', 'users.id', '=', 'notice.user_id')
        ->join('books', 'books.id', '=', 'notice.book_id')
        ->select('users.name as name','users.home as home','books.name as book_name', 'books.image_url as url')
        ->where('notice.notice_id', \Auth::id())
        ->groupBy('users.name','users.home', 'books.name', 'books.image_url')
        ->get();
        
        return view('users.notice',['users'=> $users]);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);    
       
         $user->delete();
       
        return redirect()->back();
    }
   
}
