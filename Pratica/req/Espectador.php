<?php
// Apenas para testes
// include ('DB.php');
class Espectador {

	protected $id;
	protected $email;
	protected $logado;
	protected $nivel;

	public function __construct(){
		$this->logado = false;
		$this->nivel = 3;
	}

	public function logar($email,$senha){
		
		// Criando conexão com o banco de dados
		$db = new DB();

		// Definir a string da consulta
		$sql = "SELECT * FROM usuarios WHERE email=:email";

		// Preparo a consulta;
		$select = $db->prepare($sql);

		// Executa a consulta
		$select->execute(
			[
				':email' => $email
			]
		);

		// Leio o resultado
		$result = $select->fetch(PDO::FETCH_ASSOC);
		var_dump($result);

		if(password_verify($senha, $result['senha'])) {
			$this->logado = true;
			return true;
		} else {
			return false;
		}
	}

}

// TESTE
// $e = new Espectador();
// if($e->logar('espectador@teste','teste')){
// 	echo 'Viva! Logou com sucesso!!!';
// } else {
// 	echo 'Não logou';
// }