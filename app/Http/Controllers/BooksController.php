<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Controllers\Controller;
    use \App\Book;
    use \App\Micropost;

  class BooksController extends Controller
  {

    public function create()
    {
        $keyword = request()->keyword;
        $books = [];
        if ($keyword) {
            $client = new \RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));

            $rws_response = $client->execute('BooksTotalSearch', [
                'keyword' => $keyword,
                'hits' => 30,
                'page' => 1,
                'field' => 0, //field指定で検索範囲を拡大、最高！！！
            ]);

            // Creating "Book" instance to make it easy to handle.（not saving）
            foreach ($rws_response->getData()['Items'] as $rws_book) {
                $book = new Book();
                $book->code = $rws_book['Item']['isbn'];
                $book->name = $rws_book['Item']['title'];
                $book->url = $rws_book['Item']['itemUrl'];
                $book->image_url = str_replace('?_ex=200x200', '', $rws_book['Item']['largeImageUrl']);
                $book->booksgenreid = $rws_book['Item']['booksGenreId'];
                $books[] = $book;
            }
        }
        
        return view('books.create', [
            'keyword' => $keyword,
            'books' => $books,
        ]);
    }
    
     public function show($id)
    { 
        
        $book = Book::find($id);
        $have_users = $book->users;
        $microposts = $book->microposts()->orderBy('created_at', 'desc')->paginate(10);

      return view('books.show', [
          'book' => $book,
          'have_users' => $have_users,
          'microposts' => $microposts,
      ]);
    }
    
     public function goodluck($id)
    {
      $book = Book::find($id);
      $have_users = $book->users;
      $count_users = $have_users->count();

      return view('books.goodluck', [
          'book' => $book,
          'have_users' => $have_users,
          'count_users' => $count_users,
      ]);
    }
    
    public function rakuten()
    {
        $query = Book::query();
       
        $query->where('name', 'like', '%'.'楽天'.'%')
              ->orwhere('name', 'like', '%'.'成功のコンセプト'.'%')
              ->orwhere('name', 'like', '%'.'成功の法則'.'%')
              ->orwhere('name', 'like', '%'.'rakuten'.'%')
              ->orwhere('name', 'like', '%'.'三木谷'.'%')
              ->orwhere('name', 'like', '%'.'Business-Do'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.society', [
            'books' => $books,
        ]);
    }
    
    public function business()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001006'.'%')
              ->orwhere('booksgenreid', 'like', '001019008'.'%')
              ->orwhere('booksgenreid', 'like', '001020008'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.business', [
            'books' => $books,
        ]);
    }
    
    public function lang()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001002'.'%')
              ->orwhere('booksgenreid', 'like', '001019005'.'%')
              ->orwhere('booksgenreid', 'like', '001020005'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.lang', [
            'books' => $books,
        ]);
    }
    
    public function novel()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001004'.'%')
              ->orwhere('booksgenreid', 'like', '001019001'.'%')
              ->orwhere('booksgenreid', 'like', '001020001'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.novel', [
            'books' => $books,
        ]);
    }
    
    public function pc()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001005'.'%')
              ->orwhere('booksgenreid', 'like', '001019009'.'%')
              ->orwhere('booksgenreid', 'like', '001020009'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.pc', [
            'books' => $books,
        ]);
    }
    
    public function shikaku()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001016'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.shikaku', [
            'books' => $books,
        ]);
    }
    
    public function society()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '001008'.'%')
              ->orwhere('booksgenreid', 'like', '001019007'.'%')
              ->orwhere('booksgenreid', 'like', '001020007'.'%');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.society', [
            'books' => $books,
        ]);
    }
    
    public function others()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'not like', '001005'.'%')
              ->where('booksgenreid', 'not like', '001006'.'%')
              ->where('booksgenreid', 'not like', '001004'.'%')
              ->where('booksgenreid', 'not like', '001016'.'%')
              ->where('booksgenreid', 'not like', '001002'.'%')
              ->where('booksgenreid', 'not like', '001008'.'%')
              ->orwherenull('booksgenreid');
        
        $books = $query->orderBy('updated_at', 'desc')->paginate(300);
        
        return view('books.others', [
            'books' => $books,
        ]);
    }
    
   
  }