@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Willkommen {{ Auth::user()->name }}!</h2>
    <hr>
    @include('includes.infobox')
    <ul class="members layout">
        @if (Auth::check())
            @if (Auth::user()->admin())
            <li class="box">
                <a href="{{ route('members.create') }}">
                    <h3 class="glow"><i class="fa fa-plus-circle"></i> Neues Mitglied hinzufügen</h3>
                </a>
            </li>
            @endif
            <li class="box">
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
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->phone }}</td>
                            @if (Auth::user()->admin()) <th><a class="admin" href="{{ route('members.edit', $member) }}"><i class="fa fa-cog"></i></a></th> @endif
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
