@extends('layouts.app')

@section('content')
    <a class="toppage" href="/">Top Pageに戻る</a>
    <div class="search">
        <div class="row">
            <div class="text-center">
                {!! Form::open(['route' => 'books.create', 'method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('keyword', $keyword, ['class' => 'form-control input-lg', 'placeholder' => 'キーワードを入力', 'size' => 40]) !!}
                    </div>
                    {!! Form::submit('本を検索', ['class' => 'btn btn-success btn-lg']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

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
                                       @include('books.have_button', ['book' => $book])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection