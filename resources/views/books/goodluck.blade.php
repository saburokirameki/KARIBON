@extends('layouts.app')

@section('content')
<a class="toppage" href="/">Top Pageに戻る</a>
    <div class="goodluck">
    <div class="panel-heading text-center">
        <img src="{{ $book->image_url }}" alt="" class="">
        <h3>この本を貸してくれる人は{{ $count_users }}人います <span class="glyphicon glyphicon-thumbs-up"></span></h3>
    </div>
    <div class="col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
       <table class="table table-striped">
            <thead>
                <tr> 
                    <th class="text-center">Nickname</th>
                    <th class="text-center">Home Team</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($have_users as $user)
                        <tr class="warning text-center">
                            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->home }}</td>
                            <td>@include('books.notice_button', ['user' => $user, 'book' => $book])</td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
    </div>
@endsection

