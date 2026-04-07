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
                            require_once('../../Conexiones/conexion.php');

                            /* =====================================================
                               RECIBE ID DE CITA (DESDE MisCitas)
                            ===================================================== */
                            $id_cita = (int) ($_GET['id'] ?? 0);

                            if ($id_cita <= 0) {
                                echo "<div class='alert alert-danger'>Cita inválida</div>";
                                return;
                            }


                            /* =====================================================
                               1️⃣ OBTENER CITA + PACIENTE + SERVICIO + ESPECIALISTA
                               (ESTA CONSULTA GARANTIZA EL PACIENTE CORRECTO)
                            ===================================================== */
                            $sql = "
SELECT 
    c.Id,
    c.Id_Paciente,
    c.Fecha,
    c.HoraInicio,
    c.HoraFin,
    c.Estado,
    c.ValorTotal,

    p.*,

    s.Nombre servicio,
    CONCAT(e.Nombre,' ',e.Apellido) especialista

FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN contratopersona e ON e.Id = se.Id_Especialista

WHERE c.Id = $id_cita
LIMIT 1
";

                            $res = $conexion->query($sql);

                            if (!$res || $res->num_rows == 0) {
                                echo "<div class='alert alert-warning'>Cita no encontrada</div>";
                                return;
                            }

                            $cita = $res->fetch_assoc();
                            $id_paciente = (int) $cita['Id_Paciente'];


                            /* =====================================================
                               2️⃣ HISTORIAL CLÍNICO
                            ===================================================== */
                            $histQ = $conexion->query("
SELECT *
FROM historial_clinico
WHERE id_paciente = $id_paciente
LIMIT 1
");

                            $hist = $histQ ? $histQ->fetch_assoc() : [];


                            /* =====================================================
                               3️⃣ PAGINACIÓN
                            ===================================================== */
                            $por_pagina = 5;
                            $pagina = max(1, (int) ($_GET['pagina'] ?? 1));
                            $offset = ($pagina - 1) * $por_pagina;


                            /* =====================================================
                               4️⃣ TOTAL VALORACIONES (⭐ TODAS DEL PACIENTE)
                            ===================================================== */
                            $total = $conexion->query("
SELECT COUNT(*) total
FROM valoracion_estetica v
INNER JOIN cita c ON c.Id = v.id_cita
WHERE c.Id_Paciente = $id_paciente
")->fetch_assoc()['total'];

                            $total_paginas = max(1, ceil($total / $por_pagina));


                            /* =====================================================
                               5️⃣ VALORACIONES (⭐ HISTORIAL COMPLETO)
                            ===================================================== */
                            $valoraciones = $conexion->query("
SELECT 
    v.*,
    s.Nombre servicio,
    CONCAT(e.Nombre,' ',e.Apellido) especialista,
    c.Fecha fecha_cita

FROM valoracion_estetica v
INNER JOIN cita c ON c.Id = v.id_cita
INNER JOIN servicio s ON s.Id = v.id_servicio
INNER JOIN contratopersona e ON e.Id = v.id_especialista

WHERE c.Id_Paciente = $id_paciente
ORDER BY v.fecha DESC
LIMIT $offset,$por_pagina
");
                            ?>



                            <!-- ===================================================== -->
                            <!-- HEADER -->
                            <!-- ===================================================== -->
                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div>
                                    <h5 class="fw-bold mb-0">
                                        <?= $cita['Nombre'] . ' ' . $cita['Apellido'] ?>
                                    </h5>
                                    <small class="text-muted">Historial clínico completo del paciente</small>
                                </div>

                                <div class="d-flex gap-2">

                                    <a href="MisCitas.php" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>

                                    <?php if ($cita['Estado'] == 'EN_PROCESO'): ?>
                                        <a href="AtenderCita.php?id=<?= $id_cita ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Nueva valoración
                                        </a>
                                    <?php endif; ?>

                                    <button onclick="window.print()" class="btn btn-outline-dark btn-sm">
                                        <i class="fas fa-print"></i>
                                    </button>

                                </div>
                            </div>



                            <!-- ===================================================== -->
                            <!-- DATOS PACIENTE -->
                            <!-- ===================================================== -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-body small">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <b>Documento:</b><br><?= $cita['NumeroDocumento'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-3"><b>Teléfono:</b><br><?= $cita['NumeroTelefono'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-3"><b>Dirección:</b><br><?= $cita['Direccion'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-3"><b>Género:</b><br><?= $cita['Genero'] ?? '-' ?></div>

                                    </div>
                                </div>
                            </div>



                            <!-- ===================================================== -->
                            <!-- INFO CITA ACTUAL -->
                            <!-- ===================================================== -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-body small">
                                    <div class="row">

                                        <div class="col-md-3"><b>Fecha cita actual:</b><br><?= $cita['Fecha'] ?></div>
                                        <div class="col-md-3"><b>Hora:</b><br><?= substr($cita['HoraInicio'], 0, 5) ?>
                                        </div>
                                        <div class="col-md-3"><b>Servicio:</b><br><?= $cita['servicio'] ?></div>
                                        <div class="col-md-3"><b>Especialista:</b><br><?= $cita['especialista'] ?></div>

                                    </div>
                                </div>
                            </div>



                            <!-- ===================================================== -->
                            <!-- HISTORIAL CLÍNICO -->
                            <!-- ===================================================== -->
                            <div class="card shadow-sm mb-4">

                                <div class="card-header bg-light fw-semibold">
                                    <i class="fas fa-notes-medical"></i> Historial clínico
                                </div>

                                <div class="card-body small">

                                    <div class="row">

                                        <div class="col-md-3"><b>Estatura:</b><br><?= $hist['Estatura'] ?? '-' ?></div>
                                        <div class="col-md-3"><b>Peso:</b><br><?= $hist['Peso'] ?? '-' ?></div>
                                        <div class="col-md-6"><b>Alergias:</b><br><?= $hist['alergias'] ?? '-' ?></div>

                                        <div class="col-md-6 mt-2">
                                            <b>Enfermedades:</b><br><?= $hist['enfermedades'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <b>Medicamentos:</b><br><?= $hist['medicamentos'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <b>Antecedentes:</b><br><?= $hist['antecedentes_relevantes'] ?? '-' ?>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <b>Embarazo/Lactancia:</b><br><?= $hist['embarazo_lactancia'] ?? '-' ?>
                                        </div>

                                    </div>

                                </div>
                            </div>



                            <!-- ===================================================== -->
                            <!-- VALORACIONES -->
                            <!-- ===================================================== -->
                            <div class="card shadow-sm">

                                <div class="card-header bg-light fw-semibold">
                                    <i class="fas fa-spa"></i> Valoraciones estéticas
                                </div>

                                <div class="card-body">

                                    <?php if ($valoraciones->num_rows == 0): ?>

                                        <div class="alert alert-info">Sin valoraciones registradas.</div>

                                    <?php else: ?>

                                        <div class="accordion" id="acordeonValoraciones">

                                            <?php $i = 0;
                                            while ($v = $valoraciones->fetch_assoc()):
                                                $i++; ?>

                                                <div class="accordion-item">

                                                    <h2 class="accordion-header" id="head<?= $i ?>">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#val<?= $i ?>">

                                                            <?= $v['fecha'] ?> | <?= $v['servicio'] ?> |
                                                            <?= $v['especialista'] ?>
                                                        </button>
                                                    </h2>

                                                    <div id="val<?= $i ?>" class="accordion-collapse collapse"
                                                        data-bs-parent="#acordeonValoraciones">

                                                        <div class="accordion-body small">

                                                            <b>Cita:</b> <?= $v['fecha_cita'] ?><br><br>

                                                            <b>Tipo piel:</b> <?= $v['tipo_piel'] ?><br>
                                                            <b>Fototipo:</b> <?= $v['fototipo'] ?><br>
                                                            <b>Estado piel:</b> <?= $v['estado_piel'] ?><br><br>

                                                            <b>Diagnóstico:</b><br><?= $v['diagnostico_estetico'] ?><br><br>

                                                            <b>Procedimiento:</b><br><?= $v['procedimiento_realizado'] ?><br><br>

                                                            <b>Productos:</b> <?= $v['productos_utilizados'] ?: '-' ?><br>
                                                            <b>Equipos:</b> <?= $v['equipos_utilizados'] ?: '-' ?><br>
                                                            <b>Reacciones:</b> <?= $v['reacciones'] ?: '-' ?><br>
                                                            <b>Recomendaciones:</b> <?= $v['recomendaciones'] ?: '-' ?><br>
                                                            <b>Próxima cita:</b> <?= $v['proxima_cita'] ?: '-' ?>

                                                        </div>
                                                    </div>

                                                </div>

                                            <?php endwhile; ?>

                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>



                            <!-- ===================================================== -->
                            <!-- PAGINACIÓN PRO -->
                            <!-- ===================================================== -->
                            <?php if ($total_paginas > 1): ?>

                                <nav class="mt-4">
                                    <ul class="pagination justify-content-center">

                                        <li class="page-item <?= ($pagina <= 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?id=<?= $id_cita ?>&pagina=<?= $pagina - 1 ?>">‹</a>
                                        </li>

                                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                            <li class="page-item <?= ($i == $pagina ? 'active' : '') ?>">
                                                <a class="page-link" href="?id=<?= $id_cita ?>&pagina=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="page-item <?= ($pagina >= $total_paginas ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?id=<?= $id_cita ?>&pagina=<?= $pagina + 1 ?>">›</a>
                                        </li>

                                    </ul>
                                </nav>

                            <?php endif; ?>







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