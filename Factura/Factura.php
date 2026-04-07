<?php
session_start();
require_once('../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if(($rol != 3)) { 
  $error = $_SESSION['Error'];      
  $_SESSION['Error']  = "Sesion no iniciada";   
  header('location: ../Usuario/Usuario.php');   
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Centro </title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="../css/style-starter.css">
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
  <link href="../css/style.min1.css" rel="stylesheet">
</head>
  <?php
      if (isset($_SESSION["Error"])) {
            $error=$_SESSION["Error"];
            echo "<br>$error";
      }
  ?>

<body class="sidebar-menu-collapsed">
  <section>
    <div class="sidebar-menu sticky-sidebar-menu">
      <div class="logo info-color">
        <h1><a href="../Administrador/Perfil.php"> 
          Perfil 
        </a>
      </h1>
    </div>
    <div class="logo-icon text-center gris">
      <a href="#" title="logo"><img src="../img/logo.png" alt="logo-icon"> </a>
    </div>
    <div class="sidebar-menu-inner">
      <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="fondoperfil">
          <a class="colorperfil">
            <span class="nombre">
              <img class="rounded-circle fotop" height="70px" src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['foto']); ?>">
            </td>
            <br>
            <center> 
              <?php echo ''.$_SESSION['nombre']; ?>
            </center>
          </span>
        </a>
        <hr>
      </li>

      <li>
        <a href="../Administrador/Perfil.php">
          <i class="fas fa-user colores"></i>
          <span> Perfil </span>
        </a>
      </li>
      <li>
        <a href="../Administrador/Contratos.php?Ver=<?php echo $Id;?>">
          <i class="far fa-address-book colores"></i>
          <span> Contratos </span>
        </a>
      </li>
      <li>
        <a href="../Administrador/Pacientes.php">
          <i class="fas fa-users colores"></i> 
          <span> Pacientes </span>
        </a>
      </li>
      <li>
        <a href="../Gastos/Gastos.php">
          <i class="fa fa-table colores"></i> 
          <span> Gastos </span>
        </a>
      </li>
      <li>
        <a href="../Servicios/Servicios.php">
          <i class="far fa-list-alt"></i>
          <span> Servicios </span>
        </a>
      </li>
      <li>
        <a href="../Administrador/RegistroCitas.php">
          <i class="far fa-calendar-alt"></i>
          <span> Registro de Citas </span>
        </a>
      </li>
      <li>
        <a href="../Administrador/CitasFacturadas.php">
          <i class="fas fa-layer-group colores"></i> 
          <span> Facturar Citas </span>
        </a>
      </li>
      <li>
        <a href="../Factura/FacturasGuardadas.php">
          <i class="far fa-bookmark colores"></i> 
          <span> Facturas </span>
        </a>
      </li>
      <li>
        <a href="../Servicios/ReportesAdministrador.php">
          <i class="far fa-map"></i> 
          <span> Servicios </span>
        </a>
      </li>
      <li>
        <a href="../Blog/InicioAdministrador.php">
          <i class="far fa-sticky-note"></i> 
          <span> Blog </span>
        </a>
      </li>
    </ul>
    <!-- //sidebar nav end -->
    <!-- toggle button start -->
    <a class="toggle-btn">
      <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
      <i class="fa fa-angle-double-right menu-collapsed__right"></i>
    </a>
    <!-- //toggle button end -->
  </div>
</div>
<!-- //sidebar menu end -->

<div class="navbar user-panel-top navbar-expand-lg gris navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav nav-flex-icons">
      <li class="nav-item titulolargo">
        <center> Lotus Splendor </center>
      </li>
    </ul>
    <ul class="navbar-nav nav-flex-icons">

      <li class="nav-item">
        <a href="../Usuario/salir.php" class="nav-link border border-light rounded waves-effect">
          <i class="fas fa-door-open iconosalir"></i>
          <b class="titulomenu"> Salir </b>
        </a>
      </li>
    </ul>
  </div>
</div>








<div class="main-content fondoper">
  <div class="container-fluid content-top-gap">
    <div class="card text-center">
      <div class="card-header">
        <b> Citas </b>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Grid column -->
          <div class="col-lg-11 col-md-11 caja">






            <form method="post" action="Cita.php">
              <div class="col-md-12">
                <input class="form-control Buscar" id="myInput" type="text" placeholder="Buscar...">
                <br>
                <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                  <thead class="blue lighten-4">
                    <tr>
                      <td class="th-sm"> <b> <center> Paciente </center> </b> </td>
                      <td class="th-sm"> <b> <center> Fecha y Hora </center> </b> </td>
                      <td class="th-sm"> <b> <center> Descripción </center> </b> </td>
                      <td class="th-sm"> <b> <center> Estado </center> </b> </td>
                      <td class="th-sm"> <b> <center> Ver </center> </b> </td>
                    </tr>
                  </thead>
                  <?php
                  $consulta="SELECT cita.Id, cita.Id_Paciente, cita.FechaHora, cita.Descripcion, cita.Estado FROM usuario
                  INNER JOIN paciente ON usuario.Id=paciente.Id_Usuario
                  INNER JOIN cita ON cita.Id_Paciente=paciente.Id where usuario.Id=".$_SESSION['id'];
                  $ejecutar= mysqli_query($conexion, $consulta);
                  while($Fila=mysqli_fetch_assoc($ejecutar)){
                    $id=$Fila['Id'];
                    $idp=$Fila['Id_Paciente'];
                    $fh=$Fila['FechaHora'];
                    $decrip=$Fila['Descripcion'];
                    $estado=$Fila['Estado'];
                    ?>
                    <tbody id="myTable">
                      <tr>
                        <td><center>
                          <?php 
                          $sub_sql_2 = "SELECT * FROM paciente WHERE Id='$idp' ";
                          $execute = mysqli_query($conexion, $sub_sql_2);
                          $pais = mysqli_fetch_assoc($execute);
                          echo $pais['Nombre'];
                          ?>
                        </center>
                      </td>
                      <td><center>
                        <?php 
                        echo $fh;
                        ?>
                      </center>
                    </td>
                    <td><center><?php echo $decrip;?></center></td>
                    <td><center>
                      <?php 
                      if ($estado==1) {
                        echo "<a href='Cita.php' class='btn btn-outline-success waves-effect'>Activado</a>";
                      }if ($estado==0) {
                        echo "<a href='Cita.php' class='btn btn-outline-danger waves-effect'>Desactivado</a>";
                      }

                      ?>
                         
                      </center></td>
                      <td>
                        <center>
                          <a href="HistirialClinico.php?Ver=<?php echo $idhc;?>"> 
                            <center>  <i class="far fa-paper-plane ojo"></i>  </center>
                          </a>
                        </center>
                      </td>
                      <td>
                        <center>

                          <button type="button" onclick="window.location='cita_borrar.php?rut=<?php echo $id; ?>';">
                            Cancelar
                          </button>

                        </center>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>



            </div>
          </div>
        </div>

      </form>



      <center>
        <br>
        <a href="insertCita.php" class="btn btn-outline-secondary waves-effect"> 
          <center><i class="fas fa-edit iconobtn"></i><b> Insertar </b></center>
        </a>
      </center>




    </div>
  </div>
</div>
</div>
</div>
</div>


</section>

<br>
<br>

















<!--Footer-->
<footer class="page-footer text-center info-color font-small mt-4 wow fadeIn">
  <!--Call to action-->
  <!--/.Call to action-->
  <hr class="my-4">
  <!-- Social icons -->
  <div class="pb-4">
    <a href="https://www.facebook.com/mdbootstrap" target="_blank">
      <i class="fab fa-facebook-f mr-3 icono"></i>
    </a>
    <a href="https://twitter.com/MDBootstrap" target="_blank">
      <i class="fab fa-twitter mr-3 icono"></i>
    </a>
    <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
      <i class="fab fa-youtube mr-3 icono"></i>
    </a>
    <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
      <i class="fab fa-google-plus-g mr-3 icono"></i>
    </a>
    <a href="https://dribbble.com/mdbootstrap" target="_blank">
      <i class="fab fa-dribbble mr-3 icono"></i>
    </a>
    <a href="https://pinterest.com/mdbootstrap" target="_blank">
      <i class="fab fa-pinterest mr-3 icono"></i>
    </a>
    <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
      <i class="fab fa-github mr-3 icono"></i>
    </a>
    <a href="http://codepen.io/mdbootstrap/" target="_blank">
      <i class="fab fa-codepen mr-3 icono"></i>
    </a>
  </div>
  <!-- Social icons -->
  <!--Copyright-->
  <div class="footer-copyright py-3">
    © 2020 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> Lotus Splendor </a>
  </div>
  <!--/.Copyright-->

</footer>












<!-- Script de Material Design Bootstrap -->

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>

<!-- Script de Bootstrap Menu -->

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/jquery.nicescroll.js"></script>
<script src="../js/scripts.js"></script>
<script src="../js/bootstrap.min.js"></script>







<script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>


  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function(){
          $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
        });
      });
    });
  </script>













</body>

</html>
