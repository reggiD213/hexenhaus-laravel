@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Bewerbungsformular</h2>
    <hr>
    @if (count($errors))
        <div class="box">
            Bitte Formular korrekt ausfüllen!<br>
            Fehler:
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form enctype="multipart/form-data" class="box" method="post" action="{{ route('applications.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' error' : ''}}">
            <input class="effect" type="text" value="{{ old('name') }}" maxlength="128" name="name" autocomplete="off" required placeholder=" ">
            <label>Bandname:</label>
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('mail') ? ' error' : ''}}">
            <input class="effect" id="application_mail" type="email" value="{{ old('mail') }}" maxlength="50" name="mail" autocomplete="off" required placeholder=" ">
            <label>E-Mail Adresse:</label>
            @if ($errors->has('mail'))
                <span>{{ $errors->first('mail') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('genre') ? ' error' : ''}}">
            <label>Genre:</label>
            <div class="help-tip">
                <i class="fa fa-question-circle"></i>
                <p>Bitte wählt das Genre, das eurem am Nächsten kommt.</p>
            </div><br>
            
            <input id="metal" type="radio" name="genre" value="metal" @if(old('genre') == 'metal') checked @endif>
            <label for="metal">Metal</label><br>
            <input id="stoner" type="radio" name="genre" value="stoner" @if(old('genre') == 'stoner') checked @endif>
            <label for="stoner">Stoner</label><br>
            <input id="psy" type="radio" name="genre" value="psy" @if(old('genre') == 'psy') checked @endif>
            <label for="psy">Psy</label><br>

            
            @if ($errors->has('genre'))
                <span>{{ $errors->first('genre') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('text') ? ' error' : ''}}">
            <textarea class="effect" id="application_text" rows="10" maxlength="2500" name="text" placeholder=" ">{{ old('text') }}</textarea>
            <label>Bewerbungstext:</label>
            @if ($errors->has('text'))
                <span>{{ $errors->first('text') }}</span>
            @endif
        </div>
        <h4>Optional:</h4>
        <div class="form-group{{ $errors->has('homepage') ? ' error' : ''}}">
            <input class="effect" type="text" value="{{ old('link1') }}" name="link1" autocomplete="off" placeholder=" ">
            <label>Link 1:</label>
            @if ($errors->has('link1'))
                <span>{{ $errors->first('link1') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('homepage') ? ' error' : ''}}">
            <input class="effect" type="text" value="{{ old('link2') }}" name="link2" autocomplete="off" placeholder=" ">
            <label>Link 2:</label>
            @if ($errors->has('link2'))
                <span>{{ $errors->first('link2') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('homepage') ? ' error' : ''}}">
            <input class="effect" type="text" value="{{ old('link3') }}" name="link3" autocomplete="off" placeholder=" ">
            <label>Link 3:</label>
            @if ($errors->has('link3'))
                <span>{{ $errors->first('link3') }}</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit"><i class="fa fa-check-circle"></i> Absenden</button>
        </div>

    </form>
@endsection

@section('sidebar')
    <h2>Weitere Optionen</h2>
    <hr>
    <div class="box">
        <button class="big"><a href="{{ route('apply') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button>
    </div>
@endsection

@include('includes.js.edit_form')
@include('includes.css.edit_form')