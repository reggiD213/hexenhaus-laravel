Bewerbung von: <br>
{{ $application->name }}
am {{ $application->created_at->formatLocalized('%A, %d.%m.%Y') }}

Genre: {{ $application->genre }}
<br>
<br>
E-Mail Adresse: <a href="mailto:{{ $application->mail }}">{{ $application->mail }}</a><br>

@if ($application->link1 || $application->link2 || $application->link1)Links: <br>@endif  
@if ($application->link1)<a target="_blank" href="{{ $application->link1 }}">{{ $application->link1 }}</a>@endif
@if ($application->link2)<a target="_blank" href="{{ $application->link2 }}">{{ $application->link2 }}</a>@endif
@if ($application->link3)<a target="_blank" href="{{ $application->link3 }}">{{ $application->link3 }}</a>@endif

Bewerbungstext:

{!! $application->text !!}