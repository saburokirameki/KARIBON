@if ($books)
<div class="row">
        @foreach ($books as $book)
            @if (is_numeric($book->code))
                <div class="book">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <img src="{{ $book->image_url }}" alt="" class="">
                            </div>
                            <div class="panel-body">
                                @if ($book->id)
                                    <p class="book-title"><a href="{{ route('books.show', $book->id) }}">{{ $book->name }}</a></p>
                                @else
                                    <p class="book-title">{{ $book->name }}</p>
                                @endif
                                <div class="buttons text-center">
                                     @if (Auth::user()->is_having($book->code))
                                       @include('books.have_button', ['book' => $book])
                                
                                     @else
                                         <div class="buttons text-center">
                                          <input type="button" onclick="location.href='{{ route('books.goodluck', $book->id) }}'"value="借りる">
                                         </div>
                                     @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif