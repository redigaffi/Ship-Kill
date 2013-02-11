

/**
*	Cambiar el titulo
*	var site: nombre de página actua.
**/
function changeTitle(site)
{
	$(document).attr("title", site);
}

/**
* 	Carga con Ajax en box.
*	
*	var select: 	#identificador o .clase a cargar en.	
* 	var file: 		archivo a cargan en.
**/
function loadInBox(select, file, site)
{
	$(select).load(file).hide().fadeIn('slow');
	changeTitle(site);
}

/**
*	Comprueba los mensajes de error ocurridos al conectar un usuario.
*
*/
function checkLoginError(errorCode)
{
	switch(errorCode)
	{
		case 'correcto':
			window.location.href = './me.php';
		break;

		case 'incorrecto':
			alert('el usuario es incorrecto');
		break;

	}
}

/**
*	Loguea usuarios con ajax y devuelve mensaje.
*
**/
function loginUser(email1, pass1)
{
	$.post('./system/post/login.php', { email: email1, pass: pass1}, function(returnCode)
	{
		checkLoginError(returnCode);
	});
}

/**
*	Conseguir celda id de la celda presionada.
*
**/
function getId(tid)
{
	$.post('./ajax.php', { aId: $().val(),  pId: $().val(), id:tid }, function(data)
	{
		var get = parseInt(data);
		if(get)
		{
			$('table tr td#'+tid).html('<img src="./point.png" />');
		}
		else
			alert('noob');
	});
}

/**
*	Seleccionar que campos
**/
function select(id)
{
	$.post('./system/post/selectPoints.php', { sId: id }, function(data)
	{
		switch(data)
		{
			// Se ha seleccionado
			case 'good':
				$('table tr td#'+id).html('<center><img src="./ressources/img/point.png" /></center>');
			break;

			// El campo ya está seleccionado
			case 'selected':
				alert('ya esta seleccionado');
			break;

			// No se puede seleccionar nada más.
			case 'finish':
				alert('finish');
			break;
		}

	});
}

function isReadyGame()
{
	$.post('./system/post/isReadyGame.php', {}, function(data)
	{
		var num = parseInt(data);
		switch(num)
		{
			case 0:
				$('#statusPlayReadyGood').hide();
				$('#statusPlayReadyBad').hide().fadeIn('slow');
				$('#LinkToGame').hide();


			break;

			case 1:
				$('#statusPlayReadyBad').hide();
				$('#statusPlayReadyGood').hide().fadeIn('slow');
				$('#LinkToGame').hide().fadeIn('slow');

			break;
		}
	});
}

function checkAttacks()
{
	$.post('./system/post/checkAttacked.php', { }, function(data)
	{

		if(data == 'none')
		{
			
		}
		else
		{
			var arr = data.split(':');
			var text = '';

			for(a in arr)
			{
				if(arr[a] == '')
				{

				}
				else
				{
					text += '<span id="position">¡ALERTA! </span> Le han atacado, POSICION ' + arr[a] + '.<br />';			
					$('table tr td#'+arr[a]).html('<center><img src="./ressources/img/cancel.png" /></center>');
					
				}
			}

			$('#attackedZones').html(text);
		}


	});
}

function attack(id)
{
	
	$.post('./system/post/attack.php', { cId: id }, function(data)
	{
		switch(data)
		{
			case 'turn_false':
				alert('No es tu turno');
			break;
		}
	});
}

function MyTurn()
{
	$.post('./system/post/turn.php', {}, function(data)
	{
		var num = parseInt(data);
		if(num)
		{
			$('#myTurnFalse').hide()
			$('#myTurnTrue').hide().fadeIn('slow');
		}
		else
		{
			$('#myTurnTrue').hide();
			$('#myTurnFalse').hide().fadeIn('slow');
		}
	});
}