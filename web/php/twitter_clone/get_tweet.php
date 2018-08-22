<?php

	session_start();
	
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$id_usuario = $_SESSION['id_usuario'];
	
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	// Consulta ao BD
	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario ";
	$sql.= " FROM tweet AS t ";
	$sql.= " JOIN usuarios AS u ON (t.id_usuario = u.id) ";
	$sql.= " WHERE id_usuario = $id_usuario ";
	$sql.= " OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = $id_usuario) ";
	$sql.= " ORDER BY data_inclusao DESC ";

	// Execusão da consulta
	$resultado_id = mysqli_query($link, $sql);
	
	if($resultado_id){
		
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			//var_dump($registro);
			echo '<a href="#" class="list-group-item">';
				echo '<h4 class="list-group-item-heading">'.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
				echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
			echo '</a>';
		}
	} else {
			echo 'Erro na consulta de tweets no Banco de Dados!';
	}
?>