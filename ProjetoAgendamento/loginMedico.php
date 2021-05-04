<?php
  ob_start();
  require_once 'app/classes/Medico.php';
  $doc = new Medico();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Importante ter essas duas metas-->
    <!--Significa que a largura vai ser igual ao dispositivo, escala inicial de zoom vai ser 1 e que ele não vai encolher em relação ao conteúdo-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale = 1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- Pasta Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="public/bibliotecas/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/bibliotecas/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/sb-admin.min.css">

    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <title>Saúde Pública</title>

    <style type="text/css">      
      .row{
          margin-bottom: 10px;
      }
      body{
        margin-top:; /*para que a barra de rolagem não coma as palavras/conteudos*/
        background-color: rgb(176,224,230);
      }
    </style>

    <script> /*script jquery*/
      $(document).ready(function(){
        //verifica se os campos de usuário e senha foram devidamente preenchidos
        $('#btn_login').click(function(){
          var campo_vazio = false;
          //condição para o campo usuario
          if($('#campo_crm').val() == ''){ //caso o campo não possua valor as bordas ficam vermelhas
            $('#campo_crm').css({'border-color': '#A94442'});
            campo_vazio = true;
          }else{ //caso o campo seja preenchido fica cinza
            $('#campo_crm').css({'border-color': '#CCC'});
          }
          //condição para o campo senha
          if($('#campo_senha').val() == ''){ //caso o campo não possua valor as bordas ficam vermelhas
            $('#campo_senha').css({'border-color': '#A94442'});
            campo_vazio = true;
          } else{ //caso o campo seja preenchido fica cinza
            $('#campo_senha').css({'border-color': '#CCC'});
          }
          if(campo_vazio) return false;         
        });
      });           
    </script>
</head>
<body> 
    <!--Navegação-->
    <nav class="navbar fixed-top navbar-dark bg-light navbar-expand-lg" id="menu">
      <!--Logo do site/brand-->
      <a class="navbar-brand" href="index.php">
        <img src="imagens/logoSus.png" width="80" height="30" class="d-inline-block align-top">
      </a>
      <!--Fim da logo-->
      <div class="collapse navbar-collapse justify-content-between" id="nav1">
        <ul class="navbar-nav ml-auto">
            <button type="button" class="btn btn-info btn-sm">
            <a href="index.php" class="linha1 nav-link active" onclick="">Voltar para login do paciente</a>
            </button>
        </ul>
      </div>

    </nav> <!--Fim do Menu-->

    <div class="container"> <!--Inicio do Container-->
      <div class="row rounded"> <!--Inicio da ROW-->
        <div class="first-column col-lg-4 col-md-6 col-sm-6"> <!--Primeira coluna-->
            <h2 class="title title-primary">Bem-vindo(a)!</h2>
            <p class="description description-primary">Aqui é a área do profissional em que poderá visualizar consultas marcadas pelos pacientes e listar todos pacientes cadastrados no sistema.</p>
            <p class="pCadastro">Ainda não é cadastrado?</p> 
            <!--Botão para cadastro-->
            <a class="btn btn-sm btn-outline-light" href="cadastroMedico.php" role="button"><i class="fa fa-fw fa-user"></i>&nbsp;Cadastre-se aqui</a>               
        </div> <!--Fim primeira coluna-->

        <div class="second-column col-lg-5 col-md-6 col-sm-6"> <!--Segunda coluna-->
          <h2 class="title title-second"></h2>
          <form method="POST"> <!--Inicio do FORMULARIO-->
            <h2 class="title title-second">Entrar como profissional</h2>
            <div class="form-group"> <!--Campo cpf-->
              <label class="badge badge-info" for="campo_crm">CRM</label>
              <input type="number" class="form-control" name="crm_medico" id="campo_crm" size="11" maxlength="11" placeholder="Digite o CRM">           
            </div> <!--Fim Campo cpf-->

            <div class="form-group"> <!--Campo senha-->
              <label class="badge badge-info" for="campo_senha">Senha</label>
              <input type="password" class="form-control" name="senha" id="campo_senha" placeholder="Digite sua Senha">
            </div> <!--Fim campo senha-->

            <button class="btn btn-info btn-block" id="btn_login">Entrar</button> <!--Botão-->
          </form> <!--Fim do FORMULARIO-->
        </div> <!--Fim segunda coluna-->
      </div> <!--Fim da ROW-->



    </div> <!--Fim do Container-->
  <!-- =================== Implentação do PHP ====================== -->
  <?php
  //verifica se clicou no botao
  if(isset($_POST['crm_medico']))
  { //isset verifaca a existencia de uma var
    //addslashes previne contra hackers
    $crm_medico = addslashes($_POST['crm_medico']);
    $senha = addslashes($_POST['senha']);

    if(!empty($crm_medico) && !empty($senha)) //verifica se todos os campos foram preenchidos
    { //!empty = se não esta vazio
        $doc->conectar("db_susagendamento", "127.0.0.1", "root", ""); //conecta com o BD
        //verifica se deu erro
        if($doc->msgErro == "")
        {//inicio if doc erro esta ok
            if($doc->logar($crm_medico, $senha))
            {//inicio if logar
              header("location: painelMedico.php");
            }//fim if logar
            else
            {//inicio else logar
              ?>
                <div class="msg-erro" style="width: 36%; margin: 2px auto; padding: 10px; background-color: rgba(250,128,114,.2); font-size: 12pt; border: 1px solid rgb(165, 42, 42);">
                    CPF e/ou senha estão incorretos!
                </div>
              <?php
            }//fim else logar
        }//fim if doc erro
        else
        {//else doc erro
          ?>
            <div class="msg-erro">
              <?echo "Erro: ".$doc->msgErro; ?>
            </div>
          <?php
        }//fim else doc erro
      } //Fim do if !empty
    else
    {
      ?>
        <div class="msg-erro" style="width: 36%; margin: 2px auto; padding: 10px; background-color: rgba(250,128,114,.2); font-size: 12pt; border: 1px solid rgb(165, 42, 42);">
           Preencha todos os campos! 
        </div>
      <?php
    }
  }//isset verifaca a existencia de uma var
  ?>
  <!--Fim da Implentação do PHP-->

  <!-- Footer -->
  <footer class="page-footer font-small">
    <!-- Copyright -->
    <div class="pfo footer-copyright text-center py-3">Copyright © 2020 - <?=date('Y')?> Saúde Pública</div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="public/bibliotecas/jquery/jquery.min.js"></script>
    <script src="public/bibliotecas/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/bibliotecas/jquery-easing/jquery.easing.min.js"></script>
    <script src="public/js/sb-admin.min.js" type="text/javascript"></script>

</body>
</html>