<!DOCTYPE html>
<?php require 'init.php'; $site = 'Indice'; ?>

<html lang="es">
	<?php include RSC . 'tpl/head.php'; ?>
	<script>
	/**
	*	Al finalizar la carga del documento.
	*
	**/
	$(document).ready(function()
	{
		loadInBox('#container', './ressources/tpl/ajax/index.php', 'Índice - Ship Kill');
		$('#intro_sexy_tweet').scrollTo('40%');
	});
	</script>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>

		<section id="container" class="wrapper"></section>
		<div style="clear: both;"></div>
		<section id="intro_sexy">
			<div class="wrapper">
					<h3>El Desarrollador: ( @JWHC_ )</h3>

					<div id="intro_sexy_tweet"><?php require SYS . 'tweets.php'; ?></div>
			</div>
		</section>

		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>