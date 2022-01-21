@extends('layout')
@section('content')  
    <ul>
        <h3>Delete done  task</h3>
        
        @foreach ($tasks as $task)
        <form method="POST" action="/admin/tasks/{{$task->id}}">
            @csrf
            @method('delete')
            <li><button type="submit">
                &#10004

                {{$task->descrizione}}
                
                <label><b>Added:</b></label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label><b>By:</b></label>
                {{$task->user->name}}
            </button>
            </li>
        @endforeach
    </ul>
@endsection