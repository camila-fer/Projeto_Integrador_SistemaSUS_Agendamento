<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Importante ter essas duas metas-->
    <!--Significa que a largura vai ser igual ao dispositivo, escala inicial de zoom vai ser 1 e que ele não vai encolher em relação ao conteúdo-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale = 1, shrink-to-fit=no">

    <!-- Pasta Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="public/bibliotecas/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/bibliotecas/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/sb-admin.min.css">

    <title>Saúde Pública</title>

    <style type="text/css">      
      .row{
          margin-bottom: 10px;
      }
      body{
        margin-top:; /*para que a barra de rolagem não coma as palavras/conteudos*/
        background-color: rgb(95,158,160);
      }
    </style>

</head>
<body class="bg-light navbar-light fixed-nav sticky-footer" id="page-top"> 
    <!--Navegação-->
    <nav class="navbar navbar-expand-lg navbar-info bg-light fixed-top" id="mainNav">
      <!--Logo do site/brand-->
      <a class="navbar-brand" href="home.html">
        <img src="imagens/logoSus.png" width="90" height="35" class="d-inline-block align-top">
      </a>
      <!--Fim da logo-->
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarPaciente" aria-control="navbarPaciente" aria-expended="false" aria-label="Navegacao Toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarPaciente" class="collapse navbar-collapse">
          <ul class="navbar-nav navbar-sidenav">
              <li class="nav-item" data-toggle="tooltip" data-placement="right">
                  <a class="nav-link mt-4 active" href="#">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text" id="titulo">Meu perfil</span>
                  </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right">
                  <a class="nav-link" href="listaPacientes.php">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text" id="titulo">Lista de pacientes</span>
                  </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right">
                  <a class="nav-link" href="#">
                    <i class="fa fa-fw fa-clipboard"></i>
                    <span class="nav-link-text" id="titulo">Minha agenda</span>
                  </a>
              </li>
          </ul>
          <!--Para esconder a lista do lado-->
          <ul class="navbar-nav sidenav-toggler">
              <li class="nav-item">
                  <a id="sidenavToggler" class="nav-link text-center">
                    <i class="fa fa-fw fa-angle-left"></i>
                  </a>
              </li>
          </ul>
          <!--Links do Menu-->
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <form class="form-inline my-2 my-lg-0 mr-lg-2">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Pesquisar por...">
                          <span class="input-group-btn">
                              <button class="btn btn-secondary" type="button">
                                  <i class="fa fa-search"></i>
                              </button>
                          </span>
                      </div>
                  </form>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="sair.php">
                      <i class="fa fa-sign-out">Sair</i>
                  </a>
              </li>
          </ul>

      </div>      
    </nav>

    <!--Conteudo-->
    <div class="content-wrapper" style="background-color: rgb(220,220,220);">
        <div class="container-fluid">
          <div class="alert alert-light" role="alert">
            Painel Médico
          </div>        
        </div>
        <!--RODAPÉ-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright Saúde Pública 2020 -  <?=date('Y')?></small>
                </div>              
            </div>
        </footer>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="public/bibliotecas/jquery/jquery.min.js"></script>
    <script src="public/bibliotecas/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/bibliotecas/jquery-easing/jquery.easing.min.js"></script>
    <script src="public/js/sb-admin.min.js" type="text/javascript"></script>

</body>
</html>