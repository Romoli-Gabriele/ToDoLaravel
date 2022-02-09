@extends('layout')
@section('content')  
<ul>
    @foreach ($teams as $team)
        <li>
            <label>Team: </label>
            {{$team->name}} 
            <label>{{__('team.leaders')}}: </label>
            @foreach($leaders as $leader)
            @if ($leader->team_id == $team->id)
                <li>{{$leader->name}}</li>
            @endif
            @endforeach
            <label>{{__('team.numberof')}} <a href="{{route('teams.show', ['team'=>$team])}}">{{__('team.members')}}</a>: </label>{{$team->members->count()}}
        </li>
    @endforeach
</ul>
@endsection