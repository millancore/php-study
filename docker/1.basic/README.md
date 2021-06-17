# Basic Example

## Build Image

```
docker build -t <user>/<imageName>:<version> dir
```

## Windows multi-line command ( ` ) - Powershell

```
docker run --rm -d --name mysql `
-e MYSQL_ROOT_PASSWORD=secret `
-e MYSQL_DATABASE=example `
-v $pwd/data:/var/lib/mysql `
--network mynet mysql:5.7
```

```
docker run --rm -d --name myapp `
--network mynet -p 80:80 `
-v $pwd/var/www/html <user>/<imageName>:<version>
``` 
## Linux multi-line command ( \ )

```
docker run --rm -d --name mysql \
-e MYSQL_ROOT_PASSWORD=secret \
-e MYSQL_DATABASE=example \
-v $pwd/data:/var/lib/mysql \
--network mynet mysql:5.7
```

```
docker run --rm -d --name myapp \
--network mynet -p 80:80 \
-v $pwd/var/www/html <user>/<imageName>:<version>
``` 

