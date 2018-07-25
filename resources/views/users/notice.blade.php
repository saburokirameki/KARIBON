@extends('layouts.app')

@section('content')

     <h1 class="kariru-search">あなたの本を借りたい人がいます。<br/><br/>※本が返ってきたら、『KARIBON完了』ボタンを押しましょう！</h1>
     
    @foreach ($users as $user)
        <div class="alert">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="{{ $user->url }}" alt="" class="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="alert alert-warning text-center" role="alert">
                <h2>{{$user->name}}({{$user->home}})です。<br/>『{{$user->book_name}}』を<br/>貸してください！</h2>
                    <div class='btn-group'>
                        @if (Auth::user()->id == $user->notice_id)
                        {!! Form::open(['route' => ['users.confirm'], 'method' => 'delete']) !!}
                            {!! Form::submit('KARIBON完了', ['class' =>'btn btn-danger btn-md']) !!}
                            {{Form::hidden('notice_id', $user->id)}}
                        {!! Form::close() !!}
                       @endif
                    </div>
                </div>
            </div>
    @endforeach
@endsection