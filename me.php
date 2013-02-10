<!DOCTYPE html>
<?php require 'init.php'; $site = 'Me'; ?>
<script>
	/**
	*	Al finalizar la carga del documento.
	*
	**/
	$(document).ready(function()
	{
		loadInBox('#container', './ressources/tpl/ajax/index.php', 'Índice - Ship Kill');
	});
</script>
<html lang="es">
	<?php include RSC . 'tpl/head.php'; ?>

	<body>
		<?php include RSC . 'tpl/header.php'; ?>

		<section id="container" class="wrapper"></section>
		<div style="clear: both;"></div>

		<?php include RSC . 'tpl/footer.php'; ?>
	</body>
</html>