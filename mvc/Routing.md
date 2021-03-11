# Routing

En aplicaciones modernas hechas en PHP todas las solicitudes se redirecionan a un único archivo llamado `index.php` es por lo tanto que se hace necesario un mecanismo que enrute las diferentes solicitudes hacia los scripts designados que suelen ser los controladores.

Aquí exploramos como están hechas las bases del enrutado en un framework PHP.


Lo primero que debemos hacer es asociar los diferentes controladores a una una url determinada para ello podemos comenzar un simple arreglo.

```php
use Fec\Http\Controllers\HomeController;

$routes = [
   '/' => [
        'controller' => HomeController::class,
        'action' => 'index'
    ],
]
```

En este arreglo hemos definido una serie de elementos que usaremos para comparar con la url que viene en solicitud, podemos acceder a esta desde la variable global `$_SERVER['REQUEST_URI']`.

Así pues si la url es la misma que hemos definido en la ruta podemos crear una instancia del controlador y ejecutar el metodo.

> Nota: La anotacion `::class` es usada para la resolución de nombres de clases. Se obtiene un string con el nombre completo de la clase con su espacio de nombre. esto es util porque podemos definir la clase sin instanciarla.

```php

$controller = new $routes[$requestUri]['controller'];

call_user_func([$controller, $routes[$requestUri]['action']]);

```

Pero esta forma de enrutar es muy primitiva, por lo general las rutas de las solicitudes y mas las que se definen en REST suele traer parámetros dentro de la url tipo `/users/12` o `/category/sports` etc. Por lo que necesitamos de una forma de comparar expresiones dentro en rutas y capturar los valores que hay en ellas para pasarlas como parámetros a los métodos de los controladores.

Agreguemos una nueva ruta pero esta vez usando expresiones regulares, en esta ruta le decimos que esperamos un sección de la url que sera una secuencia de dígitos. `(\d+)`

```php
$routes = [
    '/users/(\d+)' => [
        'controller' => UserController::class,
        'action' => 'show'
    ],
]
```

Ahora vamos a recorrer el arreglo de rutas en busca de una ruta que haga match con la que trae la solicitud. Para ellos vamos a usar la función de PHP [preg_match](https://www.php.net/manual/es/function.preg-match)

```php
$requestPath = $_SERVER['REQUEST_URI'];

foreach($routes as $route => $params) {

    if(preg_match('#^'.$route.'$#i', $requestPath, $matches)) {
        $controller = new $params['controller'];

        call_user_func([$controller, $params['action']], $matches[1]);
        break;
    }
}
```
Veamos los detalles en esta parte del código, el primero parámetro de la funcion `preg_match`  es el patrón o expresión contra la que compararemos la ruta actual, las funciones de  expresiones regulares en PHP debe están envueltas entre algún signo esto para poder diferenciar la cuerpo de la expresión de algunos modificadores globales, suele usarse `/`, yo suelo usar `#` porque me es mas intuitivo visualmente.

Vemos que la expresión arranca con el signo `^` y termina con `$` esto indica el principio y fin de una cadena de texto, también podemos notar el `i` final que un modificador global que indica que se valide sin tener en cuenta mayusculas o minusculas `case insensitive`.

No entrare en muchos detalles sobre expresiones regulares pero si quieres aprender y explorarlas recomiendo https://regexr.com

la funcion `preg_match` recibe un ultimo parametro `$matches` por referencia donde se guardaran los los valores, en caso de que se haga match con alguna ruta, este es un array que almacena como primer elemento el string con el que ha hecho match y en los siguientes los diferentes grupos `(\d+)` que hayamos definido en la expresione regular.

## Casos a tener en cuenta

Aquí hay muchas cosas que se pueden/ deben mejorar, por ejemplo que pasa si la ruta trae parámetros por `GET` tipo `?page=1&limit=10` etc, esto provocaría que ya no se pueda hacer match con la expresión regular, podemos agrega una validación para esto.

```php
$queryPos = strpos($requestPath, '?');

if ($queryPost !== false) {
    $requestPath = substr($requestPath, 0, $queryPos);
}

```

Otro caso puede ser si el método del controlador no existe debemos hace una validación, podemos hacer uso de la funcion [method_exists](https://www.php.net/manual/es/function.method-exists)

y por ultimo que retornaremos si la ruta de la request no hace match con ninguna ruta definida en nuestro router, podemos validarlo y retornar un tipo 404 Not found.

```php
if (empty($matches)) {
    http_response_code(404);
    echo "Page not found";
}
```

## Refactor

Todo esto esta muy bien para fines teóricos pero este código no sigue la pautas [SOLID](https://www.digitalocean.com/community/conceptual_articles/s-o-l-i-d-the-first-five-principles-of-object-oriented-design) y esta bastante cohesionado  y cada validación va agregando complejidad. Es por ello que debemos llevar esto a otra instancia y construir un verdadero Router,

Dejo aquí una pautas para ello, cada ruta debe ser una instancia de la clase Route y tener una propiedades definidas, un método (GET, POST, PUT. Ect) , una expresión y manejador que puede ser la definición de un controller y su método o una función anónima que pasemos como parámetro. 

También debemos de crear una clase que se encargara de almacenar las rutas, podemos llamarla RouterCollection y un Despacher que tendrá la lógica de recorrer la colección de rutas instanciar el controlador asi como ejecutar el método.


