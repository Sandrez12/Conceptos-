@extends('layouts.app')

@section('title', $page['titulo'])
@section('description', $page['intro'])

@section('content')
<div class="wrap biblio">
    <header class="doc-head">
        <h1>{{ $page['titulo'] }}</h1>
        <p class="lead">{{ $page['intro'] }}</p>
    </header>

    @foreach ($porTema as $tema => $items)
        <section aria-labelledby="tema-{{ $loop->index }}">
            <h2 id="tema-{{ $loop->index }}">{{ $tema }}</h2>
            <ul class="refs">
                @foreach ($items as $ref)
                    <li>
                        {{ $ref['autor'] }}@if (!empty($ref['anio'])) ({{ $ref['anio'] }})@endif.
                        <cite>{{ $ref['titulo'] }}</cite>.
                        {{ $ref['detalle'] }}
                        @if (!empty($ref['url']))
                            <a href="{{ $ref['url'] }}" target="_blank" rel="noopener noreferrer">{{ $ref['url'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </section>
    @endforeach
</div>
@endsection
