<?php
	
		session_start();
	
		require_once('db.class.php');

		$usuario = $_POST['usuario'];
		$senha = md5($_POST['senha']);

		$sql = "SELECT id, usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

		$objDb = new db();
		$link = $objDb->conecta_mysql();
	
	// update = true/false
	// insert = true/false
	// select = false/resorce
	// delete true/false
	
		$resultado_id = mysqli_query($link, $sql);
	
		if($resultado_id){
			// Verifica se a conexão e a consulta tiveram êxito
			$dados_usuario = mysqli_fetch_array($resultado_id);
			// Verifica se retornou o registro
			if(isset($dados_usuario['usuario'])){
			
					$_SESSION['id_usuario'] = $dados_usuario['id'];
					$_SESSION['usuario'] = $dados_usuario['usuario'];
					$_SESSION['email'] = $dados_usuario['email'];
			
					header('Location: home.php');
			} else {
		 			header('Location: index.php?erro=1');
			}
		} else {
			echo 'Erro na execução da consulta! Favor entrar com o administrador do site!';
		}

?>