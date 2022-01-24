@extends('layout')
@section('content')
<form method="POST" action="{{route('tasks.store')}}">
    @csrf
    <label><b>Add Task</b></label>
    <input type="text" name="descrizione" placeholder="description"> 
    <button type="submit">Submit</button>
</form>
@endsection