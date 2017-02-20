@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Newsfeeds editieren</h2>
    <hr>
    @include('includes.infobox')
    <ul class="newsfeeds layout">
        <li class="box">
            <a href="{{ route('newsfeeds.create') }}">
                <h3 class="glow"><i class="fa fa-plus-circle"></i> Neue News erstellen</h3>
            </a>
        </li>

        @foreach($newsfeeds as $newsfeed)
            <li class="box">
                <div class="row">
                    <div class="col-static-4">
                        {{ $newsfeed->text }}
                        <div class="vr right"></div>
                    </div>
                    <div class="col-static-2">
                        <a class="button" href="{{ route('newsfeeds.edit', $newsfeed) }}"><i class="fa fa-cog"></i> Bearbeiten</a>
                        <form method="post" action="{{ route('newsfeeds.destroy', $newsfeed) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <div class="form-group">
                                <button type="submit"><i class="fa fa-minus-circle"></i> Löschen</button>
                            </div>
                        </form>

                    </div>
                </div>
            </li>
        @endforeach
    </ul>

@endsection

@section('sidebar')

    @include('includes.regular')

@endsection

