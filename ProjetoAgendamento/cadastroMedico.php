<?php
  require_once 'app/classes/Medico.php'; //primeiro preciso trazer o documento para cá
  $doc = new Medico(); //instancio a classe Pacientes
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Importante ter essas duas metas-->
    <!--Significa que a largura vai ser igual ao dispositivo, escala inicial de zoom vai ser 1 e que ele não vai encolher em relação ao conteúdo-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale = 1, shrink-to-fit=no">

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
    <nav class="navbar fixed-top navbar-dark bg-light navbar-expand-lg" id="menu">
      <!--Logo do site/brand-->
      <a class="navbar-brand" href="index.php">
        <img src="imagens/logoSus.png" width="80" height="30" class="d-inline-block align-top">
      </a>
      <!--Fim da logo-->

      <!--Para que os icones do menu apareçam-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav1" aria-controls="nav1" aria-expanded="false" aria-label="Navegação Toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="nav1">
        <ul class="navbar-nav ml-auto">
      <div class="collapse navbar-collapse justify-content-between" id="nav1">
        <ul class="navbar-nav ml-auto">
            <button type="button" class="btn btn-info btn-sm">
              <a href="index.php" class="linha1 nav-link active" onclick=""><i class="fa fa-sign-out">Logar profissional</i></a>
            </button>
        </ul>
      </div>
        </ul>
      </div>
    </nav> <!--Fim do Menu-->

    <div class="container"> <!--Inicio do Container-->
      <div class="row rounded"> <!--Inicio da ROW-->

        <div class="second-column col-lg-5 col-md-6 col-sm-6"> <!--Segunda coluna-->
            <h2 class="title title-second"></h2>
            <form method="POST"> <!--Inicio do FORMULARIO-->
              <h2 class="title title-second">Cadastrar Profissional</h2>

            <div class="form-group">
              <label for="crm">CRM</label>
              <input type="text" class="form-control" name="crm_medico" id="crm" size="11" placeholder="Ex.: 12345678999" maxlength="30">
            </div>

            <div class="form-group">
              <label for="Tname">Nome Completo</label>
              <input type="text" class="form-control" id="Tname" name="nome" placeholder="Nome Completo" maxlength="30">
            </div>

            <div class="form-group">
              <label for="especi">Especialidade</label>
              <select class="form-control" name="cod_especialidade" id="especi">
                <option value="">Selecione...</option>
                <option>Clinico Geral</option>
                <option>Psicólogo</option>
              </select>
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

    <!-- ================ Implentação do PHP ========================= -->
    <?php
    //verifica se clicou no botao
    if(isset($_POST['nome']))
    { //isset verifaca a existencia de uma var
      //addslashes previne contra hackers
      $crm_medico = addslashes($_POST['crm_medico']);
      $nome = addslashes($_POST['nome']);
      $cod_especialidade = addslashes($_POST['cod_especialidade']);
      $senha = addslashes($_POST['senha']);
      $confirmaSenha = addslashes($_POST['confirmaSenha']);
      //verifica se todos os campos foram preenchidos
      if(!empty($crm_medico) && !empty($nome) && !empty($cod_especialidade) && !empty($senha) && !empty($confirmaSenha))
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
                        if($doc->cadastrar($crm_medico, $nome, $cod_especialidade, $senha))
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
      <div class="pfo footer-copyright text-center py-3">Copyright © 2020 - <?=date('Y')?> Saúde Pública</div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bibliotecas/js/jquery-3.5.1.min.js"></script>
    <script src="bibliotecas/js/popper.min.js"></script>
    <script src="bibliotecas/js/bootstrap.min.js"></script>
</body>
</html>