<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 1)) {
    $error = $_SESSION['Error'];
    $_SESSION['Error'] = "Sesion no iniciada";
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
                    <a href="../../Blog/InicioEspecialista.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-house me-3 IconosMenu"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="../Agenda/MiAgenda.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar-check me-3 IconosMenu"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="../Agenda/MisCitas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar me-3 IconosMenu"></i>
                        <span>Mis citas</span>
                    </a>
                    <a href="../Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-user me-3 IconosMenu"></i>
                        <span>Pacientes</span>
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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Agenda</h4>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <?php
                            $id_usuario = $_SESSION['id'];

                            $sqlEsp = "
SELECT Id 
FROM contratopersona
WHERE Id_Usuario = $id_usuario
LIMIT 1
";

                            $resEsp = $conexion->query($sqlEsp);
                            $rowEsp = $resEsp->fetch_assoc();

                            $id_especialista = $rowEsp['Id'];
                            ?>

                            <div id="calendar" style="min-height:650px;"></div>



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



    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {

                locale: 'es',
                height: "auto",
                initialView: 'dayGridMonth',

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

                /* =========================
                   CARGAR CITAS
                ========================= */
                events: {
                    url: 'ajax_citas_especialista.php',
                    method: 'POST',
                    extraParams: {
                        especialista: <?= $id_especialista ?>
                    }
                },

                /* =========================
                   COLORES POR ESTADO
                ========================= */
                eventDidMount: function (info) {

                    const estado = info.event.extendedProps.estado;

                    if (estado === 'PENDIENTE') {
                        info.el.style.backgroundColor = '#ffc107'; // amarillo
                    }

                    if (estado === 'EN_PROCESO') {
                        info.el.style.backgroundColor = '#0d6efd'; // azul
                    }

                    if (estado === 'ATENDIDA') {
                        info.el.style.backgroundColor = '#198754'; // verde
                    }

                    if (estado === 'CANCELADA') {
                        info.el.style.backgroundColor = '#dc3545'; // rojo
                    }
                },

                /* =========================
                   CLICK INTELIGENTE
                ========================= */
                eventClick: function (info) {

                    const estado = info.event.extendedProps.estado;

                    // SOLO atender si está en proceso
                    if (estado === 'EN_PROCESO') {
                        window.location.href = "AtenderCita.php?id=" + info.event.id;
                    } else {
                        alert("Esta cita aún no está en proceso.\nLa secretaria debe confirmarla primero.");
                    }
                }

            });

            calendar.render();
        });
    </script>



</body>

</html>

<?php
unset($_SESSION["Error"]);
?>