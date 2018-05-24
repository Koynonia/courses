<?php

class db {
	
	private $host = 'linoox.com.br';
	private $usuario = 'linoox_admin';
	private $senha = 'sh@l0N20';
	private $database = 'linoox_twitter';
	
	public function conecta_mysql(){
		
		// Cria a conexão
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
		
		// Ajustar o charset de comunicação entre a aplicação e o banco de dados
		mysqli_set_charset($con, 'utf8');
		
		// Verificar se houve erros de conexão
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar com o BD MySQL: \n\n'.mysqli_connect_error();
		}
		
		return $con;
	}
}

?>