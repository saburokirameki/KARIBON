@extends('layouts.app')

@section('content')
<a class="toppage" href="/">Top Pageに戻る</a>
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="book">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="{{ $book->image_url }}" alt="">
                    </div>
                    <div class="panel-body">
                        <p class="book-title">{{ $book->name }}</p>
                        <div class="buttons text-center">
                            @if (Auth::user()->is_having($book->code))
                                @include('books.have_button', ['book' => $book])
                                
                            @else
                                <a href='{{ route('books.goodluck', $book->id) }}' class="cp_btn text-center">借りる</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="have-users">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        貸してくれるユーザ
                    </div>
                    <div class="panel-body">
                        @foreach ($have_users as $user)
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        <br>
                        
                        @endforeach
                    <div class='text-center'>    
                        @if (!(Auth::user()->is_having($book->code)))
                                {!! Form::open(['route' => 'book_user.have']) !!}
                                {!! Form::hidden('bookCode', $book->code) !!}
                                {!! Form::submit('＋自分も貸す', ['class' =>'jibunmo']) !!}
                                {!! Form::close() !!}
                        @endif
                    </div>
                    </div>
                </div>
            </div>
            <p class="text-center"><a href="{{ $book->url }}" target="_blank">楽天ブックス詳細ページへ</a></p>
        </div>
        <div class="col-md-offset-2 col-md-8">
        <div class="form-group ">
              {!! Form::open(['route' => 'microposts.store', 'method' => 'post']) !!}
              {{Form::hidden('book_id', $book->id)}}
              {{Form::hidden('user_id', $user->id)}}
              {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2', 'placeholder'=>'最大１０００文字']) !!}
              {!! Form::submit('この本に対するコメントを投稿', ['class' => 'btn btn-success btn-block']) !!}
              {!! Form::close() !!}
            </div>
            @if (count($microposts) > 0)
                <ul class="media-list">
                    @foreach ($microposts as $micropost)
                        <?php $user = $micropost->user; ?>
                        <li class="media">
                            <div class="media-body">
                                <div>
                                    {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                                </div>
                                <div>
                                    <p>{!! nl2br(e($micropost->content)) !!}</p>
                                </div>
                                <div class='btn-group'>
                                @if (Auth::user()->id == $micropost->user_id)
                                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('コメントを削除', ['class' =>'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            {!! $microposts->render() !!}
            </div>
            
@endsection

