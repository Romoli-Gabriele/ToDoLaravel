@extends('layout')
@section('content')  
    <ul>
        @foreach ($tasks as $task)
            <li>
                @if ($task->terminata)
                    {!!"&#10004"!!}
                @else
                    {{$task->id}}
                    <a style="text-decoration: none; color:black" href="{{ route('tasks.edit', ['task' => $task->id]) }}"><b>To Do</b></a>
                @endif
                {{$task->descrizione}}
                
                <label><b>Added:</b></label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label><b>By:</b></label>
                {{$task->user->name}}
            </li>
        @endforeach
    </form>
    </ul>
@endsection