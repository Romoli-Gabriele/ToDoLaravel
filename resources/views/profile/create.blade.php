@extends('layout')
@section('content')
<form method="POST" action="{{route('profile.store')}}">
    @csrf
    <label><b>Create Profile</b></label>
    <input type="text" name="cognome" placeholder="Cognome" required>
    @error('cognome')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="text" name="indirizzo" placeholder="Indirizzo" required>
    @error('indirizzo')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="text" name="codice_fiscale" placeholder="Codice Fiscale" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" required>
    @error('codice_fiscale')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="tel" name="cellulare" placeholder="Cellulare" required><br>
    @error('cellulare')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="text" name="sede" placeholder="Sede di riferimento" required>
    @error('sede')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <input type="text" name="ruolo" placeholder="Ruolo" required>
    @error('ruolo')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <button type="submit">Submit</button>
</form>
@endsection