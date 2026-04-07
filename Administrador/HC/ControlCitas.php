<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 3)) {
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
    $consul = "SELECT admi.Foto, admi.Nombre, admi.Apellido, u.Usuario, admi.Id FROM administrador admi
  INNER JOIN usuario u ON admi.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
    $ejecu = mysqli_query($conexion, $consul);
    $Fil = mysqli_fetch_assoc($ejecu);
    $idusua = $Fil['Id'];
    $nomusuario = $Fil['Nombre'];
    $apeusuario = $Fil['Apellido'];
    $email = $Fil['Usuario'];
    $foto = $Fil['Foto'];
    ?>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4 Lolo">
                    <a href="../../Blog/InicioAdministrador.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-house me-3 IconosMenu"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="../../Administrador/Personal/Contratos.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-users-gear me-3 IconosMenu"></i>
                        <span>Equipo</span>
                    </a>
                    <a href="../../Administrador/Servicios/Servicios.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-spa me-3 IconosMenu"></i>
                        <span>Rituales</span>
                    </a>
                    <a href="../../Administrador/Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-user me-3 IconosMenu"></i>
                        <span>Pacientes</span>
                    </a>
                    <a href="../../Administrador/Citas/RegistroCitas.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-calendar-days me-3 IconosMenu"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="../../Administrador/HC/ControlCitas.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-clock me-3 IconosMenu"></i>
                        <span>Agenda de hoy</span>
                    </a>
                    <a href="../../Administrador/Facturas/FacturarAdmin.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-file-invoice-dollar me-3 IconosMenu"></i>
                        <span>Nueva factura</span>
                    </a>
                    <a href="../../Administrador/Facturas/FacturasAdmin.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-folder-open me-3 IconosMenu"></i>
                        <span>Facturas</span>
                    </a>
                    <a href="../../Administrador/Reportes/Reportes.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-chart-line me-3 IconosMenu"></i>
                        <span>Reportes</span>
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
                        <?php
                        // VALIDAR FOTO PARA EL MENÚ
                        if (!empty($foto) && file_exists("../Perfil/Img/" . $foto)) {
                            $fotoMenu = "../Perfil/Img/" . $foto;
                        } else {
                            $fotoMenu = "../Perfil/Img/user-default.png";
                        }
                        ?>
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">

                            <img src="<?= $fotoMenu ?>" class="rounded-circle" height="26" loading="lazy"
                                alt="Foto perfil">

                            <b class="NomMiCuenta ms-2">Mi cuenta</b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
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

                            <!-- ================= FILTROS ================= -->
                            <form method="GET" class="row g-3 mb-4">

                                <div class="col-md-4">
                                    <input type="text" name="paciente" class="form-control"
                                        placeholder="Buscar paciente" value="<?= htmlspecialchars($paciente) ?>">
                                </div>

                                <div class="col-md-3">
                                    <select name="estado" class="form-select">
                                        <option value="">Todos los estados</option>
                                        <option value="PENDIENTE" <?= $estado == 'PENDIENTE' ? 'selected' : '' ?>>Pendiente
                                        </option>
                                        <option value="EN_PROCESO" <?= $estado == 'EN_PROCESO' ? 'selected' : '' ?>>En
                                            proceso</option>
                                        <option value="ATENDIDA" <?= $estado == 'ATENDIDA' ? 'selected' : '' ?>>Atendida
                                        </option>
                                        <option value="FACTURADA" <?= $estado == 'FACTURADA' ? 'selected' : '' ?>>Facturada
                                        </option>
                                        <option value="CANCELADA" <?= $estado == 'CANCELADA' ? 'selected' : '' ?>>Cancelada
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select name="facturar" class="form-select">
                                        <option value="">Facturación</option>
                                        <option value="NO" <?= $facturar == 'NO' ? 'selected' : '' ?>>No facturada</option>
                                        <option value="SI" <?= $facturar == 'SI' ? 'selected' : '' ?>>Facturada</option>
                                    </select>
                                </div>

                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
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
                                                        <a href="activar_cita.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="return confirm('¿Deseas iniciar esta cita?')"
                                                            title="Iniciar cita">
                                                            <i class="fas fa-play"></i>
                                                        </a>

                                                    <?php elseif ($row['Estado'] == 'EN_PROCESO'): ?>
                                                        <a href="../HC/atender_cita.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-warning" title="Atender cita">
                                                            <i class="fas fa-notes-medical"></i>
                                                        </a>

                                                    <?php elseif ($row['Estado'] == 'ATENDIDA'): ?>
                                                        <a href="../Facturas/FacturarAdmin.php"
                                                            class="btn btn-sm btn-success" title="Facturar">
                                                            <i class="fas fa-cash-register"></i>
                                                        </a>

                                                    <?php elseif ($row['Estado'] == 'FACTURADA'): ?>
                                                        <span class="badge bg-secondary">Cerrada</span>

                                                    <?php elseif ($row['Estado'] == 'CANCELADA'): ?>
                                                        <span class="badge bg-danger">Cancelada</span>
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