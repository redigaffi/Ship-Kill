<?php
class Game
{
	public 		$gameId;
	public 		$selId;
	private 	$sql;
	private     $max_check = 5;

	public function Game($sql, $id, $sel)
	{
		$this->gameId 	= $id;
		$this->sql 		= $sql;
		if(empty($sel))
			$this->selId 		= 1;
		else
			$this->selId 		= $sel;
	}

	public function canJoin($id)
	{

		$q = $this->sql->query('SELECT `to_id`, `by` FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();

		if( ($q['to_id'] == $id) || ($q['by'] == $id) )
			return true;
		else
			return false;

	}

	public function checkPointCount($cId)
	{
		# Quien está seleccionando de los dos jugadores.
		$sel = 'selected'.$this->selId;
		
		# Consulta MySQL.
		$q = $this->sql->query('SELECT '.$sel.' FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();

		#Si está vacio puede tirar.
		if(empty($q[$sel]))
		{
			# Consulta actualizando el tiro.
			$this->sql->query('UPDATE `games` SET  '.$sel.'="'.$cId.'" WHERE id = "'.$this->gameId.'" ');

			# Todo bien.
			return 'good';
		}
		# Si ya ha tirado una, o más veces.
		else
		{
			# Seleccionamos que id's ya ha seleccionado
			$data = explode(':', $q[$sel]);

			# Contamos cuantos ha seleccionado
			$count = count($data);

			# Si no ha llegado a tirar más de los permitidos.
			if($count < $this->max_check)
			{

				# Si no ha seleccionado una ID ya seleccionada.
				if( !in_array($cId, $data) )
				{
					# Obtenemos las ID's ya seleccionadas.
					$string = $q[$sel];

					# Añadimos la nueva ID al final de las deás.
					$string .= ':'.$cId;

					# Ejecutamos la consulta con la nueva ID.
					$this->sql->query('UPDATE `games` SET  '.$sel.'="'.$string.'" WHERE id = "'.$this->gameId.'" ');

					# Todo bien.
					return 'good';
				}
				else
					# Ya se ha seleccionado la ID actual.
					return 'selected';
			}
			else 
				# Ya no puedes seleccionar más [Has llegado al límite].
				return 'finish';
		}
	}
	 
	public function isReadyGame()
	{
		$q = $this->sql->query('SELECT selected1, selected2 FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();

		$count1 = count(explode(':', $q['selected1']));
		$count2 = count(explode(':', $q['selected2']));

		if( ($count1 == $this->max_check) && ($count2 == $this->max_check) )
			return 1;
		else
			return 0;
	}

	public function CreateGame($c, $r, $do = 'select')
	{
		$count = 0;
		

		echo '<table class="gameTable">';
		for($a = 0; $a < $c; $a++)
		{

			echo '<tr>';
			for($b = 0; $b < $r; $b++)
			{?>
				<td onclick="<?=$do.'('.$count.')'?>;" id="<?=$count?>"></td>
			<?php
				++$count;
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	public function selectAttacked()
	{
		if($this->selId == 2)
		{
			$at = 'attacked1';
			$sel = 'selected2';
		}
		elseif ($this->selId == 1) 
		{
			$at = 'attacked2';
			$sel = 'selected1';
		}

		$q = $this->sql->query('SELECT '.$at.','.$sel.' FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();

		$get = explode(':', $q[$sel]);
		$at  = explode(':', $q[$at]);

		$attacked = '';
		foreach($at as $value)
		{
			if( in_array($value, $get) )
				$attacked .=  $value.':';
			else
				return 'none';
		}

		return $attacked;
	}

	public function playerTurn()
	{
		$q = $this->sql->query('SELECT `turn` FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();
		return $q['turn'];
	}

	public function attack($cId)
	{

		$at = 'attacked' . $this->selId;

		$q = $this->sql->query('SELECT `'.$at.'`,`by`,`to_id` FROM games WHERE id="'.$this->gameId.'"');
		$q = $q->fetch_assoc();

		if( $_SESSION['user']['id'] == $this->playerTurn() )
		{

			if( !empty($cId) )
			{
				if( $_SESSION['user']['id'] == $q['by'] )
					$newId = $q['to_id'];
				else
					$newId = $q['by'];

				if( empty($q[$at]) )
					$this->sql->query('UPDATE `games` SET  '.$at.'="'.$cId.'", turn="'.$newId.'" WHERE id = "'.$this->gameId.'" ');
				else
				{
					$new = $q[$at] . ':' . $cId;
					$this->sql->query('UPDATE `games` SET  '.$at.'="'.$new.'", turn="'.$newId.'" WHERE id = "'.$this->gameId.'" ');

				}
			}

			return 'turn_true';
		}
		else
			return 'turn_false';
	}

	public function getChats()
	{
		$q = $this->sql->query('SELECT * FROM chat WHERE chatId="'.$this->gameId.'"');
		$text = '';
		while( $data = $q->fetch_assoc() )
		{
			$getUser = $this->sql->query('SELECT name FROM users WHERE id="'.$data['id'].'"');
			$getUser = $getUser->fetch_assoc();
			$text 	.= '<strong>'. $getUser['name'] . '</strong> Envió - ' . $data['msg']  . ':';
		}
		return $text;

	}

}
?>
