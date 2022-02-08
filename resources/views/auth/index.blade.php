@extends('layout')
@section('content')
<form action="/admin" method="GET">
    <label>Only team leaders</label><input type="checkbox" name="teamleader"
    @isset($_GET['teamleader'])
    checked
    @endisset
    >
    <label>Only user with one task assigned</label><input type="checkbox" name="onetask"
    @isset($_GET['onetask'])
    checked
    @endisset
    >
    <label></label>
    <button type="submit">Submit</button>
</form>

<ul>
    @foreach ($users as $user)
        <li><label class="
            @if ($user->isAdmin())
                text-green
            @elseif($user->isTeamleader())
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