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
                                        <i class="fas fa-calendar-check me-2"></i>
                                        Gestión de Citas
                                    </h5>
                                    <small class="text-muted">
                                        Control diario de citas, atención e historial de pacientes
                                    </small>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <?php
                            $id_usuario = (int) $_SESSION['id'];

                            /* =====================================================
                               OBTENER ID ESPECIALISTA
                            ===================================================== */
                            $sqlEsp = "SELECT Id FROM contratopersona WHERE Id_Usuario = $id_usuario LIMIT 1";
                            $resEsp = $conexion->query($sqlEsp);
                            $rowEsp = $resEsp->fetch_assoc();

                            if (!$rowEsp) {
                                echo "<div class='alert alert-danger'>Especialista no encontrado</div>";
                                return;
                            }

                            $id_especialista = (int) $rowEsp['Id'];


                            /* =====================================================
                               FILTROS
                            ===================================================== */
                            $buscar = trim($_GET['buscar'] ?? '');
                            $estado = trim($_GET['estado'] ?? '');
                            $fecha = trim($_GET['fecha'] ?? '');

                            $where = "WHERE se.Id_Especialista = $id_especialista";

                            if ($buscar !== '') {
                                $buscar = $conexion->real_escape_string($buscar);
                                $where .= " AND CONCAT(p.Nombre,' ',p.Apellido) LIKE '%$buscar%'";
                            }

                            if ($estado !== '') {
                                $estado = $conexion->real_escape_string($estado);
                                $where .= " AND c.Estado = '$estado'";
                            }

                            if ($fecha !== '') {
                                $where .= " AND c.Fecha = '$fecha'";
                            }


                            /* =====================================================
                               PAGINACIÓN
                            ===================================================== */
                            $por_pagina = 8;
                            $pagina = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
                            $offset = ($pagina - 1) * $por_pagina;


                            /* =====================================================
                               TOTAL REGISTROS
                            ===================================================== */
                            $sqlTotal = "
SELECT COUNT(*) total
FROM cita c
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN paciente p ON p.Id = c.Id_Paciente
$where
";

                            $total = $conexion->query($sqlTotal)->fetch_assoc()['total'];
                            $paginas = ceil($total / $por_pagina);


                            /* =====================================================
                               CONSULTA PRINCIPAL
                               ⭐ FIX IMPORTANTE: se agrega Id_Paciente
                            ===================================================== */
                            $sql = "
SELECT
    c.Id,
    c.Id_Paciente,   -- ⭐ NECESARIO PARA HISTORIAL
    c.Fecha,
    c.HoraInicio,
    c.Estado,
    c.Facturar,
    CONCAT(p.Nombre,' ',p.Apellido) paciente,
    s.Nombre servicio

FROM cita c
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN paciente p ON p.Id = c.Id_Paciente

$where

ORDER BY c.Fecha DESC, c.HoraInicio DESC
LIMIT $offset,$por_pagina
";

                            $resultado = $conexion->query($sql);
                            ?>


                            <!-- =====================================================
   FILTROS
===================================================== -->
                            <form class="row g-2 mb-4">

                                <div class="col-md-4">
                                    <input type="text" name="buscar" class="form-control"
                                        placeholder="🔍 Buscar paciente..." value="<?= htmlspecialchars($buscar) ?>">
                                </div>

                                <div class="col-md-3">
                                    <select name="estado" class="form-select">
                                        <option value="">Todos los estados</option>
                                        <option value="PENDIENTE" <?= $estado == 'PENDIENTE' ? 'selected' : '' ?>>Pendiente
                                        </option>
                                        <option value="EN_PROCESO" <?= $estado == 'EN_PROCESO' ? 'selected' : '' ?>>En
                                            proceso
                                        </option>
                                        <option value="ATENDIDA" <?= $estado == 'ATENDIDA' ? 'selected' : '' ?>>Atendida
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="date" name="fecha" class="form-control" value="<?= $fecha ?>">
                                </div>

                                <div class="col-md-1 d-grid">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                <div class="col-md-1 d-grid">
                                    <a href="MisCitas.php" class="btn btn-secondary">
                                        <i class="fas fa-eraser"></i>
                                    </a>
                                </div>

                            </form>



                            <!-- =====================================================
   TABLA
===================================================== -->
                            <div class="table-responsive">

                                <table class="table table-hover align-middle text-center">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Paciente</th>
                                            <th>Servicio</th>
                                            <th>Estado</th>
                                            <th width="180">Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php if ($resultado->num_rows == 0): ?>
                                            <tr>
                                                <td colspan="6" class="text-muted py-4">
                                                    No hay citas registradas
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php while ($row = $resultado->fetch_assoc()): ?>

                                            <?php
                                            $badge = 'secondary';
                                            if ($row['Estado'] == 'EN_PROCESO')
                                                $badge = 'primary';
                                            if ($row['Estado'] == 'ATENDIDA')
                                                $badge = 'success';
                                            ?>

                                            <tr>
                                                <td><?= $row['Fecha'] ?></td>
                                                <td><?= substr($row['HoraInicio'], 0, 5) ?></td>
                                                <td><?= $row['paciente'] ?></td>
                                                <td><?= $row['servicio'] ?></td>

                                                <td>
                                                    <span class="badge bg-<?= $badge ?>">
                                                        <?= $row['Estado'] ?>
                                                    </span>
                                                </td>

                                                <td class="d-flex justify-content-center gap-1">

                                                    <!-- VER -->
                                                    <button type="button" class="btn btn-sm btn-info verCitaBtn"
                                                        data-id="<?= $row['Id'] ?>" data-paciente="<?= $row['paciente'] ?>"
                                                        data-servicio="<?= $row['servicio'] ?>"
                                                        data-fecha="<?= $row['Fecha'] ?>"
                                                        data-hora="<?= substr($row['HoraInicio'], 0, 5) ?>"
                                                        data-estado="<?= $row['Estado'] ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>




                                                    <!-- ATENDER -->
                                                    <?php if ($row['Estado'] == 'EN_PROCESO'): ?>
                                                        <a href="AtenderCita.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-primary" title="Atender cita">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </a>
                                                    <?php endif; ?>


                                                    <!-- HISTORIAL / VALORACIÓN -->
                                                    <?php if ($row['Estado'] == 'ATENDIDA'): ?>
                                                        <a href="VerValoracion.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-success" title="Historial clínico">
                                                            <i class="fas fa-file-medical"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>

                                        <?php endwhile; ?>

                                    </tbody>

                                </table>
                            </div>


                            <!-- =====================================================
   PAGINACIÓN PRO
===================================================== -->
                            <?php if ($paginas > 1):

                                $limite = 2; // cuántas páginas mostrar a cada lado
                                $inicio = max(1, $pagina - $limite);
                                $fin = min($paginas, $pagina + $limite);

                                $queryBase = "&buscar=$buscar&estado=$estado&fecha=$fecha";
                                ?>

                                <nav class="mt-4">
                                    <ul class="pagination justify-content-center align-items-center shadow-sm">

                                        <!-- PRIMERA -->
                                        <li class="page-item <?= ($pagina == 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?pagina=1<?= $queryBase ?>">
                                                «
                                            </a>
                                        </li>

                                        <!-- ANTERIOR -->
                                        <li class="page-item <?= ($pagina == 1 ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?pagina=<?= $pagina - 1 ?><?= $queryBase ?>">
                                                ‹
                                            </a>
                                        </li>


                                        <!-- NUMEROS -->
                                        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                                            <li class="page-item <?= ($i == $pagina ? 'active' : '') ?>">
                                                <a class="page-link" href="?pagina=<?= $i ?><?= $queryBase ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>


                                        <!-- SIGUIENTE -->
                                        <li class="page-item <?= ($pagina == $paginas ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?pagina=<?= $pagina + 1 ?><?= $queryBase ?>">
                                                ›
                                            </a>
                                        </li>

                                        <!-- ULTIMA -->
                                        <li class="page-item <?= ($pagina == $paginas ? 'disabled' : '') ?>">
                                            <a class="page-link" href="?pagina=<?= $paginas ?><?= $queryBase ?>">
                                                »
                                            </a>
                                        </li>

                                    </ul>
                                </nav>

                            <?php endif; ?>









                            <!-- ================= MODAL VER CITA ================= -->
                            <div class="modal fade" id="modalCita" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-calendar-check"></i> Detalle de la cita
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body small">

                                            <p><b>Paciente:</b> <span id="mPaciente"></span></p>
                                            <p><b>Servicio:</b> <span id="mServicio"></span></p>

                                            <div class="row">
                                                <div class="col-6"><b>Fecha:</b> <span id="mFecha"></span></div>
                                                <div class="col-6"><b>Hora:</b> <span id="mHora"></span></div>
                                            </div>

                                            <p class="mt-2">
                                                <b>Estado:</b>
                                                <span id="mEstado" class="badge"></span>
                                            </p>

                                        </div>

                                        <div class="modal-footer">

                                            <a id="btnAtender" class="btn btn-primary btn-sm d-none">
                                                <i class="fas fa-stethoscope"></i> Atender
                                            </a>

                                            <a id="btnHistorial" class="btn btn-success btn-sm d-none">
                                                <i class="fas fa-file-medical"></i> Historial
                                            </a>

                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">
                                                Cerrar
                                            </button>

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



    <script>
        const modalElement = document.getElementById('modalCita');
        const modal = new bootstrap.Modal(modalElement);

        document.querySelectorAll('.verCitaBtn').forEach(btn => {

            btn.addEventListener('click', () => {

                const id = btn.dataset.id;
                const estado = btn.dataset.estado;

                // datos
                mPaciente.innerText = btn.dataset.paciente;
                mServicio.innerText = btn.dataset.servicio;
                mFecha.innerText = btn.dataset.fecha;
                mHora.innerText = btn.dataset.hora;

                // badge estado
                mEstado.innerText = estado;
                mEstado.className = "badge";

                if (estado === 'PENDIENTE') mEstado.classList.add('bg-secondary');
                if (estado === 'EN_PROCESO') mEstado.classList.add('bg-primary');
                if (estado === 'ATENDIDA') mEstado.classList.add('bg-success');

                // OCULTAR TODOS
                btnAtender.classList.add('d-none');
                btnHistorial.classList.add('d-none');

                // MOSTRAR SEGÚN ESTADO
                if (estado === 'EN_PROCESO') {
                    btnAtender.href = "AtenderCita.php?id=" + id;
                    btnAtender.classList.remove('d-none');
                }

                if (estado === 'ATENDIDA') {
                    btnHistorial.href = "VerValoracion.php?id=" + id;
                    btnHistorial.classList.remove('d-none');
                }

                modal.show();
            });

        });
    </script>







</body>

</html>

<?php
unset($_SESSION["Error"]);
?>