@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>News editieren</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('newsfeeds.update', $newsfeed) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <div class="form-group{{ $errors->has('text') ? ' error' : ''}}">
            <label for="newsfeed_text">Text:</label>
            <input id="newsfeed_text" type="text" value="{{ old('text') ? old('text') : $newsfeed->text }}" name="text" autocomplete="off" placeholder="Newstext eingeben">
            @if ($errors->has('text'))
                <span>{{ $errors->first('text') }}</span>
            @endif
        </div>
        <hr>
        <div class="form-group">
            <button type="submit"><i class="fa fa-check-circle"></i> Ändern</button>
        </div>

    </form>
@endsection

@section('sidebar')
    <h2>Weitere Optionen</h2>
    <hr>
    <div class="box">
        <button class="big"><a href="{{ route('newsfeeds.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
        <hr>
        <form method="post" action="{{ route('newsfeeds.destroy', $newsfeed) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit" class="big"><i class="fa fa-minus-circle"></i> Löschen</button>
        </form>
    </div>
@endsection
