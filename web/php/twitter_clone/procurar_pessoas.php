<?php
	session_start();

	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');
	
	// Instancia do objeto DB
	$objDb = new db();

	// Conexão com o BD
	$link = $objDb->conecta_mysql();
	
	$id_usuario = $_SESSION['id_usuario'];
	
	//-- qtd de tweets
	$sql = "SELECT COUNT(*) AS qtd_tweets FROM tweet WHERE id_usuario = $id_usuario ";
	
	// Execusão da consulta
	$resultado_id = mysqli_query($link, $sql);
	
	$qtd_tweets = 0;
	
	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_tweets = $registro['qtd_tweets'];
	} else {
		echo 'Erro ao executar a query';
	}
	
	//-- qtd de seguidores
	$sql = "SELECT COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";
	$resultado_id = mysqli_query($link, $sql);
	$qtd_seguidores = 0;
	
	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_seguidores = $registro['qtd_seguidores'];
	} else {
		echo 'Erro ao executar a query';
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">

			$(document).ready(function(){

				$('#btn_procurar_pessoa').click(function(){

					if($('#nome_pessoa').val().length > 0){

							$.ajax({
								url: 'get_pessoas.php',
								method: 'post',
								data: $('#form_procurar_pessoas').serialize(),
								success: function(data){
									$('#pessoas').html(data);
									
									$('.btn_seguir').click( function(){
										// A função seletora ($), com o "this" recupera o 
										// atributo personalizado do elemento clicado (data-id_usuario),
										// atribuindo à uma variavel "id_usuario".
										var id_usuario = $(this).data('id_usuario');
										// A função hide() esconde o botão.
										$('#btn_seguir_'+id_usuario).hide();
										// A função show() exibe o botão
										$('#btn_deixar_seguir_'+id_usuario).show();
										
										$.ajax({
											url: 'seguir.php',
											method: 'post',
											data: { seguir_id_usuario: id_usuario },
											success: function(data){
												alert('Registro efetuado com sucesso!');
											}
										});
									});
									
									$('.btn_deixar_seguir').click( function(){
										
										var id_usuario = $(this).data('id_usuario');
										// A função show() exibe o botão.
										$('#btn_seguir_'+id_usuario).show();
										// A função hide() esconde o botão
										$('#btn_deixar_seguir_'+id_usuario).hide();
										
										$.ajax({
											url: 'deixar_seguir.php',
											method: 'post',
											data: { deixar_seguir_id_usuario: id_usuario },
											success: function(data){
												alert('Registro removido com sucesso!');
											}
										});
									});
								}
							});
					}

				});
				
			});

		</script>

	</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png" />
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="home.php">Home</a></li>
						<li><a href="sair.php">Sair</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


		<div class="container">
			<div class="col-sm-3 col-md-3">
				<div class="panel panel-defaultr">
					<div class="panel-body">
						<h4><?= $_SESSION['usuario'] ?></h4>
						<hr />
						<div class="col-sm-6 col-md-6">
							TWEETS <br /> <?= $qtd_tweets ?>
						</div>
						<div class="col-sm-6 col-md-6">
							SEGUIDORES <br /> <?= $qtd_seguidores ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="form_procurar_pessoas" class="input-group">
							<input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem você está procurando?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_procurar_pessoa" type="button">Procurar</button>
							</span>
						</form>
					</div>
				</div>
				
				<div id="pessoas" class="list-group">
					
				</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>