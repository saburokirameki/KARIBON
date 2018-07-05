@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->name, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="status text-center">
            <ul>
                <li>
                    <div class="status-label">貸すわよ</div>
                    <div id="have_count" class="status-value">
                        {{ $count_have }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @include('books.books', ['books' => $books])
    {!! $books->render() !!}
@endsection