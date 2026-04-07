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
                                    <h5 class="fw-bold EstiloLetraTarjeta mb-0">
                                        <i class="fas fa-user-md me-2"></i>
                                        Atención de Pacientes
                                    </h5>
                                    <small class="text-muted">
                                        Control de citas, atención clínica e historial de pacientes
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php

                        /* =====================================================
                        VALIDACIONES
                        ===================================================== */
                        $id_usuario = (int) ($_SESSION['id'] ?? 0);
                        $id_paciente = (int) ($_GET['id'] ?? 0);

                        if ($id_usuario <= 0 || $id_paciente <= 0) {
                            die("<div class='alert alert-danger'>Acceso inválido</div>");
                        }


                        /* =====================================================
                        1️⃣ ESPECIALISTA ACTIVO
                        ===================================================== */
                        $resEsp = $conexion->query("
    SELECT Id
    FROM contratopersona
    WHERE Id_Usuario = $id_usuario
    AND Rol='Especialista'
    AND EstadoContrato = 1
    LIMIT 1
");

                        if (!$resEsp || $resEsp->num_rows == 0) {
                            die("<div class='alert alert-danger'>No tienes contrato activo</div>");
                        }

                        $id_especialista = (int) $resEsp->fetch_assoc()['Id'];


                        /* =====================================================
                        2️⃣ PACIENTE
                        ===================================================== */
                        $resPaciente = $conexion->query("
    SELECT *
    FROM paciente
    WHERE Id = $id_paciente
    LIMIT 1
");

                        if (!$resPaciente || $resPaciente->num_rows == 0) {
                            die("<div class='alert alert-danger'>Paciente no encontrado</div>");
                        }

                        $paciente = $resPaciente->fetch_assoc();


                        /* =====================================================
                        3️⃣ HISTORIAL
                        ===================================================== */
                        $resHistorial = $conexion->query("
    SELECT *
    FROM historial_clinico
    WHERE id_paciente = $id_paciente
    LIMIT 1
");

                        $hc = ($resHistorial && $resHistorial->num_rows > 0)
                            ? $resHistorial->fetch_assoc()
                            : null;


                        /* =====================================================
                        4️⃣ VALORACIONES (POR CITA)
                        ===================================================== */
                        $valoraciones = $conexion->query("
    SELECT v.*
    FROM valoracion_estetica v
    INNER JOIN cita c ON c.Id = v.id_cita
    INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
    WHERE c.Id_Paciente = $id_paciente
    AND se.Id_Especialista = $id_especialista
    ORDER BY v.fecha DESC
");


                        /* =====================================================
                        5️⃣ CITAS
                        ===================================================== */
                        $citas = $conexion->query("
    SELECT c.Fecha, c.HoraInicio, c.Estado
    FROM cita c
    INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
    WHERE c.Id_Paciente = $id_paciente
    AND se.Id_Especialista = $id_especialista
    ORDER BY c.Fecha DESC
");


                        /* =====================================================
                        DATOS EXTRA
                        ===================================================== */
                        $edad = 0;
                        if (!empty($paciente['FechaNacimiento'])) {
                            $edad = date_diff(
                                date_create($paciente['FechaNacimiento']),
                                date_create('today')
                            )->y;
                        }
                        ?>


                        <!-- =====================================================
HTML
===================================================== -->

                        <div class="card shadow-sm">
                            <div class="card-body">

                                <a href="Pacientes.php" class="btn btn-outline-secondary btn-sm mb-4">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>

                                <h4 class="fw-bold">
                                    <?= $paciente['Nombre'] . ' ' . $paciente['Apellido'] ?>
                                </h4>

                                <p class="text-muted small">
                                    📞 <?= $paciente['NumeroTelefono'] ?: 'No registrado' ?> |
                                    🪪 <?= $paciente['NumeroDocumento'] ?: 'No registrado' ?> |
                                    🎂 <?= $edad ?> años
                                </p>

                                <hr>

                                <h5 class="fw-bold text-danger">
                                    <i class="fas fa-notes-medical"></i> Historial clínico
                                </h5>

                                <?php if (!$hc): ?>
                                    <div class="alert alert-warning">Sin historial clínico</div>
                                <?php else: ?>
                                    <ul class="small">
                                        <li><b>Alergias:</b> <?= $hc['alergias'] ?: 'Ninguna' ?></li>
                                        <li><b>Enfermedades:</b> <?= $hc['enfermedades'] ?: 'Ninguna' ?></li>
                                        <li><b>Medicamentos:</b> <?= $hc['medicamentos'] ?: 'Ninguno' ?></li>
                                    </ul>
                                <?php endif; ?>

                                <hr>

                                <h5 class="fw-bold text-success">
                                    <i class="fas fa-spa"></i> Valoraciones
                                </h5>

                                <?php if (!$valoraciones || $valoraciones->num_rows == 0): ?>
                                    <div class="alert alert-info">Sin valoraciones</div>
                                <?php else: ?>
                                    <table class="table table-sm table-hover">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Diagnóstico</th>
                                            <th>Procedimiento</th>
                                        </tr>
                                        <?php while ($v = $valoraciones->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $v['fecha'] ?></td>
                                                <td><?= $v['diagnostico_estetico'] ?></td>
                                                <td><?= $v['procedimiento_realizado'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </table>
                                <?php endif; ?>

                                <hr>

                                <h5 class="fw-bold text-primary">
                                    <i class="fas fa-calendar-check"></i> Citas
                                </h5>

                                <?php if (!$citas || $citas->num_rows == 0): ?>
                                    <div class="alert alert-secondary">Sin citas</div>
                                <?php else: ?>
                                    <table class="table table-sm text-center">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                        </tr>
                                        <?php while ($c = $citas->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $c['Fecha'] ?></td>
                                                <td><?= substr($c['HoraInicio'], 0, 5) ?></td>
                                                <td><?= $c['Estado'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </table>
                                <?php endif; ?>

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

    <!-- ---------- INCLUYE ESTO (una sola vez) ---------- -->

    <!-- FullCalendar CSS (v5+) -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 JS (usa bundle que incluye popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- ------------------------------------------------- -->





</body>

</html>

<?php
unset($_SESSION["Error"]);
?>