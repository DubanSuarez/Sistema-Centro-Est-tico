<?php
session_start();
require_once('../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if(($rol != 3)) { 
  $error = $_SESSION['Error'];      
  $_SESSION['Error']  = "Sesión no iniciada";   
  header('location: ../Usuario/Usuario.php');   
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Lotus Splendor </title>
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
    <?php
    $consul=" SELECT * FROM usuario where Id = ".$_SESSION['id'];
    $ejecu= mysqli_query($conexion, $consul);
    $Fil=mysqli_fetch_assoc($ejecu);
    $idusua=$Fil['Id'];
    $nomusuario=$Fil['NombreUsuario'];
    $email=$Fil['Usuario'];
    $foto=$Fil['Foto'];
    ?>
    <div class="logo-icon text-center gris">
      <a href="#" title="logo"><img src="../img/logo.png" alt="logo-icon"> </a>
    </div>
    <div class="sidebar-menu-inner">
      <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="fondoperfil">
          <a class="colorperfil">
            <span class="nombre">
              <img class="rounded-circle fotop" height="70px" src="data:image/jpg;base64,<?php echo base64_encode($foto); ?>">
            </td>
            <br>
            <center> 
              <?php echo $nomusuario; ?>
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
        <a href="../Servicios/Reporte.php">
          <i class="fab fa-buromobelexperte"></i> 
          <span> Reportes </span>
        </a>
      </li>
      <li>
        <a href="../Blog/InicioAdministrador.php">
          <i class="far fa-sticky-note"></i> 
          <span> Blog </span>
        </a>
      </li>
    </ul>
    <a class="toggle-btn">
      <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
      <i class="fa fa-angle-double-right menu-collapsed__right"></i>
    </a>
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
        <b> Facturas </b>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-11 col-md-11 caja">
            <div class="card-deck">
              <div class="card mb-4 hoverable p-2">
                <div class="view overlay">
                  <form name="form" action="Servicios.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-5">
                        <a href="Anuladas.php" name="anuladas" class="btn btn-outline-success waves-effect" value="" style="float: left !important;"><b> Anuladas </b> </a>
                      </div>
                      <div class="col-md-7 mt-1 mt-2">
                        <input class="form-control Buscar" id="myInput" type="text" placeholder="Buscar...">
                        <br>
                      </div>
                    </div>
                  <br>                    
                    <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%" align="center">
                      <thead class="blue lighten-4">
                        <tr>
                          <th class="th-sm"><center> Paciente </center></th>
                          <th class="th-sm"><center> Fecha y Hora </center></th>
                          <th class="th-sm"><center> Forma de Pago </center></th>
                          <th class="th-sm"><center> Total </center></th>
                          <th class="th-sm"><center> PDF </center></th>
                          <th class="th-sm"><center> Anular Factura </center></th>
                        </tr>
                      </thead>
                      <?php 
                      $por_pagina=15;
                      if (isset($_GET['pagina'])) {
                        $pagina=$_GET['pagina'];
                      }else{
                        $pagina=1;
                      }
                      $empieza=($pagina-1) * $por_pagina;
                      $consulta="SELECT * FROM factura WHERE FacturaAnulada=0 order by Id desc LIMIT $empieza, $por_pagina";
                      $ejecutar= mysqli_query($conexion, $consulta);
                      $i=0;
                      while($Fila=mysqli_fetch_assoc($ejecutar)){
                        $id=$Fila['Id'];
                        $ids=$Fila['Id_Secretaria'];
                        $idp=$Fila['Id_Paciente'];
                        $fechah=$Fila['FechaHora'];
                        $fpago=$Fila['FormaPago'];
                        $total=$Fila['Total'];
                        $i++;
                        ?>
                        <tbody id="myTable">
                          <tr>
                           <td>
                            <?php 
                            $sub_sql_2 = "SELECT * FROM paciente WHERE Id='$idp' ";
                            $execute = mysqli_query($conexion, $sub_sql_2);
                            $pais = mysqli_fetch_assoc($execute);
                            echo $pais['Nombre']," ",$pais['Apellido'];
                            ?>
                          </td>
                          <td><?php echo $fechah;?></td>
                          <td><?php echo $fpago;?></td>
                          <td><?php echo $total;?></td>
                          <td>
                           <center>
                             <a href="../pdf/index.php?PDF=<?php echo $id;?>" class="btn btn-outline-primary waves-effect" name="Generar" target="_blank"><i class="far fa-file-pdf"></i></center></a>
                           </center>
                         </td> 
                         <td>
                          <center>
                            <a href="AnularF.php?Anular=<?php echo $id;?>" onClick="javascript: return confirm('¿Estas seguro?');"  class="btn btn-outline-danger waves-effect"> 
                              <center><i class="fas fa-ban Eliminar"></i> </center>
                            </a>
                          </center>
                        </td>      
                      </tr>
                      <?php 
                    } 
                    ?>
                    <?php 
                    if (isset($_GET['actualizar'])) {
                      include("updateServicio.php");
                    }
                    ?>
                    <?php 
                    if (isset($_GET['eliminar'])) {
                      $borrar_id = $_GET['eliminar'];
                      $eliminar = "DELETE FROM servicio WHERE Id = '$borrar_id' ";
                      $ejecutar = mysqli_query($conexion, $eliminar);
                      if ($ejecutar) {
                        echo "<script> alert('El Servicio ha sido eliminado!') </script>";
                        echo "<script> window.open('Servicios.php', '_self') </script>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <nav aria-label="Page navigation example">
                  <ul class="pagination pg-blue paginacion">
                    <?php
                    $query="SELECT * FROM factura";
                    $resultado=mysqli_query($conexion, $query);
                    $total_registros=mysqli_num_rows($resultado);
                    $total_paginas=ceil($total_registros/$por_pagina);
                    echo "<center><li class=\"page-item paginacion\"><a href='FacturasGuardadas.php?pagina=1' class=\"page-link paginacion\">".'Primera '."</a></i>";
                    for ($i=1; $i <=$total_paginas ; $i++) { 
                      echo "<li class=\"page-item paginacion\"><a href='FacturasGuardadas.php?pagina=".$i."' class=\"page-link paginacion\">".$i."</a></i>";
                    }
                    echo "<li class=\"page-item paginacion\"><a href='FacturasGuardadas.php?pagina=$total_paginas' class=\"page-link paginacion\">".'Última '."</a></i></center>";
                    ?>
                  </ul>
                </nav>
              </form>
            </div>
          </div>
        </div>
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
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
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

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      M.AutoInit();
    });
  </script>

</body>
</html>
<?php
unset($_SESSION["Error"]);
?>