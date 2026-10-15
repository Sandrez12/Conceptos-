<?php

namespace Tests\Unit;

use App\Exceptions\ContentNotFoundException;
use App\Services\FileContentSource;
use PHPUnit\Framework\TestCase;

class FileContentSourceTest extends TestCase
{
    private string $dir;

    protected function setUp(): void
    {
        $this->dir = sys_get_temp_dir().'/content_'.uniqid();
        mkdir($this->dir);
        file_put_contents("{$this->dir}/demo.php", '<?php return ["titulo" => "Demo", "intro" => "x", "items" => []];');
    }

    protected function tearDown(): void
    {
        @unlink("{$this->dir}/demo.php");
        @rmdir($this->dir);
    }

    public function test_carga_el_contenido_de_una_pagina(): void
    {
        $page = (new FileContentSource($this->dir))->page('demo');

        $this->assertSame('Demo', $page['titulo']);
    }

    public function test_lanza_excepcion_si_la_pagina_no_existe(): void
    {
        $this->expectException(ContentNotFoundException::class);

        (new FileContentSource($this->dir))->page('inexistente');
    }

    public function test_rechaza_nombres_con_rutas(): void
    {
        $this->expectException(ContentNotFoundException::class);

        (new FileContentSource($this->dir))->page('../demo');
    }

    public function test_todo_el_contenido_real_es_valido(): void
    {
        $source = new FileContentSource(dirname(__DIR__, 2).'/resources/content');

        foreach (['solid', 'cohesion', 'inyeccion', 'bibliografia'] as $nombre) {
            $page = $source->page($nombre);
            $this->assertNotEmpty($page['titulo']);
            $this->assertNotEmpty($page['items'], "La página {$nombre} no tiene ítems");
        }
    }
}
