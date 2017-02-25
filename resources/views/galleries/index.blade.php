@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection
@section('content')
    <h2>Bildergalerie</h2>
    <hr>
    @include('includes.infobox')
    @if (Auth::check() && Auth::user()->admin == 1)
        <div class="box">
            <a href="{{ route('galleries.create') }}" class="table">
                <div class="cell">
                    <h3 class="glow"><i class="fa fa-plus-circle"></i> Neue Gallerie hinzufügen</h3>
                </div>
            </a>
        </div>
    @endif
    @foreach($galleries as $gallery)
        <div class="box gallery">
            @if (Auth::check() && Auth::user()->admin == 1)
                <a class="button left" href="{{ route('galleries.edit', $gallery) }}"><i class="fa fa-cog"></i> Bearbeiten</a>
                <form method="post" action="{{ route('galleries.destroy',$gallery) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="left"><i class="fa fa-minus-circle"></i> Löschen</button>
                </form>
            @endif
            <a class="left" href="{{ route('galleries.show', $gallery) }}">
                <h3 class="glow">{{ $gallery->event->printDate() }}</h3>
            </a>
            <div class="clear"></div>
            <hr>
            @foreach($gallery->pics as $pic)
                <div class="col-2">
                    <a href="/images/uploads/gallery/{{ $pic->filename }}" class="table swipe" title="{{ $pic->name }}" itemprop="contentUrl" data-size="{{ $pic->width }}x{{ $pic->height }}" data-index="{{ $loop->index }}">
                        <div class="cell">
                            <img src="/images/uploads/gallery/{{ $pic->thumbnail() }}" alt="{{ $pic->name }}" itemprop="thumbnail">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection

@section('sidebar')
    @include('includes.regular')
@endsection

@section('js')
    @include('includes.photoswipe')
@endsection

@section('css')
    <link rel="stylesheet" href="/libs/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="/libs/photoswipe/default-skin/default-skin.css">
@endsection
