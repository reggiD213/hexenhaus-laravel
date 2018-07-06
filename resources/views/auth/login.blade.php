@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Bitte einloggen oder registrieren!</h2>
    <hr> 
@endsection

@section('sidebar')
    <h2>Einloggen</h2>
    <hr>
    <div class="box">
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <input class="effect" id="email" type="email" name="email" value="{{ old('email') }}" autofocus placeholder=" " required>
                <label for="email">E-Mail Adresse:</label>
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' error' : '' }}">
                <input class="effect" id="password" type="password" name="password" placeholder=" " required>
                <label for="password">Passwort:</label>
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="remember">Eingeloggt bleiben?</label><br>
                <input id="remember" type="checkbox" name="remember">
            </div>

            <div class="form-group">
                <button class="big" type="submit"><i class="fa fa-check-circle"></i> Einloggen</button>
            </div>

        </form>

        <a class="dull left" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        <a class="dull right" href="{{ route('register') }}">Registrieren?</a>

    </div>
@endsection