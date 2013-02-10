<?php
/**
*	Clase dedicada a los usuarios
**/

class User
{
	private 	$id;
	public 		$user;
	private 	$pass;
	private 	$mysql;

	# Constructor de la clase.
	public function User($username, $password, $mysql)
	{
		$this->user 	= 	$username;
		$this->pass 	= 	$password;
		$this->mysql 	= 	$mysql;
	}

	# Autenticar al usuario
	public function login()
	{
		# Consulta al servidor MySQL
		$query = $this->mysql->query('SELECT *  FROM users WHERE email="' . $this->user . '" AND pass="' . $this->pass . '"');
		
		# Si ha devuelto algún registro con la entrada de usuarios.
		if($query->num_rows)
		{
			# Asignamos datos
			$userData 		= 	$query->fetch_assoc();
			$this->user 	= 	$userData['email'];
			$this->id 		= 	$userData['id'];

			# Creación de la sesión
			$_SESSION['user'] 			= 	$userData;

			# Eliminación de contraseña en la sesión
			$_SESSION['user']['pass']	= 	null;

			# Todo correcto.
			return 'correcto';
		}
		else
			return 'incorrecto';
	}
}
?>