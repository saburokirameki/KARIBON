
@extends('layouts.app')

@section('content')

 <div class="col-md-offset-2 col-md-8 text-center">
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

        {!! Form::label('profile') !!}
        {!! Form::textarea('profile', old('profile'), ['class' => 'form-control', 'rows' => '7', 'placeholder'=>'最大４００文字　（例）気軽に借りに来てね！']) !!}
        {!! Form::submit('プロフィールを更新', ['class' => 'btn btn-success btn-block']) !!}

    {!! Form::close() !!}
    
    <br/>
    <br/>
    <br/>
    @if(Auth::id()==$user->id)
    <p class='text-right'>{!! link_to_route('users.taikai', 'アカウントの削除') !!}</p>
    @endif
    
</div>
@endsection