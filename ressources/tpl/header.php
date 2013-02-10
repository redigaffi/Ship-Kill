<header>
	<div class="wrapper">
		<div id="text_header"><strong>S</strong>pace Marine</div>
		<?php if(empty($_SESSION)):?>
			<div id="login_header"><a href="#" onclick="loadInBox('#container', './ressources/tpl/ajax/login.php', 'Login - Ship Kill');">Acceder</a> - <a href="#">Registro</a></div>
		<?php else: ?>
			<div id="loggedin_header"><span style="color: green;">Conectado como:</span> <p id="user"><?=$_SESSION['user']['name'];?></p> &nbsp; • <p id="logout">Desconexión</p></div>
		<?php endif;?>
		
	</div>
</header>
<nav>
	<?=getMenu('#container', $site, true);?>
</nav>