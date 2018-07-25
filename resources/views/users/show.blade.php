@extends('layouts.app')

@section('content')
<a class="toppage" href="/">Top Pageに戻る</a>
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->name, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="text-center">
            <h3>{{ $user->profile }}</h3>
            @if(Auth::id()==$user->id)
            {!! link_to_route('users.edit', '自己紹介を書く', ['id' => $user->id]) !!}
            @endif
            @include('user_follow.follow_button', ['user' => $user])
        </div>
        @if(Auth::id()==$user->id)
            <div class="tuika-button text-center">
                    <a href="{{ route('books.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        貸せる本を追加
                    </a>
            </div>
        @endif
        <br>
        <br>
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="{{ Request::is('users/'.$user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">貸せる本 <span class="badge">{{ $count_have_books }}</span></a></li>
            <li role="presentation" class="{{ Request::is('users/*/borrow') ? 'active' : '' }}"><a href="{{ route('users.borrow', ['id' => $user->id]) }}">借りている本 <span class="badge">{{ $count_notice_user }}</span></a></li>
            <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">フォロー <span class="badge">{{ $count_followings }}</span></a></li>
            <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">フォロワー <span class="badge">{{ $count_followers }}</span></a></li>
        </ul>
        <br>
        <div class="status text-center">
                    <div class="status-label"　id="have_count">貸せる本{{ $count_have }}冊</div>
        </div>
    </div>
   @include('books.books')
    {!! $books->render() !!}
    
@endsection