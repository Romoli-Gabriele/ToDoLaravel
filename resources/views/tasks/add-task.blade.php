@extends('layout')
@section('content')
<form method="POST" action="{{route('tasks.store')}}">
    @csrf
    <label>Add Task</label>
    <input type="text" name="descrizione" placeholder="description">
    @isset($users)
    <label>Assign to:</label>
    <select name="assigned">
        @role('admin')
        @else
        <option>Nobody</option selected>
        @endrole
        @foreach ($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    @else
    <label>Assign to youself: </label><input type="checkbox" name="assigned">
    @endisset
    <button type="submit">Submit</button>
</form>
@endsection