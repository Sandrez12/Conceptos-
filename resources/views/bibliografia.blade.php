@extends('layouts.app')

@section('title', 'Bibliografía')

@section('content')
<h1 class="mb-4">Bibliografía</h1>
<div class="glass-card">
    <ul class="list-group list-group-flush">
        @foreach($bibliografia as $item)
            <li class="list-group-item bg-transparent text-white">
                @php
                    // Detectar enlaces y convertirlos en clicables
                    $texto = preg_replace(
                        '/(https?:\/\/[^\s]+)/',
                        '<a href="$1" target="_blank" class="text-warning">$1</a>',
                        e($item)
                    );
                @endphp
                {!! nl2br($texto) !!}
            </li>
        @endforeach
    </ul>
</div>
@endsection
