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
            <div class="contenercitas">
              <h5 class="mb-0 text-center EstiloLetraTarjeta">Perfil</h5>
            </div>
          </div>
          <div class="card-body">


            <?php
            /* =====================================================
               SUBIR FOTO PERFIL PACIENTE
            ===================================================== */
            if (isset($_POST['btnFoto']) && isset($_FILES['foto'])) {

              $id_usuario = (int) $_SESSION['id'];

              $nombre = $_FILES['foto']['name'];
              $tmp = $_FILES['foto']['tmp_name'];

              if ($tmp != "") {

                $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
                $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $permitidas)) {

                  $nuevoNombre = "paciente_" . $id_usuario . "." . $ext;
                  $ruta = "../../Img/Pacientes/" . $nuevoNombre;

                  move_uploaded_file($tmp, $ruta);

                  $conexion->query("
                UPDATE paciente
                SET Foto = '$nuevoNombre'
                WHERE Id_Usuario = $id_usuario
            ");

                  header("Location: Perfil.php?ok=foto");
                  exit;
                }
              }
            }
            ?>


            <?php
            /* =====================================================
               DATOS PACIENTE
            ===================================================== */
            $id_usuario = (int) ($_SESSION['id'] ?? 0);

            $sql = "
SELECT *
FROM paciente
WHERE Id_Usuario = $id_usuario
LIMIT 1
";

            $res = $conexion->query($sql);

            if (!$res || $res->num_rows === 0) {
              die("<div class='alert alert-danger'>Perfil no encontrado</div>");
            }

            $p = $res->fetch_assoc();

            /* ========= EDAD ========= */
            $edad = 0;
            if (!empty($p['FechaNacimiento'])) {
              $edad = date_diff(
                date_create($p['FechaNacimiento']),
                date_create('today')
              )->y;
            }

            /* ========= FOTO ========= */
            $baseRuta = '../../Img/Pacientes/';
            $archivo = !empty($p['Foto']) ? $p['Foto'] : 'user-default.png';

            if (!file_exists($baseRuta . $archivo)) {
              $archivo = 'user-default.png';
            }

            $foto = $baseRuta . $archivo;
            ?>


            <style>
              .perfil-card {
                border-radius: 18px;
              }

              .avatar-perfil {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                border: 4px solid #e9ecef;
              }

              .section-title {
                font-weight: 600;
                color: #0d6efd;
                margin-top: 25px;
                margin-bottom: 12px;
              }
            </style>


            <?php if (isset($_GET['ok'])): ?>
              <div class="alert alert-success text-center">
                Foto actualizada correctamente
              </div>
            <?php endif; ?>


            <div class="row g-4">

              <!-- ================= FOTO + RESUMEN ================= -->
              <div class="col-md-4">

                <div class="card shadow-sm border-0 perfil-card text-center p-4">

                  <form method="POST" enctype="multipart/form-data">

                    <img src="<?= htmlspecialchars($foto) ?>" class="avatar-perfil mb-3 shadow-sm">

                    <div class="mb-2">
                      <input type="file" name="foto" class="form-control form-control-sm" required>
                    </div>

                    <button name="btnFoto" class="btn btn-outline-primary btn-sm rounded-pill w-100">
                      <i class="fas fa-camera me-1"></i> Cambiar foto
                    </button>
                  </form>

                  <hr class="my-4">

                  <h4 class="fw-bold mb-1">
                    <?= htmlspecialchars($p['Nombre'] . ' ' . $p['Apellido']) ?>
                  </h4>

                  <span class="badge bg-success mb-2">Paciente</span>

                  <p class="text-muted small mb-3">
                    <?= $edad ?> años
                  </p>

                  <!-- SEGURIDAD -->
                  <div class="card border-0 bg-light p-3 shadow-sm">

                    <small class="text-muted d-block mb-1">
                      Correo de acceso
                    </small>

                    <div class="fw-semibold mb-3 text-truncate">
                      <?= htmlspecialchars($email) ?>
                    </div>

                    <a href="ActualizarCorreo.php" class="btn btn-outline-primary btn-sm rounded-pill mb-2 w-100">
                      <i class="fas fa-envelope"></i> Cambiar correo
                    </a>

                    <a href="CambiarPassword.php" class="btn btn-outline-secondary btn-sm rounded-pill w-100">
                      <i class="fas fa-key"></i> Cambiar contraseña
                    </a>

                  </div>

                </div>

              </div>



              <!-- ================= DATOS ================= -->
              <div class="col-md-8">

                <form action="ActualizarPerfil.php" method="POST">

                  <h5 class="section-title">
                    <i class="fas fa-user"></i> Información personal
                  </h5>

                  <div class="row g-3">

                    <div class="col-md-6">
                      <label>Nombre</label>
                      <input class="form-control bg-light" name="Nombre" value="<?= htmlspecialchars($p['Nombre']) ?>"
                        readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Apellido</label>
                      <input class="form-control bg-light" name="Apellido"
                        value="<?= htmlspecialchars($p['Apellido']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Documento</label>
                      <input class="form-control bg-light" name="NumeroDocumento"
                        value="<?= htmlspecialchars($p['NumeroDocumento']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Teléfono</label>
                      <input class="form-control bg-light" name="NumeroTelefono"
                        value="<?= htmlspecialchars($p['NumeroTelefono']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Género</label>
                      <input class="form-control bg-light" value="<?= htmlspecialchars($p['Genero']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Fecha nacimiento</label>
                      <input type="date" class="form-control bg-light" name="FechaNacimiento"
                        value="<?= htmlspecialchars($p['FechaNacimiento']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Dirección</label>
                      <input class="form-control bg-light" name="Direccion"
                        value="<?= htmlspecialchars($p['Direccion']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Estado civil</label>
                      <input class="form-control bg-light" name="EstadoCivil"
                        value="<?= htmlspecialchars($p['EstadoCivil']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Ocupación</label>
                      <input class="form-control bg-light" name="Ocupacion"
                        value="<?= htmlspecialchars($p['Ocupacion']) ?>" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>Fecha registro</label>
                      <input class="form-control bg-light" value="<?= htmlspecialchars($p['FechaRegistro']) ?>"
                        readonly>
                    </div>


                  </div>

                  <div class="text-end mt-4">
                    <button class="btn btn-success px-4">
                      <i class="fas fa-save"></i> Actualizar datos
                    </button>
                  </div>

                </form>

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

</body>

</html>

<?php
unset($_SESSION["Error"]);
?>