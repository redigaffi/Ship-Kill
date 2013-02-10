<?php
require 'init.php'; 
$site = 'Play'; 

$game = new Game($mysql, $_SESSION['gameId'], $_SESSION['selId']);

//if(!$game->canJoin($_SESSION['user']['id']))
//	header('Location: ' . SITE . 'me.php');
?>

<!DOCTYPE html>

<html lang="es">
	<?php  include RSC . 'tpl/head.php'; ?>
	<script>
	$(document).ready(function()
	{
		setInterval(function()
		{
				checkAttacks();
		},3000);
	});
	</script>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>

		<div id="attackedZones">
			dd
		</div>

		<section id="container" class="wrapper">
			<h3>Ataca a tu oponente</h3>
			<?php
				$game->CreateGame(5,5,'attack');
			?>
		</section>
		


		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>