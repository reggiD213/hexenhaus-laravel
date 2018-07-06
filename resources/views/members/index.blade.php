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
            <li class="box">
                    <h3>Userliste</h3>
                    <hr>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Privileges</th>
                            <th>Ändern</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>    
                                <form method="post" action="{{ route('users.update', $user) }}">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}
                                    <td><input type="text" value="{{ old('name') ? old('name') : $user->name }}" name="name" autocomplete="off" placeholder=" "></td>
                                    <td><input type="email" value="{{ old('email') ? old('email') : $user->email }}" name="email" autocomplete="off" placeholder=" "></td>
                                    <td><input type="number" min="0" max="127" step="1" value="{{ old('privileges') ? old('privileges') : $user->privileges }}" name="privileges" autocomplete="off" placeholder=" "></td>
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
        <form method="post" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <button type="submit" class="big">Logout</button>
        </form>
    </div>
@endsection
