<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Controllers\Controller;
    use \App\Book;

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
                'imageFlag' => 1,
                'hits' => 30,
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

      return view('books.show', [
          'book' => $book,
          'have_users' => $have_users,
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
    
    public function business()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001006'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.business', [
            'books' => $books,
        ]);
    }
    
    public function lang()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001002'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.lang', [
            'books' => $books,
        ]);
    }
    
    public function novel()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001004'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.novel', [
            'books' => $books,
        ]);
    }
    
    public function pc()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001005'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.pc', [
            'books' => $books,
        ]);
    }
    
    public function shikaku()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001016'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.shikaku', [
            'books' => $books,
        ]);
    }
    
    public function society()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'like', '%'.'001008'.'%');
        
        $books = $query->paginate(300);
        
        return view('books.society', [
            'books' => $books,
        ]);
    }
    
    public function others()
    {
        $query = Book::query();
       
        $query->where('booksgenreid', 'not like', '%'.'001005'.'%')
              ->orwhere('booksgenreid', 'not like',  '%'.'001006'.'%')
              ->orwhere('booksgenreid', 'not like',  '%'.'001004'.'%')
              ->orwhere('booksgenreid', 'not like',  '%'.'001016'.'%')
              ->orwhere('booksgenreid', 'not like',  '%'.'001002'.'%')
              ->orwhere('booksgenreid', 'not like',  '%'.'001008'.'%')
              ->orwherenull('booksgenreid');
        
        $books = $query->paginate(300);
        
        return view('books.others', [
            'books' => $books,
        ]);
    }
  }