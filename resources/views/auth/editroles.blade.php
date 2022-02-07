@extends('layout')
@section('content')
<form method="POST">
@csrf
@method('PUT')
    <label>User {{$user->name}} Roles</label>
@foreach($roles as $role)
    <label>{{$role->name}}</label><input name="{{$role->slug}}" type="checkbox"
    @if($user->isRole($role->slug))
        checked
    @endif
    >
@endforeach
<button type="submit">Submit</button>
</form>
@endsection