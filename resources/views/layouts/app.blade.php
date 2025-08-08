<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Conceptos de Programación')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/github-dark.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #4b6cb7, #182848);
            min-height: 100vh;
            padding-top: 70px;
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            color: white;
        }
        nav.navbar {
            background: rgba(255, 255, 255, 0.15) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        nav .nav-link {
            color: white !important;
            font-weight: 500;
        }
        nav .nav-link:hover {
            color: #ffd700 !important;
        }
        pre {
            background: rgba(0, 0, 0, 0.4) !important;
            border-radius: 10px;
            padding: 1em;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">Conceptos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('solid') }}">SOLID</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cohesion') }}">Cohesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('inyeccion') }}">Inyección</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('bibliografia') }}">Bibliografía</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
</body>
</html>
