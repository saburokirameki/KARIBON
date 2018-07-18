@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>さあ、はじめよう</h1>
        <h4>KARIBONではあなたの同期が持っている本を借りたり、<br>
        あなたのおすすめの本を同期と簡単にシェアできます。</h4>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Nickname') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
                    
                     <div class="form-group">
                        {!! Form::label('home', 'Home Team  (GHRスタッフの方⇒「GHR」、メンターさん⇒「mentor」)')!!}
                        {!! Form::text('home', old('home'), ['class' => 'form-control','placeholder' => 'ex) 2-B']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', ['class' => 'form-control','placeholder' => '6文字以上必要です']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirmation') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
    
                    {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>
@endsection