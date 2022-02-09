@extends('layout')
@section('content')

<h4>{{__('profile.info')}}</h4>
<label>{{__('user.name')}}Nome: </label>{{auth()->user()->name}}<br>
<label>{{__('profile.surname')}}: </label>{{$profile->cognome}}<br>
<label>{{__('profile.address')}}: </label>{{$profile->indirizzo}}<br>
<label>{{__('profile.bdate')}}: </label>{{$profile->ddn}}<br>
<label>{{__('profile.code')}}: </label>{{$profile->codice_fiscale}}<br>
<label>{{__('profile.phone')}}: </label>{{$profile->cellulare}}<br>
<label>{{__('profile.workplace')}}: </label>{{$profile->sede}}<br>
<label>{{__('user.roles')}}: </label>
@foreach(auth()->user()->roles as $role)
    <ul>
        <li>{{$role->name}}</li>
    </ul>
@endforeach
<br>
<a href="{{route('profile.edit', ['profile'=>$profile->id])}}">{{__('profile.edit')}}</a>
<form method="POST" action="{{ route('profile.destroy', ['profile' => $profile->id]) }}">
    @csrf
    @method('delete')
<button type="submit">{{__('profile.delete')}}</button>
</form>
@endsection
