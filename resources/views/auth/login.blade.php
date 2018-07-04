@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">Log in</div>
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

                    <div class="text-right">
                        {!! form::submit('Log in', ['class' => 'btn btn-success']) !!}
                    </div>
                {!! form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection