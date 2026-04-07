<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 2)) {
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
    /* ================================
       OBTENER DATOS USUARIO
    ================================ */

    $consul = "SELECT cp.Foto, cp.Nombre, cp.Apellido, u.Usuario
           FROM contratopersona cp 
           INNER JOIN usuario u ON cp.Id_Usuario = u.Id 
           WHERE u.Id = " . $_SESSION['id'];

    $ejecu = mysqli_query($conexion, $consul);
    $Fil = mysqli_fetch_assoc($ejecu);

    $nombre = $Fil['Nombre'] ?? '';
    $apellido = $Fil['Apellido'] ?? '';
    $fotoBD = $Fil['Foto'] ?? '';

    /* ================================
       RUTA FOTO (SIN file_exists)
    ================================ */

    $rutaBase = "../../Img/Personal/"; // 👈 AJUSTA si tu carpeta es otra
    
    if (!empty($fotoBD) && file_exists(__DIR__ . "/$rutaBase$fotoBD")) {
        $fotoMenu = $rutaBase . $fotoBD;
    } else {
        $fotoMenu = "../../Img/user-default.png";
    }
    ?>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4 Lolo">

                    <a href="../../Blog/InicioSecretaria.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-house me-3 IconosMenu"></i>
                        <span>Inicio</span>
                    </a>
					<a href="../Servicios/ReportesPaciente.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="fa-solid fa-spa me-3 IconosMenu">
						</i><span>Rituales</span>
					</a>
                    <a href="../Pacientes/Pacientes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-user me-3 IconosMenu"></i>
                        <span>Pacientes</span>
                    </a>

                    <a href="../Agenda/Agenda.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar me-3 IconosMenu"></i>
                        <span>Agenda</span>
                    </a>

                    <a href="../ActivarCitas/ControlCitas.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa fa-clock me-3 IconosMenu"></i>
                        <span>Agenda de hoy</span>
                    </a>


                    <a href="../Facturas/Facturar.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-file-invoice-dollar me-3 IconosMenu"></i>
                        <span>Nueva factura</span>
                    </a>

                    <a href="../Facturas/Facturas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-folder-open me-3 IconosMenu"></i>
                        <span>Facturas</span>
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
            <div class="card-header">
              <div class="row mb-4">
                <div class="col-md-6 text-md-start">
                  <h5 class="fw-bold EstiloLetraTarjeta">Citas</h4>
                </div>
                <div class="col-md-6 text-md-end text-end">
                  <a href="insertCita.php" class="btn btn-primary" data-mdb-ripple-init
                    data-mdb-ripple-color="dark">
                    <i class="fas fa-edit iconobtn"></i><b> Insertar </b>
                  </a>
                </div>
              </div>
            </div>


            <div class="card-body">

              <div id="calendar"></div>

            </div>
          </div>
      </section>
      <!-- Section: Main chart -->
    </div>
  </main>







  <!-- Modal Detalle Cita -->
  <div class="modal fade" id="citaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content rounded-4 shadow-lg border-0">

        <!-- HEADER -->
        <div class="modal-header text-white" style="background:#006F75;">
          <h5 class="modal-title">
            <i class="fas fa-calendar-check me-2"></i>
            Detalles de la Cita
          </h5>

          <button type="button" class="close text-white border-0 bg-transparent" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>


        <!-- BODY -->
        <div class="modal-body p-4">

          <div class="row g-3">

            <div class="col-md-6">
              <label class="fw-bold text-muted">Paciente</label>
              <div class="form-control bg-light" id="modalPaciente"></div>
            </div>

            <div class="col-md-6">
              <label class="fw-bold text-muted">Servicio</label>
              <div class="form-control bg-light" id="modalServicio"></div>
            </div>

            <div class="col-md-4">
              <label class="fw-bold text-muted">Fecha</label>
              <div class="form-control bg-light" id="modalFecha"></div>
            </div>

            <div class="col-md-4">
              <label class="fw-bold text-muted">Hora inicio</label>
              <div class="form-control bg-light" id="modalHoraInicio"></div>
            </div>

            <div class="col-md-4">
              <label class="fw-bold text-muted">Hora fin</label>
              <div class="form-control bg-light" id="modalHoraFin"></div>
            </div>

            <div class="col-md-12">
              <label class="fw-bold text-muted">Estado</label>
              <div class="form-control bg-light fw-bold" id="modalEstado"></div>
            </div>

          </div>
        </div>


        <!-- FOOTER -->
        <div class="modal-footer justify-content-center gap-2">

          <!-- BOTONES ACCIÓN (se ocultan con JS) -->
          <button type="button" class="btn btn-warning px-4" id="btnActualizar">
            <i class="fas fa-pen me-1"></i> Actualizar
          </button>

          <button type="button" class="btn btn-danger px-4" id="btnEliminar">
            <i class="fas fa-trash me-1"></i> Eliminar
          </button>

          <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
            Cerrar
          </button>

        </div>

      </div>
    </div>
  </div>



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

  <!-- ---------- INCLUYE ESTO (una sola vez) ---------- -->

  <!-- FullCalendar CSS (v5+) -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 JS (usa bundle que incluye popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <!-- ------------------------------------------------- -->


  <!-- Full Calendar -->
  <!-- ---------- SCRIPT: inicializar calendario + modal handlers ---------- -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {

      var calendarEl = document.getElementById('calendar');

      window.calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        locale: 'es',

        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
          today: 'Hoy',
          month: 'Mes',
          week: 'Semana',
          day: 'Día'
        },

        height: "auto",
        nowIndicator: true,
        selectable: true,

        events: 'getCitas.php',

        /* =====================================
           🎨 COLORES POR ESTADO
        ===================================== */
        eventDidMount: function (info) {

          var estado = (info.event.extendedProps.estado || "PENDIENTE").toUpperCase();
          var el = info.el;

          switch (estado) {

            case "PENDIENTE":
              el.style.backgroundColor = "#FFC107";
              el.style.borderColor = "#FFC107";
              break;

            case "EN_PROCESO":
              el.style.backgroundColor = "#0D6EFD";
              el.style.borderColor = "#0D6EFD";
              break;

            case "FACTURADA":
              el.style.backgroundColor = "#198754";
              el.style.borderColor = "#198754";
              break;

            case "CANCELADA":
              el.style.backgroundColor = "#DC3545";
              el.style.borderColor = "#DC3545";
              break;

            default:
              el.style.backgroundColor = "#6C757D";
              el.style.borderColor = "#6C757D";
          }

          el.style.color = "#fff";
          el.style.fontWeight = "600";
          el.style.borderRadius = "8px";
        },


        /* ===========================
           CLICK → MODAL
        =========================== */
        eventClick: function (info) {

          var evento = info.event.extendedProps || {};
          var estado = (evento.estado || "PENDIENTE").toUpperCase();

          var parts = info.event.title ? info.event.title.split(" - ") : [];

          $("#modalPaciente").text(parts[0] || "");
          $("#modalServicio").text(parts[1] || "");
          $("#modalFecha").text(info.event.start?.toISOString().split("T")[0] || "");
          $("#modalHoraInicio").text(info.event.start?.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) || "");
          $("#modalHoraFin").text(info.event.end?.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) || "No registrado");
          $("#modalEstado").text(estado);
          $("#modalDescripcion").text(evento.description ?? "Sin descripción");

          $("#btnActualizar").data("id", info.event.id);
          $("#btnEliminar").data("id", info.event.id);

          // 🔒 VISIBILIDAD DE BOTONES
          if (estado === "PENDIENTE") {
            $("#btnActualizar").show();
            $("#btnEliminar").show();
          } else {
            $("#btnActualizar").hide();
            $("#btnEliminar").hide();
          }

          $("#citaModal").modal("show");
        }
      });

      window.calendar.render();
    });


    /* ===========================
       ❌ CANCELAR CITA (ANTES ELIMINAR)
    =========================== */
    $(document).on('click', '#btnEliminar', function () {

      var idCita = $(this).data('id');
      if (!idCita) return;

      if (!confirm("¿Deseas cancelar esta cita?")) return;

      $.ajax({
        url: "eliminarCita.php", // 👈 TU PHP (cambia estado)
        type: "POST",
        data: { id: idCita },

        success: function (response) {
          alert(response);
          $("#citaModal").modal("hide");
          window.calendar.refetchEvents();
        },

        error: function (xhr) {
          alert(xhr.responseText || "No se pudo cancelar la cita");
        }
      });
    });


    /* ===========================
       ✏️ ACTUALIZAR
    =========================== */
    $(document).on('click', '#btnActualizar', function () {

      var idCita = $(this).data('id');
      if (!idCita) return;

      window.location.href = "editarCita.php?id=" + idCita;
    });
  </script>




</body>

</html>

<?php
unset($_SESSION["Error"]);
?>