@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Bild {{ $pic->name }} editieren</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            @foreach($errors->all() as $error)
                Bitte Formular korrekt ausfüllen!
            @endforeach
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('pics.update', $pic) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <label for="pic_name">Name:</label>
            <input id="pic_name" type="text" value="{{ old('name') ? old('name') : $pic->name }}" name="name" autocomplete="off" placeholder="Bildname eingeben">
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('image') ? ' error' : ''}}">
            <label for="pic_thumb">Bild:<br>
                <img id="image" src="/images/uploads/gallery/{{ $pic->thumbnail() }}">
            </label>
            <input id="pic_thumb" type="file" name="image">
            @if ($errors->has('image'))
                <span>{{ $errors->first('image') }}</span>
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
        <button class="big"><a href="{{ route('pics.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
        <hr>
        <form method="post" action="{{ route('pics.destroy',$pic) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit" class="big"><i class="fa fa-minus-circle"></i> Löschen</button>
        </form>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')
