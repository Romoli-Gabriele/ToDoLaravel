@extends('layout')
@section('content')
<ul>
    @foreach ($users as $user)
        <li><label class="
            @if ($user->isAdmin())
                text-purple
            @elseif($user->isLeader())
                text-red
            @endif
            "
            >{{$user->name}}</label>
            
            
            <label>Email: {{$user->email}}</label>
            <label>Team: {{$user->team->name}}</label>
        </li>
    @endforeach
</ul>
@endsection