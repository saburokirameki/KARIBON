@extends('layouts.app')

@section('content')

    <aside class="text-center">
        <br>
        <a href="{{ route('welcome') }}" class="yamenai">やっぱり続ける</a>
        <br>
        <br>
            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('本当に退会する', ['class' => 'btn btn-danger btn-lg']) !!}
            {!! Form::close() !!}
    </aside>
@endsection