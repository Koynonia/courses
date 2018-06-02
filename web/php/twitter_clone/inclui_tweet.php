<?php
	
	session_start();
	
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$id_usuario = $_SESSION['id_usuario'];
	$texto_tweet = $_POST['texto_tweet'];
	
	if($texto_tweet == '' || $id_usuario == ''){
		echo "erro ao incluir tweet!";
		die();
	}
		
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	// Consulta ao BD
	$sql = "INSERT INTO tweet(id_usuario, tweet) values('$id_usuario','$texto_tweet')";
	
	mysqli_query($link, $sql);
?>