@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->name, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="tuika-button text-center">
                <a href="{{ route('books.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    貸せる本を追加
                </a>
        </div>
      
        <div class="status text-center">
                    <div class="status-label"　id="have_count">貸せる本{{ $count_have }}冊</div>
        </div>
    </div>
   @include('books.books')
    {!! $books->render() !!}
@endsection