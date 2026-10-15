<?php

return [
    'titulo' => 'Principios SOLID',
    'intro' => 'Cinco principios de diseño orientado a objetos que hacen el código más fácil de entender, cambiar y probar. Cada uno incluye una señal para detectar el problema y un ejemplo en PHP/Laravel antes y después de aplicarlo.',
    'items' => [
        [
            'id' => 'srp',
            'sigla' => 'S',
            'titulo' => 'Responsabilidad Única',
            'ingles' => 'Single Responsibility Principle',
            'resumen' => 'Una clase debe tener una sola razón para cambiar.',
            'descripcion' => 'Cada clase se ocupa de un único aspecto del sistema. Cuando una clase valida, guarda en base de datos y además envía correos, cualquier cambio en uno de esos temas obliga a tocar (y volver a probar) los otros.',
            'senal' => 'La clase tiene métodos que no usan los mismos atributos, o su nombre termina en "Manager", "Helper" o "Utils".',
            'malo' => <<<'PHP'
class OrderService
{
    public function checkout(array $data): void
    {
        // 1. Validar
        if (empty($data['items'])) {
            throw new InvalidArgumentException('Carrito vacío');
        }

        // 2. Persistir
        $order = Order::create($data);

        // 3. Notificar
        Mail::to($data['email'])->send(new OrderConfirmed($order));
    }
}
PHP,
            'bueno' => <<<'PHP'
class CheckoutController
{
    public function __construct(
        private OrderValidator $validator,
        private OrderRepository $orders,
        private OrderNotifier $notifier,
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validator->validate($request->all());
        $order = $this->orders->create($data);
        $this->notifier->confirmed($order);

        return redirect()->route('orders.show', $order);
    }
}
PHP,
        ],
        [
            'id' => 'ocp',
            'sigla' => 'O',
            'titulo' => 'Abierto/Cerrado',
            'ingles' => 'Open/Closed Principle',
            'resumen' => 'Abierto para extender, cerrado para modificar.',
            'descripcion' => 'Se debe poder añadir comportamiento nuevo sin editar el código que ya funciona. Se logra apoyándose en abstracciones: agregar un caso nuevo significa agregar una clase, no otra rama en un condicional.',
            'senal' => 'Cada vez que aparece un tipo nuevo hay que modificar un `if/elseif` o un `switch` en varios lugares.',
            'malo' => <<<'PHP'
class PriceCalculator
{
    public function total(float $amount, string $customerType): float
    {
        if ($customerType === 'regular') {
            return $amount;
        } elseif ($customerType === 'vip') {
            return $amount * 0.90;
        } elseif ($customerType === 'student') {
            return $amount * 0.85;
        }
        // Un tipo nuevo = editar esta clase otra vez
        return $amount;
    }
}
PHP,
            'bueno' => <<<'PHP'
interface Discount
{
    public function apply(float $amount): float;
}

class VipDiscount implements Discount
{
    public function apply(float $amount): float { return $amount * 0.90; }
}

class StudentDiscount implements Discount
{
    public function apply(float $amount): float { return $amount * 0.85; }
}

class PriceCalculator
{
    public function total(float $amount, Discount $discount): float
    {
        return $discount->apply($amount); // nunca cambia al agregar descuentos
    }
}
PHP,
        ],
        [
            'id' => 'lsp',
            'sigla' => 'L',
            'titulo' => 'Sustitución de Liskov',
            'ingles' => 'Liskov Substitution Principle',
            'resumen' => 'Una subclase debe poder usarse donde se espera su clase base.',
            'descripcion' => 'Si el código funciona con `Bird`, debe seguir funcionando con cualquier subclase sin sorpresas. Una subclase que lanza excepciones donde la base no las lanza, o que debilita lo que la base promete, rompe el contrato.',
            'senal' => 'Una subclase sobrescribe un método para lanzar `NotImplementedException`, o el código cliente hace `instanceof` antes de usar el objeto.',
            'malo' => <<<'PHP'
class Bird
{
    public function fly(): void { /* vuela */ }
}

class Penguin extends Bird
{
    public function fly(): void
    {
        throw new LogicException('Los pingüinos no vuelan'); // rompe el contrato
    }
}
PHP,
            'bueno' => <<<'PHP'
abstract class Bird
{
    abstract public function move(): void;
}

interface Flyer
{
    public function fly(): void;
}

class Sparrow extends Bird implements Flyer
{
    public function move(): void { $this->fly(); }
    public function fly(): void { /* vuela */ }
}

class Penguin extends Bird
{
    public function move(): void { /* nada */ }
}
PHP,
        ],
        [
            'id' => 'isp',
            'sigla' => 'I',
            'titulo' => 'Segregación de Interfaces',
            'ingles' => 'Interface Segregation Principle',
            'resumen' => 'Es mejor varias interfaces pequeñas que una grande.',
            'descripcion' => 'Ninguna clase debería verse obligada a implementar métodos que no usa. Interfaces pequeñas y específicas hacen que las dependencias sean más claras y fáciles de sustituir.',
            'senal' => 'Hay implementaciones con métodos vacíos o que lanzan excepciones solo para cumplir la interfaz.',
            'malo' => <<<'PHP'
interface Machine
{
    public function print(string $doc): void;
    public function scan(): string;
    public function fax(string $doc): void;
}

class BasicPrinter implements Machine
{
    public function print(string $doc): void { /* ok */ }
    public function scan(): string { throw new BadMethodCallException(); }
    public function fax(string $doc): void { throw new BadMethodCallException(); }
}
PHP,
            'bueno' => <<<'PHP'
interface Printer { public function print(string $doc): void; }
interface Scanner { public function scan(): string; }
interface Fax     { public function fax(string $doc): void; }

class BasicPrinter implements Printer
{
    public function print(string $doc): void { /* ok */ }
}

class OfficeMachine implements Printer, Scanner, Fax
{
    public function print(string $doc): void { /* ok */ }
    public function scan(): string { return '...'; }
    public function fax(string $doc): void { /* ok */ }
}
PHP,
        ],
        [
            'id' => 'dip',
            'sigla' => 'D',
            'titulo' => 'Inversión de Dependencias',
            'ingles' => 'Dependency Inversion Principle',
            'resumen' => 'Depende de abstracciones, no de implementaciones concretas.',
            'descripcion' => 'Los módulos de alto nivel (reglas de negocio) no deben depender de los de bajo nivel (base de datos, correo, APIs). Ambos dependen de una interfaz. En Laravel, el contenedor de servicios decide qué implementación entregar.',
            'senal' => 'Aparece `new` con clases concretas dentro de la lógica de negocio, o es imposible probar sin una base de datos real.',
            'malo' => <<<'PHP'
class ReportController
{
    public function index()
    {
        $repo = new MySqlOrderRepository(); // acoplado a MySQL
        return view('report', ['orders' => $repo->all()]);
    }
}
PHP,
            'bueno' => <<<'PHP'
interface OrderRepository
{
    public function all(): Collection;
}

class ReportController
{
    public function __construct(private OrderRepository $orders) {}

    public function index()
    {
        return view('report', ['orders' => $this->orders->all()]);
    }
}

// AppServiceProvider::register()
$this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
PHP,
        ],
    ],
];
