<?php
  ob_start();
  require_once 'app/classes/Pacientes.php';
  $doc = new Pacientes();
?>
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
    <link rel="stylesheet" type="text/css" href="public/bibliotecas/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="public/css/sb-admin.min.css">

    <title>Saúde Pública</title>

    <style type="text/css">      
      .row{
          margin-bottom: 10px;
      }
      body{
        margin-top:; /*para que a barra de rolagem não coma as palavras/conteudos*/
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
                  <a class="nav-link mt-4" href="#">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text" id="titulo">Meu perfil</span>
                  </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right">
                  <a class="nav-link active" href="listaPacientes.php">
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
            Lista de Pacientes
          </div>        
        </div>

        <!--TABELA-->
        <div class="row" style="margin: 20px;">
            <div class="">
                <h1>Tabela</h1>
            </div>
        </div>
        <div class="card mb-3"> <!--Card-->
            <div class="card-header">
                <!--cabeçalho da tabela-->
                <i class="fa fa-table"></i>
                Listagem de Pacientes
            </div>
            <!--Corpo da tabela-->
            <div class="card-body">

                <!--começo da estrutura da tabela-->
                <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
                    <thead>
                        <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th class="col-2">Ação</th>
                        </tr>
                    </thead>
                <!-- ==================== PHP PARA LISTAR PACIENTES ========================= -->
                <?php
                  $doc->conectar("db_susagendamento", "127.0.0.1", "root", ""); //conecta com o BD
                  $dados = $doc->buscarDados();
                  if(count($dados) > 0)
                  {
                      for ($i=0; $i < count($dados); $i++) {
                          echo "<tr>"; //abro o tr 
                          foreach ($dados[$i] as $k => $v) {
                              if($k != "cod_paciente"){ //se a coluna é dife de id
                                  echo "<td>".$v."</td>";
                              }
                          }
                          ?>
                          <td>
                               <a class="btn btn-danger btn-sm" href="listaPacientes.php?cod_paciente=<?php echo $dados[$i]['cod_paciente'];?>">Excluir</a>
                          </td>
                          <?php
                          echo "</tr>"; //fecho o tr
                      }
                  }
                ?>
                <!-- ==================== FIM DO PHP PARA LISTAR PACIENTES ========================= -->

                    <!--tfoot recebe os valores da th acima-->
                    <tfoot>
                         <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th class="col-2">Ação</th>
                        </tr>                     
                    </tfoot>
                    <!--Pega os valores correspondentes no BD-->
                    <tbody>              
           
                    </tbody>
                </table>
            </div>
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
    <script src="public/bibliotecas/datatables/jquery.dataTables.js"></script>
    <script src="public/bibliotecas/datatables/dataTables.bootstrap4.js"></script>
    <script src="public/js/sb-admin.min.js" type="text/javascript"></script>
    <script src="public/js/sb-admin-datatables.min.js" type="text/javascript"></script>

</body>
</html>

<!-- ================ PHP PEGA O COD PARA EXCLUIR =================== -->
<?php
  $doc->conectar("db_susagendamento", "127.0.0.1", "root", ""); //conecta com o BD
  if (isset($_GET['cod_paciente'])) {//se a variavel existir
    $cod_paciente = addslashes($_GET['cod_paciente']);
    $doc->excluirPaciente($cod_paciente);
    //depois que excluir preciso atualizar a página
    header("location: listaPacientes.php");
  }

?>