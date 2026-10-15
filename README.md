# Conceptos de buenas prácticas

Sitio educativo que explica, con ejemplos **antes y después** en PHP y Laravel, tres temas centrales del diseño de software:

- **Principios SOLID**: cada principio con su señal de alerta y código de ejemplo.
- **Cohesión y acoplamiento**: niveles, cómo medirlos y cómo desacoplar con interfaces y eventos.
- **Inyección de dependencias**: formas de inyectar, el contenedor de servicios de Laravel, pruebas con dobles y errores comunes.

Incluye además una **bibliografía** agrupada por tema.

![CI](https://github.com/Sandrez12/Conceptos-/actions/workflows/ci.yml/badge.svg)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)

## Características

- Diseño oscuro responsivo, con tabla de contenido lateral que sigue tu lectura.
- Bloques de código con resaltado de sintaxis y botón **Copiar**.
- Accesible: enlace para saltar al contenido, navegación por teclado y respeto a `prefers-reduced-motion`.
- Sin base de datos y sin paso de compilación de frontend: el contenido vive en archivos PHP editables.

## Cómo está construido

El contenido se separa de la presentación y se entrega por una interfaz, aplicando lo mismo que el sitio enseña:

```
app/Contracts/ContentSource.php          Interfaz: page(string $name): array
app/Services/FileContentSource.php       Implementación que lee resources/content/*.php
app/Providers/AppServiceProvider.php     Enlaza la interfaz con la implementación
app/Http/Controllers/PaginaController.php  Recibe ContentSource por constructor
resources/content/                       solid.php, cohesion.php, inyeccion.php, bibliografia.php
resources/views/                         Blade: layout, home, concepto, bibliografia, 404
public/css, public/js                    Estilos y comportamiento sin build
```

Para agregar un concepto basta con añadir un elemento al arreglo `items` del archivo correspondiente en `resources/content/`.

## Instalación local

Requisitos: PHP 8.2+ y Composer.

```bash
git clone https://github.com/Sandrez12/Conceptos-.git
cd Conceptos-

composer install
cp .env.example .env
php artisan key:generate

php artisan serve
```

Abre `http://127.0.0.1:8000`. No hace falta migrar ninguna base de datos.

## Pruebas y estilo

```bash
php artisan test         # pruebas de las páginas y del servicio de contenido
vendor/bin/pint --test   # verificación de estilo de código
```

## Despliegue

El repositorio incluye un `Dockerfile` multi-etapa (dependencias sin paquetes de desarrollo + PHP/Apache) y un `render.yaml` para publicarlo gratis en [Render](https://render.com):

1. Entra a Render y elige **New → Blueprint**.
2. Selecciona este repositorio: Render lee `render.yaml` y crea el servicio `conceptos`.
3. Cuando termine el despliegue, la URL pública aparece en el panel. El health check usa `/up`.

También funciona en cualquier proveedor que ejecute contenedores:

```bash
docker build -t conceptos .
docker run -p 8080:80 conceptos
```

## Tecnologías

PHP, Laravel 12, Blade, CSS propio, highlight.js, Docker.
