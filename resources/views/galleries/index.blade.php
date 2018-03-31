@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection
@section('content')
    <h2>Bildergalerie</h2>
    <hr>
    @include('includes.infobox')
    @if (Auth::check() && Auth::user()->admin())
        <div class="box">
            <a href="{{ route('galleries.create') }}">
                <h3 class="glow"><i class="fa fa-plus-circle"></i> Neue Gallerie hinzufügen</h3>
            </a>
        </div>
    @endif
    @foreach($events as $event)
        <div class="box gallery">
            <a class="left" href="{{ route('galleries.show', $event) }}">
                <h3 class="glow">{{ $event->printShortDate() . ' | ' . $event->name }}</h3>
            </a>
            @if (Auth::check() && Auth::user()->admin())
                <a class="button right" href="{{ route('galleries.show', $event) }}"><i class="fa fa-cog"></i> Bearbeiten</a>
            @endif
            <div class="clear"></div>
            <hr>
            @foreach($event->randomPics as $pic)
                <div class="col-1">
                    <div class="square-1">
                        <div class="content">
                            <div class="table">
                                <a class="table-cell swipe" href="/images/uploads/events/{{ $event->date() }}/gallery/{{ $pic->filename }}"
                                   title="{{ $pic->name }}" itemprop="contentUrl" data-size="{{ $pic->width }}x{{ $pic->height }}" data-index="{{ $loop->index }}"
                                   style="background-image: url('/images/uploads/events/{{ $event->date() }}/gallery/{{ $pic->thumbnail() }}')"></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-1">
                <div class="square-1">
                    <div class="content">
                        <div class="table">
                            <a class="table-cell dull" href="{{ route('galleries.show', $event) }}"
                               title="gesamte Gallerie für {{ $event->printShortDate() }} anzeigen">mehr anzeigen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{ $events->links('pagination.default') }}
    
@endsection

@section('sidebar')
    @include('includes.regular')
@endsection

@section('js')
    @include('includes.js.photoswipe')
@endsection

@section('css')
    <link rel="stylesheet" href="/libs/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="/libs/photoswipe/default-skin/default-skin.css">
@endsection
