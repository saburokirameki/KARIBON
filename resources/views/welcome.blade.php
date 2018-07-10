@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>みんなで作る図書館</h1>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">KARIBONを始める</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')    
    <div class="karireu-list">借りれる本一覧</div>

    @if ($books)
<div class="row">
        @foreach ($books as $book)
            @if ($book->users()->exists())
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
                                    <input type="button" onclick="location.href='{{ route('books.show', $book->id) }}'"value="借りる">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
    {!! $books->render() !!}
@endsection
    