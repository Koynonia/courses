<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<title>Mensagens divertidas</title>
	</head>

	<body>

		<?php
		# Tipos de saída:
		echo '<strong>01.</strong> Teste de impressão com <strong>echo</strong><br /><br />';
		print ('<strong>02.</strong> Teste de impressão com <strong>print</strong><br /><br />');

		# Declaração de variáveis (o tipo é feito na atribuição) e concatenação:
		$valor = 10.5 * 2;
		$texto = '<strong>03. Variáveis</strong> em PHP recebem o tipo na sua atribuição, não necessitando declarar = ';
		echo $texto.$valor.'<br /><br />';
		echo "<strong>04.</strong> Ou pode imprimir variáveis usando <strong>aspas duplas</strong>: $valor<br /><br />";

		# Formas de declarar ARRAYS:
		$mensagens_divertidas['a'] = 'Estou fazendo as contas aqui e este mês não tem jeito, vou ter que ganhar na loteria.';
		$mensagens_divertidas['b'] = 'As 3 coisas que as mulheres mais gostam de ouvir: Eu te amo, 50% de desconto e como você emagreceu!';
		$mensagens_divertidas[3] = 'Cara feia pra mim é espelho!';
		$mensagens_divertidas[4] = 'Estou tão carente que o churrasqueiro chega e diz: "Coração?" e eu respondo: "O que foi amor?".';
		$mensagens_divertidas[5] = 'O casamento é um relacionamento a dois, no qual uma das pessoas está sempre crta e a outra é o marido.';

		# Forma de declarar Array 2:
		$teste = 'Teste com variável';

		$mensagens_divertidas_paramentro = array(
			'a' => 2,
			'b' => true,
			3 => -7.15,
			4 => $teste,
			5 => 'Isto é uma string.'
		);

		echo '<strong>05. Impressão pela função var_dump():</strong><br />';
		var_dump($mensagens_divertidas);
		echo '<br /><br /><strong>06. Impressão pela função print_r():</strong><br />';
		print_r($mensagens_divertidas);
		echo '<br /><br /><strong>07. Impressão pelo echo de uma posição do Array:</strong><br />';
		echo $mensagens_divertidas[3];
		echo '<br /><br /><strong>08. Impressão pelo print de uma posição do Array:</strong><br />';
		print $mensagens_divertidas['a'];
		echo '<br /><br /><strong>09. Os índices do Array podem combinar valores alfa-numéricos:</strong><br />';
		echo '$mensagens_divertidas["a"]<br />';
		echo '$mensagens_divertidas[3]<br /><br />';
		echo '<strong>10. Atribuindo vários tipos para os índices do ARRAY:</strong>';
		echo '<br/>';
		var_dump($mensagens_divertidas_paramentro);
		?>
		
	</body>
</html>