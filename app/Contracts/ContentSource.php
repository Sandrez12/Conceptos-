<?php

namespace App\Contracts;

interface ContentSource
{
    /**
     * Devuelve el contenido de una página (título, introducción e ítems).
     *
     * @return array<string, mixed>
     *
     * @throws \App\Exceptions\ContentNotFoundException
     */
    public function page(string $name): array;
}
