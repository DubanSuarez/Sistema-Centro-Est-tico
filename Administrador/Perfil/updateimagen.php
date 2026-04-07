<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 3)) {
  $error = $_SESSION['Error'];
  $_SESSION['Error'] = "Sesión no iniciada";
  header('location: ../Usuario/Usuario.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Lotus Splendor </title>
  <link rel="stylesheet" href="../../Css/style2025.css?v=<?php echo time(); ?>">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />

</head>
<?php
if (isset($_SESSION["Error"])) {
  $error = $_SESSION["Error"];
  echo "<br>$error";
}
?>

<body>
  <div class="fondo-azul"></div>
  <?php
  $consul = "SELECT admi.Foto, admi.Nombre, admi.Apellido, u.Usuario, admi.Id FROM administrador admi
  INNER JOIN usuario u ON admi.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
  $ejecu = mysqli_query($conexion, $consul);
  $Fil = mysqli_fetch_assoc($ejecu);
  $idusua = $Fil['Id'];
  $nomusuario = $Fil['Nombre'];
  $apeusuario = $Fil['Apellido'];
  $email = $Fil['Usuario'];
  $foto = $Fil['Foto'];
  ?>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 Lolo">
          <a href="../../Blog/InicioAdministrador.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
            <i class="fa-solid fa-house me-3 IconosMenu"></i>
            <span>Inicio</span>
          </a>
          <a href="../../Administrador/Personal/Contratos.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-users-gear me-3 IconosMenu"></i>
            <span>Equipo</span>
          </a>
          <a href="../../Administrador/Servicios/Servicios.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-spa me-3 IconosMenu"></i>
            <span>Rituales</span>
          </a>
          <a href="../../Administrador/Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-user me-3 IconosMenu"></i>
            <span>Pacientes</span>
          </a>
          <a href="../../Administrador/Citas/RegistroCitas.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-calendar-days me-3 IconosMenu"></i>
            <span>Agenda</span>
          </a>
          <a href="../../Administrador/HC/ControlCitas.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-clock me-3 IconosMenu"></i>
            <span>Agenda de hoy</span>
          </a>
          <a href="../../Administrador/Facturas/FacturarAdmin.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-file-invoice-dollar me-3 IconosMenu"></i>
            <span>Nueva factura</span>
          </a>
          <a href="../../Administrador/Facturas/FacturasAdmin.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-folder-open me-3 IconosMenu"></i>
            <span>Facturas</span>
          </a>
          <a href="../../Administrador/Reportes/Reportes.php" class="list-group-item py-2 OpcionMenu"
            data-mdb-ripple-init>
            <i class="fa-solid fa-chart-line me-3 IconosMenu"></i>
            <span>Reportes</span>
          </a>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <!-- Logo -->
        <a class="navbar-brand LogoMenu" href="#">
          <img src="../../Img/LogoMenu.svg" class="LogoSplendor" alt="" loading="lazy" />
        </a>
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Avatar -->
          <li class="nav-item dropdown BotonMiCuenta">
            <?php
            // VALIDAR FOTO PARA EL MENÚ
            if (!empty($foto) && file_exists("Img/" . $foto)) {
              $fotoMenu = "Img/" . $foto;
            } else {
              $fotoMenu = "Img/user-default.png";
            }
            ?>
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">

              <img src="<?= $fotoMenu ?>" class="rounded-circle" height="26" loading="lazy" alt="Foto perfil">

              <b class="NomMiCuenta ms-2">Mi cuenta</b>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="../Perfil/Perfil.php">
                  <i class="fa-solid fa-user me-2"></i> Perfil
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../../Usuario/salir.php">
                  <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->



  <!-- Información -->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <!-- Section: Main chart -->
      <section class="mb-4">
        <div class="card">
          <div class="card-header py-3">
            <div class="card-header py-3">
              <div class="row gap-2">
                <div class="col-md-12 d-flex justify-content-md-start justify-content-center">
                  <h5 class=" mb-0 text-center EstiloLetraTarjeta">Actualizar foto de perfil</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php
              $idUsuario = $_SESSION['id'];
              $mensajeError = "";
              $mensajeExito = "";

              /* CONSULTAR FOTO ACTUAL DEL ADMINISTRADOR */
              $consulta = "SELECT Foto 
             FROM administrador 
             WHERE Id_Usuario = $idUsuario 
             LIMIT 1";

              $ejecutar = mysqli_query($conexion, $consulta);
              $admin = mysqli_fetch_assoc($ejecutar);

              if (!$admin) {
                die("Administrador no encontrado");
              }

              /* ACTUALIZAR FOTO */
              if (isset($_POST['actualizarImagen'])) {

                if (!isset($_FILES['Foto']) || $_FILES['Foto']['error'] !== 0) {
                  $mensajeError = "Debes seleccionar una imagen válida.";
                } else {

                  $imagen = $_FILES['Foto'];
                  $nombreOriginal = $imagen['name'];
                  $tmp = $imagen['tmp_name'];

                  /* EXTENSIÓN */
                  $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                  $extPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

                  if (!in_array($extension, $extPermitidas)) {
                    $mensajeError = "Formato no permitido. Usa JPG, PNG o WEBP.";
                  } else {

                    /* NOMBRE ÚNICO */
                    $nuevoNombre = "admin_" . $idUsuario . "_" . time() . "." . $extension;
                    $ruta = "Img/" . $nuevoNombre;

                    /* MOVER IMAGEN */
                    if (move_uploaded_file($tmp, $ruta)) {

                      /* BORRAR FOTO ANTERIOR */
                      if (!empty($admin['Foto']) && file_exists("Img/" . $admin['Foto'])) {
                        unlink("Img/" . $admin['Foto']);
                      }

                      /* ACTUALIZAR BD */
                      $update = "UPDATE administrador 
                           SET Foto='$nuevoNombre' 
                           WHERE Id_Usuario=$idUsuario";

                      mysqli_query($conexion, $update);

                      // actualizar variable para que se vea sin recargar
                      $admin['Foto'] = $nuevoNombre;

                      $mensajeExito = "Foto actualizada correctamente.";
                    } else {
                      $mensajeError = "Error al subir la imagen.";
                    }
                  }
                }
              }
              ?>
              <form method="POST" enctype="multipart/form-data">

                <!-- MENSAJES -->
                <?php if ($mensajeError) { ?>
                  <div class="alert alert-danger text-center mb-4">
                    <?= $mensajeError ?>
                  </div>
                <?php } ?>

                <?php if ($mensajeExito) { ?>
                  <div class="alert alert-success text-center mb-4">
                    <?= $mensajeExito ?>
                  </div>
                <?php } ?>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                  <div class="row g-4 align-items-center">

                    <!-- FOTO -->
                    <div class="col-md-5 text-center">

                      <div class="position-relative d-inline-block">
                        <?php if (!empty($admin['Foto'])) { ?>
                          <img src="Img/<?= $admin['Foto'] ?>" class="rounded-circle shadow"
                            style="width:170px; height:170px; object-fit:cover;" alt="Foto actual">
                        <?php } else { ?>
                          <img src="Img/user-default.png" class="rounded-circle shadow"
                            style="width:170px; height:170px; object-fit:cover;" alt="Sin foto">
                        <?php } ?>
                      </div>

                      <p class="text-muted mt-3 mb-0">Foto de perfil actual</p>
                    </div>

                    <!-- FORM -->
                    <div class="col-md-7">


                      <div class="mb-3">
                        <input type="file" name="Foto" class="form-control" accept="image/*"
                          onchange="previewImagen(event)" required>
                      </div>

                      <!-- PREVIEW -->
                      <div class="d-flex align-items-center gap-3 mt-3">
                        <img id="preview" class="rounded-circle shadow d-none"
                          style="width:90px; height:90px; object-fit:cover;">
                        <small class="text-muted">Vista previa de la nueva imagen</small>
                      </div>

                      <!-- BOTÓN -->
                      <div class="mt-4">
                        <button type="submit" name="actualizarImagen" class="btn btn-warning btn-rounded px-4">
                          <i class="fas fa-camera me-2"></i> Guardar cambios
                        </button>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- VOLVER -->
                <div class="text-center mt-4">
                  <a href="Perfil.php" class="btn btn-outline-success btn-rounded" data-mdb-ripple-init
                    data-mdb-ripple-color="dark">
                    Volver al perfil
                  </a>
                </div>

              </form>








            </div>
          </div>
      </section>
      <!-- Section: Main chart -->
    </div>
  </main>



  <br><br>
  <footer class="bg-body-tertiary text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3 ColorFooter">
      © 2020 Copyright:
      <a class="text-body FooterLink" href="https://dubansuarez.github.io/portfolio-projects/">DS.com</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function previewImagen(event) {
      const img = document.getElementById('preview');
      img.src = URL.createObjectURL(event.target.files[0]);
      img.classList.remove('d-none');
    }
  </script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>