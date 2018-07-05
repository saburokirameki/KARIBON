<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Book;

class BookUserController extends Controller
{
    public function have()
    {
        $bookCode = request()->isbn;

        // Search items from "itemCode"
        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('BooksTotalSearch', [
            'isbn' => $bookCode,
        ]);
        $rws_book = $rws_response->getData()['Items'][0]['Item'];

        // create Item, or get Item if an item is found
        $book = Book::firstOrCreate([
            'code' => $rws_book['isbn'],
            'name' => $rws_book['title'],
            'url' => $rws_book['itemUrl'],
            // remove "?_ex=128x128" because its size is defined
            'image_url' => str_replace('?_ex=128x128', '', $rws_book['mediumImageUrl']),
        ]);

        \Auth::user()->have($book->id);

        return redirect()->back();
    }

    public function dont_have()
    {
        $bookCode = request()->isbn;

        if (\Auth::user()->is_having($bookCode)) {
            $bookId = Book::where('code', $bookCode)->first()->id;
            \Auth::user()->dont_have($bookId);
        }
        return redirect()->back();
    }
}