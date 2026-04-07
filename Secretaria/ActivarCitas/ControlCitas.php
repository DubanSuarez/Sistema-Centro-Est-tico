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
                        <div class="card-header py-3">
                            <div class="row mb-4">
                                <div class="col-md-6 text-md-start text-center">
                                    <h5 class="fw-bold EstiloLetraTarjeta">Atención de Citas</h4>
                                        <small class="text-muted">Gestión diaria de citas y atención al paciente</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php
                            /* =========================================================
                               FILTROS
                            ========================================================= */
                            $paciente = $_GET['paciente'] ?? '';
                            $estado = $_GET['estado'] ?? '';
                            $facturar = $_GET['facturar'] ?? '';
                            ?>
                            <!-- ================= FILTROS PRO CITAS ================= -->
                            <form method="GET" class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <div class="row g-3">

                                        <!-- Buscar paciente -->
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Buscar paciente</label>
                                            <input type="text" name="paciente" class="form-control"
                                                placeholder="Nombre, documento o teléfono"
                                                value="<?= htmlspecialchars($paciente ?? '') ?>">
                                        </div>

                                        <!-- Estado -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Estado cita</label>
                                            <select name="estado" class="form-select">
                                                <option value="">Todos</option>
                                                <option value="PENDIENTE" <?= ($estado ?? '') == 'PENDIENTE' ? 'selected' : '' ?>>Pendiente</option>
                                                <option value="EN_PROCESO" <?= ($estado ?? '') == 'EN_PROCESO' ? 'selected' : '' ?>>En proceso</option>
                                                <option value="ATENDIDA" <?= ($estado ?? '') == 'ATENDIDA' ? 'selected' : '' ?>>Atendida</option>
                                                <option value="FACTURADA" <?= ($estado ?? '') == 'FACTURADA' ? 'selected' : '' ?>>Facturada</option>
                                                <option value="CANCELADA" <?= ($estado ?? '') == 'CANCELADA' ? 'selected' : '' ?>>Cancelada</option>
                                            </select>
                                        </div>

                                        <!-- Facturación -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Facturación</label>
                                            <select name="facturar" class="form-select">
                                                <option value="">Todas</option>
                                                <option value="NO" <?= ($facturar ?? '') == 'NO' ? 'selected' : '' ?>>No
                                                    facturada</option>
                                                <option value="SI" <?= ($facturar ?? '') == 'SI' ? 'selected' : '' ?>>
                                                    Facturada</option>
                                            </select>
                                        </div>

                                        <!-- Botón buscar -->
                                        <div class="col-md-1 d-grid align-items-end">
                                            <button class="btn btn-dark" title="Filtrar">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                        <!-- Botón limpiar -->
                                        <div class="col-md-1 d-grid align-items-end">
                                            <a href="ControlCitas.php" class="btn btn-secondary"
                                                title="Limpiar filtros">
                                                <i class="fas fa-broom"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </form>


                            <?php
                            /* =========================================================
                               PAGINACIÓN
                            ========================================================= */
                            $por_pagina = 10;
                            $pagina = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
                            $inicio = ($pagina - 1) * $por_pagina;

                            /* =========================================================
                               WHERE DINÁMICO
                            ========================================================= */
                            $where = "c.Fecha = CURDATE()";

                            if ($paciente != '') {
                                $paciente_sql = mysqli_real_escape_string($conexion, $paciente);
                                $where .= " AND CONCAT(p.Nombre,' ',p.Apellido) LIKE '%$paciente_sql%'";
                            }

                            if ($estado != '') {
                                $estado_sql = mysqli_real_escape_string($conexion, $estado);
                                $where .= " AND c.Estado = '$estado_sql'";
                            }

                            if ($facturar != '') {
                                $facturar_sql = mysqli_real_escape_string($conexion, $facturar);
                                $where .= " AND c.Facturar = '$facturar_sql'";
                            }

                            /* =========================================================
                               CONSULTA PRINCIPAL
                            ========================================================= */
                            $sql = "
SELECT 
    c.Id,
    c.HoraInicio,
    c.Estado,
    c.Facturar,
    p.Nombre   AS PacienteNombre,
    p.Apellido AS PacienteApellido,
    s.Nombre   AS Servicio,
    cp.Nombre  AS EspNombre,
    cp.Apellido AS EspApellido
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN contratopersona cp ON cp.Id = se.Id_Especialista
WHERE $where
ORDER BY c.HoraInicio ASC
LIMIT $inicio, $por_pagina
";
                            $res = mysqli_query($conexion, $sql);

                            /* =========================================================
                               TOTAL PARA PAGINACIÓN (MISMO JOIN)
                            ========================================================= */
                            $sql_total = "
SELECT COUNT(*) AS total
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN contratopersona cp ON cp.Id = se.Id_Especialista
WHERE $where
";
                            $res_total = mysqli_query($conexion, $sql_total);
                            $total = mysqli_fetch_assoc($res_total)['total'];
                            $total_paginas = ceil($total / $por_pagina);

                            /* =========================================================
                               QUERY STRING PARA PAGINACIÓN (NO PERDER FILTROS)
                            ========================================================= */
                            $queryString = "&paciente=" . urlencode($paciente) .
                                "&estado=" . urlencode($estado) .
                                "&facturar=" . urlencode($facturar);
                            ?>

                            <!-- ================= TABLA ================= -->
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Hora</th>
                                        <th>Paciente</th>
                                        <th>Servicio</th>
                                        <th>Especialista</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (mysqli_num_rows($res) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($res)): ?>
                                            <tr>
                                                <td><?= date('H:i', strtotime($row['HoraInicio'])) ?></td>
                                                <td><?= htmlspecialchars($row['PacienteNombre'] . ' ' . $row['PacienteApellido']) ?>
                                                </td>
                                                <td><?= htmlspecialchars($row['Servicio']) ?></td>
                                                <td><?= htmlspecialchars($row['EspNombre'] . ' ' . $row['EspApellido']) ?></td>

                                                <td>
                                                    <?php
                                                    switch ($row['Estado']) {
                                                        case 'PENDIENTE':
                                                            echo '<span class="badge bg-warning text-dark">Pendiente</span>';
                                                            break;
                                                        case 'EN_PROCESO':
                                                            echo '<span class="badge bg-primary">En proceso</span>';
                                                            break;
                                                        case 'ATENDIDA':
                                                            echo '<span class="badge bg-success">Atendida</span>';
                                                            break;
                                                        case 'FACTURADA':
                                                            echo '<span class="badge bg-dark">Facturada</span>';
                                                            break;
                                                        case 'CANCELADA':
                                                            echo '<span class="badge bg-danger">Cancelada</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">

                                                    <?php if ($row['Estado'] == 'PENDIENTE'): ?>

                                                        <!-- ACTIVAR CITA -->
                                                        <a href="activar_cita.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="return confirm('¿Deseas iniciar esta cita?')"
                                                            title="Iniciar cita">
                                                            <i class="fas fa-play"></i>
                                                        </a>


                                                    <?php elseif ($row['Estado'] == 'EN_PROCESO'): ?>

                                                        <!-- EN ATENCION -->
                                                        <button class="btn btn-sm btn-warning" disabled
                                                            title="Paciente en atención">
                                                            <i class="fas fa-user-md"></i> En atención
                                                        </button>


                                                    <?php elseif ($row['Estado'] == 'ATENDIDA'): ?>

                                                        <!-- FACTURAR -->
                                                        <a href="../Facturas/Facturar.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-success" title="Facturar cita">
                                                            <i class="fas fa-cash-register"></i>
                                                        </a>


                                                    <?php elseif ($row['Estado'] == 'FACTURADA'): ?>

                                                        <!-- CERRADA -->
                                                        <span class="badge bg-secondary">
                                                            <i class="fas fa-check-circle"></i> Cerrada
                                                        </span>


                                                    <?php elseif ($row['Estado'] == 'CANCELADA'): ?>

                                                        <!-- CANCELADA -->
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times"></i> Cancelada
                                                        </span>

                                                    <?php endif; ?>

                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No hay citas programadas para hoy
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- ================= PAGINACIÓN ================= -->
                            <nav>
                                <ul class="pagination justify-content-center">

                                    <li class="page-item <?= $pagina == 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=1<?= $queryString ?>">⏮</a>
                                    </li>

                                    <li class="page-item <?= $pagina == 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $pagina - 1 ?><?= $queryString ?>">◀</a>
                                    </li>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?><?= $queryString ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?= $pagina == $total_paginas ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $pagina + 1 ?><?= $queryString ?>">▶</a>
                                    </li>

                                    <li class="page-item <?= $pagina == $total_paginas ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $total_paginas ?><?= $queryString ?>">⏭</a>
                                    </li>

                                </ul>
                            </nav>





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