@extends('layout')
@section('content')
<ul>
    @foreach ($users as $user)
        <li><label class="
            @if ($user->isLeader())
                text-red-500
            @endif
            "
            >{{$user->name}}</label>
            
            
            <label><b>Email: </b>{{$user->email}}</label>
            <label><b>Team: </b>{{$user->team->name}}</label>
        </li>
    @endforeach
</ul>
@endsection