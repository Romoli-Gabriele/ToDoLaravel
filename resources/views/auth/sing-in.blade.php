@extends('layout')
@section('content')
<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="{{__('user.name')}}" required>
    @error('name')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <input type="text" name="cognome" placeholder="{{__('profile.surname')}}" required>
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
    <button type="submit">{{__('task.submit')}}</button>
</form>
<br>

@endsection