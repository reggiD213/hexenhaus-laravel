@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neues Member erstellen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            Bitte Formular korrekt ausfüllen!
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('members.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('firstname') ? ' error' : ''}}">
            <label for="members_firstname">Vorname:</label>
            <input id="members_firstname" type="text" value="{{ old('firstname') }}" name="firstname" autocomplete="off" placeholder="Vorname eingeben">
            @if ($errors->has('firstname'))
                <span>{{ $errors->first('firstname') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('lastname') ? ' error' : ''}}">
            <label for="members_lastname">Nachname:</label>
            <input id="members_lastname" type="text" value="{{ old('lastname') }}" name="lastname" autocomplete="off" placeholder="Nachname eingeben">
            @if ($errors->has('lastname'))
                <span>{{ $errors->first('lastname') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <label for="members_name">Anzeigename:</label>
            <input id="members_name" type="text" value="{{ old('name') }}" name="name" autocomplete="off" placeholder="Anzeigename eingeben">
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' error' : ''}}">
            <label for="members_email">E-Mail Adresse:</label>
            <input id="members_email" type="email" value="{{ old('email') }}" name="email" autocomplete="off" placeholder="E-Mail Adresse eingeben">
            @if ($errors->has('email'))
                <span>{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' error' : ''}}">
            <label for="members_phone">Telefonnummer:</label>
            <input id="members_phone" type="text" value="{{ old('phone') }}" name="phone" autocomplete="off" placeholder="Telefonnummer eingeben">
            @if ($errors->has('phone'))
                <span>{{ $errors->first('phone') }}</span>
            @endif
        </div>
    
        <div class="form-group{{ $errors->has('street') ? ' error' : ''}}">
            <label for="members_street">Straße:</label>
            <input id="members_street" type="text" value="{{ old('street') }}" name="street" autocomplete="off" placeholder="Straße eingeben">
            @if ($errors->has('street'))
                <span>{{ $errors->first('street') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('housenumber') ? ' error' : ''}}">
            <label for="members_housenumber">Hausnummer:</label>
            <input id="members_housenumber" type="text" value="{{ old('housenumber') }}" name="housenumber" autocomplete="off" placeholder="Hausnummer eingeben">
            @if ($errors->has('housenumber'))
                <span>{{ $errors->first('housenumber') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('zip') ? ' error' : ''}}">
            <label for="members_zip">Postleitzahl:</label>
            <input id="members_zip" type="number" step="1" min="10000" max="99999" value="{{ old('zip') }}" name="zip" autocomplete="off" placeholder="Postleitzahl eingeben">
            @if ($errors->has('zip'))
                <span>{{ $errors->first('zip') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('city') ? ' error' : ''}}">
            <label for="members_city">Wohnort:</label>
            <input id="members_city" type="text" value="{{ old('city') }}" name="city" autocomplete="off" placeholder="Wohnort eingeben">
            @if ($errors->has('city'))
                <span>{{ $errors->first('city') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('birthday') ? ' error' : ''}}">
            <label for="members_birthday">Geburtsdatum:</label>
            <input id="members_birthday" type="date" value="{{ old('birthday') }}" name="birthday" autocomplete="off" placeholder="Geburtsdatum eingeben">
            @if ($errors->has('birthday'))
                <span>{{ $errors->first('birthday') }}</span>
            @endif
        </div>

        <hr>
        <div class="form-group">
            <button type="submit"><i class="fa fa-check-circle"></i> Einfügen</button>
        </div>

    </form>
@endsection

@section('sidebar')
    <h2>Weitere Optionen</h2>
    <hr>
    <div class="box">
        <button class="big"><a href="{{ route('members.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection
