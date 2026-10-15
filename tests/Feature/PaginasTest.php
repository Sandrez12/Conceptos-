<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaginasTest extends TestCase
{
    public function test_inicio_muestra_los_tres_temas(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('SOLID')
            ->assertSee('Cohesión y acoplamiento')
            ->assertSee('Inyección de dependencias');
    }

    public function test_cada_tema_se_renderiza_con_su_contenido(): void
    {
        $paginas = [
            '/solid' => ['Responsabilidad Única', 'Inversión de Dependencias'],
            '/cohesion-acoplamiento' => ['Cohesión', 'Acoplamiento'],
            '/inyeccion-dependencias' => ['Formas de inyectar', 'contenedor de servicios'],
        ];

        foreach ($paginas as $ruta => $textos) {
            $respuesta = $this->get($ruta)->assertOk();
            foreach ($textos as $texto) {
                $respuesta->assertSee($texto, false);
            }
        }
    }

    public function test_el_codigo_de_ejemplo_se_escapa_correctamente(): void
    {
        $this->get('/solid')
            ->assertSee('$this-&gt;validator', false)
            ->assertDontSee('$this->validator', false);
    }

    public function test_bibliografia_agrupa_por_tema_y_enlaza_las_fuentes_en_linea(): void
    {
        $this->get('/bibliografia')
            ->assertOk()
            ->assertSee('Clean Architecture')
            ->assertSee('https://laravel.com/docs/container', false)
            ->assertSee('rel="noopener noreferrer"', false);
    }

    public function test_navegacion_entre_temas(): void
    {
        $this->get('/solid')->assertSee(route('cohesion'), false);
        $this->get('/inyeccion-dependencias')->assertSee(route('bibliografia'), false);
    }

    public function test_una_ruta_inexistente_muestra_la_pagina_404(): void
    {
        $this->get('/no-existe')->assertNotFound()->assertSee('Esta página', false);
    }

    public function test_health_check_responde(): void
    {
        $this->get('/up')->assertOk();
    }
}
