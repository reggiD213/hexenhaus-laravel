@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Neues Bild hochladen</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('pics.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <label for="pic_name">Name:</label>
            <input id="pic_name" type="text" value="{{ old('name') }}" name="name" autocomplete="off" placeholder="Bildname eingeben">
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' error' : ''}}">
            <label for="pic_thumb">Bild:<br>
                <img id="image" src="/images/uploads/bands/not-available.jpg">
            </label>
            <input id="pic_thumb" type="file" name="image">
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
        <button class="big"><a href="{{ route('pics.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')