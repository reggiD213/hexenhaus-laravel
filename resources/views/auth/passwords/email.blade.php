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
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
                <input class="effect" id="email" type="email" name="email" value="{{ old('email') }}" autofocus placeholder=" " required>
                <label for="email">E-Mail-Adresse:</label>
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button class="big" type="submit"><i class="fa fa-envelope"></i> Passwort Reset Link schicken</button>
            </div>
        </form>

        <a class="dull left" href="{{ route('register') }}">Registrieren?</a>
        <a class="dull right" href="{{ route('login') }}">Einloggen?</a>
    </div>


@endsection
