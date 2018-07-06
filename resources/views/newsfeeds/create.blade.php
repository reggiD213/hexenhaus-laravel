@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neue News erstellen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('newsfeeds.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('text') ? ' error' : ''}}">
            <input class="effect" id="newsfeed_text" type="text" value="{{ old('text') }}" name="text" autocomplete="off" placeholder=" " required>
            <label for="newsfeed_text">Text:</label>
            @if ($errors->has('text'))
                <span>{{ $errors->first('text') }}</span>
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
        <button class="big"><a href="{{ route('newsfeeds.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection
