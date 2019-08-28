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
		$sql = "SELECT id,senha FROM usuarios WHERE email=:email";

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

		// Verificando senha
		if($result){
			if(password_verify($senha, $result['senha'])) {
				$this->id = $result['id'];	
				$this->email = $email;
				$this->logado = true;
				return true;
			} else {
			return false;
			}
		}
	}

	// Criando método para ler mensagens do banco de dados!
	public function lerMensagens(){

		// criando conexão com o banco de dados
		$db = new DB();

		// Definir a string da consulta
		$sql = "SELECT 
					m.id,
					u.email, 
					m.texto, 
					m.hora
				FROM 
					mensagens m 
					INNER JOIN usuarios u ON u.id = m.id_usuario;";

		// Preparo a consulta:
		$select = $db->prepare($sql);

		// Executa a consulta
		$select->execute();

		// Leio o resultado
		$result = $select->fetchAll(PDO::FETCH_ASSOC);

		// Retornar o resultado/as mensagens
		return $result;

	}
	
	public function getEmail() {
		return $this->email;
	}

}

// TESTE
// $e = new Espectador();
// if($e->logar('espectador@teste','teste')){
// 	echo 'Viva! Logou com sucesso!!!';
// } else {
// 	echo 'Não logou';
// }