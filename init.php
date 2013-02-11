<?php

/**
*	Inicializar la sesión.
**/
session_start();

/**
* 	Rutas de sistema.
**/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(realpath(__FILE__)));
define('RSC', ROOT . DS . 'ressources' . DS);
define('SYS', ROOT . DS . 'system' . DS);
define('SITE', 'http://localhost/game/');
define('SITE_DATA', SITE . 'ressources/');

/**
* 	Información del juego.
**/
define('VERSION', '0.1 A');
define('GAME', 'Ship Kill');


/**
*	Incluiciones Generales
*
**/
require SYS . 'Mysql.php';

/**
* 	Estructura del menu.
**/
$menu = 
	[

		/** 
		* 	Enlaces sin Ajax.
		*	Nombre del enlace | url hacía el enlace.
		**/
		'Indice_N' => 
					[
						'Índice' 		=> 	'#',
						'About' 		=> 	'#',
						'Sistema' 		=> 	'#',
						'Jugabilidad'	=> 	'#'
					],

		/** 
		* 	Enlaces con Ajax.
		*	Nombre del enlace | archivo a cargar en ./system/ajax/[ARCHIVO].
		**/
		'Indice_A' => 
					[
						'Índice' 		=> 	'index',
						'About' 		=> 	'about',
						'Sistema' 		=> 	'system',
						'Jugabilidad'	=> 	'gaming'
					],

		'Me_N' => 
				[
					'Perfil' => '#',
					'Perfil' => '#',
					'Perfil' => '#',
					'Perfil' => '#'
				],

		'Me_A' => 
				[
					'Perfil' 		=> 'profile',
					'Partidas' 		=> 'game',
					'Ranking' 		=> 'rank',
					'Personaje'		=> 'person'
				]
	];

/**
* 	Obtener el resultado dependiendo de el sitio.
**/
function getTitle($site, $separator = '-', $afterText)
{
	return $site . ' ' . $separator . ' ' . $afterText;
}

/**
*	Obtener el menu dependiendo del sitio actual.
*
**/
function getMenu($selector, $site, $ajax = false)
{
	global $menu; 

	if(!$ajax)
	{
		foreach($menu[$site.'_N'] as $name => $link)
			echo '<a href="' . $link . '">' . $name . '</a>';
	}
	else
	{
		foreach($menu[$site.'_A'] as $name => $site): 
			$title = getTitle($name, '-', GAME);
			?>
			<a href="#" onclick="loadInBox('<?=$selector;?>', '<?=SITE.'ressources/tpl/ajax/'.$site.'.php';?>', '<?=$title;?>');"><?=$name?></a>
		<?php endforeach;
	}
}

/**
*	Autocarga de clases.
*
**/
function __autoload($name)
{
	require SYS . $name . '.php';
}

?>
