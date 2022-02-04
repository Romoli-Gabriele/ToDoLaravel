@extends('layout')
@section('content')  
    <ul>
        <h3>Delete done  task</h3>
        
        @foreach ($tasks as $task)
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('delete')
            <li><button type="submit">
                &#10004

                {{$task->descrizione}}
                
                <label>Added:</label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label>By:</label>
                {{$task->user->name}}
            </button>
            </li>
        @endforeach
    </ul>
@endsection