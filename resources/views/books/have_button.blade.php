@if (Auth::user()->is_having($book->code))
    {!! Form::open(['route' => 'book_user.dont_have', 'method' => 'delete']) !!}
        {!! Form::hidden('bookCode', $book->code) !!}
        {!! Form::submit('貸せる本から削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'book_user.have']) !!}
        {!! Form::hidden('bookCode', $book->code) !!}
        {!! Form::submit('貸せる本に追加', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endif