@extends('layouts.fullsize')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>Bildergalerie, {{ $gallery->event->printDate() }}</h2>
    <hr>
    @include('includes.infobox')
    <div class="box gallery">
        <a class="left button" href="{{ route('galleries.index') }}"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
        <a class="left button" href="{{ route('events.show', $gallery->event) }}">Zum Event</a>
        <h3 class=" left glow">{{ $gallery->event->printDate() }}</h3>

        @if (Auth::check() && Auth::user()->admin == 1)
            <form method="post" action="{{ route('galleries.destroy',$gallery) }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="right"><i class="fa fa-minus-circle"></i> Löschen</button>
            </form>
        @endif
        <div class="clear"></div>
        <hr>
        @if (Auth::check() && Auth::user()->admin == 1)
            <div class="col-2">
                <div class="square-1">
                    <div class="content">
                        <div class="table">
                            <div class="uploader" id="uploader"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach($gallery->pics as $pic)
            <div class="col-1">
                <div class="square-1">
                    <div class="content">
                        <div class="table">
                            <a class="table-cell swipe" href="/images/uploads/galleries/{{$gallery->id}}/{{ $pic->filename }}" title="{{ $pic->name }}" itemprop="contentUrl" data-size="{{ $pic->width }}x{{ $pic->height }}" data-index="{{ $loop->index }}"
                               style="background-image: url('/images/uploads/galleries/{{$gallery->id}}/{{ $pic->thumbnail() }}')"></a>
                        </div>
                    </div>
                    @if (Auth::check() && Auth::user()->admin == 1)
                        <form method="post" action="{{ route('pics.destroy', $pic) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="right"><i class="fa fa-minus-circle"></i></button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('sidebar')
    @include('includes.regular')
@endsection

@section('js')
    @include('includes.js.photoswipe')
    @include('includes.js.fineuploader')
@endsection

@section('css')
    <link rel="stylesheet" href="/libs/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="/libs/photoswipe/default-skin/default-skin.css">

    <link href="/libs/fine-uploader/fine-uploader-gallery.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
