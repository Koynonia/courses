<?php
	
		require_once('db.class.php');

		$sql = "SELECT * FROM usuarios";

		$objDb = new db();
		$link = $objDb->conecta_mysql();
	
		$resultado_id = mysqli_query($link, $sql);
	
		if($resultado_id){
			// Verifica se a conexão e a consulta tiveram êxito.
			// Recupera registros pelo indice (MYSQLI_NUM) ou pelo nome associativo do campo (MYSQLI_ASSOC), ou ambos (MYSQLI_BOTH).
			
			//$dados_usuario = mysqli_fetch_array($resultado_id, MYSQLI_NUM);
			//$dados_usuario = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			
			$dados_usuario = array();
			
			while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
				$dados_usuario[] = $linha;
			}
			
			// Exibe os registros do array
			//var_dump($dados_usuario);
			
			foreach($dados_usuario as $usuario){
				//var_dump($usuario);
				//var_dump($usuario['email']);
				echo $usuario['email'];
				echo '<br /><br />';
			}

		} else {
			echo 'Erro na execução da consulta! Favor entrar com o administrador do site!';
		}

?>