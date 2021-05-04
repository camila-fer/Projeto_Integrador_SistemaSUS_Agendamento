<?php
  require_once 'classes/Pacientes.php'; //primeiro preciso trazer o documento para cá
  $doc = new Pacientes(); //instancio a classe Pacientes
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Importante ter essas duas metas-->
    <!--Significa que a largura vai ser igual ao dispositivo, escala inicial de zoom vai ser 1 e que ele não vai encolher em relação ao conteúdo-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale = 1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/estilo.css"> <!--CSS estilo-->
    <link rel="stylesheet" type="text/css" href="css/formCadas.css"> <!--CSS cadastro-->


    <!-- Pasta Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bibliotecas/css/bootstrap.min.css">
    <!--Link para kit fontawesome-->
    <script src="https://kit.fontawesome.com/a04173fc9f.js" crossorigin="anonymous"></script>

    <title>Cadastro</title>

    <style type="text/css"> /*estilo CSS*/        
      .row{
          margin-bottom: 10px;
      }
      body{
        margin-top: 100px; /*para que a barra de rolagem não coma as palavras/conteudos*/
        background-color: rgb(176,224,230);
      }
    </style>
</head>
<body>
    <!--Navegação-->
    <nav class="navbar fixed-top navbar-light bg-light navbar-expand-lg" id="menu">
      <!--Logo do site/brand-->
      <a class="navbar-brand" href="home.html">
        <img src="imagens/logoSus.png" width="80" height="30" class="d-inline-block align-top">
      </a>
      <!--Fim da logo-->

      <!--Para que os icones do menu apareçam-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav1" aria-controls="nav1" aria-expanded="false" aria-label="Navegação Toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="nav1">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="home.html" class="linha1 nav-link active" onclick="">Acesso á informações</a>
          </li>
        </ul>
      </div>
    </nav> <!--Fim do Menu-->

    <div class="container"> <!--Inicio do Container-->
      <div class="row rounded"> <!--Inicio da ROW-->

        <div class="second-column col-lg-5 col-md-6 col-sm-6"> <!--Segunda coluna-->
            <h2 class="title title-second"></h2>
            <form method="POST"> <!--Inicio do FORMULARIO-->
              <h2 class="title title-second">Cadastre-se aqui</h2>

            <div class="form-group">
              <label for="Tname">Nome Completo</label>
              <input type="text" class="form-control" id="Tname" name="nome" placeholder="Nome Completo" maxlength="30">
            </div>
            <div class="form-group">
              <label for="cCPF">CPF</label>
              <input type="text" class="form-control" name="cpf_paciente" id="cCPF" size="11" placeholder="Ex.: 12345678999" maxlength="11">
            </div>


              <div class="form-group "> <!--Campo senha-->
                <label for="TEnd">Endereço</label>
                <!--<i class="fas fa-lock icone-modificar"></i>-->
                <input type="text" class="form-control" name="endereco" id="TEnd" placeholder="Rua" maxlength="100">
              </div> <!--Fim campo senha-->
            <div class="form-group">
              <label for="cIda">Data de Nascimento</label>
              <input type="date" class="form-control" id="cIda" name="data_nascimento" placeholder="Ex.:Ex.: dd/mm/aaaa">
            </div>   

            <div class="form-group">
              <label for="cFone">Telefone com DDD</label>
              <input type="text" class="form-control" data-mask="(00) 0000-0000" name="telefone" id="cFone" size="" placeholder="Ex.: (00)0000-0000" maxlength="30">
            </div>
              <div class="form-group"> <!--Campo senha-->
                <label for="Csenha">Senha</label>
                <!--<i class="fas fa-lock icone-modificar"></i>-->
                <input type="password" class="form-control" name="senha" id="Csenha" placeholder="Digite sua Senha" maxlength="8">
              </div> <!--Fim campo senha-->

              <div class="form-group"> <!--Campo senha-->
                <label for="Csenha">Confirmar Senha</label>
                <!--<i class="fas fa-lock icone-modificar"></i>-->
                <input type="password" class="form-control" name="confirmaSenha" id="Csenha" placeholder="Confirme sua Senha" maxlength="8">

              </div> <!--Fim campo senha-->


              <button class="btn btn-info btn-block">Cadastrar</button> <!--Botão-->

            </form> <!--Fim do FORMULARIO-->
          </div> <!--Fim segunda coluna-->
      </div> <!--Fim da ROW-->
    </div> <!--Fim do Container-->
    <!--Implentação do PHP-->
    <?php
    //verifica se clicou no botao
    if(isset($_POST['nome']))
    { //isset verifaca a existencia de uma var
      //addslashes previne contra hackers
      $cpf_paciente = addslashes($_POST['cpf_paciente']);
      $nome = addslashes($_POST['nome']);
      $endereco = addslashes($_POST['endereco']);
      $data_nascimento = addslashes($_POST['data_nascimento']);
      $telefone = addslashes($_POST['telefone']);
      $senha = addslashes($_POST['senha']);
      $confirmaSenha = addslashes($_POST['confirmaSenha']);
      //verifica se todos os campos foram preenchidos
      if(!empty($cpf_paciente) && !empty($nome) && !empty($endereco) && !empty($data_nascimento) && !empty($telefone) && !empty($senha) && !empty($confirmaSenha))
      { //!empty = se não esta vazio
            //faz o envio
            $doc->conectar("db_susagendamento", "127.0.0.1", "root", "");
            //verifica se deu erro
            if($doc->msgErro == "")
            {//esta ok
                //primeiro verifica a confirmação da senha
                if($senha == $confirmaSenha)
                { //Inicio if senha e confirSenha
                        //cadastra
                        if($doc->cadastrar($cpf_paciente, $nome, $endereco, $data_nascimento, $telefone, $senha))
                        {
                            ?>
                            <div id="msg-sucesso" style="width: 36%; margin: 20px auto; padding: 10px; background-color: rgba(50,205,50,.3); font-size: 12pt; border: 1px solid rgb(34,139,34);">
                                Cadastrado com sucesso! Acesse para entrar!
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="msg-erro" style="width: 36%; margin: 20px auto; padding: 10px; background-color: rgba(250,128,114,.2); font-size: 12pt; border: 1px solid rgb(165, 42, 42);">
                                CPF já cadastrado!
                            </div>
                            <?php
                        }
                }//Fim if senha e confirSenha
                else
                {
                    ?>
                      <div class="msg-erro" style="width: 36%; margin: 20px auto; padding: 10px; background-color: rgba(250,128,114,.2); font-size: 12pt; border: 1px solid rgb(165, 42, 42);">
                          Senha e confirmar senha não correspondem!
                      </div>
                    <?php
                }
            }//fim doc->msgErro
            
            else
            { //else do if msg erro
                echo "Erro: ".$doc->msgErro;
            }
      }//Fim do if !empty = se não esta vazio
      else{
        ?>
          <div class=" container msg-erro" style="width: 36%; margin: 20px auto; padding: 10px; background-color: rgba(255,100,60,0.4); font-size: 12pt; border: 1px solid rgb(165, 42, 42);">
              Senha e confirmar senha não correspondem!
          </div>
        <?php 
      }
    } //Fim isset
    ?> <!--Fim da Implentação do PHP-->

    <!-- Footer -->
    <footer class="page-footer font-small">
      <!-- Copyright -->
      <div class="pfo footer-copyright text-center py-3">Copyright © 2020 Saúde Pública
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bibliotecas/js/jquery-3.5.1.min.js"></script>
    <script src="bibliotecas/js/popper.min.js"></script>
    <script src="bibliotecas/js/bootstrap.min.js"></script>
</body>
</html>