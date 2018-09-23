@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Band {{ $band->name }} editieren</h2>
    <hr>
    @include('includes.infobox')
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('bands.update', [$band]) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <input class="effect" id="band_name" type="text" value="{{ old('name') ? old('name') : $band->name }}" name="name" autocomplete="off" placeholder=" " required>
            <label for="band_name">Name:</label>
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('description') ? ' error' : ''}}">
            <textarea class="effect" id="band_desc" rows="5" name="description" placeholder=" " required>{{ old('description') ? old('description') : $band->description }}</textarea>
            <label for="band_desc">Beschreibung:</label>
            @if ($errors->has('description'))
                <span>{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('homepage') ? ' error' : ''}}">
            <input class="effect" id="band_link" type="text" value="{{ old('homepage') ? old('homepage') : $band->homepage }}" name="homepage" autocomplete="off" placeholder=" " required>
            <label for="band_link">Link:</label>
            @if ($errors->has('homepage'))
                <span>{{ $errors->first('homepage') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('soundcloud') ? ' error' : ''}}">
            <input class="effect" id="band_soundcloud" type="text" value="{{ old('soundcloud') ? old('soundcloud') : $band->soundcloud }}" name="soundcloud" autocomplete="off" placeholder=" ">
            <label for="band_soundcloud">Soundcloud-Embed-Link oder User ID (optional):</label>
            @if ($errors->has('soundcloud'))
                <span>{{ $errors->first('soundcloud') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('bandcamp') ? ' error' : ''}}">
            <input class="effect" id="band_bandcamp" type="text" value="{{ old('bandcamp') ? old('bandcamp') : $band->bandcamp }}" name="bandcamp" autocomplete="off" placeholder=" ">
            <label for="band_bandcamp">Bandcamp-Embed-Link oder Album ID (optional):</label>
            @if ($errors->has('bandcamp'))
                <span>{{ $errors->first('bandcamp') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('youtube') ? ' error' : ''}}">
            <input class="effect" id="band_youtube" type="text" value="{{ old('youtube') ? old('youtube') : $band->youtube }}" name="youtube" autocomplete="off" placeholder=" ">
            <label for="band_youtube">Youtube-Username (optional):</label>
            @if ($errors->has('youtube'))
                <span>{{ $errors->first('youtube') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' error' : ''}}">
            <label for="band_thumb">Bild:<br>
                <img id="image" src="/images/uploads/bands/{{ $band->id . '/' . $band->image }}">
            </label><br>
            <input id="band_thumb" type="file" name="image">
            @if ($errors->has('image'))
                <span>{{ $errors->first('image') }}</span>
            @endif
        </div>
        <br>
        <div class="form-group">
            <button type="submit"><i class="fa fa-check-circle"></i> Ändern</button>
        </div>
    </form>
@endsection

@section('sidebar')
    <h2>Weitere Optionen</h2>
    <hr>
    <div class="box">
        <button class="big"><a href="{{ route('bands.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
        <hr>
        <form method="post" action="{{ route('bands.destroy',[$band]) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit" class="big"><i class="fa fa-minus-circle"></i> Löschen</button>
        </form>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')