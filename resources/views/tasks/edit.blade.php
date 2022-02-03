@extends('layout')
@section('content')
    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
        @method('PUT')
        @csrf
        <label><b>Edit Task</b></label>
        <input type="text" name="descrizione" value="{{$task->descrizione}}">
        <label><b>Done</b></label>
        <input type="checkbox" name="terminata" 
        @if ($task->terminata)
        checked 
        @endif
        >
        <input >
        <button type="submit">Submit</button>
    </form>
@endsection