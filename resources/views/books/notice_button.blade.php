@if (Auth::user()->is_noticing($user->id, $book->id))
    {!! Form::open(['route' => ['user.dont_notice', $user->id], 'method' => 'delete']) !!}
        {{ Form::hidden('notice_id', $user->id) }}
        {{ Form::hidden('book_id', $book->id) }}
        {!! Form::submit('依頼取り消し', ['class' => "btn btn-danger btn-block"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['user.notice', $user->id]]) !!}
        {{ Form::hidden('notice_id', $user->id) }}
        {{ Form::hidden('book_id', $book->id) }}
        {!! Form::submit('この人から借りる', ['class' => "btn btn-primary btn-block"]) !!}
    {!! Form::close() !!}
@endif