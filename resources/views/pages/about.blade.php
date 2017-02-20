@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>Über uns</h2>
    <hr>
    <div class="about box">
        <p>
            Wir, das Hexenhaus Ulm, sind ein gemeinnütziger Verein, mit dem Ziel jungen Bands eine Chance zu geben.
            Bei uns könnt ihr auf einer großen Bühne mit dem besten Equipment zusammen mit etablierten Bands spielen.
        </p>
        <p>
            Schaut euch doch einfach dieses kurze Video an, um einen Überblick über uns zu bekommen:
        </p>

        <div class="videoWrapper">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/WOxszjUpbTM" frameborder="0" allowfullscreen></iframe>
        </div>
        <span class="dull">Danke an Andreas Hessner für den Film!</span>
    </div>
@endsection

@section('sidebar')
    @include('includes.regular')
@endsection