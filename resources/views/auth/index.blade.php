@extends('layout')
@section('content')
<ul>
    @foreach ($users as $user)
        <li><label class="
            @if ($user->isAdmin())
                text-green
            @elseif($user->isTeamLeader())
                text-red
            @endif
            "
            >Nome: </label>{{$user->name}}
            <label>Email: </label>{{$user->email}}
            @if(!$user->isAdmin())
            <label>Team: </label>{{$user->team->name}}
            @endif
            @role('admin')
            <a href="/admin/roles/{{$user->id}}">Edit Roles</a>
            @endrole
        </li>
    @endforeach
</ul>
@endsection