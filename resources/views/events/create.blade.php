@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neuen Event erstellen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('events.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('date') ? ' error' : ''}}">
            <label for="event_date">Datum: </label>
            <input id="event_date" type="hidden" value="{{ old('date') }}" name="date">
            <div id="date_picker"></div>
            @if ($errors->has('date'))
                <span>{{ $errors->first('date') }}</span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('time') ? ' error' : ''}}">
            <label for="event_time">Beginn: </label>
            <input id="event_time" type="text" value="{{ old('time')}}" data-scroll-default="{{ old('time') }}" name="time">
            @if ($errors->has('time'))
                <span>{{ $errors->first('time') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <label for="event_name">Name: </label>
            <input id="event_name" type="text" value="{{ old('name') }}" name="name" autocomplete="off" placeholder="Eventname eingeben">
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('desc_short') ? ' error' : ''}}">
            <label for="event_desc_short">Kurzbeschreibung: </label>
            <textarea id="event_desc_short" rows="5" name="desc_short" placeholder="kurze Eventbeschreibung eintippen">{{ old('desc_short') }}</textarea>
            @if ($errors->has('desc_short'))
                <span>{{ $errors->first('desc_short') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('desc_long') ? ' error' : ''}}">
            <label for="event_desc_long">Beschreibung: </label>
            <textarea id="event_desc_long" rows="5" name="desc_long" placeholder="ausführliche Eventbeschreibung eintippen">{{ old('desc_long') }}</textarea>
            @if ($errors->has('desc_long'))
                <span>{{ $errors->first('desc_long') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('price') ? ' error' : ''}}">
            <label for="event_price">Preis [€]:</label>
            <input id="event_price" type="number" step="0.01" min="0.00" max="99" value="{{ old('price') }}" name="price" autocomplete="off" placeholder="Eintrittspreis eingeben">
            @if ($errors->has('price'))
                <span>{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('tickets') ? ' error' : ''}}">
            <label for="event_tickets">Ticketvorverkauf:</label>
            <input id="event_tickets" type="checkbox" value="1" name="tickets" autocomplete="off" {{ old('tickets') == 1 ? "checked" : "" }}>
            @if ($errors->has('tickets'))
                <span>{{ $errors->first('tickets') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' error' : ''}}">
            <label for="event_thumb">Bild:<br>
                <img id="image" src="/images/uploads/events/not-available.jpg">
            </label>
            <input id="event_thumb" type="file" name="image">
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
        <button class="big"><a href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')