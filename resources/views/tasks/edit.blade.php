@extends('layout')
@section('content')
    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
        @method('PUT')
        @csrf
        <label>Edit Task</label>
        <input type="text" name="descrizione" value="{{$task->descrizione}}">
        @isset($task->assigned)
        <label>Done</label>
        <input type="checkbox" name="terminata" 
        @if ($task->terminata)
        checked 
        @endif
        >
        @endisset
        @if($users!=null)
        <label>Assign to:</label>
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
        <label>Assign to youself: </label>
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