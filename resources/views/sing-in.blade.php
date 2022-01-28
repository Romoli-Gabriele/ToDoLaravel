@extends('layout')
@section('content')
<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="name" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="email" name="email" placeholder="email" required>
    @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
    @enderror
    <input type="password" name="password" placeholder="password" required>
    @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <button type="submit">Submit</button>
</form>
<br>

@endsection