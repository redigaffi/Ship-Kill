<?php
require 'init.php'; 
$site = 'Play'; 

$game = new Game($mysql, $_SESSION['gameId'], $_SESSION['selId']);

if(!$game->canJoin($_SESSION['user']['id']))
	header('Location: ' . SITE . 'me.php');
?>

<!DOCTYPE html>

<html lang="es">
	<?php  include RSC . 'tpl/head.php'; ?>
	<script>
	$(document).ready(function()
	{
		$('#myTurnTrue').hide();
		$('#myTurnFalse').hide();

		refreshChat('#chats');
		MyTurn();
		checkAttacks();
		setInterval(function()
		{
			MyTurn();
			checkAttacks();
		}, 2000);

	});
	</script>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>
		<div id="myTurnTrue">Tu Turno</div>

		<div id="chat">
			<h3>Chat</h3>
			<div id="chats"></div>
			<input placeholder="Escribe tu mensaje" id="sendText" type="text"></input>
			<button onclick="sendChat('#sendText');	">Enviar</button>
		</div>

		<div id="myTurnFalse">Espera Tu Turno</div>
		<div style="" id="attackedZones"></div>

		<section id="container" class="wrapper">
			<h3>Ataca a tu oponente</h3>
			<?php $game->CreateGame(5,5,'attack'); ?>
		</section>
		


		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>