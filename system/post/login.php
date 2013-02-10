<?php
require '../../init.php';
//require SYS . 'User.php';
//require SYS . 'Mysql.php';

# Filtrar entrada
$email 	= 	$_POST['email'];
$pass 	= 	$_POST['pass'];

if(empty($email) || empty($pass))
	exit();

# Instanciar al usuario
$user = new User($email, $pass, $mysql);

# Comprobar los datos introducidos.
echo $user->Login();
?>