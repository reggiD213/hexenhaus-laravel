@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    TODO: Profile Page
@endsection

@section('sidebar')
    <h2>Einloggen</h2>
    <hr>
    <div class="box">
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Adresse:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus>
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
                <input id="remember" type="checkbox" name="remember">
                <label for="remember">Eingeloggt bleiben?</label>
            </div>

            <div class="form-group">
                <button type="submit"><i class="fa fa-check-circle"></i> Einloggen</button>
            </div>

        </form>

        <a class="dull left" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        <a class="dull right" href="{{ route('register') }}">Registrieren?</a>

    </div>
@endsection