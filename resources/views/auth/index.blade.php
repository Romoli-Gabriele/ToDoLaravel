@extends('layout')
@section('content')
<form action="
@if(auth()->user()->isAdmin())
/admin
@else
/team/{{auth()->user()->team->id}}/users
@endif
" method="GET">
    <label>{{__('user.onlytm')}}</label><input type="checkbox" name="teamleader"
    @isset($_GET['teamleader'])
    checked
    @endisset
    >
    <label>{{__('user.assig')}}</label><input type="checkbox" name="onetask"
    @isset($_GET['onetask'])
    checked
    @endisset
    >
    <label>{{__('user.free')}}</label><input type="checkbox" name="zerotask"
    @isset($_GET['zerotask'])
    checked
    @endisset
    >
    <label>{{__('user.without')}}</label><input type="checkbox" name="noCF"
    @isset($_GET['noCF'])
    checked
    @endisset
    >
    <br>
    <input type="text" value="{{request('search')}}" name="search" placeholder="{{__('task.find')}}" class="text-sm">
    <button type="submit">{{__('task.submit')}}</button>
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
            >{{__('user.name')}}: </label>{{$user->name}}
            <label>Email: </label>{{$user->email}}
            @if(!$user->isAdmin())
            <label>Team: </label>{{$user->team->name}}
            @endif
            @role('admin')
            <a href="/admin/roles/{{$user->id}}">{{__('user.edit')}}</a>
            @endrole
        </li>
    @endforeach
</ul>
@endsection