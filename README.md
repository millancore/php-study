# php-study-group
Grupo de estudio de PHP en https://frontend.cafe


## Instalacion de PHP

### Windows

la forma mas sencilla de comenzar a trabajar con PHP en windows a atraves de la instalacion de XAMP, XAMP es un programa que trae lo necesesario para comenzar a crear nuestra app en PHP

- Un servidor HTTP - Apache
- Un motor de base de datos - MySQL
- Y PHP

Puedes descargar XAMP desde este link [https://www.apachefriends.org/download.html]()

Una vez tenemos instalado XAMP podemos comprobar que podemos ejecutar php desde la consola de windows (cmd).

Escribiendo en la consola `php -v`

> Nota: Es importante especificar el parametro `-v` de lo contrario php se quedara a la espera de un archivo para interpretar.

> Nota: Si al ejecutar `php -v` te lanza un error es que debemos agregar a la variables de entorno el ejecutable de PHP, XAMP por defecto  instala PHP en la ruta `C:\xamp\php`, aqui podemos ver como agregar esta ruta al path. [https://www.neoguias.com/agregar-directorio-path-windows/]()

Una vez podemos ver en consola la version de php es hora de comenzar a trabajar con php.

## Servidor integrado

PHP trae consigo un servidor HTTP perfecto para comenzar a desarrollar nuestra app. (no se recomienda su uso en produccion)

para hacer uso de este basta con que vayamos a la carpeta donde tenemos nuestro codigo PHP y ejecutemos en la consola.

`php -S localhost:8000`

por defecto los servidores HTTP cargan el archivo con nombre `index.php` asi que puede ser un buen comienzo para nuestra web.

Si tenemos una directorio de archivos de la siguente forma.

```
.
├── users
│   ├── index.php
│   └── detail.php
└── index.php
```
Las rutas validas seran las siguentes 

`http://localhost:8000`
`http://localhost:8000/users`
`http://localhost:8000/users/detail.php`

Esta es la forma basica en la que un servidor HTTP resuelve las urls. 

> Esta forma es valida pero nos obliga a manejar las solicitudes de manera individual en cada archivo, por lo que los frameworks y aplicaciones modernas sugieren usar unico punto de entrada para las solicitudes.

Podemos definir a nuestro servidor HTTP un archivo para que se encargue de recibir todas las request y desde ahi manejaremos las respuestas.

`php -S localhost:8000 router.php`

> No es necesario de que este archivo se llame `router.php` puede ser el `index.php` u otro.


## Obteniendo datos de la request.

Tenemos un formulario de html.

```html
<form method="POST" action="process.php">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 

```

En este formulario sera procesado por el script con nombre `process.php` si no definimos ningun sera procesado por el actual. 

Hay varias formas de obtener los datos que envia el formulario. 

Si viene por `GET` lo podemos hacer mediante la variable de PHP `$_GET` que nos retornara una array con los datos.

Si es por `POST` usaremos `$_POST` o podemos obtener el cuerpo de la solucitud independientemente del metodo que se uso con `$_REQUEST`.

## Request 

Una request esta compuesta por 3 partes, un Request line que es la url mas el metodo, las cabeceras o headers que enviar informacion del navegador, cookies, auth, y/o las que definamos y un cuerpo.

para obtener la informacion de los headers podemos usar la funcion `getallheaders()`


Tambien podemos encontrar informacion general de la request en la variable `$_SERVER` esta sera de especial utilidad a la hora de enrutar el request a uno u otro script (controlador etc)