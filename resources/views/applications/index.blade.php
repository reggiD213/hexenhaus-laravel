@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Bewerbungsübersicht</h2>
    <hr>
    @include('includes.infobox')
    <ul class="applications layout">
        @foreach($applications as $application)
            <li class="box">
                <a class="left" href="{{ route('applications.show', $application) }}"><h3 class="glow">{{ $application->created_at->formatLocalized('%A, %d.%m.%Y') }}</h3></a>
                <span class="dull right">Genre: {{ $application->genre }}</span><br>
                <hr>
                <a href="{{ route('applications.show', $application) }}"><h3>{{ $application->name }}</h3></a>
                <hr>
                <p>{!! str_limit($application->text, 300) !!}</p>
                <hr>
                <a class="button left" href="{{ route('applications.show', $application) }}"><i class="fa fa-info-circle"></i> Details</a>
            </li>
        @endforeach
    </ul>

    <div>
        {{-- $applications->links('pagination.default') --}}
    </div>

@endsection