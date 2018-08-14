<?php
	
	session_start();
	
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$id_usuario = $_SESSION['id_usuario'];
	$deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];
	
	if($id_usuario == '' || $deixar_seguir_id_usuario == ''){
		echo "Erro ao deixar de seguir usuário!";
		die();
	}
		
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	// Consulta ao BD
	$sql = "DELETE FROM usuarios_seguidores WHERE id_usuario = $id_usuario AND seguindo_id_usuario = $deixar_seguir_id_usuario";
	//echo $sql;
	mysqli_query($link, $sql);
?>