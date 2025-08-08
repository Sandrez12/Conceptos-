<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaginaController extends Controller
{
    private $data;

    public function __construct()
    {
        $jsonPath = storage_path('app/pagina.json');
        $this->data = json_decode(File::get($jsonPath), true);
    }

    public function index()
    {
        return view('home');
    }

    public function solid()
    {
        return view('solid', ['solid' => $this->data['solid']]);
    }

    public function cohesionAcoplamiento()
    {
        return view('cohesion_acoplamiento', ['cohesion_acoplamiento' => $this->data['cohesion_acoplamiento']]);
    }

    public function inyeccionDependencias()
    {
        return view('inyeccion_dependencias', ['inyeccion_dependencias' => $this->data['inyeccion_dependencias']]);
    }

    public function bibliografia()
{
    return view('bibliografia', [
        'bibliografia' => $this->data['bibliografia'] ?? []
    ]);
}

}
