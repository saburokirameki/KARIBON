@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="book">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="{{ $book->image_url }}" alt="">
                    </div>
                    <div class="panel-body">
                        <p class="book-title">{{ $book->name }}</p>
                        <div class="buttons text-center">
                            @if (Auth::check())
                                @include('books.have_button', ['book' => $book])
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
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="text-center"><a href="{{ $book->url }}" target="_blank">楽天ブックス詳細ページへ</a></p>
        </div>
    </div>
@endsection

