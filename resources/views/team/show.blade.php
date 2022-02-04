@extends('layout')
@section('content') 
<ul>
    <h5>Team {{$team->name}}</h5>
    @foreach($members as $user)
        <li><label class="
            @if ($user->isAdmin())
                text-purple
            @elseif($user->isLeader())
                text-red
            @endif
            "
            >{{$user->name}}</label>
            <label>Email: {{$user->email}}</label>
    </li>
    @endforeach
</ul>
@endsection