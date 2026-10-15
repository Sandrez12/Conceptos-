<?php

return [
    'titulo' => 'Inyección de dependencias',
    'intro' => 'Una clase no crea lo que necesita: lo recibe desde afuera. Es la forma práctica de aplicar el principio de inversión de dependencias y la base del contenedor de servicios de Laravel.',
    'items' => [
        [
            'id' => 'que-es',
            'sigla' => '1',
            'titulo' => 'Qué es y por qué importa',
            'resumen' => 'Recibir las dependencias en lugar de construirlas.',
            'descripcion' => 'Con inyección de dependencias el código de negocio queda desacoplado de las implementaciones concretas: puedes cambiar el proveedor de correo, usar una base de datos en memoria o reemplazar una API por un objeto falso en las pruebas, sin tocar la clase que lo usa.',
            'senal' => 'Para probar una clase tienes que crear archivos, conectarte a internet o levantar una base de datos.',
            'malo' => <<<'PHP'
class WeatherReport
{
    public function today(): string
    {
        $client = new HttpWeatherClient(); // la clase decide su dependencia
        return $client->fetch('Bucaramanga');
    }
}
PHP,
            'bueno' => <<<'PHP'
class WeatherReport
{
    public function __construct(private WeatherClient $client) {}

    public function today(): string
    {
        return $this->client->fetch('Bucaramanga');
    }
}
PHP,
        ],
        [
            'id' => 'tipos',
            'sigla' => '2',
            'titulo' => 'Formas de inyectar',
            'resumen' => 'Constructor, método y setter.',
            'descripcion' => 'La inyección por constructor es la más recomendada: la clase nunca existe en un estado incompleto y las dependencias quedan visibles. Por método sirve cuando la dependencia solo se usa en una operación. Por setter se reserva para dependencias opcionales.',
            'bueno' => <<<'PHP'
// 1. Por constructor (recomendada)
class Mailer
{
    public function __construct(private Transport $transport) {}
}

// 2. Por método: Laravel resuelve el parámetro automáticamente
public function store(Request $request, OrderRepository $orders)
{
    $orders->create($request->validated());
}

// 3. Por setter (dependencia opcional)
public function setLogger(LoggerInterface $logger): void
{
    $this->logger = $logger;
}
PHP,
        ],
        [
            'id' => 'contenedor',
            'sigla' => '3',
            'titulo' => 'El contenedor de servicios de Laravel',
            'resumen' => 'Resuelve y entrega las dependencias por ti.',
            'descripcion' => 'Laravel lee los tipos del constructor y construye el objeto con todas sus dependencias. Cuando la dependencia es una interfaz, le indicas una vez qué implementación usar en un Service Provider.',
            'bueno' => <<<'PHP'
// app/Providers/AppServiceProvider.php
public function register(): void
{
    // Cada vez que se pida la interfaz, se entrega esta clase
    $this->app->bind(WeatherClient::class, HttpWeatherClient::class);

    // Una única instancia compartida
    $this->app->singleton(Metrics::class, fn () => new Metrics(config('metrics.dsn')));
}
PHP,
        ],
        [
            'id' => 'pruebas',
            'sigla' => '4',
            'titulo' => 'Pruebas con dobles',
            'resumen' => 'Sustituye lo externo por un objeto controlado.',
            'descripcion' => 'Como la clase recibe su dependencia, en una prueba puedes entregarle un doble que responde siempre lo mismo. Las pruebas se vuelven rápidas y deterministas.',
            'bueno' => <<<'PHP'
class FakeWeatherClient implements WeatherClient
{
    public function fetch(string $city): string
    {
        return "Soleado en {$city}";
    }
}

public function test_reports_the_weather(): void
{
    $report = new WeatherReport(new FakeWeatherClient());

    $this->assertSame('Soleado en Bucaramanga', $report->today());
}
PHP,
        ],
        [
            'id' => 'errores',
            'sigla' => '5',
            'titulo' => 'Errores comunes',
            'resumen' => 'Service Locator y contenedores por todas partes.',
            'descripcion' => 'Llamar a `app(Clase::class)` dentro de la lógica oculta las dependencias reales: no se ven en la firma y complican las pruebas. Úsalo solo en el borde de la aplicación (providers, comandos). Tampoco conviene inyectar diez dependencias en un constructor: suele ser señal de que la clase tiene demasiadas responsabilidades.',
            'malo' => <<<'PHP'
class ReportGenerator
{
    public function build(): array
    {
        $repo = app(OrderRepository::class); // dependencia oculta (Service Locator)
        return $repo->all()->toArray();
    }
}
PHP,
            'bueno' => <<<'PHP'
class ReportGenerator
{
    public function __construct(private OrderRepository $repo) {}

    public function build(): array
    {
        return $this->repo->all()->toArray();
    }
}
PHP,
        ],
    ],
];
