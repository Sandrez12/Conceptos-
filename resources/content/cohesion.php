<?php

return [
    'titulo' => 'Cohesión y acoplamiento',
    'intro' => 'Dos medidas de calidad que se miran juntas: la cohesión describe qué tan relacionadas están las partes dentro de un módulo, y el acoplamiento qué tanto dependen unos módulos de otros. El objetivo es alta cohesión y bajo acoplamiento.',
    'items' => [
        [
            'id' => 'cohesion',
            'sigla' => 'Co',
            'titulo' => 'Cohesión',
            'resumen' => 'Qué tan bien trabajan juntas las partes de un módulo.',
            'descripcion' => 'Un módulo cohesivo hace una cosa y la hace completa: todos sus métodos y datos persiguen el mismo propósito. La cohesión baja suele aparecer como clases "cajón de sastre".',
            'senal' => 'No puedes describir la clase en una frase sin usar la palabra "y".',
            'malo' => <<<'PHP'
// Baja cohesión: funciones sin relación entre sí
class Utils
{
    public static function formatDate(DateTime $d): string { /* ... */ }
    public static function sendEmail(string $to, string $body): void { /* ... */ }
    public static function calculateTax(float $amount): float { /* ... */ }
    public static function resizeImage(string $path): void { /* ... */ }
}
PHP,
            'bueno' => <<<'PHP'
// Alta cohesión: todo gira en torno a un solo concepto
class TaxCalculator
{
    public function __construct(private float $rate) {}

    public function taxFor(float $amount): float
    {
        return round($amount * $this->rate, 2);
    }

    public function totalWithTax(float $amount): float
    {
        return $amount + $this->taxFor($amount);
    }
}
PHP,
            'tabla' => [
                ['nivel' => 'Funcional (ideal)', 'detalle' => 'Todos los elementos contribuyen a una única tarea bien definida.'],
                ['nivel' => 'Secuencial', 'detalle' => 'La salida de un elemento es la entrada del siguiente.'],
                ['nivel' => 'Comunicacional', 'detalle' => 'Los elementos operan sobre los mismos datos.'],
                ['nivel' => 'Procedural', 'detalle' => 'Se agrupan porque se ejecutan en cierto orden.'],
                ['nivel' => 'Temporal', 'detalle' => 'Se agrupan porque ocurren al mismo tiempo (por ejemplo, al iniciar).'],
                ['nivel' => 'Lógica', 'detalle' => 'Se agrupan por categoría general, no por función.'],
                ['nivel' => 'Coincidental (peor)', 'detalle' => 'No hay relación entre los elementos.'],
            ],
        ],
        [
            'id' => 'acoplamiento',
            'sigla' => 'Ac',
            'titulo' => 'Acoplamiento',
            'resumen' => 'Cuánto sabe un módulo de los detalles de otro.',
            'descripcion' => 'Con acoplamiento alto, un cambio en una clase obliga a modificar muchas otras y las pruebas aisladas se vuelven imposibles. Se reduce dependiendo de interfaces y comunicando módulos con datos simples o eventos.',
            'senal' => 'Cambiar una clase rompe pruebas de otras que no tienen relación aparente.',
            'malo' => <<<'PHP'
class InvoiceService
{
    public function send(Invoice $invoice): void
    {
        // Conoce la clase concreta y su configuración interna
        $mailer = new SmtpMailer('smtp.example.com', 587, 'user', 'secret');
        $mailer->connect();
        $mailer->sendRaw($invoice->customer->email, $invoice->toHtml());
    }
}
PHP,
            'bueno' => <<<'PHP'
interface InvoiceNotifier
{
    public function notify(Invoice $invoice): void;
}

class InvoiceService
{
    public function __construct(private InvoiceNotifier $notifier) {}

    public function send(Invoice $invoice): void
    {
        $this->notifier->notify($invoice); // no sabe cómo se entrega
    }
}
PHP,
            'tabla' => [
                ['nivel' => 'De datos (deseable)', 'detalle' => 'Los módulos comparten solo datos simples por parámetros.'],
                ['nivel' => 'De estampa', 'detalle' => 'Se pasa una estructura completa aunque solo se use una parte.'],
                ['nivel' => 'De control', 'detalle' => 'Un módulo decide el flujo de otro mediante banderas.'],
                ['nivel' => 'Externo / común', 'detalle' => 'Comparten estado global o recursos externos.'],
                ['nivel' => 'De contenido (peor)', 'detalle' => 'Un módulo accede o modifica el interior de otro.'],
            ],
        ],
        [
            'id' => 'eventos',
            'sigla' => 'Ev',
            'titulo' => 'Desacoplar con eventos',
            'resumen' => 'Quien origina un hecho no necesita saber quién reacciona.',
            'descripcion' => 'En Laravel, los eventos y listeners permiten que el registro de una orden dispare correos, métricas o inventario sin que el código de la orden los conozca.',
            'senal' => 'Un método de negocio llama a cinco servicios distintos solo para "avisar" que algo pasó.',
            'bueno' => <<<'PHP'
// Quien crea la orden solo anuncia lo ocurrido
OrderPlaced::dispatch($order);

// Cada reacción vive en su propio listener
class SendOrderConfirmation { public function handle(OrderPlaced $e): void { /* ... */ } }
class ReserveStock          { public function handle(OrderPlaced $e): void { /* ... */ } }
PHP,
        ],
    ],
];
