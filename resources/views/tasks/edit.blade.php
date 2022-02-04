@extends('layout')
@section('content')
    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
        @method('PUT')
        @csrf
        <label><b>Edit Task</b></label>
        <input type="text" name="descrizione" value="{{$task->descrizione}}">
        @isset($task->assigned)
        <label><b>Done</b></label>
        <input type="checkbox" name="terminata" 
        @if ($task->terminata)
        checked 
        @endif
        >
        @endisset
        @if($users!=null)
        <label><b>Assign to:</b></label>
        <select name="assigned">
        <option>Nobody</option>
        @foreach ($users as $user)
        <option value="{{$user->id}}" 
            @if ($task->assigned == $user)
            selected
            @endif
        >{{$user->name}}</option>
        @endforeach
        </select>
        @else
        @if($task->assigned == null || $task->assigned->id == auth()->user()->id)
        <label><b>Assign to youself: </b></label>
        <input type="checkbox" name="assigned"
        @isset($task->assigned)
        checked
        @endisset
        >
        @endif
        @endif
        <button type="submit">Submit</button>
    </form>
@endsection