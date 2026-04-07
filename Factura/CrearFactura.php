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
        <b> Factura Creada </b>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8 caja">
            <form method="POST" action="" enctype="multipart/form-data">
              <?php
              if (isset($_GET['crear'])) {
                $editar_id = $_GET['crear'];
                $consulta="SELECT cita.Id_Paciente, paciente.NumeroTelefono, paciente.Direccion, servicio.Nombre, servicio.Valor, servicio.Id_Personal, cita.Fecha, cita.Hora, servicio.Descripcion, paciente.NumeroDocumento FROM cita 
                INNER JOIN servicio on servicio.Id=cita.Id_Servicio 
                INNER JOIN paciente on paciente.Id=cita.Id_Paciente 
                WHERE cita.Id_Paciente='$editar_id' ";
                $ejecutar= mysqli_query($conexion, $consulta);
                $Fila=mysqli_fetch_assoc($ejecutar);
                $nom=$Fila["Id_Paciente"];
                $telefono=$Fila["NumeroTelefono"];
                $direccion=$Fila["Direccion"];
                $servicio=$Fila["Nombre"];
                $costo=$Fila["Valor"];
                $especialista=$Fila["Id_Personal"];
                $fh=$Fila["Fecha"];
                $hr=$Fila["Hora"];
                $descrip=$Fila["Descripcion"];
                $doc=$Fila["NumeroDocumento"];
              }
              ?>
              <div class="container">
                <div class="row">
                  <div class="col-md-7">
                      
                      <?php
	                       $lista_array=array(0,1,2,3,4,5,6,7,8,9,10);
	                       	$random_keys=array_rand($lista_array, 4);
		                       	$a = $lista_array[$random_keys[0]];
		                       	$b = $lista_array[$random_keys[1]];
		                       	$c = $lista_array[$random_keys[2]];
		                       	$d = $lista_array[$random_keys[3]];
                    ?>
                     
                     <div class="mt-1" style="width: 30%; float:left;">
                        <p><b>Número Factura: </b></p>
                        <input type="number" class="form-control" name="nfactura" value="<?php echo $a, $b, $c, $d; ?>">
                        <br>
                        <br>
                     </div>
                     
                      
                  </div>
                  <div class="col-md-5">
                    <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                      <thead class="blue lighten-4">
                        <tr>
                          <td class="th-sm"> <b> <center> Fecha y Hora </center> </b> </td>
                          <td class="th-sm"> <b> <center> Secretaria/o </center> </b> </td>
                        </tr>
                      </thead>
                      <tbody id="myTable">
                        <tr>
                          <td>
                            <center>
                              <?php
                              date_default_timezone_set("America/Bogota");
                              $fecha_actual = date("Y-m-d H:i:s");
                              ?> 
                              <input type="datetime" name="fechahora" value="<?php echo $fecha_actual; ?>" required="">  
                            </td>
                          </center>
                        </td>
                        <td>
                          <center>
                           <select name="secretaria" class="browser-default custom-select">
                             <?php
                             $sql="SELECT * FROM usuario WHERE usuario.Id=".$_SESSION['id'];
                             $ejecutar= mysqli_query($conexion, $sql);
                             $res=mysqli_fetch_assoc($ejecutar); 
                             echo "<option value = '".$res['Id']."'>".$res['NombreUsuario']."</option>";
                             ?>    
                           </select>    
                         </center>
                       </td>
                     </tr>
                   </tbody>
                 </table>
               </div>
               <br><br>
               <div class="col-md-12">
                <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                  <thead class="blue lighten-4">
                    <tr>
                      <td class="th-sm"> <b> <center> Nombre Completo </center> </b> </td>
                      <td class="th-sm"> <b> <center> Número de Documento </center> </b> </td>
                      <td class="th-sm"> <b> <center> Número de Teléfono </center> </b> </td>
                      <td class="th-sm"> <b> <center> Dirección </center> </b> </td>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <tr>
                      <td><center><b> 
                        <input type="text" name="factupaci" class="form-control" value="<?php 
                        $sub_sql_2 = "SELECT * FROM paciente WHERE Id='$nom' ";
                        $execute = mysqli_query($conexion, $sub_sql_2);
                        $pais = mysqli_fetch_assoc($execute);
                        echo $pais['Nombre']," ",$pais['Apellido'];
                        ?> " style="width: 100%;">
                      </b></center></td>
                      <td><center><b> <?php echo $doc;?> </b></center></td>
                      <td><center><b> <?php echo $telefono;?> </b></center></td>
                      <td><center><b> <?php echo $direccion;?> </b></center></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <br><br>
              <?php
              date_default_timezone_set("America/Bogota");
              $fecha_a = date("Y-m-d");
              ?> 
              <div class="col-md-12">
                <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                  <thead class="blue lighten-4">
                    <tr>
                      <td class="th-sm"> <b> <center> Servicio </center> </b> </td>
                      <td class="th-sm"> <b> <center> Descripción  </center> </b> </td>
                      <td class="th-sm"> <b> <center> Costo </center> </b> </td>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php
                    $sql="SELECT cita.Id, cita.Id_Paciente, cita.Fecha, cita.Facturar, servicio.Nombre, servicio.Valor, servicio.Descripcion, cita.Precio, cita.Servicio, cita.Especialista FROM `cita` 
                    INNER JOIN servicio on servicio.Id=cita.Id_Servicio
                    WHERE cita.Fecha='$fecha_a' and cita.Id_Paciente='$nom' and cita.Facturar=1 ";
                    $ejecutar= mysqli_query($conexion, $sql);
                    while ($consulta=mysqli_fetch_array($ejecutar)) {
                      $idc=$consulta['Id'];
                      $sernom=$consulta['Servicio'];
                      $val=$consulta['Precio'];
                      $descc=$consulta['Descripcion'];
                      ?>
                      <tr>
                        <td><center><b> <?php echo $sernom;?> </b></center></td>
                        <td><center><b> <?php echo $descc;?> </b></center></td>
                        <td><center><b> <?php echo $val;?> </b></center></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <br><br>
              <div class="col-md-4">
                <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <td class="blue lighten-4"><center><b> Forma de pago </b></center></td>
                      <td>
                        <center>
                          <select name="formapago" class="browser-default custom-select">
                            <option value="Efectivo"> Efectivo </option>
                            <option value="Tarjeta de Credito"> Tarjeta de Credito </option>
                          </select>
                        </center>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-4">
                <table id="dt-bordered" class="table table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <td class="blue lighten-4"><center><b> Total </b></center></td>
                      <td><center><b>
                        <input type="text" name="txttotal" class="form-control" value=" <?php
                        $sql="SELECT cita.Id, cita.Id_Paciente, cita.Fecha, cita.Facturar, servicio.Nombre, servicio.Valor, cita.Precio, sum(cita.Precio) ValorTotal, servicio.Descripcion FROM `cita` 
                        INNER JOIN servicio on servicio.Id=cita.Id_Servicio 
                        WHERE cita.Fecha='$fecha_a' and cita.Id_Paciente='$nom' and cita.Facturar=1 
                        group by cita.Id_Paciente";
                        $ejecutar= mysqli_query($conexion, $sql);
                        $res=mysqli_fetch_assoc($ejecutar); 
                        echo $res['ValorTotal'];
                        ?>   ">
                      </b></center></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br><br><br>
          <input class="btn btn-outline-info waves-effect" type="submit" name="Enviar" value="Guardar">
          <?php 
          if (isset($_POST['Enviar'])) {
              $numfactura=$_POST['nfactura'];
            $actualizar="UPDATE cita SET Facturar=2, NFactura='$numfactura' WHERE Fecha='$fecha_a' and Estado=1 and Facturar=1 and Id_Paciente=$editar_id ";

            $ejecutar= mysqli_query($conexion, $actualizar) or die(mysqli_error()); 
          }    
           if (isset($_POST['Enviar'])) {
            $idpac=$_POST['factupaci'];
            $fera=$_POST['fechahora'];
            $fpago=$_POST['formapago'];
            $total=$_POST['txttotal'];
            $idadminis=$_SESSION['id'];
            $numfactura=$_POST['nfactura'];
            $factu=0;
            $query = "INSERT INTO factura (Id_Paciente, FechaHora, FormaPago, Total, Fecha, Id_Administrador,FacturaAnulada, NFactura) VALUES ('$nom', '$fera', '$fpago', '$total', '$fecha_a', '$idadminis', '$factu', '$numfactura')";

            $result=mysqli_query($conexion, $query) or die (mysqli_error());
            
            echo "<script>alert('Factura Guardada')</script>";
            echo "<script>window.open('FacturasGuardadas.php','_self')</script>";
            
          }           
          ?> 
        </form>
        <div class="volver">
          <br>
          <br>
          <center>
            <a href="../Administrador/CitasFacturadas.php" class="btn btn-outline-success waves-effect">
              <b class="ver"> Volver </b>
            </a>
          </center>
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