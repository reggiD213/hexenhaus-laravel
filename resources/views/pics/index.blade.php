@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection
@section('content')
    <h2>Bildergalerie</h2>
    <hr>
    @include('includes.infobox')
    <div class="pics box">
        <div class="row">
            @if (Auth::check() && Auth::user()->admin())
                <div class="col-2">
                    <a href="{{ route('pics.create') }}" class="table">
                        <div class="cell">
                            <h3 class="glow"><i class="fa fa-plus-circle"></i> Neues Bild hinzufügen</h3>
                        </div>
                    </a>
                </div>
            @endif
            @foreach($pics as $pic)
                <div class="col-2 rel">
                    <a href="/images/uploads/gallery/{{ $pic->filename }}" class="table swipe" title="{{ $pic->name }}" itemprop="contentUrl" data-size="{{ $pic->width }}x{{ $pic->height }}" data-index="{{ $loop->index }}">
                        <div class="cell">
                            <img src="/images/uploads/gallery/{{ $pic->thumbnail() }}" alt="{{ $pic->name }}" itemprop="thumbnail">
                        </div>
                    </a>
                    @if (Auth::check() && Auth::user()->admin())
                        <a class="admin" href="{{ route('pics.edit', $pic) }}"><i class="fa fa-cog"></i></a>
                    @endif
                </div>

            @endforeach
        </div>
    </div>
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
