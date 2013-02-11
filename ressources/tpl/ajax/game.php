<?php include '../../../init.php'; 
$query = $mysql->query('SELECT * FROM games');
?>
<h3>Partidas disponibles para ti</h3>
<p>
	<table id="game">
	<tr>
		<th>ID 				</th>
		<th>Nombre			</th>
		<th>Iniciado Por:	</th>
		<th>&nbsp;</th>
	</tr>
	<?php while( $data = $query->fetch_assoc() ): 	
	if($_SESSION['user']['id'] == $data['by'])
		$link = 1;
	else
		$link = 2;
	?>
	<tr>
		<td><?=$data['id']?></td>
		<td><?=$data['name']?></td>
		<td><?=$data['by']?></td>
		<td><a href="<?=SITE.'prepareGameLoad.php?id='.$data['id'] . '&sel='.$link;?>">Entrar</a></td>
	</tr>
	<?php endwhile; ?>
	</table>
</p>