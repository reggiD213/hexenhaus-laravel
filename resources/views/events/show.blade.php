@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $event->name }}</h2>
    <hr>
    <div class="box event">
            <a class="left button" href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
        @if($event->gallery)
            <a class="left button" href="{{ route('galleries.show', $event->gallery) }}">Zur Gallerie</a>
        @endif
        <h3 class="glow left">{{ $event->printDate() }}</h3>
        <span class="dull right">Eintritt: {{ $event->printPrice() }}€ , Beginn: {{ $event->printTime() }}</span>
        <div class="clear"></div>
        <hr>
        <a href="/images/uploads/events/{{ $event->id }}/{{ $event->image }}" class="swipe" title="{{ $event->title }}" itemprop="contentUrl" data-size="{{ $event->image_width }}x{{ $event->image_height }}" data-index="1">
            <img class="right" src="/images/uploads/events/{{ $event->id }}/{{ $event->image }}" alt="{{ $event->title }}" itemprop="thumbnail">
        </a>
        <p>{!! $event->desc_long !!}</p>
    </div>
@endsection

@section('js')
    @include('includes.photoswipe')
@endsection

@section('css')
    <link rel="stylesheet" href="/libs/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="/libs/photoswipe/default-skin/default-skin.css">
@endsection
