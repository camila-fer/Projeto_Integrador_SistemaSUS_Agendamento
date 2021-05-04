<?php
session_start();//Iniciando a sessão
//Criação da classe
class Pacientes{
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
	public function cadastrar($cpf_paciente, $nome, $endereco, $data_nascimento, $telefone, $senha){
		global $conn;
		global $msgErro;
		//ANTES DE CADASTRAR VERIFICA SE JA TEM O CPF CADASTRADO
		//PRA ISSO BUSCO PELO CPF DO PACIENTE
		$sql = $conn->prepare("SELECT cod_paciente FROM pacientes WHERE cpf_paciente = :c");
		$sql->bindValue(":c", $cpf_paciente);
		$sql->execute();
		//verifica se o id veio ou não
		if ($sql->rowCount() > 0) {//cpf ja existe no BD
			return false;
		}else{//não foi encontrado o cpf
			$sql = $conn->prepare("INSERT INTO pacientes (cpf_paciente, nome, endereco, data_nascimento, telefone, senha) VALUES (:c, :n, :en, :dN, :t, :s)");
			$sql->bindValue(":c", $cpf_paciente);
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":en", $endereco);
			$sql->bindValue(":dN", $data_nascimento);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":s", md5($senha)); //MD5 faz a criptografia para embaralhar a senha
			$sql->execute();
			return true; //significa que foi cadastrada
		}
	}
	//Método para login
	public function logar($cpf_paciente, $senha){
		global $conn;
		global $msgErro;
		//verifica se o cpf e senha estao cadastrados, se sim
		$sql = $conn->prepare("SELECT * FROM pacientes WHERE cpf_paciente = :c AND senha = :s") or die ("Erro ao selecionar");
		$sql->bindValue(":c", $cpf_paciente);
		$sql->bindValue(":s", md5($senha)); //MD5 faz a criptografia para 
		$sql->execute();
		//verifica se esse id veio
		if($sql->rowCount() > 0)
		{ //que esta cadastrada
			$dados = $sql->fetch(); //transforma em array
			$_SESSION['cod_paciente'] = $dados['cod_paciente'];
			return true; //logado com sucesso		
			}else{
				return false; //não foi possível logar
			}
		}

	//MÉTODO que busca as infos no BD e colocar no canto direito da tela
	public function buscarDados(){
		global $conn;
		global $msgErro;

		$result = array(); //caso esteja vazio não da nenhum erro
		$cmd = $conn->query("SELECT cod_paciente, cpf_paciente, nome, data_nascimento, endereco, telefone FROM pacientes ORDER BY nome");
		//PDO::FETCH_ASSOC = economiza memória
		$result = $cmd->fetchAll(PDO::FETCH_ASSOC); //variavel em forma de array
		return $result; //retorna a variavel
	}
	//Método para excluir pessoa
	public function excluirPaciente($cod_paciente){
		global $conn;
		global $msgErro;

		$cmd = $conn->prepare("DELETE FROM pacientes WHERE cod_paciente = :cod");
		$cmd->bindValue(":cod", $cod_paciente);
		$cmd->execute();
	}

	//MÉTODO BUSCAR DADOS DE UMA PESSOA
	public function buscarDadosPessoa($cod_paciente){ //passo por parametro o id
		//caso não venha os dados
		$result = array();
		$cmd = $conn->prepare("SELECT * FROM pacientes WHERE cod_paciente = :cod");
		//substituição
		$cmd->bindValue(":cod", $cod_paciente);
		$cmd->execute();
		$result = $cmd->fetch(PDO::FETCH_ASSOC); //transforma a variavel
		return $result;


	}


	//MÉTODO ATUALIZAR DADOS NO BD
	public function atualizarDados($nome, $data_nascimento, $endereco, $telefone){
		$cmd = $conn->prepare("UPDATE pacientes SET nome = :n, data_nascimento = :dN, endereco = :en, telefone = :t WHERE cod_paciente = :cod");
		$cmd->bindValue(":n", $nome);
		$cmd->bindValue(":dN", $data_nascimento);
		$cmd->bindValue(":en", $endereco);
		$cmd->bindValue(":t", $telefone);
		$cmd->bindValue(":cod", $cod_paciente);
		$cmd->execute();
	}

}
?>