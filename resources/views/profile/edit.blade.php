@extends('layout')
@section('content')
<form method="POST" action="{{route('profile.update', ['profile'=>$profile->id])}}">
    @method('PUT')
    @csrf
    <label><b>Edit Profile</b></label>
    <label>Cognome: </label><input type="text" name="cognome" value="{{$profile->cognome}}" required>
    @error('cognome')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <label>Indirizzo: </label><input type="text" name="indirizzo" value="{{$profile->indirizzo}}" required>
    @error('indirizzo')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <label>Codice fiscale: </label><input type="text" name="codice_fiscale" value="{{$profile->codice_fiscale}}" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" required>
    @error('codice_fiscale')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <label>Cellulare: </label><input type="tel" name="cellulare" value="{{$profile->cellulare}}" required><br>
    @error('cellulare')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <label>Sede di riferimento: </label><input type="text" name="sede" value="{{$profile->sede}}" required>
    @error('sede')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <label>Ruolo: </label><input type="text" name="ruolo" value="{{$profile->ruolo}}" required>
    @error('ruolo')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <button type="submit">Submit</button>
</form>
@endsection