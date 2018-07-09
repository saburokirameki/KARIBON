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
    @include('books.books')
    {!! $books->render() !!}
@endsection
    