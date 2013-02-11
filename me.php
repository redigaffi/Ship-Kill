<!DOCTYPE html>
<?php require 'init.php'; $site = 'Me'; ?>

<html lang="es">
	<?php include RSC . 'tpl/head.php'; ?>
	<script>
		/**
		*	Al finalizar la carga del documento.
		*
		**/
		$(document).ready(function()
		{
			loadInBox('#container', './ressources/tpl/ajax/profile.php', 'Índice - Ship Kill');
		});
	</script>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>

		<section id="container" class="wrapper">dd</section>
		<div style="clear: both;"></div>

		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>