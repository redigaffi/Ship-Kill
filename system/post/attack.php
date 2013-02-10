<?php
require '../../init.php';
$game = new Game($mysql, $_SESSION['gameId'], $_SESSION['selId']);
echo $game->attack($_POST['cId']);
?>