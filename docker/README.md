# Docker


## Docker run 

```bash
docker run [OPTIONS] IMAGE[:TAG] [COMMAND] [ARG...]
```
**Nota** en Windows multi-line use tick ( ` ) - Powershell

Built-in web server 

```bash
 docker run --rm \
 -p 9000:9000 \
 -v "$PWD":/var/www/html \
 php:7.4-alpine \
 php -S 0.0.0.0:9000 -t /var/www/html
```

Apache Server

```bash
docker run --rm \
-p 80:80 \
--name my-app \
-v "$PWD":/var/www/html \
 php:7.4-apache
```

 - `--rm` Remueve el contenedor cuando no este en ejecucion.
 - `-p` Vincula un puerto del host con uno de contenedor  `host:container` 
 - `-v` Monta una carpeta/archivo para ser compartida con el contenedor
 - `-d` Inicia el contenedor en modo no vinculado a la salida de logs
 - `-e` Agregar varibles de entorno `NAME=value`
 - `--name` Le agrega un identificador al contendor.

 `$PWD` (Print Working Directory) obtenemos el directorio actual desde el cual se ejecuta el comando.

 ## Comandos utiles

 Ver las extensiones habilidatas en una imagen

 ```bash
 docker run --rm \
 php:7.4-alpine \
 php -m
 ```
 Otras opciones ultiles con el comando php son.

 - `php -a` Modo interactivo
 - `php -i` Listar informacion de PHP similar a `phpinfo()` pero en formato texto puedes enviar el resultado a un archivo para hacer mas sencillo su analisis `php -i > phpinfo.txt`
 - `php --init` Ver las rutas para los archivos de configuracion de php.

Ver las varibles de entorno disponibles

 ```bash
 docker run --rm \
 php:7.4-alpine \
 printenv
 ```

 ## Docker Logs

 ```bash
  docker logs [OPTIONS] CONTAINER
```
| Opcion  | Descripción  |
|---|---|
| `--follow` , `-f` | Seguir la salida de logs |
| `--since` | Mostrar logs DESDE un fecha u tiempo relativo, ej: 1h, 40m, 2s |
| `--until` | Mostrar logs ANTES un fecha u tiempo relativo, ej: 1h, 40m, 2s |
| `--tail , -n` | Numero de lineas desde el final del log |
| `-t` | Ver el timestamp del log |



## Comandos de Docker

| Comando  | Descripción  |
|---|---|
| `docker start [id/name]` | Arranca un contenedor |
| `docker stop [id/name]` | Detiene un contenedor |
| `docker rm [id/name]` | Elimina un contener |
| `docker ps`  | Listar contenedores activos  | 
| `docker ps -a` | Listar todos los contenedores |
| `docker logs [id/name]` | Ver los logs de contendor |
| `docker exec [id/name] command` | Ejecutar un commando en el contenedor |
| `docker top [id/nane]` | Ver los procesos en ejecucion de un contenedor |
| `docker inspect [id/name]` | Ver la informacion del contendor |
| `docker attach [id/name]` | Vincularse a la salida estandar del contendor |


