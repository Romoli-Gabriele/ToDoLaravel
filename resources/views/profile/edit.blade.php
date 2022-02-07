@extends('layout')
@section('content')
<form method="POST" action="{{route('profile.update', ['profile'=>$profile->id])}}">
    @method('PUT')
    @csrf
    <label>Edit Profile</label><br>
    <label>Cognome: </label><input type="text" name="cognome" value="{{$profile->cognome}}" required>
    @error('cognome')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <br>
    <label>Indirizzo: </label><input type="text" name="indirizzo" value="{{$profile->indirizzo}}" required>
    @error('indirizzo')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <br>
    <label>Data di nascita: </label><input type="date" name="ddn" value="{{$profile->ddn}}" required>
    @error('ddn')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <br>
    <label>Codice fiscale: </label><input type="text" name="codice_fiscale" value="{{$profile->codice_fiscale}}" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" required>
    @error('codice_fiscale')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <br>
    <label>Cellulare: </label><input type="tel" name="cellulare" value="{{$profile->cellulare}}" required><br>
    @error('cellulare')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <label>Sede di riferimento: </label><input type="text" name="sede" value="{{$profile->sede}}" required>
    @error('sede')
        <p class="text-red text-xs ">{{ $message }}</p>
    @enderror
    <br>
    <button type="submit">Submit</button>
</form>
@endsection