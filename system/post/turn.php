<?php
require '../../init.php';
$game = new Game($mysql, $_SESSION['gameId'], $_SESSION['selId']);
if ( $game->attack()  == 'turn_false' )
	echo 0;
elseif( $game->attack()  == 'turn_true' )
	echo 1;
?>