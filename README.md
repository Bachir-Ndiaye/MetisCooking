# MetisCooking
Projet P2 - Wild Code School

## Goals
We are a team of 4 web developers with one goal : MAKE A FUNCTIONAL WEBSITE in less than 5 weeks.

Starting day : April, 7, 2021.

Our goal at the end of the project will be to have :

- Valid HTML, CSS, PHP ans JS 
- Well designed pages
- Uniformity of webpages
- Dynamic features 
- Deployable application


## Team

| Names  | Contact |
| ------------- |:-------------:|
| Amadou NDIAYE      | amadou.n-diaye@hotmail.com     |
| Marcel CATHELIN     | marcel671@gmail.com     |
| Lucas PREA |    lucas.sokha@gmail.com   |
| Said HOUSSOUNALI |    saidhoubebe@gmail.com   |

## Stack and tools
<div sttyle="display:flex; justify-content:space-around;">
  <h1> STACK </h1>
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/50/000000/css3.png" width="70"/></a> 
<a href=""><img src="https://img.icons8.com/color/48/000000/html-5--v1.png" width="70"/></a> 
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/sass.png" width="70"/></a> 
<a href=""><img src="https://img.icons8.com/color/48/000000/bootstrap.png" width="70"/></a> 
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/javascript.png" width="70"/></a> 
  <a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/mysql-logo.png" width="70"/></a>
  <a href="https://cssbattle.dev/player/amadou"><img src="https://www.php.net/images/logos/new-php-logo.png" width="70"/></a>
  
    <h1> TOOLS </h1>
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/material-outlined/48/000000/github.png" width="70"/></a>
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/git.png" width="70"/></a> 
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/intellij-idea.png" width="70"/></a> 
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/visual-studio.png" width="70"/></a>
<a href="https://cssbattle.dev/player/amadou"><img src="https://img.icons8.com/color/48/000000/console.png" width="70"/></a> 
<a href="https://cssbattle.dev/player/amadou"><img src="https://lh3.googleusercontent.com/proxy/5jw3IAMpKO4mIGZnyVMibS9-Cwwl_9DsGtL7RhB16q1TJSc14uNLD78Z6YkwFX7RA89HH54zZvBI179me3r8B-UNsTDoWZPPGZ07I3XVdmFMmetRsWHzKNg" width="70"/></a>
<a href="https://cssbattle.dev/player/amadou"><img src="https://twig.symfony.com/images/logo.png" width="70"/></a>

</div>


## You want to be a part of our project or test locally  the project ?

```
$ git clone https://github.com/Bachir-Ndiaye/MetissCooking/
$ git remote add origin https://github.com/Bachir-Ndiaye/MetissCooking/ (note that you can replace "origin" by whatever you want, i.e "project-p2")
$ git remote -v ( to see if the remote was added correctly)
$ composer install
```
> Create a db.php file to configure connexion to the database and copy paste this line of code for the db name (copy the db.php.dist and add your credentials) 

```
define('APP_DB_NAME', 'metiscooking');

```
> Make tables available in your database. Open a mysql CLI and run the command :

```
mysql> source mc.sql;
```
> To make test easier we created a default user and admin email and password to log in
```
User emil : user@metiscooking.fr
User password : 1234

Admin email : admin@metiscooking.fr
Admin password : admin
```
## Push your work ?

```
$ git branch (see if your are in the correct branch)
$ git status
$ git add . (if you work with a database or sensistive files create a .gitignore file)
$ git commit -m "a detailed message of what you have done or features added"
$ git push -u origin your_branch_name

```

One of the collaborators will validate your Pull Request if it's okay for us.



==================================================================================================================================================================




# Simple MVC

## Description

This repository is a simple PHP MVC structure from scratch.

It uses some cool vendors/libraries such as Twig and Grumphp.
For this one, just a simple example where users can choose one of their databases and see tables in it.

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import `simple-mvc.sql` in your SQL server,
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## Example 

An example (a basic list of items) is provided (you can load the *simple-mvc.sql* file in a test database). The accessible URLs are :

* Home page at [localhost:8000/](localhost:8000/)
* Items list at [localhost:8000/item/index](localhost:8000/item/index)
* Item details [localhost:8000/item/index/show/:id](localhost:8000/item/show/2)
* Item edit [localhost:8000/item/index/edit/:id](localhost:8000/item/edit/2)
* Item add [localhost:8000/item/index/add](localhost:8000/item/add)
* Item deletion [localhost:8000/item/index/delete/:id](localhost:8000/item/delete/2)

## How does URL routing work ?

![Simple MVC.png](https://raw.githubusercontent.com/WildCodeSchool/simple-mvc/master/Simple%20-%20MVC.png)
