@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>みんなで作る図書館</h1>
                
                    <form id="form1" action="/">
                    <input id="sbox" name="s" type="text" placeholder="タイトルを入力" />
                    <input id="sbtn" type="submit" value="借りられる本を検索" />
                    </form>
                    
            </div>
        </div>
    </div>
@endsection

@section('content')
<a class="toppage" href="{{ route('books.rakuten') }}">PageTopへ</a>
    <div class="karireu-list">借りられる本一覧</div>
    
<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="{{ Request::is('/' ) ? 'active' : '' }}"><a href="/">すべて</a></li>
    <li role="presentation" class="{{ Request::is('books/rakuten') ? 'active' : '' }}"><a href="{{ route('books.rakuten') }}">楽天</a></li>
    <li role="presentation" class="{{ Request::is('books/pc') ? 'active' : '' }}"><a href="{{ route('books.pc') }}">システム開発</a></li>
    <li role="presentation" class="{{ Request::is('books/business') ? 'active' : '' }}"><a href="{{ route('books.business') }}">ビジネス</a></li>
    <li role="presentation" class="{{ Request::is('books/novel') ? 'active' : '' }}"><a href="{{ route('books.novel') }}">小説</a></li>
    <li role="presentation" class="{{ Request::is('books/shikaku' ) ? 'active' : '' }}"><a href="{{ route('books.shikaku') }}">資格</a></li>
    <li role="presentation" class="{{ Request::is('books/lang') ? 'active' : '' }}"><a href="{{ route('books.lang') }}">語学</a></li>
    <li role="presentation" class="{{ Request::is('books/society') ? 'active' : '' }}"><a href="{{ route('books.society') }}">人文/社会</a></li>
    <li role="presentation" class="{{ Request::is('books/others') ? 'active' : '' }}"><a href="{{ route('books.others') }}">その他</a></li>
    </ul>
    
        @if (count($books) > 0)
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
                                            <a class="comment" href="{{ route('books.show', $book->id) }}"><span class="glyphicon glyphicon-comment"></span>{{  $book->microposts()->count() }}</a>
                                            @if (Auth::check())
                                                @if (Auth::user()->is_having($book->id))
                                                @else
                                                <a href='{{ route('books.goodluck', $book->id) }}' class="cp_btn">借りる</a>
                                                @endif
                                            @else
                                                <a href='{{ route('books.goodluck', $book->id) }}' class="cp_btn">借りる</a>
                                            @endif
                                        @else
                                            <p class="book-title">{{ $book->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
               <div class='paginate'>{!! $books->render() !!}</div>
        @endif
   
@endsection
    