@extends('layout')
@section('content')
<form method="POST" action="{{route('profile.store')}}">
    @csrf
    <label><b>Create Profile</b></label>
    <input type="text" name="indirizzo" placeholder="Indirizzo" required>
    <input type="text" name="codice_fiscale" placeholder="Codice Fiscale" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" required>
    <input type="tel" name="cellulare" placeholder="Cellulare" required><br>
    <input type="text" name="sede" placeholder="Sede di riferimento" required>
    <input type="text" name="ruolo" placeholder="Ruolo" required>
    <button type="submit">Submit</button>
</form>
@endsection