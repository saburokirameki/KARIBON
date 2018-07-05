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
                'hits' => 20,
            ]);

            // Creating "Book" instance to make it easy to handle.（not saving）
            foreach ($rws_response->getData()['Items'] as $rws_book) {
                $book = new Book();
                $book->code = $rws_book['Item']['isbn'];
                $book->name = $rws_book['Item']['title'];
                $book->url = $rws_book['Item']['itemUrl'];
                $book->image_url = str_replace('?_ex=128x128', '', $rws_book['Item']['mediumImageUrl']);
                $books[] = $book;
            }
        }

        return view('books.create', [
            'keyword' => $keyword,
            'books' => $books,
        ]);
    }
  }