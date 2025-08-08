<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        // Leer el JSON desde storage/app/pageContent.json
        $json = Storage::get('pageContent.json');

        // Convertir el JSON a un array de PHP
        $pageContent = json_decode($json, true);

        // Pasar el contenido a la vista
        return view('page', ['content' => $pageContent]);
    }
}
