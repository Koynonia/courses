<?php
	
	session_start();
	
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$id_usuario = $_SESSION['id_usuario'];
	$seguir_id_usuario = $_POST['seguir_id_usuario'];
	
	if($id_usuario == '' || $seguir_id_usuario == ''){
		echo "Erro ao seguir usuário";
		die();
	}
		
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	// Consulta ao BD
	$sql = "INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) values($id_usuario,$seguir_id_usuario)";
	//echo $sql;
	mysqli_query($link, $sql);
?>
