@extends('layouts.app')

@section('content')
    <div class="col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
        <ul class="nav nav-tabs nav-justified">
             <li role="presentation" class="{{ Request::is('users' ) ? 'active' : '' }}"><a href="users">Nickname順</a></li>
            <li role="presentation" class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ route('users.home') }}">Home Team別</a></li>
            <li role="presentation" class="{{ Request::is('ranking') ? 'active' : '' }}"><a href="{{ route('users.ranking') }}">貸出冊数順</a></li>
        </ul>
       <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                 <tr>
                    <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->home }}</td>
                    <td>{{ $user->books()->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection