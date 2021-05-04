<?php
	session_start(); //inicia a sessão
	unset($_SESSION['cod_paciente']); //Destrói a sessão privada
	header('Location: index.php'); //Volta para o index
?>