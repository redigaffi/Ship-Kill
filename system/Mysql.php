<?php
/**
*	MySQL connection strings.
**/

define('USER', 'root');
define('PASS', 'd');
define('HOST', 'localhost');
define('DATA', 'game');

$mysql = new mysqli(HOST, USER, PASS, DATA);

if(!$mysql)
	exit('No se ha podido establecer una conexión con el servidor MySQL');
?>