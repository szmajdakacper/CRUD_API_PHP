# PHP_CRUD_API

A simple API CRUD application with an example of use. The application is based on the sample "products" table from http://www.mysqltutorial.org.

<hr>
Files to change:<br>
1. api_app/config/log.txt<br>
-First line: mysql:dbname=DBNAME;host=HOSTNAME;charset=utf8<br>
-Second line: USERNAME<br>
-Third line: PASSWORT<br>
2. example/path.txt<br>
-First line: (for example) http://localhost/api_app/products/api<br>
<hr>
The application is based on the sample "products" table from http://www.mysqltutorial.org,<br>
MySQL-Dump with products is in main folder products.sql<br>
<hr>
Routes are defined in api_app/web.php<br>
<hr>
In folder Example is the easiest way to use this application,<br>
consists of files:<br>
-<strong>C</strong>reate.php<br>
-<strong>R</strong>ead.php<br>
-<strong>U</strong>pdate.php<br>
-<strong>D</strong>elete.php<br>
<hr>
<i>this application can be adapted to other databases and can be further developed</i>
