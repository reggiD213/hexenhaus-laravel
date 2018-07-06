@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $application->name }}</h2>
    <hr>
    <div class="box application">
        <a class="left button" href="{{ route('applications.index') }}"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
        <h3 class="glow left">{{ $application->created_at->formatLocalized('%A, %d.%m.%Y') }}</h3>
        <span class="dull right">Genre: {{ $application->genre }}</span>
        <div class="clear"></div>
        <hr>
        <span class="dull">E-Mail:</span>
        <a href="mailto:{{ $application->mail }}">{{ $application->mail }}</a>
        @if ($application->link1)<a target="_blank" href="{{ $application->link1 }}">{{ $application->link1 }}</a>@endif
        @if ($application->link2)<a target="_blank" href="{{ $application->link2 }}">{{ $application->link2 }}</a>@endif
        @if ($application->link3)<a target="_blank" href="{{ $application->link3 }}">{{ $application->link3 }}</a>@endif
        <hr>
        <span class="dull">Bewerbungstext:</span>
        <p>{!! $application->text !!}</p>
    </div>
    
@endsection