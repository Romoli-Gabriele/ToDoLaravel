@extends('layout')
@section('content')

<div>Informazioni dipendente</div>
<label>Nome: </label>{{auth()->user()->name}}<br>
<label>Cognome: </label>{{$profile->cognome}}<br>
<label>Indirizzo: </label>{{$profile->indirizzo}}<br>
<label>Codice Fiscale: </label>{{$profile->codice_fiscale}}<br>
<label>Cellulare </label>{{$profile->cellulare}}<br>
<label>Sede: </label>{{$profile->sede}}<br>
<label>Ruolo: </label>{{$profile->ruolo}}<br>
@endsection
