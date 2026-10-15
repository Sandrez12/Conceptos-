# Conceptos de ingeniería de software

Sitio web educativo que explica, con ejemplos, tres temas centrales del diseño de software:

- **Principios SOLID**
- **Cohesión y acoplamiento**
- **Inyección de dependencias**

Incluye una sección de **bibliografía**. El contenido se carga desde un archivo JSON (`storage/app/pagina.json`), por lo que se puede editar sin tocar el código.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)

## Páginas

| Ruta | Contenido |
|---|---|
| `/` | Inicio |
| `/solid` | Los cinco principios SOLID |
| `/cohesion-acoplamiento` | Cohesión y acoplamiento |
| `/inyeccion-dependencias` | Inyección de dependencias |
| `/bibliografia` | Referencias |

## Instalación

Requisitos: PHP 8.2+, Composer y Node.js.

```bash
git clone https://github.com/Sandrez12/Conceptos-.git
cd Conceptos-

composer install
npm install

cp .env.example .env
php artisan key:generate

npm run dev          # en una terminal
php artisan serve    # en otra terminal
```

Abre `http://127.0.0.1:8000`.

## Tecnologías

PHP, Laravel 12, Blade, Tailwind CSS 4, Vite.
