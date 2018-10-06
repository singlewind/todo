# Journal
This is my first experience of developing Laravel with PHP. Instead of using Laravel Homestead, I will try run the envrionment with docker tools to not *pollute* my dev machine with VM. The following commands is run in windows. Mac and Linux users may need change sytax a little bit. 

## start from scratch
1. init a repo
2. copy laravel 5.7 [download](https://github.com/laravel/laravel/releases/tag/v5.7.0)
3. rename readme.md to laravel.md, so I can put the document here. 
4. install laravel depedency via composer docker image
```PowerShell
docker run --rm --interactive --tty --volume ${PWD}:/app composer install
```
> PS: You may see a list of suggestions to ask you install some php extensions. Just keep in mind these are not necessary. However, it is useful for us to setup our application image later.


