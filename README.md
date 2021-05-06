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

## Tools we are using

#### Github Project : 
To manage and monitore the project
#### Coolors.io :
Define a color panel

#### Canva : 
Design a logo

#### Visual Studio Code / IntelliJ : 
IDE

#### Git : 
Versionning and collaborate in team

#### Discord : 
Workshops and lives

#### Figma : 
Page models for mobile and desktop

## You want to be a part of our project or test locally  the project ?

```
$ git clone https://github.com/Bachir-Ndiaye/MetissCooking/
$ git remote add origin https://github.com/Bachir-Ndiaye/MetissCooking/ (note that you can replace "origin" by whatever you want, i.e "project-p2")
$ git remote -v ( to see if the remote was added correctly)
$ composer install
```
> Create a db.php file to configure connexion to the database and copy paste this line of code for th edb name (copy the db.php.dist and add your credentials) 

```
define('APP_DB_NAME', 'metiscooking');

```
> Make tables available in your database. Open a mysql CLI and run the command :

```
mysql> source mc.sql;
```
> To make test easier we created a default user and admin email and password to log in
```
User eamil : user@metiscooking.fr
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
## Update your work from distant repo ?

```
$ git fetch origin
$ git merge origin/branch_name 

```
One of the collaborators will validate your Pull Request if it's okay for us.
