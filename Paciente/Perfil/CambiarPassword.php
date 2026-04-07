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
                            $idUsuario = $_SESSION['id'] ?? 0;

                            $mensajeError = "";
                            $mensajeExito = "";

                            if ($idUsuario <= 0) {
                                die("<div class='alert alert-danger text-center'>Sesión no válida</div>");
                            }

                            /* ===== OBTENER CONTRASEÑA ACTUAL ===== */
                            $sql = "SELECT Contrasena FROM usuario WHERE Id = $idUsuario LIMIT 1";
                            $res = $conexion->query($sql);
                            $fila = $res->fetch_assoc();

                            if (!$fila) {
                                die("<div class='alert alert-danger text-center'>Usuario no encontrado</div>");
                            }

                            /* ===== PROCESAR FORM ===== */
                            if (isset($_POST['actualizar'])) {

                                $actual = trim($_POST['PasswordActual'] ?? '');
                                $nueva = trim($_POST['PasswordNueva'] ?? '');
                                $confirmar = trim($_POST['PasswordConfirm'] ?? '');

                                $guardada = trim($fila['Contrasena']); // evita espacios CHAR invisibles
                            
                                /* ===== VALIDACIONES ===== */

                                if ($actual === "" || $nueva === "" || $confirmar === "") {

                                    $mensajeError = "Todos los campos son obligatorios.";

                                } else {

                                    // ✔ Compatible con texto plano o hash
                                    $esTextoPlano = ($actual === $guardada);
                                    $esHash = password_verify($actual, $guardada);

                                    if (!$esTextoPlano && !$esHash) {

                                        $mensajeError = "La contraseña actual no es correcta.";

                                    } elseif ($nueva !== $confirmar) {

                                        $mensajeError = "La nueva contraseña y su confirmación no coinciden.";

                                    } elseif (strlen($nueva) < 8) {

                                        $mensajeError = "La nueva contraseña debe tener mínimo 8 caracteres.";

                                    } elseif ($actual === $nueva) {

                                        $mensajeError = "La nueva contraseña no puede ser igual a la actual.";

                                    } else {

                                        /* ===== GUARDAR SIEMPRE CON HASH ===== */
                                        $hash = password_hash($nueva, PASSWORD_DEFAULT);

                                        $stmt = $conexion->prepare("UPDATE usuario SET Contrasena = ? WHERE Id = ?");
                                        $stmt->bind_param("si", $hash, $idUsuario);

                                        if ($stmt->execute()) {
                                            $mensajeExito = "Contraseña actualizada correctamente.";
                                        } else {
                                            $mensajeError = "Error al actualizar la contraseña.";
                                        }

                                        $stmt->close();
                                    }
                                }
                            }
                            ?>


                            <div class="row justify-content-center">

                                <!-- REQUISITOS -->
                                <div class="col-md-4">
                                    <div class="alert alert-info small shadow-sm">
                                        <strong>Requisitos de la contraseña:</strong><br>
                                        • Mínimo 8 caracteres<br>
                                        • Se recomienda usar mayúsculas y números<br>
                                        • No debe ser igual a la contraseña actual
                                    </div>
                                </div>

                                <!-- FORMULARIO -->
                                <div class="col-md-6">
                                    <div class="card p-4 shadow-sm border-0">

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

                                            <label class="form-label">Contraseña actual</label>
                                            <input type="password" name="PasswordActual" class="form-control" required>

                                            <label class="form-label mt-3">Nueva contraseña</label>
                                            <input type="password" name="PasswordNueva" class="form-control" required
                                                minlength="8">

                                            <label class="form-label mt-3">Confirmar nueva contraseña</label>
                                            <input type="password" name="PasswordConfirm" class="form-control" required
                                                minlength="8">

                                            <div class="row mt-4">

                                                <div class="col-md-6 text-center">
                                                    <a href="Perfil.php"
                                                        class="btn btn-outline-secondary rounded-pill px-4">
                                                        Cancelar
                                                    </a>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <button type="submit" name="actualizar"
                                                        class="btn btn-outline-primary rounded-pill px-4">
                                                        <i class="fas fa-save"></i> Actualizar contraseña
                                                    </button>
                                                </div>

                                            </div>

                                        </form>

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