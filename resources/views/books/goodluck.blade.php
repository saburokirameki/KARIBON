@extends('layouts.app')

@section('content')
    <div class="goodluck">
    <div class="panel-heading text-center">
        <img src="{{ $book->image_url }}" alt="" class="">
        <P>この本を貸してくれる人は{{ $count_users }}人います＾＾</P>
    </div>
    </div>
    <div class="col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
       <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Home Team</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($have_users as $user)
                 <tr>
                     <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                     <td>{{ $user->home }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <P>借りに行こう！Good luck!</P>
    </div>
@endsection

