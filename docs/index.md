# 🧭 Guía Didáctica Completa de Programación Orientada a Objetos (OOP) en PHP

> Manual pedagógico y ampliado que cubre **todos** los apartados solicitados, con explicaciones paso a paso, analogías, buenas prácticas, errores comunes, ejercicios guiados y mini‑proyectos. Todo el código está en bloques para que puedas **copiar/pegar** fácilmente.

---

## 🧩 Índice General
1. [Introducción a la Programación Orientada a Objetos](#1-introducción-a-la-programación-orientada-a-objetos)  
2. [Clases y Objetos](#2-clases-y-objetos)  
3. [Constructores (`__construct`)](#3-constructores-__construct)  
4. [Destructores (`__destruct`)](#4-destructores-__destruct)  
5. [Modificadores de Acceso](#5-modificadores-de-acceso)  
6. [Herencia y `final`](#6-herencia-y-final)  
7. [Constantes de Clase](#7-constantes-de-clase)  
8. [Clases y Métodos Abstractos](#8-clases-y-métodos-abstractos)  
9. [Interfaces](#9-interfaces)  
10. [Traits](#10-traits)  
11. [Métodos Estáticos](#11-métodos-estáticos)  
12. [Propiedades Estáticas](#12-propiedades-estáticas)  
13. [Namespaces](#13-namespaces)  
14. [Iterables e Iteradores](#14-iterables-e-iteradores)  
15. [Principios SOLID](#15-principios-solid)  
16. [Errores Comunes en OOP PHP](#16-errores-comunes-en-oop-php)  
17. [Resumen Visual + Ejercicios Finales](#17-resumen-visual--ejercicios-finales)  
18. [Mini‑proyecto guiado: Gestor de Tareas OOP](#18-mini-proyecto-guiado-gestor-de-tareas-oop)

---

## 🧱 1. Introducción a la Programación Orientada a Objetos

La **POO** organiza el software en torno a **clases** (plantillas) y **objetos** (instancias), uniendo **datos** (propiedades) y **comportamientos** (métodos) en unidades coherentes.

### 🎯 Ventajas clave
- **Encapsulación**: ocultar detalles internos y exponer una API clara.  
- **Reutilización**: herencia, composición y traits para evitar duplicación.  
- **Mantenibilidad**: cambios localizados y pruebas más sencillas.  
- **Modelado realista**: el dominio se refleja en el código.

### 🧠 Conceptos esenciales
| Concepto | Descripción | Ejemplo |
|---|---|---|
| Clase | Molde que define estructura y conducta | `class Persona { ... }` |
| Objeto | Instancia concreta de una clase | `$p = new Persona();` |
| Propiedad | Dato del objeto | `$p->nombre` |
| Método | Acción del objeto | `$p->saludar()` |
| `$this` | Referencia al objeto actual | `$this->propiedad` |

### 🧩 Ejemplo de introducción
```php
<?php
class Persona {
    public string $nombre;
    public function saludar(): void {
        echo "Hola, soy {$this->nombre}";
    }
}
$ana = new Persona();
$ana->nombre = "Ana";
$ana->saludar();
```

---

## 🚗 2. Clases y Objetos

### 🔹 Definición y sintaxis básica
```php
<?php
class Coche {
    public string $marca;
    public string $modelo;

    public function arrancar(): void {
        echo "El {$this->marca} {$this->modelo} está arrancando...";
    }
}
$auto = new Coche();
$auto->marca = "Toyota";
$auto->modelo = "Corolla";
$auto->arrancar();
```

### 🔧 Reglas prácticas
- Nombra las clases en **PascalCase** y los métodos/propiedades en **camelCase**.  
- Una clase debe tener **una responsabilidad principal** (cohesión).

### 🧪 Ejercicio
Crea `Libro` con `$titulo`, `$autor` y `descripcion()` que devuelva “*«Título» de Autor*”.

---

## ⚙️ 3. Constructores (`__construct`)

El constructor se ejecuta **al crear** un objeto, ideal para **inicializar** estado o validar.

```php
<?php
class Usuario {
    public function __construct(
        public string $nombre,
        public string $email
    ) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email inválido");
        }
    }
}
$u = new Usuario("Laura", "laura@mail.com");
```

### 🔁 Herencia y `parent::__construct()`
```php
<?php
class Animal {
    public function __construct(public string $nombre) {}
}
class Perro extends Animal {
    public function __construct(string $nombre, public string $raza) {
        parent::__construct($nombre);
    }
}
```

### ⚠️ Errores frecuentes
- Olvidar `__` en `__construct`.  
- No usar `$this->` al asignar propiedades.  

### 🧪 Ejercicio
Implementa `Conexion` con host, db y un flag `conectado` que se marque a `true` en el constructor.

---

## 🧹 4. Destructores (`__destruct`)

Se ejecutan cuando el objeto **se destruye** o termina el script. Útiles para **liberar recursos**.

```php
<?php
class Archivo {
    private $fh;
    public function __construct(string $ruta) { $this->fh = fopen($ruta, 'w'); }
    public function escribir(string $txt): void { fwrite($this->fh, $txt); }
    public function __destruct() { if ($this->fh) fclose($this->fh); }
}
```

### 💡 Consejos
- Limítalo a tareas de limpieza (cerrar conexiones/archivos).  
- Evita lógica de negocio en `__destruct()`.

### 🧪 Ejercicio
Crea `LoggerArchivo` que abra un archivo en `__construct` y lo cierre en `__destruct`.

---

## 🔐 5. Modificadores de Acceso

Controlan la **visibilidad** de miembros.

| Modificador | Acceso |
|---|---|
| `public` | En cualquier lugar |
| `protected` | Clase actual y subclases |
| `private` | Solo la clase actual |

```php
<?php
class Cuenta {
    private float $saldo = 0;
    public function depositar(float $m): void { if ($m > 0) $this->saldo += $m; }
    public function verSaldo(): float { return $this->saldo; }
}
```

### 🧠 Encapsulación
Usa getters/setters solo cuando **aporten valor** (validación, invariantes).

### 🧪 Ejercicio
`Producto` con `$precio` privado y `setPrecio()` que rechace valores negativos.

---

## 🧬 6. Herencia y `final`

La herencia permite **reutilizar** y **especializar**.

```php
<?php
class Animal { public function sonido(): string { return "Sonido"; } }
class Gato extends Animal { public function sonido(): string { return "Miau"; } }
$g = new Gato(); echo $g->sonido();
```

### 🔒 `final`
```php
<?php
final class Sistema {}
class Base {
    final public function noSobrescribir(): void {}
}
```

### 🧭 Composición vs Herencia
Prefiere **composición** si la relación no es “es-un(a)”.

### 🧪 Ejercicio
`Vehiculo` con `arrancar()`. `Moto` sobrescribe el comportamiento.

---

## ⚙️ 7. Constantes de Clase

Valores **inmutables** por clase.

```php
<?php
class Config {
    public const VERSION = "2.1.0";
    public const AUTOR = "Equipo PHP";
}
echo Config::VERSION;
```

### 🧪 Ejercicio
`Matematica::PI` y método `areaCirculo(float $r): float`.

---

## 🧩 8. Clases y Métodos Abstractos

Plantillas que **no se instancian** y fuerzan implementación en hijas.

```php
<?php
abstract class Figura {
    abstract public function area(): float;
    public function unidad(): string { return "cm²"; }
}
class Rectangulo extends Figura {
    public function __construct(private float $w, private float $h) {}
    public function area(): float { return $this->w * $this->h; }
}
```

### 🧪 Ejercicio
`Figura` + `Circulo` y `Triangulo` implementando `area()`.

---

## 🧠 9. Interfaces

Definen **contratos** (sin implementación) que varias clases pueden cumplir.

```php
<?php
interface Exportable { public function exportar(): string; }
class Usuario implements Exportable {
    public function __construct(private string $nombre) {}
    public function exportar(): string { return json_encode(['nombre'=>$this->nombre]); }
}
function enviar(Exportable $x): void { echo $x->exportar(); }
enviar(new Usuario("Ana"));
```

### Diferencias con abstractas
- Interfaces: **solo** método(s) sin cuerpo; múltiples `implements`.  
- Abstractas: pueden tener propiedades y métodos con cuerpo; **una** clase base.

### 🧪 Ejercicio
`Pago` con `procesar()`. `PagoPaypal` y `PagoTarjeta` lo implementan.

---

## 🔀 10. Traits

Reutilizan **métodos** sin herencia múltiple.

```php
<?php
trait Logger { public function log(string $m): void { echo "[LOG] $m\n"; } }
trait Notificador { public function notificar(string $m): void { echo "📢 $m\n"; } }
class Servicio {
    use Logger, Notificador;
}
$s = new Servicio();
$s->log("Iniciado"); $s->notificar("Listo");
```

### Conflictos y alias
```php
<?php
trait A { public function hola(){ echo "A"; } }
trait B { public function hola(){ echo "B"; } }
class X {
  use A, B { A::hola insteadof B; B::hola as holaB; }
}
```

### 🧪 Ejercicio
`Autenticable` como trait con `login()` y `logout()` usado en 2 clases.

---

## 🧮 11. Métodos Estáticos

Pertenecen a la **clase** (no al objeto).

```php
<?php
class Calculadora {
    public static function sumar(int $a,int $b): int { return $a+$b; }
}
echo Calculadora::sumar(3,5);
```

- Usa `self::` dentro de la clase; `static::` para late static binding.
- No acceden a `$this`.

### 🧪 Ejercicio
`Conversor::kmAMillas(float $km): float` y `::millasAKm(float $mi): float`.

---

## 🧭 12. Propiedades Estáticas

Compartidas por **todas** las instancias.

```php
<?php
class Contador {
    public static int $total = 0;
    public function __construct() { self::$total++; }
}
new Contador(); new Contador();
echo Contador::$total; // 2
```

### 🧪 Ejercicio
`Sesion::$usuariosConectados` y método `conectar()` que la incremente.

---

## 🗂️ 13. Namespaces

Evitan **colisiones** de nombres y organizan el código.

```php
<?php
// src/Model/Usuario.php
namespace App\Model;
class Usuario { public function info(): string { return "Soy Usuario del Modelo"; } }
```
```php
<?php
// index.php
use App\Model\Usuario as UsuarioModelo;
$u = new UsuarioModelo();
echo $u->info();
```

### Reglas
- Declarar `namespace` al inicio del archivo.  
- Importar con `use` y alias con `as` cuando convenga.

### 🧪 Ejercicio
Dos `Usuario` en `App\Model` y `App\Controller` y úsalos con alias.

---

## 🔁 14. Iterables e Iteradores

`iterable` = **array** u objeto que implementa `Iterator`.

```php
<?php
function mostrar(iterable $xs): void { foreach($xs as $x) echo "$x "; }
mostrar([1,2,3]);
```

### Implementar `Iterator`
```php
<?php
class Serie implements Iterator {
    private array $data; private int $i = 0;
    public function __construct(array $data){ $this->data = array_values($data); }
    public function current(): mixed { return $this->data[$this->i]; }
    public function key(): mixed { return $this->i; }
    public function next(): void { $this->i++; }
    public function rewind(): void { $this->i = 0; }
    public function valid(): bool { return isset($this->data[$this->i]); }
}
foreach(new Serie(["a","b","c"]) as $k=>$v){ echo "$k:$v "; }
```

### 🧪 Ejercicio
`ListaTareas` iterable con `Iterator` y métodos `agregar()` y `listar()`.

---

## 🧱 15. Principios SOLID

| Letra | Principio | En una línea |
|---|---|---|
| **S** | Single Responsibility | Una clase = un motivo de cambio |
| **O** | Open/Closed | Extiende sin modificar |
| **L** | Liskov Substitution | Hijas sustituyen a la base sin sorpresas |
| **I** | Interface Segregation | Interfaces pequeñas y específicas |
| **D** | Dependency Inversion | Depende de **interfaces**, no de concreciones |

### Ejemplo corto de DI
```php
<?php
interface Notificador { public function enviar(string $msg): void; }
class Email implements Notificador { public function enviar(string $msg): void { echo "Email: $msg"; } }
class Servicio {
  public function __construct(private Notificador $n) {}
  public function run(){ $this->n->enviar("Hola"); }
}
$s = new Servicio(new Email()); $s->run();
```

---

## 🚧 16. Errores Comunes en OOP PHP

- Usar `$this` dentro de métodos estáticos.  
- Exponer todo como `public` sin encapsular.  
- Heredar sin relación “es‑un(a)” (usa composición/traits).  
- No usar namespaces en proyectos medianos/grandes.  
- Falta de validaciones en constructores.  
- No escribir pruebas unitarias para clases con lógica crítica.

---

## 🧠 17. Resumen Visual + Ejercicios Finales

### Mapa conceptual
```
CLASE → Molde
OBJETO → Instancia
PROPIEDADES → Datos
MÉTODOS → Acciones
ENCAPSULACIÓN → Oculta y protege
HERENCIA → Reutiliza
POLIMORFISMO → Misma interfaz, distinto comportamiento
ABSTRACCIÓN → Enfócate en lo esencial
```

### Banco de ejercicios
1. **CuentaBancaria**: depósito, retiro, verSaldo (con validaciones).  
2. **Tienda**: `Producto` y `Carrito` (agregar, total, eliminar).  
3. **Figuras**: abstracta `Figura` + `Rectangulo`, `Circulo`, `Triangulo`.  
4. **Exportable**: interfaz con implementación JSON/XML.  
5. **Logger**: trait con alias y resolución de conflicto.  
6. **Conversor**: métodos estáticos y contador estático de conversiones.  
7. **Namespaces**: separa `Model`, `Controller` y `Service`.  
8. **Iterador**: `Paginador` que recorre páginas de resultados.

---

## 🧩 18. Mini‑proyecto guiado: Gestor de Tareas OOP

> Objetivo: aplicar todo el temario (clases, herencia, interfaces, traits, estáticos, namespaces e iteradores) en un mini‑proyecto funcional y fácil de ampliar.

### 18.1 Estructura de carpetas (sugerida)
```
src/
  Model/
    Tarea.php
    ColeccionTareas.php
  Service/
    Persistencia.php
  Util/
    Logger.php
index.php
```

### 18.2 Código

**`src/Util/Logger.php` (trait)**
```php
<?php
namespace App\Util;
trait Logger {
    protected function log(string $msg): void {
        echo "[LOG] " . date('H:i:s') . " - $msg\n";
    }
}
```

**`src/Model/Tarea.php`**
```php
<?php
namespace App\Model;

interface Exportable { public function exportar(): array; }

class Tarea implements Exportable {
    public function __construct(
        private string $titulo,
        private bool $completada = false
    ) {
        if (trim($titulo) === '') {
            throw new \InvalidArgumentException("El título es obligatorio");
        }
    }
    public function completar(): void { $this->completada = true; }
    public function esCompletada(): bool { return $this->completada; }
    public function titulo(): string { return $this->titulo; }
    public function exportar(): array {
        return ['titulo'=>$this->titulo, 'completada'=>$this->completada];
    }
}
```

**`src/Model/ColeccionTareas.php` (iterable)**
```php
<?php
namespace App\Model;

use Iterator;
use App\Util\Logger;

class ColeccionTareas implements Iterator {
    use Logger;

    /** @var Tarea[] */
    private array $tareas = [];
    private int $i = 0;

    public function agregar(Tarea $t): void {
        $this->tareas[] = $t;
        $this->log("Tarea agregada: ".$t->titulo());
    }
    public function current(): mixed { return $this->tareas[$this->i] ?? null; }
    public function key(): mixed { return $this->i; }
    public function next(): void { $this->i++; }
    public function rewind(): void { $this->i = 0; }
    public function valid(): bool { return isset($this->tareas[$this->i]); }
    public function total(): int { return count($this->tareas); }
}
```

**`src/Service/Persistencia.php` (métodos estáticos)**
```php
<?php
namespace App\Service;

use App\Model\ColeccionTareas;

class Persistencia {
    public static function guardarJSON(ColeccionTareas $c, string $ruta): void {
        $data = [];
        foreach ($c as $t) { $data[] = $t->exportar(); }
        file_put_contents($ruta, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
}
```

**`index.php`**
```php
<?php
require __DIR__.'/src/Util/Logger.php';
require __DIR__.'/src/Model/Tarea.php';
require __DIR__.'/src/Model/ColeccionTareas.php';
require __DIR__.'/src/Service/Persistencia.php';

use App\Model\Tarea;
use App\Model\ColeccionTareas;
use App\Service\Persistencia;

$t1 = new Tarea("Comprar leche");
$t2 = new Tarea("Enviar informe");
$t2->completar();

$lista = new ColeccionTareas();
$lista->agregar($t1);
$lista->agregar($t2);

foreach ($lista as $t) {
    echo ($t->esCompletada() ? "✅" : "⬜️") . " " . $t->titulo() . PHP_EOL;
}

Persistencia::guardarJSON($lista, __DIR__.'/tareas.json');
echo "Guardado en tareas.json";
```

### 18.3 Extensiones sugeridas
- Añadir `Repositorio` con interfaz + implementación en archivos o BD.  
- Validaciones avanzadas y excepciones personalizadas.  
- Comandos CLI (por ejemplo, marcar tareas por índice).

---

## ✅ Cierre
Con esta guía puedes **aprender, practicar y enseñar** OOP en PHP desde cero hasta un nivel intermedio/avanzado, con una base sólida para frameworks modernos.
