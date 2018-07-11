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

        {!! Form::open(['method' => 'GET']) !!}
        {!! Form::text('s' , null) !!}
        {!! Form::submit('借りれる本を検索') !!}
        {!! Form::close() !!}   
       
        @if (count($data) > 0)
            <div class="row">
                @foreach ($data as $book)
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
               {!! $data->render() !!}
        @else
            <div class = "kariru-search text-center">検索ヒット件数：０</div>
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
            　 {!! $books->render() !!}
            </div>
            
        @endif
    
    
   
@endsection
    