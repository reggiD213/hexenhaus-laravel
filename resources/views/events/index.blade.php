@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    @if(Route::currentRouteName() != 'events.index.archive')
        <h2>Kommende Veranstaltungen</h2>
    @else
        <h2>Vergangene Veranstaltungen</h2>
    @endif
    <hr>
    @include('includes.infobox')
    <ul class="events layout">
        @if (Auth::check() && Auth::user()->booker())
            <li class="box">
                <a href="{{ route('events.create') }}">
                    <h3 class="glow"><i class="fa fa-plus-circle"></i> Neuen Event erstellen</h3>
                </a>
            </li>
        @endif
        @foreach($events as $event)
            <li class="box">
                <div class="row">
                    <div class="col-static-2">
                        <a class="left thumb" href="{{ route('events.show', $event) }}">
                            <img src="/images/uploads/events/{{ $event->date() }}/{{ $event->thumbnail() }}" alt="{{ $event->name }}">
                        </a>
                        <div class="vr"></div>
                    </div>

                    <div class="col-static-4">
                        <a href="{{ route('events.show', $event) }}">
                            <h3 class="glow">{{ $event->printDate() }}</h3>
                            <hr>
                            <h3>{{ $event->name }}</h3>
                        </a>
                        <hr>
                        <p>{!! clean(html_tidy_truncate($event->desc_long, 300)) !!}</p>
                        <span class="dull">Eintritt: {{ $event->printPrice() }} €, Einlass: {{ $event->printTime() }}</span>
                        <hr>
                        <a class="button left" href="{{ route('events.show', $event) }}"><i class="fa fa-info-circle"></i> Details</a>
                        @if ($event->tickets)
                            <a class="button left" target="_blank" href="https://www.ulmtickets.de/orte/hexenhaus"><i class="fa fa-ulm-tickets"></i> Tickets</a>
                        @endif
                        @if (Auth::check() && Auth::user()->booker())
                            <a class="button left" href="{{ route('events.edit', $event) }}"><i class="fa fa-cog"></i> Bearbeiten</a>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div>

        {{ $events->links('pagination.default') }}

        @if(Route::currentRouteName() != 'events.index.archive')
            <a class="right dull" href="{{ route('events.index.archive') }}">Zeige vergangene Veranstaltungen</a>
        @else
            <a class="right dull" href="{{ route('events.index') }}">Zeige kommendende Veranstaltungen</a>
        @endif
    </div>

@endsection

@section('sidebar')

    @include('includes.regular')

@endsection