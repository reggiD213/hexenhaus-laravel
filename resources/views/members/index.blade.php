@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Willkommen {{ Auth::user()->name }}!</h2>
    <hr>
    @include('includes.infobox')
    <ul class="members layout">
        @if (Auth::user()->admin())
            <li class="box">
                <a href="{{ route('members.create') }}">
                    <h3 class="glow"><i class="fa fa-plus-circle"></i> Neues Mitglied hinzufügen</h3>
                </a>
            </li>
        @endif
        @if (Auth::user()->member())
            <li class="box">
                <h3>Mitgliederliste</h3>
                <hr>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email-Adresse</th>
                        <th>Telefonnummer</th>
                        @if (Auth::user()->admin()) <th>Bearbeiten</th> @endif
                    </tr>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->name ? $member->name : $member->firstname + " " + $member->lastname }}</td>
                            <td> <a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                            <td>{{ $member->phone }}</td>
                            @if (Auth::user()->admin()) <th><a class="admin" href="{{ route('members.edit', $member) }}"><i class="fa fa-cog"></i></a></th> @endif
                        </tr>
                    @endforeach
                </table>
            </li>
        @endif
        @if (Auth::user()->admin())
            <li class="box">
                <h3>Seiteneinstellungen</h3>
                <hr>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Wert</th>
                        <th>Ändern</th>
                    </tr>
                    @foreach ($settings as $setting)
                        <tr>    
                            <form method="post" action="{{ route('settings.update', $setting) }}">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                                <td>{{ $setting->name }}</td>
                                <td><input type="text" value="{{ old('value') ? old('value') : $setting->value }}" name="value" autocomplete="off" placeholder=" "></td>
                                <td><button type="submit"><i class="fa fa-check-circle"></i> Ändern</button></td>
                            </form>
                        </tr>
                    @endforeach
                </table>
            </li>
        @endif
    </ul>
@endsection

@section('sidebar')
    <h2>Member Area</h2>
    <hr>
    @if (session('status'))
        <div class="box">
            {{ session('status') }}
        </div>
    @endif
    <div class="box">
        <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
        </form>
    </div>
@endsection
