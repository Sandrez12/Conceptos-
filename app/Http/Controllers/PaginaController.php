<?php

namespace App\Http\Controllers;

use App\Contracts\ContentSource;
use Illuminate\Contracts\View\View;

class PaginaController extends Controller
{
    /** Páginas de contenido, en el orden en que se recorren. */
    private const TEMAS = [
        'solid' => ['ruta' => 'solid', 'etiqueta' => 'SOLID'],
        'cohesion' => ['ruta' => 'cohesion', 'etiqueta' => 'Cohesión y acoplamiento'],
        'inyeccion' => ['ruta' => 'inyeccion', 'etiqueta' => 'Inyección de dependencias'],
    ];

    public function __construct(private readonly ContentSource $content) {}

    public function index(): View
    {
        $temas = collect(self::TEMAS)->map(function (array $tema, string $clave) {
            $page = $this->content->page($clave);

            return $tema + ['titulo' => $page['titulo'], 'intro' => $page['intro'], 'total' => count($page['items'])];
        });

        return view('home', ['temas' => $temas]);
    }

    public function solid(): View
    {
        return $this->tema('solid');
    }

    public function cohesionAcoplamiento(): View
    {
        return $this->tema('cohesion');
    }

    public function inyeccionDependencias(): View
    {
        return $this->tema('inyeccion');
    }

    public function bibliografia(): View
    {
        $page = $this->content->page('bibliografia');
        $porTema = collect($page['items'])->groupBy('tema');

        return view('bibliografia', ['page' => $page, 'porTema' => $porTema]);
    }

    private function tema(string $clave): View
    {
        $claves = array_keys(self::TEMAS);
        $i = array_search($clave, $claves, true);

        return view('concepto', [
            'page' => $this->content->page($clave),
            'anterior' => $i > 0 ? self::TEMAS[$claves[$i - 1]] : null,
            'siguiente' => $i < count($claves) - 1 ? self::TEMAS[$claves[$i + 1]] : null,
        ]);
    }
}
