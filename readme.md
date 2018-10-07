# Journal
This is my first experience of developing Laravel with PHP. Instead of using Laravel Homestead, I will try run the envrionment with docker tools to not *pollute* my dev machine with VM. The following commands is run in windows. Mac and Linux users may need change sytax a little bit. 

Please install docker, if you like me use windows. If you use mac machine, you can use Valet to configure your computer. 

## To Run
```powershell
[comment]: # install all laravel depedencies
docker run --rm --interactive --tty --volume ${PWD}:/app composer install

[comment]: # start all the services
docker-compose up -d

[comment]: # migrate database
docker-compose exec app php artisan migrate

[comment]: # also can load some sample data
docker-compose exec app php artisan db:seed --class=SampleTasksSeeder

[comment]: # run some unit tests
docker-compose exec app ./vendor/bin/phpunit --filter TaskTest
```

Visit http://localhost:8080/

## Work on FED
```powershell
yarn install
yarn run watch
```

or you prefer npm
```powershell
npm install
npm run watch
```

to build FED assets
```powershell
yarn run dev
yarn run production
```

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

10. Create Model and Controller, keep add logic.

11. Use assets from this [Sample](https://github.com/Daivasmara/To-Do-List). Config build with laravel-mix, so we can build js and scss in laravel. Use yarn instead of npm. Use axios talk to back end instead of localStorage.




