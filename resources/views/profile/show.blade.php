@extends('layout')
@section('content')

<div>Informazioni dipendente</div>
<label>Nome: </label>{{auth()->user()->name}}<br>
<label>Cognome: </label>{{$profile->cognome}}<br>
<label>Indirizzo: </label>{{$profile->indirizzo}}<br>
<label>Data di nascita: </label>{{$profile->ddn}}<br>
<label>Codice Fiscale: </label>{{$profile->codice_fiscale}}<br>
<label>Cellulare </label>{{$profile->cellulare}}<br>
<label>Sede: </label>{{$profile->sede}}<br>
<label>Ruoli: </label>
@foreach(auth()->user()->roles as $role)
    <ul>
        <li>{{$role->name}}</li>
    </ul>
@endforeach
<br>
<a href="{{route('profile.edit', ['profile'=>$profile->id])}}">Edit Profile</a>
<form method="POST" action="{{ route('profile.destroy', ['profile' => $profile->id]) }}">
    @csrf
    @method('delete')
<button type="submit">Delete Profile</button>
</form>
@endsection
