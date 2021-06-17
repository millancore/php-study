# Plug and Play

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