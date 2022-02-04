@extends('layout')
@section('content')
<form method="POST" action="{{route('tasks.store')}}">
    @csrf
    <label><b>Add Task</b></label>
    <input type="text" name="descrizione" placeholder="description">
    <label>Assign to:</label>
    @isset($users)
    <select name="assigned">
        <option>Nobody</option selected>
        @foreach ($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    @else
    <label><b>Assign to youself: </b></label><input type="checkbox" name="assigned">
    @endisset
    <button type="submit">Submit</button>
</form>
@endsection