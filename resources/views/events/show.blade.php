@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $event->name }}</h2>
    <hr>
    <div class="box event">
        <a class="left button" href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
        <h3 class="glow left">{{ $event->printDate() }}</h3>
        <span class="dull right">Eintritt: {{ $event->printPrice() }}€ , Beginn: {{ $event->printTime() }}</span>
        <div class="clear"></div>
        <hr>
        <img class="right" src="/images/uploads/events/{{ $event->id }}/{{ $event->image }}" alt="{{ $event->title }}">
        <p>{{ $event->desc_long }}</p>
    </div>
@endsection