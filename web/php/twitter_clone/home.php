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

				$('#btn_tweet').click(function(){

					if($('#texto_tweet').val().length > 0){

							$.ajax({
								url: 'inclui_tweet.php',
								method: 'post',
								// Em caso de formularios com varios campos, usa-se a função do jquery 'serialize'
								// que retorna a propriedade 'name' como chaves dos campos e seus valores de uma tag 'form',
								// e retornando um JSON, exemplo:
								data: $('#form_tweet').serialize(),
								// ou poderia ser campo a campo, usando a tag "div"
								//data: { texto_tweet: $('#texto_tweet').val() },
								success: function(data){
									$('#texto_tweet').val('');
									atualizaTweet();
								}
							});
					}

				});
				
				function atualizaTweet(){
					$.ajax({
						url: 'get_tweet.php',
						success: function(data){
							$('#tweets').html(data);
						}
					});
				}
				atualizaTweet();
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
						<form id="form_tweet" class="input-group">
							<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
							</span>
						</form>
					</div>
				</div>
				
				<div id="tweets" class="list-group">
					
				</div>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>
			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>