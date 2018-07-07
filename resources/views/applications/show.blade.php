@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $application->name }}</h2>
    <hr>
    @include('includes.infobox')
    <div class="box application">
        <h3 class="glow left">{{ $application->created_at->formatLocalized('%A, %d.%m.%Y') }}</h3>
        <span class="dull right">Genre: {{ $application->genre }}</span>
        <div class="clear"></div>
        <hr>
        <span class="dull">E-Mail:</span>
        <a href="mailto:{{ $application->mail }}">{{ $application->mail }}</a>
        @if ($application->link1 || $application->link2 || $application->link1)<span class="dull">Links:</span>@endif  
        @if ($application->link1)<a target="_blank" href="{{ $application->link1 }}">{{ $application->link1 }}</a>@endif
        @if ($application->link2)<a target="_blank" href="{{ $application->link2 }}">{{ $application->link2 }}</a>@endif
        @if ($application->link3)<a target="_blank" href="{{ $application->link3 }}">{{ $application->link3 }}</a>@endif
        <hr>
        <span class="dull">Bewerbungstext:</span>
        <p>{!! nl2br(e($application->text)) !!}</p>
    </div>
@endsection

@section('sidebar')
    <h2>Weitere Optionen</h2>
    <hr>
    <div class="box">
        <button class="big"><a href="{{ route('applications.index') }}"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></button><br><br>
        <button class="big"><a href="{{ route('applications.send', $application) }}"><i class="fa fa-arrow-circle-o-left"></i> E-Mail erneut senden</a></button>
        <hr>
        <form method="post" action="{{ route('applications.destroy', $application) }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit" class="big"><i class="fa fa-minus-circle"></i> Löschen</button>
        </form>
    </div>
@endsection