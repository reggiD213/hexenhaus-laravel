<header>
    <div class="row">
        <div class="col-2">
            <div class="box logo">
                <a><img src="/images/logo.png"></a>
            </div>
        </div>
        <div class="col-4">
            <div class="box news">
                <div id="newsticker" class="newswrapper">
                    <ul class="layout">
                        @foreach($newsfeeds as $newsfeed)
                            <li>
                                <div>
                                    {!! $newsfeed->text !!}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if (Auth::check() && Auth::user()->privileges >= 3)
                    <a class="admin" href="{{ route('newsfeeds.index') }}"><i class="fa fa-cog"></i></a>
                @endif
            </div>
            <nav>
                <ul class="box main_nav layout">
                    <li><a class="{{ set_active(['events','/','events_archive']) }}" href="{{ route('events.index') }}">EVENTS</a></li>
                    <li><a class="{{ set_active('apply') }}" href="{{ route('apply') }}">BEWERBEN</a></li>
                    <li><a class="{{ set_active('bands') }}" href="{{ route('bands.index') }}">BANDS</a></li>
                    <li><a class="{{ set_active('pics') }}" href="{{ route('galleries.index') }}">PICS</a></li>
                    <li><a class="{{ set_active('contact') }}" href="{{ route('contact') }}">KONTAKT</a></li>
                    <li><a class="{{ set_active('about') }}" href="{{ route('about') }}">ÜBER UNS</a></li>
                </ul>
            </nav>


        </div>
    </div>
</header>