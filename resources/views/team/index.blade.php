@extends('layout')
@section('content')  
<ul>
    @foreach ($teams as $team)
        <li>
            <label>Team: </label>
            {{$team->name}} 
            <label>Leader: </label> {{$team->team_leader->name}}
            <label>Nuber of <a href="{{route('teams.show', ['team'=>$team])}}">members</a>: </label>{{$team->members->count()}}
        </li>
    @endforeach
</ul>
@endsection