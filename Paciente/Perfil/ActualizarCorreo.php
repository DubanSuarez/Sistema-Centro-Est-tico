<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 4)) {
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
  $consul = "SELECT p.Foto, p.Nombre, p.Apellido, u.Usuario, p.Id FROM paciente p 
  INNER JOIN usuario u ON p.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
  $ejecu = mysqli_query($conexion, $consul);
  $Fil = mysqli_fetch_assoc($ejecu);
  $idusua = $Fil['Id'];
  $nombre = $Fil['Nombre'];
  $apellido = $Fil['Apellido'];
  $email = $Fil['Usuario'];
  $fotoBD = $Fil['Foto'];

  /* ================================
     RUTA FOTO (SIN file_exists)
  ================================ */

  $rutaBase = "../../Img/Pacientes/"; // 👈 AJUSTA si tu carpeta es otra
  
  if (!empty($fotoBD) && file_exists(__DIR__ . "/$rutaBase$fotoBD")) {
    $fotoMenu = $rutaBase . $fotoBD;
  } else {
    $fotoMenu = "../../Img/Pacientes/user-default.png";
  }
  ?>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 Lolo">
          <a href="../../Blog/InicioPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-house fa-fw me-3 IconosMenu">
            </i><span>Inicio</span>
          </a>
          <a href="../Servicios/ReportesPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-spa me-3 IconosMenu">
            </i><span>Rituales</span>
          </a>
          <a href="../Cita/Cita.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fas fa-calendar fa-fw me-3 IconosMenu">
            </i><span>Citas</span>
          </a>
          <a href="../Archivo/CodigoHC.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
            <i class="fa-solid fa-folder-open me-3 IconosMenu">
            </i><span>Historial Clinico</span>
          </a>
          <a href="../Facturas/FacturasGuardadas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-receipt me-3 IconosMenu">
            </i><span>Facturas</span>
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
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">

              <!-- FOTO CIRCULAR -->
              <img src="<?= $fotoMenu ?>" class="avatar-menu me-2" alt="Foto perfil">

              <b class="NomMiCuenta">
                <?= htmlspecialchars($nombre . ' ' . $apellido) ?>
              </b>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
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
                                    <h5 class=" mb-0 text-center EstiloLetraTarjeta">Perfil</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">




                            <?php
                            /* =====================================================
                               CONFIGURACIÓN INICIAL
                            ===================================================== */

                            $idUsuario = $_SESSION['id'] ?? 0;

                            if ($idUsuario <= 0) {
                                die("<div class='alert alert-danger text-center'>Sesión no válida</div>");
                            }

                            $mensajeError = "";
                            $mensajeExito = "";


                            /* =====================================================
                               OBTENER DATOS ACTUALES
                            ===================================================== */

                            $sql = "SELECT Usuario, Contrasena 
        FROM usuario 
        WHERE Id = $idUsuario 
        LIMIT 1";

                            $res = $conexion->query($sql);
                            $user = $res->fetch_assoc();

                            if (!$user) {
                                die("<div class='alert alert-danger text-center'>Usuario no encontrado</div>");
                            }

                            $correoActual = $user['Usuario'];


                            /* =====================================================
                               PROCESAR FORMULARIO
                            ===================================================== */

                            if (isset($_POST['actualizarCorreo'])) {

                                $nuevoCorreo = trim($_POST['CorreoNuevo']);
                                $password = trim($_POST['Password']);


                                /* ===== VALIDACIONES ===== */

                                if ($nuevoCorreo == "" || $password == "") {

                                    $mensajeError = "Todos los campos son obligatorios.";

                                } elseif (!filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {

                                    $mensajeError = "Formato de correo inválido.";

                                } elseif ($nuevoCorreo == $correoActual) {

                                    $mensajeError = "El nuevo correo no puede ser igual al actual.";

                                }
                                /* ===== VALIDAR PASSWORD ===== */ elseif (
                                    $user['Contrasena'] !== $password &&
                                    !password_verify($password, $user['Contrasena'])
                                ) {

                                    $mensajeError = "La contraseña no es correcta.";

                                }
                                /* ===== VALIDAR CORREO DUPLICADO ===== */ else {

                                    $check = $conexion->query("SELECT Id FROM usuario 
                                   WHERE Usuario = '$nuevoCorreo' 
                                   AND Id <> $idUsuario");

                                    if ($check->num_rows > 0) {

                                        $mensajeError = "Este correo ya está registrado por otro usuario.";

                                    } else {

                                        /* ===== ACTUALIZAR ===== */

                                        $update = "UPDATE usuario 
                       SET Usuario = '$nuevoCorreo' 
                       WHERE Id = $idUsuario";

                                        if ($conexion->query($update)) {

                                            $correoActual = $nuevoCorreo;
                                            $mensajeExito = "Correo actualizado correctamente.";

                                        } else {

                                            $mensajeError = "Error al actualizar el correo.";
                                        }
                                    }
                                }
                            }
                            ?>



                            <div class="row justify-content-center">

                                <!-- ================= INFO LATERAL ================= -->
                                <div class="col-md-4">

                                    <div class="alert alert-info shadow-sm small">
                                        <strong>Recomendaciones:</strong><br>
                                        • Usa un correo válido<br>
                                        • Debe ser único<br>
                                        • Será tu usuario de acceso<br>
                                        • Confirma con tu contraseña
                                    </div>

                                </div>


                                <!-- ================= FORMULARIO ================= -->
                                <div class="col-md-6">

                                    <div class="card p-4 shadow border-0 rounded-4">

                                        <?php if ($mensajeError): ?>
                                            <div class="alert alert-danger text-center">
                                                <?= $mensajeError ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($mensajeExito): ?>
                                            <div class="alert alert-success text-center">
                                                <?= $mensajeExito ?>
                                            </div>
                                        <?php endif; ?>


                                        <form method="POST" autocomplete="off">

                                            <!-- CORREO ACTUAL -->
                                            <label class="form-label">Correo actual</label>
                                            <input type="email" class="form-control mb-3"
                                                value="<?= htmlspecialchars($correoActual) ?>" disabled>


                                            <!-- NUEVO -->
                                            <label class="form-label">Nuevo correo</label>
                                            <input type="email" name="CorreoNuevo" class="form-control"
                                                placeholder="ejemplo@correo.com" required>


                                            <!-- PASSWORD -->
                                            <label class="form-label mt-3">Confirmar contraseña</label>
                                            <input type="password" name="Password" class="form-control" required>


                                            <!-- BOTONES -->
                                            <div class="row mt-4">

                                                <div class="col-md-6 text-center">
                                                    <a href="Perfil.php"
                                                        class="btn btn-outline-secondary rounded-pill px-4 w-100">
                                                        Cancelar
                                                    </a>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <button type="submit" name="actualizarCorreo"
                                                        class="btn btn-outline-primary rounded-pill px-4 w-100">
                                                        <i class="fas fa-save"></i> Actualizar correo
                                                    </button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>






                        </div>
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


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>