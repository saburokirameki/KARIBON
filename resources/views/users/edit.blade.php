
@extends('layouts.app')

@section('content')

 <div class="col-md-offset-2 col-md-8 text-center">
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

        {!! Form::label('profile') !!}
        {!! Form::textarea('profile', old('profile'), ['class' => 'form-control', 'rows' => '2', 'placeholder'=>'最大４００文字']) !!}
        {!! Form::submit('プロフィールを更新', ['class' => 'btn btn-success btn-block']) !!}

    {!! Form::close() !!}
    
</div>
@endsection