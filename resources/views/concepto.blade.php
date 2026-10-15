@extends('layouts.app')

@section('title', $page['titulo'])
@section('description', $page['intro'])

@section('content')
<div class="wrap doc">
    <aside class="toc" aria-label="En esta página">
        <p class="toc-title">En esta página</p>
        <ol>
            @foreach ($page['items'] as $item)
                <li><a href="#{{ $item['id'] }}"><b>{{ $item['sigla'] }}</b> {{ $item['titulo'] }}</a></li>
            @endforeach
        </ol>
    </aside>

    <div class="doc-body">
        <header class="doc-head">
            <h1>{{ $page['titulo'] }}</h1>
            <p class="lead">{{ $page['intro'] }}</p>
        </header>

        @foreach ($page['items'] as $item)
            <article class="concept" id="{{ $item['id'] }}">
                <header>
                    <span class="badge" aria-hidden="true">{{ $item['sigla'] }}</span>
                    <div>
                        <h2>{{ $item['titulo'] }}</h2>
                        @isset($item['ingles'])<p class="en">{{ $item['ingles'] }}</p>@endisset
                    </div>
                </header>

                <p class="summary">{{ $item['resumen'] }}</p>
                <p>{{ $item['descripcion'] }}</p>

                @isset($item['senal'])
                    <p class="callout"><strong>Señal de alerta:</strong> {!! preg_replace('/`([^`]+)`/', '<code>$1</code>', e($item['senal'])) !!}</p>
                @endisset

                @isset($item['tabla'])
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th scope="col">Nivel</th><th scope="col">Descripción</th></tr></thead>
                            <tbody>
                                @foreach ($item['tabla'] as $fila)
                                    <tr><th scope="row">{{ $fila['nivel'] }}</th><td>{{ $fila['detalle'] }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endisset

                @if (isset($item['malo']) || isset($item['bueno']))
                    <div class="compare {{ isset($item['malo'], $item['bueno']) ? 'two' : 'one' }}">
                        @isset($item['malo'])
                            <x-code-block label="Antes" tone="bad" :code="$item['malo']" />
                        @endisset
                        @isset($item['bueno'])
                            <x-code-block :label="isset($item['malo']) ? 'Después' : 'Ejemplo'" tone="good" :code="$item['bueno']" />
                        @endisset
                    </div>
                @endif
            </article>
        @endforeach

        <nav class="pager" aria-label="Navegación entre temas">
            @if ($anterior)
                <a class="prev" href="{{ route($anterior['ruta']) }}"><small>← Anterior</small>{{ $anterior['etiqueta'] }}</a>
            @else
                <a class="prev" href="{{ route('home') }}"><small>← Volver</small>Inicio</a>
            @endif
            @if ($siguiente)
                <a class="next" href="{{ route($siguiente['ruta']) }}"><small>Siguiente →</small>{{ $siguiente['etiqueta'] }}</a>
            @else
                <a class="next" href="{{ route('bibliografia') }}"><small>Siguiente →</small>Bibliografía</a>
            @endif
        </nav>
    </div>
</div>
@endsection
