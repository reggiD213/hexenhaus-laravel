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
                <input class="effect" id="name" type="text" name="name" value="{{ old('name') }}" autofocus placeholder=" " required>
                <label for="name">Name:</label>
                @if ($errors->has('name'))
                    <span>{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <input class="effect" id="email" type="email" name="email" value="{{ old('email') }}" placeholder=" " required>
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
                <input class="effect" id="password-confirm" type="password" name="password_confirmation" placeholder=" " required>
                <label for="password-confirm">Passwort bestätigen</label>
            </div>

            <div class="form-group">
                <button class="big" type="submit"><i class="fa fa-check-circle"></i> Registrieren</button>
            </div>

        </form>

        <a class="dull left" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        <a class="dull right" href="{{ route('login') }}">Einloggen?</a>

    </div>
@endsection