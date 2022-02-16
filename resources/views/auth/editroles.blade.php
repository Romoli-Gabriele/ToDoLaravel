@extends('layout')
@section('content')
<form method="POST">
@csrf
@method('PUT')
    <label>{{__('user.user')}} {{$user->name}} {{__('user.roles')}}</label>
@foreach($roles as $role)
    <label>{{$role->name}}</label><input name="{{$role->slug}}" type="checkbox"
    @if($user->isRole($role->slug))
        checked
    @endif
    >
@endforeach
<button type="submit">{{__('task.submit')}}</button>
</form>
@endsection