## HTTPD (Apache)

### Build image

```
docker build -t myhttpd:v1 apache
```

### Create Network

```
docker network create mynet
```

### Create Container

Windows multi-line Powershell

```
docker run --rm -d --name myapp `
-p 80:80 --network mynet `
-v $pwd/src:/var/www/html myhttpd:v1
```

Linux multi-line

```
docker run --rm -d --name myapp \
-p 80:80 --network mynet \
-v $pwd/src:/var/www/html myhttpd:v1
```

## PHP-FPM

### Create Container

Windows multi-line Powershell

```
docker run --rm -d --name php-fpm `
--network mynet -v $pwd/src:/var/www/html `
php:7.4-fpm-alpine
```

Linux multi-line

```
docker run --rm -d --name php-fpm / 
--network mynet -v $pwd/src:/var/www/html /
php:7.4-fpm-alpine
```