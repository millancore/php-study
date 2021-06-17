# Dockerfile

### FROM
 indica la imagen base sobre la que se construirá la imagen.

 ```
 FROM php:7.4-alpine
 ```

 ### ARG
Podemos definir variables para ser usadas en el momento de costrucion de la imagen.

```
ARG HTTPD_CONF=/usr/local/apache2/conf
```

### LABEL
Agrega meta datos a la imagen
```
LABEL author="Juan Millan"
LABEL version="1.0"
LABEL description="My PHP App"
```

### RUN
Nos permite ejecutar comandos en la creacion de imagen.

```
RUN docker-php-ext-install mysqli
```

### ENV

Establece variables de entorno.

```
APP_VERSION=1.3.2
```

### COPY
```
COPY . /app
```

### ADD
Agregar archivos a la imagen permite enviar archivos comprimidos o desde una url.

```
ADD myapp.tar /var/www/html
```

### EXPOSE
Esta instrucción especifica que puertos estaran disponibles para escucha en tiempo de ejecución.

```
EXPOSE 80 443
```

### USER
determina el nombre de usuario a utilizar cuando se ejecuta un contenedor, y adicionalmente cuando se ejecutan comandos.

### WORKDIR
Nos permite definir el directorio de trabajo es util si luego queremos ejecutar `RUN` en algun directorio epecifico.

### ENTRYPOINT

la instrucción entrypoint define el comando y los parámetros que se ejecutan primero cuando se ejecuta el contenedor.

```
ENTRYPOINT ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
```

## Construir imagen

```
 docker build [OPTIONS] PATH | URL | -
```

`-t` Agrega una etiqueta a la imagen

```
docker build -t myapp:v1 .
```

`-f` Especifica un Dockefile para la construccion de la imagen


```
docker build -t myapp:xdebug -f Dockerfile.debug
```