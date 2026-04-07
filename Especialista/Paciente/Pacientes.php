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

                        $id_usuario = (int) ($_SESSION['id'] ?? 0);

                        if ($id_usuario <= 0) {
                            die("<div class='alert alert-danger text-center'>Sesión no válida</div>");
                        }


                        /* =====================================================
                           ESPECIALISTA ACTIVO
                        ===================================================== */
                        $sqlEsp = "
SELECT Id 
FROM contratopersona 
WHERE Id_Usuario = $id_usuario
AND Rol = 'Especialista'
AND EstadoContrato = 1
LIMIT 1
";

                        $resEsp = $conexion->query($sqlEsp);

                        if (!$resEsp || $resEsp->num_rows === 0) {
                            die("<div class='alert alert-danger text-center'>
            No tienes contrato activo como especialista
         </div>");
                        }

                        $id_especialista = (int) $resEsp->fetch_assoc()['Id'];


                        /* =====================================================
                           FILTRO BUSCAR
                        ===================================================== */
                        $buscar = trim($_GET['buscar'] ?? '');
                        $where = "WHERE se.Id_Especialista = $id_especialista";

                        if ($buscar !== '') {
                            $b = $conexion->real_escape_string($buscar);
                            $where .= " AND (
        CONCAT(p.Nombre,' ',p.Apellido) LIKE '%$b%' OR
        p.NumeroTelefono LIKE '%$b%' OR
        p.NumeroDocumento LIKE '%$b%'
    )";
                        }


                        /* =====================================================
                           PAGINACIÓN
                        ===================================================== */
                        $por_pagina = 6;
                        $pagina = max(1, (int) ($_GET['pagina'] ?? 1));
                        $offset = ($pagina - 1) * $por_pagina;


                        /* =====================================================
                           TOTAL
                        ===================================================== */
                        $sqlTotal = "
SELECT COUNT(DISTINCT p.Id) total
FROM paciente p
INNER JOIN cita c ON c.Id_Paciente = p.Id
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
$where
";

                        $resTotal = $conexion->query($sqlTotal);
                        $total = (int) ($resTotal->fetch_assoc()['total'] ?? 0);
                        $paginas = max(1, ceil($total / $por_pagina));


                        /* =====================================================
                           CONSULTA PRINCIPAL
                        ===================================================== */
                        $sql = "
SELECT
    p.*,
    MAX(c.Fecha) AS ultima_cita,
    COUNT(c.Id) AS total_citas,
    (
        SELECT COUNT(*) 
        FROM historial_clinico hc 
        WHERE hc.id_paciente = p.Id
    ) AS historial
FROM paciente p
INNER JOIN cita c ON c.Id_Paciente = p.Id
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
$where
GROUP BY p.Id
ORDER BY ultima_cita DESC
LIMIT $offset, $por_pagina
";

                        $resultado = $conexion->query($sql);
                        ?>


                        <!-- =====================================================
   ESTILOS PRO
===================================================== -->
                        <style>
                            .card-body {
                                background: #f6f8fb;
                            }

                            .paciente-card {
                                border-radius: 18px;
                                transition: .25s;
                            }

                            .paciente-card:hover {
                                transform: translateY(-6px);
                                box-shadow: 0 15px 30px rgba(0, 0, 0, .12);
                            }

                            .avatar {
                                width: 90px;
                                height: 90px;
                                object-fit: cover;
                                border-radius: 50%;
                                border: 3px solid #e9ecef;
                            }

                            .search-box {
                                position: relative;
                            }

                            .search-box i {
                                position: absolute;
                                left: 14px;
                                top: 50%;
                                transform: translateY(-50%);
                                color: #999;
                            }

                            .search-box input {
                                padding-left: 40px;
                                border-radius: 12px;
                            }

                            .badge-soft {
                                font-size: .75rem;
                                padding: 6px 10px;
                                border-radius: 50px;
                            }
                        </style>



                        <!-- =====================================================
   CARD BODY
===================================================== -->
                        <div class="card-body rounded-3">

                            <!-- ================= BUSCADOR ================= -->
                            <form class="row g-2 mb-4">
                                <div class="col-md-10 search-box">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="buscar" class="form-control form-control-lg"
                                        placeholder="Buscar paciente..." value="<?= htmlspecialchars($buscar) ?>">
                                </div>

                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-primary btn-lg rounded-3">
                                        Buscar
                                    </button>
                                </div>
                            </form>



                            <!-- ================= LISTADO ================= -->
                            <div class="row g-4">

                                <?php if (!$resultado || $resultado->num_rows === 0): ?>
                                    <div class="col-12">
                                        <div class="alert alert-info text-center shadow-sm">
                                            No tienes pacientes asociados todavía
                                        </div>
                                    </div>
                                <?php endif; ?>


                                <?php while ($row = $resultado->fetch_assoc()):

                                    $id_p = (int) $row['Id'];

                                    $edad = 0;
                                    if (!empty($row['FechaNacimiento'])) {
                                        $edad = date_diff(
                                            date_create($row['FechaNacimiento']),
                                            date_create('today')
                                        )->y;
                                    }

                                    /* ================= IMAGEN SEGURA ================= */
                                    $baseRuta = '../../Img/Pacientes/';
                                    $archivo = !empty($row['Foto']) ? $row['Foto'] : 'user-default.png';

                                    if (!file_exists($baseRuta . $archivo)) {
                                        $archivo = 'user-default.png';
                                    }

                                    $foto = $baseRuta . $archivo;
                                    ?>



                                    <!-- ================= CARD PACIENTE ================= -->
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card paciente-card shadow-sm border-0 h-100">

                                            <div class="card-body text-center">

                                                <img src="<?= htmlspecialchars($foto) ?>" class="avatar mb-3">

                                                <h5 class="fw-bold mb-0">
                                                    <?= htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']) ?>
                                                </h5>

                                                <small class="text-muted"><?= $edad ?> años</small>

                                                <hr>

                                                <div class="small text-start lh-lg">

                                                    <div>📞
                                                        <?= htmlspecialchars($row['NumeroTelefono'] ?: 'No registrado') ?>
                                                    </div>
                                                    <div>🪪
                                                        <?= htmlspecialchars($row['NumeroDocumento'] ?: 'No registrado') ?>
                                                    </div>
                                                    <div>📅 Última cita: <?= htmlspecialchars($row['ultima_cita'] ?: '—') ?>
                                                    </div>
                                                    <div>🗓 Total citas: <?= (int) $row['total_citas'] ?></div>

                                                    <div class="mt-2">
                                                        <?php if ($row['historial'] > 0): ?>
                                                            <span class="badge bg-success badge-soft">Historial clínico</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger badge-soft">Sin historial</span>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>

                                                <hr>

                                                <!-- BOTONES -->
                                                <div class="d-flex justify-content-center gap-2">

                                                    <a href="HistorialPaciente.php?id=<?= $id_p ?>"
                                                        class="btn btn-dark btn-sm rounded-pill px-3" title="Historial">
                                                        <i class="fas fa-notes-medical"></i>
                                                    </a>

                                                    <button class="btn btn-primary btn-sm rounded-pill px-3"
                                                        data-bs-toggle="modal" data-bs-target="#citas<?= $id_p ?>"
                                                        title="Ver citas">
                                                        <i class="fas fa-calendar"></i>
                                                    </button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <!-- ================= MODAL CITAS ================= -->
                                    <div class="modal fade" id="citas<?= $id_p ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">

                                            <div class="modal-content shadow">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Historial de citas</h5>
                                                    <button class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <?php
                                                    $citas = $conexion->query("
                            SELECT Fecha, HoraInicio, Estado
                            FROM cita c
                            INNER JOIN servicioespecialista se 
                                ON se.Id = c.Id_ServicioEspecialista
                            WHERE c.Id_Paciente = $id_p
                            AND se.Id_Especialista = $id_especialista
                            ORDER BY Fecha DESC
                        ");
                                                    ?>

                                                    <?php if (!$citas || $citas->num_rows === 0): ?>
                                                        <div class="alert alert-secondary text-center">
                                                            Sin citas registradas
                                                        </div>
                                                    <?php else: ?>

                                                        <table class="table table-hover text-center align-middle">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Hora</th>
                                                                    <th>Estado</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php while ($c = $citas->fetch_assoc()):

                                                                    $color = 'secondary';

                                                                    if ($c['Estado'] == 'Finalizada')
                                                                        $color = 'success';
                                                                    elseif ($c['Estado'] == 'Cancelada')
                                                                        $color = 'danger';
                                                                    elseif ($c['Estado'] == 'Pendiente')
                                                                        $color = 'warning';
                                                                    ?>

                                                                    <tr>
                                                                        <td><?= htmlspecialchars($c['Fecha']) ?></td>
                                                                        <td><?= substr($c['HoraInicio'], 0, 5) ?></td>
                                                                        <td>
                                                                            <span class="badge bg-<?= $color ?>">
                                                                                <?= htmlspecialchars($c['Estado']) ?>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                <?php endwhile; ?>

                                                            </tbody>
                                                        </table>

                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile; ?>
                            </div>



                            <!-- ================= PAGINACIÓN ================= -->
                            <nav class="mt-5">
                                <ul class="pagination justify-content-center">

                                    <?php for ($i = 1; $i <= $paginas; $i++): ?>
                                        <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                                            <a class="page-link" href="?pagina=<?= $i ?>&buscar=<?= urlencode($buscar) ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                </ul>
                            </nav>

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