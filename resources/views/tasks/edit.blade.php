@extends('layout')
@section('content')
    <form method="POST" action="/update/{{$task->slug}}">
        @csrf
        <label><b>Edit Task</b></label>
        <input type="text" name="descrizione" value="{{$task->descrizione}}">
        <label><b>Done</b></label>
        <input type="checkbox" name="terminata" 
        @if ($task->terminata)
        checked 
        @endif
        >
        <button type="submit">Submit</button>
    </form>
@endsection