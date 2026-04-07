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

              <h5 class="mb-0 text-center EstiloLetraTarjeta">Insertar Cita</h5>
            </div>


          </div>
          <div class="card-body">



            <form name="form" action="RegistrarCita.php" method="POST" enctype="multipart/form-data">

              <div class="container mt-4">
                <div class="card shadow-lg border-0 rounded-4">

                  <!-- HEADER -->
                  <div class="card-header rounded-top-4">
                    <h5 class="mb-0">
                      <i class="fas fa-calendar-plus me-2"></i>
                      Registrar Nueva Cita
                    </h5>
                  </div>

                  <div class="card-body p-4">
                    <div class="row g-4">

                      <?php

                      $consulta = "SELECT paciente.Nombre, paciente.Apellido, paciente.Id
                       FROM paciente
                       INNER JOIN usuario ON usuario.Id=paciente.Id_Usuario 
                       WHERE usuario.Id=" . $_SESSION['id'];

                      $resPaciente = mysqli_fetch_assoc(mysqli_query($conexion, $consulta));
                      ?>

                      <!-- PACIENTE (SOLO VISUAL) -->
                      <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">
                          <i class="fas fa-user me-1"></i> Paciente
                        </label>

                        <input type="text" class="form-control bg-light"
                          value="<?= $resPaciente['Nombre'] . ' ' . $resPaciente['Apellido']; ?>" readonly>

                        <!-- Se envía oculto -->
                        <input type="hidden" name="paciente" value="<?= $resPaciente['Id']; ?>">
                      </div>


                      <!-- SERVICIO -->
                      <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">
                          <i class="fas fa-spa me-1"></i> Servicio
                        </label>

                        <select name="servicio" id="servicio" class="form-select" required>
                          <option value="">Seleccione un servicio</option>
                          <?php
                          $consulta = "SELECT * FROM servicio";
                          $ejecutar = mysqli_query($conexion, $consulta);
                          while ($res = mysqli_fetch_assoc($ejecutar)) {
                            echo "<option value='{$res['Id']}'>{$res['Nombre']}</option>";
                          }
                          ?>
                        </select>
                      </div>


                      <!-- ESPECIALISTA -->
                      <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">
                          <i class="fas fa-user-nurse me-1"></i> Especialista
                        </label>

                        <select name="especialista" id="especialista" class="form-select" required>
                          <option value="">Seleccione un especialista</option>
                        </select>
                      </div>


                      <!-- FECHA -->
                      <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">
                          <i class="fas fa-calendar-day me-1 "></i> Fecha
                        </label>

                        <input type="date" name="txtFecha" id="fecha" class="form-control" required>
                      </div>


                      <!-- HORA -->
                      <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">
                          <i class="fas fa-clock me-1 "></i> Hora
                        </label>

                        <select name="txtHora" id="hora" class="form-select" required>
                          <option value="">Seleccione una hora</option>
                        </select>
                      </div>


                      <!-- BOTÓN -->
                      <div class="col-12 text-center mt-4">
                        <button type="submit" name="Enviar" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm">
                          <i class="fas fa-save me-2"></i>
                          Registrar Cita
                        </button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            </form>

            <br>

            <!-- VOLVER -->
            <div class="volver">
              <a href="Cita.php" class="btn btn-outline-success" data-mdb-ripple-init data-mdb-ripple-color="dark">
                <b class="ver"> Volver </b>
              </a>
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

  <script>
    // Initialization for ES Users
    import { Collapse, Ripple, initMDB } from "mdb-ui-kit";

    initMDB({ Collapse, Ripple });
  </script>

  <!-- Menú nuevo -->
  <script>
    // Graph
    var ctx = document.getElementById("myChart");

    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ],
        datasets: [{
          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
          lineTension: 0,
          backgroundColor: "transparent",
          borderColor: "#007bff",
          borderWidth: 4,
          pointBackgroundColor: "#007bff",
        },],
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false,
            },
          },],
        },
        legend: {
          display: false,
        },
      },
    });
  </script>











  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Cuando cambie el servicio, cargar especialistas
    $('#servicio').change(function () {
      var servicioId = $(this).val();
      $.ajax({
        type: 'POST',
        url: 'getEspecialistas.php',
        data: { servicioId: servicioId },
        success: function (response) {
          $('#especialista').html(response);
        }
      });
    });


    // Cuando cambien servicio, especialista o fecha, cargar horarios disponibles
    $('#fecha, #servicio, #especialista').change(function () {
      var fecha = $('#fecha').val();
      var servicioId = $('#servicio').val();
      var especialistaId = $('#especialista').val();

      if (fecha && servicioId && especialistaId) {
        $.ajax({
          type: 'POST',
          url: 'getHorarios.php',
          data: { servicioId: servicioId, especialistaId: especialistaId, fecha: fecha },
          success: function (response) {
            $('#hora').html(response);
          }
        });
      }
    });
  </script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>