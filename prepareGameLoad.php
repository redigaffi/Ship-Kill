<?php
require 'init.php'; 
$site = 'Prepare'; 
$id  = $_GET['id'];
$sel = $_GET['sel'];
$_SESSION['gameId'] = $id;
$_SESSION['selId'] = $sel;
$game = new Game($mysql, $id, $sel);

//if(!$game->canJoin($_SESSION['user']['id']))
//	header('Location: ' . SITE . 'me.php');
?>

<!DOCTYPE html>

<html lang="es">
	<?php  include RSC . 'tpl/head.php'; ?>
	<script>
	$(document).ready(function()
	{
		isReadyGame();
		$('#statusPlayReadyGood').hide();
		$('#statusPlayReadyBad').hide();
		$('#LinkToGame').hide();
		setInterval(function()
		{
			isReadyGame();
		}, 3000);
	});
	</script>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>

		<div style="clear: both;"></div>

			<div class="statusPlayReady" id="statusPlayReadyGood">
				La partida está preparada, puede proceder a jugar. 
			</div>
			<div id="LinkToGame">
				<a href="./game.php?id=<?=$id;?>&selId=<?=$sel?>">Entrar a jugar!</a>
			</div>
			<div style="" class="statusPlayReady" id="statusPlayReadyBad">
				La partida aún no está preparada, por favor espere a su oponente y termine.
			</div>
		<section id="container" class="wrapper">
			<h3>Prepara tu flota</h3>
			<?php
				$game->CreateGame(5,5, 'select');
			?>
		</section>
		


		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>