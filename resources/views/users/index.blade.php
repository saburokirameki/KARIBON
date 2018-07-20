@extends('layouts.app')

@section('content')
    <div class="col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
       <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Home Team</th>
                    <th>貸出冊数</th>
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