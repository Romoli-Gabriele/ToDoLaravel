@extends('layout')
@section('content')  
<nav>
    <a href="{{ route('tasks.create') }}">{{__('task.add')}}</a>
    @if(auth()->user()->isTeamleader())
    <a href="/delete">{{__('task.delete')}}</a>
    @elseif(auth()->user()->isAdmin())
        <a href="/admin/delete">{{__('task.delete')}}</a>
    @endif
    <form method="GET" action="/tasks">
    <input type="text" value="{{request('search')}}" name="search" placeholder="{{__('task.find')}}" class="text-sm">
    <button type="submit">{{__('task.search')}}</button>
    </form>
</nav>
    <ul>
        @foreach ($tasks as $task)
            <li>
                @if ($task->terminata)
                    {!!"&#10004"!!}
                @else
                    <a style="text-decoration: none; color:black" href="{{ route('tasks.edit', ['task' => $task->id]) }}">{{__('task.todo')}}</a>
                @endif
                {{$task->descrizione}}
                
                <label>{{__('task.added')}}:</label>
                <time>{{$task->created_at->diffForHumans()}}</time>
                <label>{{__('task.by')}}:</label>
                {{$task->user->name}}
                <label>{{__('task.assign')}}: </label>
                @if(isset($task->assigned_id))
                    {{$task->assigned->name}}
                @else
                {{__('task.nobody')}}
                @endif
            </li>
        @endforeach
    </ul>
@endsection