@extends('layout')
@section('content')
<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="password" required>
    <button type="submit">Submit</button>
    <br>
    @error('email')
        <p class="text-red text-xs ">{{ $message }}</p> 
    @enderror
</form>
<br>
<a href="/register">Not registered?</a>

@endsection