@extends('layout')
@section('content')
<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="name" required>
    @error('name')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <input type="text" name="cognome" placeholder="surname" required>
    @error('cognome')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <input type="email" name="email" placeholder="email" required>
    @error('email')
        <p class="text-red text-xs ">{{ $message }}</p> 
    @enderror
    <input type="password" name="password" placeholder="password" required>
    @error('password')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <select name="team_id" required>
        @foreach ($teams as $team)
        <option value="{{$team->id}}">{{$team->name}}</option>
        @endforeach
    </select>
    <button type="submit">Submit</button>
</form>
<br>

@endsection