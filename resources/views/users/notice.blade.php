@extends('layouts.app')

@section('content')
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
                <h2>{{$user->name}}({{$user->home}})さんが<br/>『{{$user->book_name}}』を<br/>借りたいと言っています！</h2>
                </div>
            <div class='btn-group'>
            @if (Auth::user()->id == $user->notice_id)
            {!! Form::open(['route' => ['users.confirm'], 'method' => 'delete']) !!}
                {!! Form::submit('通知を確認', ['class' =>'btn btn-danger btn-xs']) !!}
                {{Form::hidden('notice_id', $user->id)}}
            {!! Form::close() !!}
        @endif
        </div>
            </div>
    @endforeach
@endsection