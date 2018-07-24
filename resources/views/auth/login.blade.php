@extends('layouts.app')

@section('content')
    <div class="row">
        <h1 class='text-center'>Log in</h1>
        <div class="col-xs-offset-3 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['route' => 'login.post']) !!}
                        <div class="form-group">
                            {!! form::label('name', 'Nickname') !!}
                            {!! form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
    
                        <div class="form-group">
                            {!! form::label('password', 'Password') !!}
                            {!! form::password('password', ['class' => 'form-control']) !!}
                        </div>
    
                        <div class="text-center">
                            {!! form::submit('Log in', ['class' => 'btn btn-login btn-success btn-block']) !!}
                        </div>
                    {!! form::close() !!}
                </div>
            </div>
            @if (!Auth::check())
                <a href="{{ route('signup.get') }}" class="btn btn-hajimeru btn-md">新規登録</a>
            @endif
        </div>
    </div>
    
    
    
@endsection