@extends('layout')
@section('content')
    @error('descrizione')   
        <p class="text-red">{{ $message }}</p>
    @enderror
    <ul>
        @foreach ($tasks as $task)
            <li>
                @if ($task->terminata)
                    {!!"&#10004"!!}
                @else
                    <a style="text-decoration: none; color:black" href="/edit/{{$task->slug}}"><b>To Do</b></a>
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