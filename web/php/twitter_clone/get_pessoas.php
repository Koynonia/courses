<?php

	session_start();
	
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];
	
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	// Consulta ao BD
	$sql = " SELECT * FROM usuarios ";
	$sql.= " WHERE usuario LIKE '%$nome_pessoa%' AND id <> $id_usuario ";

	// Execusão da consulta
	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$registro['usuario'].'</strong> <small> - '.$registro['email'].' </small>';
				echo '<p class="list-group-item-text pull-right">';
						echo '<button type="button" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id'].'">Seguir</button>';
						echo '<button type="button" class="btn btn-primary btn_deixar_seguir" data-id_usuario="'.$registro['id'].'">Deixar de Seguir</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}
	} else {
			echo 'Erro na consulta de usuarios no Banco de Dados!';
	}
?>