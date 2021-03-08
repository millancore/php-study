# Composer

Composer es el administrador de paquetes de PHP,  y nos proporciona un estándar para la administración, instalación y descarga de librerías.

Composer también nos brinda una forma estandarizada de cargar nuestras clases y archivos   gracias al autoload, ahora veremos como usar esta característica de componer.

Puedes descargar composer en la pagina oficial: https://getcomposer.org

**Instalador de Windows:** https://getcomposer.org/doc/00-intro.md#installation-windows

## Autoload

Para compreder el autoload debemos retroceder un poco en tiempo antes de que PHP fuera un lenguaje orientado a objetos, en aquel entonces (y ahora)  para usar variables y funciones escritas en otro archivo  se hace uso de `include`, `include_once` o `require`. `require_once`. 

```php
<?php

require_once 'anotherfile.php'

```

> la diferencia de `include` y `require` radica en como el interprete falla en caso de que archivo no existe, en caso de `include` lanzara un warning y la ejecución del script continuara, con el  `require` sera un error fatal y se interrumpirá la ejecución en ese punto.

>las opciones `incluide_once` y `require_once` indican que el archivo solo debe incluir una sola vez en el caso se que trate de incluir en otro script.

Con la llegada de los objectos a PHP se hizo necesario incluir los espacios de nombre `namespaces` que permiten que existan clases con el mismo nombre en sin que esto cree conflictos, también se creo una forma de hacer los include o require dinámicamente a partir de esos espacio de nombre de esa manera se enviaba tener que incluir los archivos y definir los namespaces que se fueran a usar.

Y esto dio como inicio el primer PSR o [PSR-0](https://www.php-fig.org/psr/psr-0/) (ahora deprecated)  que dio la pauta para un carga de archivos a través de los namespaces. 

### PSR-4 (PHP Standards Recommendations)

[PSR-4](https://www.php-fig.org/psr/psr-4/) es el estándar actual que se usa para la carga de clases a través de los namespaces y es el que usaremos en el archivo composer.json de la siguiente manera

```json
{
    "autoload": {
        "psr-4": {
            "Fec\\": "app/"
        }
    }
}
```

> Es importante resaltar que el nombre del primer namespace lo definimos nosotros y lo vinculamos con un directorio de ahí en adelante los subnamespaces sera determinados por el nombre de directorios.

luego de agregar el autload a nuestro `composer.json` debemos de ejecutar el siguente comando.

```bash
 composer dump
```


Ahora bien, que namespace debería tener mi clase PHP siguendo el PSR-4, para tener un ejemplo claro, si tenemos la siguente estruturas de carpetas.

```
.
├── app
│   ├── Model
|   |    └── UserModel.php
│   └── Controller
|        └── Api
|             └── InvoiceController.php
└── index.php
```

Asi deberan ser los namespaces de clases `UserModel` y `InvoiceController`

```php
<?php
namespace Fec\Model;

class UserModel { }
```

```php
<?php
namespace Fec\Controller\Api;

class InvoiceController { }
```

Si queremos hacer uso de esta clase en otro script debemos incluir su namespace con `use` de la siguente manera.

```php
<?php

use Fec\Model\UserModel;
use Fec\Controller\Api\InvoiceController;

$user = new UserModel;
$invoiceController = new InvoiceController;

```
Como nota final no hay que olvidar que lo que crea el composer es un archivo que hace uso de la funcion [spl_autoload_register](https://www.php.net/manual/es/function.spl-autoload-register.php) siguendo el estandar PSR-4 es por ello que este archivo debe ser incluido en alguna parte de nuestro proyecto de forma traducional, por lo general se incluye en el `index.php` pero tambien podemos encontrarlo en `bootstrap.php` de la siguente manera.

```php
require_once 'vendor/autoload.php';
```

