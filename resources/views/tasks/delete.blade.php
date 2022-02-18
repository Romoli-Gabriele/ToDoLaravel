@extends('layout')
@section('content')  
    <ul>
        <h3>{{__('task.deletedone')}}</h3>
        
        @foreach ($tasks as $task)
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('delete')
            <li>
                <a href="{{route('tasks.edit', ['task' => $task->id]) }}">&#10004</a>

                {{$task->descrizione}}
                
                <label>{{__('task.added')}}:</label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label>{{__('task.by')}}:</label>
                {{$task->user->name}}
            <button type="submit">
            {{__('task.delete')}}
            </button>
            </li>
        @endforeach
    </ul>
@endsection