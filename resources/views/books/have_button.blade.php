@if (Auth::user()->is_having($book->id))
    {!! Form::open(['route' => 'book_user.dont_have', 'method' => 'delete']) !!}
        {!! Form::hidden('bookCode', $book->code) !!}
        {!! Form::submit('貸せないわ', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'book_user.have']) !!}
        {!! Form::hidden('bookCode', $book->code) !!}
        {!! Form::submit('貸すわよ', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endif