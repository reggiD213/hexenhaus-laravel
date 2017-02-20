@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection

@section('content')
    <h2>Bands bei uns im Hexenhaus</h2>
    <hr>
    @include('includes.infobox')
    <ul class="bands layout">
        @if (Auth::check() && Auth::user()->admin == 1)
            <li class="box">
                <a href="{{ route('bands.create') }}">
                    <h3 class="glow"><i class="fa fa-plus-circle"></i> Neue Band erstellen</h3>
                </a>
            </li>
        @endif
        @foreach($bands as $band)
            <li class="box">
                <div class="row">
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
                            <a class="button left" href="#"><i class="fa fa-calendar"></i> Events</a>
                        @endif
                        @if (Auth::check() && Auth::user()->admin == 1)
                            <a class="button left" href="{{ route('bands.edit', $band) }}"><i class="fa fa-cog"></i> Bearbeiten</a>
                            <form method="post" action="{{ route('bands.destroy',[$band]) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit"><i class="fa fa-minus-circle"></i> Löschen</button>
                            </form>
                        @endif
                        @if ($band->soundcloud)
                            <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/{{ $band->soundcloud }}"></iframe>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {{ $bands->links('pagination.default') }}

@endsection

@section('sidebar')

    @include('includes.regular')

@endsection


