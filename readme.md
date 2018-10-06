# Journal
This is my first experience of developing Laravel with PHP. Instead of using Laravel Homestead, I will try run the envrionment with docker tools to not *pollute* my dev machine with VM. The following commands is run in windows. Mac and Linux users may need change sytax a little bit. 

## Start from scratch
1. Initialize a repo
2. Copy laravel 5.7 [download](https://github.com/laravel/laravel/releases/tag/v5.7.0)
3. Rename readme.md to laravel.md, so I can put the document here. 
4. Install laravel depedency via composer docker image
```powershell
docker run --rm --interactive --tty --volume ${PWD}:/app composer install
```
> PS: You may see a list of suggestions to ask you install some php extensions. Just keep in mind these are not necessary. However, it is useful for us to setup our application image later.

5. Prepare php application image

laravel 5.7 dependencies:
- [x] PHP >= 7.1.3
- [x] OpenSSL PHP Extension
- [x] PDO PHP Extension
- [x] Mbstring PHP Extension
- [x] Tokenizer PHP Extension
- [x] XML PHP Extension
- [x] Ctype PHP Extension
- [x] JSON PHP Extension

We use php:7.2-fpm image which already have all the dependencies installed. 
To confirm we can run the following command
```powershell
docker run -it --rm php:7.2-fpm php -m
```
PS: Why we still need app.dockerfile if everything is ready. Because we want to control what we can install on them later.

6. Prepare reverse proxy image

We choose nginx:1.14 docker image and create a conf file vhost.conf to enable php

7. Create docker-compose.yml file to spin up all the containers. You can use the same command to update the running container as well.
```powershell
docker-compose up -d
```
To confirm all the container is up
```powershell
docker ps
```

8. Copy .env.example to .env for development, then generate the key
```powershell
docker-compose exec app php artisan key:generate
```

9. Visit [http://localhost:8080/](http://localhost:8080/)




