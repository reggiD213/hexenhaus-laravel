@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neue Band erstellen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('bands.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <label for="band_name">Name:</label>
            <input id="band_name" type="text" value="{{ old('name') }}" name="name" autocomplete="off" placeholder="Bandname eingeben">
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('description') ? ' error' : ''}}">
            <label for="band_desc">Beschreibung:</label>
            <textarea id="band_desc" rows="5" name="description" placeholder="kurze Bandbeschreibung eintippen">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span>{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('homepage') ? ' error' : ''}}">
            <label for="band_link">Link:</label>
            <input id="band_link" type="text" value="{{ old('homepage') }}" name="homepage" autocomplete="off" placeholder="Homepage Adresse eingeben">
            @if ($errors->has('homepage'))
                <span>{{ $errors->first('homepage') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('soundcloud') ? ' error' : ''}}">
            <label for="band_soundcloud">Soundcloud:</label>
            <input id="band_soundcloud" type="text" value="{{ old('soundcloud') }}" name="soundcloud" autocomplete="off" placeholder="Soundcloud-Embed-Link oder User ID eingeben">
            @if ($errors->has('soundcloud'))
                <span>{{ $errors->first('soundcloud') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' error' : ''}}">
            <label for="band_thumb">Bild:<br>
                <img id="image" src="/images/uploads/bands/not-available.jpg">
            </label>
            <input id="band_thumb" type="file" name="image">
            @if ($errors->has('image'))
                <span>{{ $errors->first('image') }}</span>
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
        <button class="big"><a href="{{ route('bands.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')