<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConceptosController extends Controller
{
    public function index()
    {
        // Ruta del archivo JSON
        $jsonPath = storage_path('app/public/conceptos.json');

        // Leer el archivo
        $data = json_decode(file_get_contents($jsonPath), true);

        // Pasar la información a la vista
        return view('conceptos.index', ['contenido' => $data]);
    }
}
