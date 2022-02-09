@extends('layout')
@section('content')
<form method="POST" action="{{route('tasks.store')}}">
    @csrf
    <label>{{__('task.add')}}</label>
    <input type="text" name="descrizione" placeholder="description">
    @isset($users)
    <label>{{__('task.assign')}}:</label>
    <select name="assigned">
        @role('admin')
        @else
        <option>{{__('task.nobody')}}</option selected>
        @endrole
        @foreach ($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    @else
    <label>{{__('task.assigny')}}: </label><input type="checkbox" name="assigned">
    @endisset
    <button type="submit">{{__('task.submit')}}</button>
</form>
@endsection