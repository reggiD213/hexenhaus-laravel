@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    TODO: Profile Page
@endsection

@section('sidebar')
    <h2>Registrieren</h2>
    <hr>
    <div class="box">
        <form role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' error' : '' }}">
                <label for="name">Name:</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span>{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Adresse:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' error' : '' }}">
                <label for="password">Passwort:</label>
                <input id="password" type="password" name="password">
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm">Passwort bestätigen</label>
                <input id="password-confirm" type="password" name="password_confirmation">
            </div>

            <div class="form-group">
                <button type="submit"><i class="fa fa-check-circle"></i> Registrieren</button>
            </div>

        </form>

        <a class="dull left" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        <a class="dull right" href="{{ route('login') }}">Einloggen?</a>

    </div>
@endsection