<?php
session_start();//Iniciando a sessão
//Criação da classe
class Medico{
	private $conn; //instancio a variavel privada
	public $msgErro = "";
	//Método para conectar ao BD
	public function conectar($dbname, $host, $usuario, $senha){ //é o ponto de partida do código
		global $conn;
		//CONEXÃO
		try{
			$conn = new PDO("mysql:dbname=".$dbname.";host=".$host, $usuario, $senha);
		}
		catch(PDOException $e){ //erro no BD
			$msgErro - $e->getMessage();
		}
	}
	//Método para Cadastrar
	public function cadastrar($crm_medico, $nome, $cod_especialidade, $senha){
		global $conn;
		global $msgErro;
		//ANTES DE CADASTRAR VERIFICA SE JA TEM O CPF CADASTRADO
		//PRA ISSO BUSCO PELO CPF DO PACIENTE
		$sql = $conn->prepare("SELECT cod_medico FROM medicos WHERE crm_medico= :cm");
		$sql->bindValue(":cm", $crm_medico);
		$sql->execute();
		//verifica se o id veio ou não
		if ($sql->rowCount() > 0) {//cpf ja existe no BD
			return false;
		}else{//não foi encontrado o cpf
			$sql = $conn->prepare("INSERT INTO medicos (crm_medico, nome, cod_especialidade, senha) VALUES (:cm, :n, :ces, :s)");
			$sql->bindValue(":cm", $crm_medico);
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":ces", $cod_especialidade);
			$sql->bindValue(":s", md5($senha)); //MD5 faz a criptografia para embaralhar a senha
			$sql->execute();
			return true; //significa que foi cadastrada
		}
	}
	//Método para login
	public function logar($crm_medico, $senha){
		global $conn;
		global $msgErro;
		//verifica se o cpf e senha estao cadastrados, se sim
		$sql = $conn->prepare("SELECT * FROM medicos WHERE crm_medico = :cm AND senha = :s") or die ("Erro ao selecionar");
		$sql->bindValue(":cm", $crm_medico);
		$sql->bindValue(":s", md5($senha)); //MD5 faz a criptografia para 
		$sql->execute();
		//verifica se esse id veio
		if($sql->rowCount() > 0)
		{ //que esta cadastrada
			$dados = $sql->fetch(); //transforma em array
			$_SESSION['cod_medico'] = $dados['cod_medico'];
			return true; //logado com sucesso		
			}else{
				return false; //não foi possível logar
			}
		}
}
?>