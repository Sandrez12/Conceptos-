<?php

namespace App\Services;

use App\Contracts\ContentSource;
use App\Exceptions\ContentNotFoundException;

/**
 * Lee el contenido de las páginas desde resources/content/{nombre}.php.
 * Cada archivo devuelve un arreglo; se carga una sola vez por petición.
 */
class FileContentSource implements ContentSource
{
    /** @var array<string, array<string, mixed>> */
    private array $loaded = [];

    public function __construct(private readonly string $directory) {}

    public function page(string $name): array
    {
        // Solo nombres simples: evita recorrer directorios con valores inesperados.
        if (! preg_match('/^[a-z0-9_-]+$/', $name)) {
            throw ContentNotFoundException::for($name);
        }

        return $this->loaded[$name] ??= $this->load($name);
    }

    /** @return array<string, mixed> */
    private function load(string $name): array
    {
        $path = "{$this->directory}/{$name}.php";

        if (! is_file($path)) {
            throw ContentNotFoundException::for($name);
        }

        return require $path;
    }
}
