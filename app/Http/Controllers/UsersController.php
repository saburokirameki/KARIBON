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
        
        
        $data = [
            'user' => $user,
            'books' => $books,
            'count_have' => $count_have,
        ];

        $data += $this->counts($user);
        
        return view('users.show', $data);
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
        ->select('users.name as name','users.home as home','books.name as book_name', 'books.image_url as url', 'notice.notice_id as notice_id', 'notice.id as id')
        ->where('notice.notice_id', \Auth::id())
        ->groupBy('users.name','users.home', 'books.name', 'books.image_url', 'notice.notice_id', 'notice.id')
        ->get();
        
        return view('users.notice',['users'=> $users]);
    }
    
     public function confirm(Request $request)
    {   
        $id=$request->notice_id;
            \Auth::user()->dont_noticed($id);
        return redirect()->back();
    }
    
    public function destroy($id) //taikai 
    {
        $user = User::find($id);    
       
         $user->delete();
       
        return redirect()->back();
    }
    
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'profile' => 'required|max:400',
        ]);
        
        $user = User::find($id); 
        $user->profile = $request->profile;
        $user->save();
        
        $count_have = $user->books()->count();
        $books = \DB::table('books')->join('book_user', 'books.id', '=', 'book_user.book_id')->select('books.*')->where('book_user.user_id', $user->id)->distinct()->paginate(20);
        
        
        $data = [
            'user' => $user,
            'books' => $books,
            'count_have' => $count_have,
        ];

        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    
   public function borrow($id)
    {   
        $user = User::find($id);
        $users = \DB::table('users')
        ->join('notice', 'users.id', '=', 'notice.notice_id')
        ->join('books', 'books.id', '=', 'notice.book_id')
        ->select('users.id as user_id', 'users.name as name','users.home as home','notice.book_id as book_id','books.name as book_name', 'books.image_url as url', 'notice.notice_id as notice_id', 'notice.id as id')
        ->where('notice.user_id', $user->id)
        ->groupBy('users.id', 'users.name','users.home', 'notice.book_id', 'books.name', 'books.image_url', 'notice.notice_id', 'notice.id')
        ->get();
        
        $data = [
            'user'=> $user,
            'users'=> $users,
        ];

        $data += $this->counts($user);
        
        return view('users.borrow',$data);
    }
        
    
    ///////////////////////
    //Yujiの趣味
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
   
}
