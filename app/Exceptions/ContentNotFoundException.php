<?php

namespace App\Exceptions;

use RuntimeException;

class ContentNotFoundException extends RuntimeException
{
    public static function for(string $name): self
    {
        return new self("No existe contenido para la página [{$name}].");
    }
}
