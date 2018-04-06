<?php

class Calculadora{
	
	private $total;
	private $num1;
	private $num2;
	
	function __construct(){
		$this->total = 0;
		$this->num1  = 0;
		$this->num2  = 0;
	}
	
	public function setNum1($parametro_num1){
		$this->num1 = $parametro_num1;
	}
	
	public function setNum2($parametro_num2){
		$this->num2 = $parametro_num2;
	}
	
	public function somar(){
		$this->total = $this->num1 + $this->num2;
	}
	
	public function subtrair(){
		$this->total = $this->num1 - $this->num2;
	}
	
	public function multiplicar(){
		$this->total = $this->num1 * $this->num2;
	}
	
	public function dividir(){
		$this->total = $this->num1 / $this->num2;
	}
	
	public function getTotal(){
		return $this->total;
	}
}

?>