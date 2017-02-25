@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>{{ $gallery->event->printDate() }}</h2>
    <hr>
    <div class="box gallery">
        @foreach($gallery->pics as $pic)
            <div class="col-2">
                <a href="/images/uploads/gallery/{{ $pic->filename }}" class="table swipe" title="{{ $gallery->event->printDate() }}" itemprop="contentUrl" data-size="{{ $pic->width }}x{{ $pic->height }}" data-index="{{ $loop->index }}">
                    <div class="cell">
                        <img src="/images/uploads/gallery/{{ $pic->thumbnail() }}" alt="{{ $pic->name }}" itemprop="thumbnail">
                    </div>
                </a>
                @if (Auth::check() && Auth::user()->admin == 1)

                @endif
            </div>
        @endforeach
    </div>
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
