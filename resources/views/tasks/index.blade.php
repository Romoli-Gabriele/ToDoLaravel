@extends('layout')
@section('content')  
<nav>
    @if(auth()->user()->isLeader())
        <a href="/delete"><b>Delete Task</b></a>
        <a href="/users"><b>All Users</b></a>
    @endif
    <a href="{{ route('tasks.create') }}"><b>Add Task</b></a>
    <form method="GET" action="/tasks">
    <input type="text" value="{{request('search')}}" name="search" placeholder="Find something" class="bg-transparent placeholder-black font-semibold text-sm">
    <button type="submit">Search</button>
    </form>
</nav>
    <ul>
        @foreach ($tasks as $task)
            <li>
                @if ($task->terminata)
                    {!!"&#10004"!!}
                @else
                    <a style="text-decoration: none; color:black" href="{{ route('tasks.edit', ['task' => $task->id]) }}"><b>To Do</b></a>
                @endif
                {{$task->descrizione}}
                
                <label><b>Added:</b></label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label><b>By:</b></label>
                {{$task->user->name}}
            </li>
        @endforeach
    </ul>
@endsection