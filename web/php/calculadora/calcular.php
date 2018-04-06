<?php

require_once 'classes/Calculadora.php';

$num1 	= $_POST['numero1'];
$num2 	= $_POST['numero2'];
$op 		= $_POST['operacao'];

$calculadora = new Calculadora();

$calculadora->setNum1( $num1 );
$calculadora->setNum2( $num2 );

$calculadora->somar();

switch( $op ){
	case 'somar':
		$calculadora->somar();
		break;
	case 'subtrair':
		$calculadora->subtrair();
		break;
	case 'multiplicar':
		$calculadora->multiplicar();
		break;
	case 'dividir':
		$calculadora->dividir();
		break;
}
echo $calculadora->getTotal();

?>