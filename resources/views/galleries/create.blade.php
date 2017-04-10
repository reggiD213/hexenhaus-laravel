@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neue Gallerie erstellen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form class="box" method="post" action="{{ route('galleries.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('event') ? ' error' : ''}}">
            <label for="gallery_event">Event:</label><br>
            <select name="event">
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->printShortDate() . " | " .  $event->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('event'))
                <span>{{ $errors->first('event') }}</span>
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
        <button class="big"><a href="{{ route('galleries.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')