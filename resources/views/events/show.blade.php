@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $event->name }}</h2>
    <hr>
    <div class="box event">
            <a class="left button" href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
        @if($event->hasPics)
            <a class="left button" href="{{ route('galleries.show', $event->gallery) }}">Zur Galerie</a>
        @endif
        @if (Auth::check() && Auth::user()->promoter() && $event->facebook_image != '../not-available.jpg')
    <a class="left button" href="/images/uploads/events/{{ $event->date() }}/{{ $event->facebook_image }}">Facebook Bild</a>
        @endif
        <h3 class="glow left">{{ $event->printDate() }}</h3>
        @if ($event->tickets)
            {{--<a class="button right" target="_blank" href="https://www.ulmtickets.de/orte/hexenhaus"><i class="fa fa-shopping-cart"></i> Tickets</a>--}}
            <a class="button right" target="_blank" href="https://www.ulmtickets.de/orte/hexenhaus"><i class="fa fa-ulm-tickets"></i> Tickets</a>
        @endif
        <span class="dull right">Eintritt: {{ $event->printPrice() }}€ , Einlass: {{ $event->printTime() }}</span>
        <div class="clear"></div>
        <hr>
        <a href="/images/uploads/events/{{ $event->date() }}/{{ $event->image }}" class="swipe" title="{{ $event->title }}" itemprop="contentUrl" data-size="{{ $event->image_width }}x{{ $event->image_height }}" data-index="1">
            <img class="right" src="/images/uploads/events/{{ $event->date() }}/{{ $event->image }}" alt="{{ $event->title }}" itemprop="thumbnail">
        </a>
        <p>{!! $event->desc_long !!}</p>
    </div>
    @if (count($event->bands))
        <h2>Bands an diesem Event</h2>
        <hr>
        <div class="flexbox">
            @foreach ($event->bands as $i => $band)
                <div class="box event_band">
                    <div class="col-static-2">
                        <a class="left thumb" target="_blank" href="{{ $band->homepage }}">
                            <img src="/images/uploads/bands/{{ $band->id . '/' . $band->image }}" alt="{{ $band->name }}">
                        </a>
                        <div class="vr"></div>
                    </div>
                    <div class="col-static-4">
                        <a target="_blank" href="{{ $band->homepage }}">
                            <h3 class="glow">{{ $band->name }}</h3>
                        </a>
                        <hr>
                        <p>{{ $band->description }}</p>
                        <a class="button left" target="_blank" href="{{ $band->homepage }}"><i class="fa fa-info-circle"></i> Website</a>
                        @if ($band->events->count())
                            {{-- <a class="button left" href="#"><i class="fa fa-calendar"></i> Events</a> --}}
                        @endif
                        @if ($band->soundcloud)
                            <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/{{ $band->soundcloud }}"></iframe>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
@endsection

@section('js')
    @include('includes.js.photoswipe')
@endsection

@section('css')
    <link rel="stylesheet" href="/libs/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="/libs/photoswipe/default-skin/default-skin.css">
@endsection
