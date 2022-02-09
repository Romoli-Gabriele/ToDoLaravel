@extends('layout')
@section('content')  
    <ul>
        <h3>{{__('task.deletedone')}}</h3>
        
        @foreach ($tasks as $task)
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('delete')
            <li><button type="submit">
                &#10004

                {{$task->descrizione}}
                
                <label>{{__('task.added')}}:</label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label>{{__('task.by')}}:</label>
                {{$task->user->name}}
            </button>
            </li>
        @endforeach
    </ul>
@endsection