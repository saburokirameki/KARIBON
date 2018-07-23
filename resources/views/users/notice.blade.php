@extends('layouts.app')

@section('content')

    @foreach ($users as $user)
   
    <div class="alert alert-warning" role="alert">{{$user->name}}({{$user->home}})さんが{{$book->name}}を借りたいと言っています！</div>
   
  
    
   
    @endforeach
       
@endsection