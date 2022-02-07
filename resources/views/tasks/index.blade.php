@extends('layout')
@section('content')  
<nav>
    <a href="{{ route('tasks.create') }}">Add Task</a>
    @if(auth()->user()->isTeamleader())
    <a href="/delete">Delete Task</a>
    @elseif(auth()->user()->isAdmin())
        <a href="/admin/delete">Delete Task</a>
    @endif
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
                    <a style="text-decoration: none; color:black" href="{{ route('tasks.edit', ['task' => $task->id]) }}">To Do</a>
                @endif
                {{$task->descrizione}}
                
                <label>Added:</label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label>By:</label>
                {{$task->user->name}}
                <label>Assigned to: </label>
                @if(isset($task->assigned_id))
                    {{$task->assigned->name}}
                @else
                    Nobody
                @endif
            </li>
        @endforeach
    </ul>
@endsection