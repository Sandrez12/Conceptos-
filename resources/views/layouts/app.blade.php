<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Conceptos de buenas prácticas') · Conceptos</title>
    <meta name="description" content="@yield('description', 'SOLID, cohesión, acoplamiento e inyección de dependencias explicados con ejemplos en PHP y Laravel.')">
    <meta name="theme-color" content="#0d1f20">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a class="skip" href="#contenido">Saltar al contenido</a>

    <header class="site-header">
        <div class="wrap bar">
            <a class="brand" href="{{ route('home') }}" aria-label="Conceptos, inicio">
                <span class="brand-mark" aria-hidden="true">{ }</span> Conceptos
            </a>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="nav" aria-label="Abrir menú">☰</button>
            <nav id="nav" class="nav" aria-label="Principal">
                <a href="{{ route('solid') }}" @class(['active' => request()->routeIs('solid')])>SOLID</a>
                <a href="{{ route('cohesion') }}" @class(['active' => request()->routeIs('cohesion')])>Cohesión</a>
                <a href="{{ route('inyeccion') }}" @class(['active' => request()->routeIs('inyeccion')])>Inyección</a>
                <a href="{{ route('bibliografia') }}" @class(['active' => request()->routeIs('bibliografia')])>Bibliografía</a>
            </nav>
        </div>
    </header>

    <main id="contenido">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap">
            <p>Material educativo sobre diseño de software con ejemplos en PHP y Laravel.</p>
            <p>Por <a href="https://github.com/Sandrez12">Andrés Felipe Joya Buitrago</a> ·
               <a href="https://github.com/Sandrez12/Conceptos-">Código en GitHub</a></p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
