@extends('layout')
@section('content')
<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="password" required>
    <button type="submit">{{__('task.submit')}}</button>
    <br>
    @error('email')
        <p class="text-red text-xs ">{{ $message }}</p> 
    @enderror
</form>
<br>
<a href="/register">{{__('user.not')}}</a>

@endsection