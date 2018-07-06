@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    TODO: Profile Page
@endsection

@section('sidebar')
    <h2>Passwort zurücksetzen</h2>
    <hr>
    @if (session('status'))
        <div class="box">
            {{ session('status') }}
        </div>
    @endif
    <div class="box">
        <form role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <input class="effect" id="email" type="email" name="email" value="{{ $email or old('email') }}" autofocus placeholder=" " required>
                <label for="email">E-Mail-Adresse:</label>
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' error' : '' }}">
                <input class="effect" id="password" type="password" name="password" placeholder=" " required>
                <label for="password">Passwort: </label>
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                <input class="effect" id="password-confirm" type="password" name="password_confirmation" placeholder=" " required>
                <label for="password-confirm">Password bestätigen:</label>
                @if ($errors->has('password_confirmation'))
                    <span>{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button class="big" type="submit"><i class="fa fa-check-circle"></i> Passwort zurückseten</button>
            </div>
        </form>

        <a class="dull left" href="{{ route('register') }}">Registrieren?</a>
        <a class="dull right" href="{{ route('login') }}">Einloggen?</a>
    </div>

@endsection
