@extends('layout')
@section('content')
<form action="/admin" method="GET">
    <label>Only team leaders</label><input type="checkbox" name="teamleader"
    @isset($_GET['teamleader'])
    checked
    @endisset
    >
    <label>Users already assigned</label><input type="checkbox" name="onetask"
    @isset($_GET['onetask'])
    checked
    @endisset
    >
    <label>Free users</label><input type="checkbox" name="zerotask"
    @isset($_GET['zerotask'])
    checked
    @endisset
    >
    <label>Users without CF</label><input type="checkbox" name="noCF"
    @isset($_GET['noCF'])
    checked
    @endisset
    >
    <br>
    <input type="text" value="{{request('search')}}" name="search" placeholder="Find something" class="text-sm">
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