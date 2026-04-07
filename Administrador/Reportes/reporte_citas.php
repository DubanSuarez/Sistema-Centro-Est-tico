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
    <!-- Iconos bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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
                                <div class="row mb-4">
                                    <div class="col-md-6 text-md-start text-center">
                                        <h5 class="fw-bold EstiloLetraTarjeta">Reporte de Citas</h5>
                                        <small class="text-muted">Visualización y control de citas registradas</small>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="card-body">



                            <?php

                            /* =========================
                               FILTROS
                            ========================= */
                            $estadoFiltro = $_GET['estado'] ?? '';
                            $fechaFiltro = $_GET['fecha'] ?? '';

                            /* =========================
                               PAGINACIÓN
                            ========================= */
                            $registrosPorPagina = 6;
                            $paginaActual = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                            $inicio = ($paginaActual - 1) * $registrosPorPagina;

                            /* =========================
                               WHERE DINÁMICO
                            ========================= */
                            $where = [];

                            if (!empty($estadoFiltro)) {
                                $estado = mysqli_real_escape_string($conexion, $estadoFiltro);
                                $where[] = "c.Estado = '$estado'";
                            }

                            if (!empty($fechaFiltro)) {
                                $fecha = mysqli_real_escape_string($conexion, $fechaFiltro);
                                $where[] = "c.Fecha = '$fecha'";
                            }

                            $whereSQL = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

                            /* =========================
                               TOTAL DE REGISTROS
                            ========================= */
                            $sqlTotal = "
SELECT COUNT(*) AS total
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN usuario u ON u.Id = se.Id_Especialista
$whereSQL
";

                            $totalResultado = mysqli_query($conexion, $sqlTotal);
                            $totalFilas = mysqli_fetch_assoc($totalResultado)['total'];
                            $totalPaginas = ceil($totalFilas / $registrosPorPagina);

                            /* =========================
                               CONSULTA PRINCIPAL
                            ========================= */
                            $sql = "
SELECT 
    c.Id,
    c.Fecha,
    c.HoraInicio,
    c.HoraFin,
    c.Estado,
    c.ValorTotal,
    CONCAT(p.Nombre,' ',p.Apellido) AS Paciente,
    s.Nombre AS Servicio,
    u.Usuario AS Especialista
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN usuario u ON u.Id = se.Id_Especialista
$whereSQL
ORDER BY c.Fecha DESC, c.HoraInicio DESC
LIMIT $inicio, $registrosPorPagina
";

                            $resultado = mysqli_query($conexion, $sql);
                            ?>



                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <form method="GET" class="row g-3 align-items-end">

                                        <div class="col-md-4">
                                            <label class="form-label">Estado</label>
                                            <select name="estado" class="form-select">
                                                <option value="">Todos</option>
                                                <option value="PENDIENTE" <?= $estadoFiltro == 'PENDIENTE' ? 'selected' : '' ?>>Pendiente</option>
                                                <option value="ATENDIDA" <?= $estadoFiltro == 'ATENDIDA' ? 'selected' : '' ?>>Atendida</option>
                                                <option value="CANCELADA" <?= $estadoFiltro == 'CANCELADA' ? 'selected' : '' ?>>Cancelada</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Fecha</label>
                                            <input type="date" name="fecha" class="form-control"
                                                value="<?= $fechaFiltro ?>">
                                        </div>

                                        <div class="col-md-4">
                                            <button class="btn btn-primary w-100">
                                                <i class="bi bi-search"></i> Filtrar
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>




                            <!-- TABLA -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Paciente</th>
                                                    <th>Servicio</th>
                                                    <th>Especialista</th>
                                                    <th>Valor</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php if (mysqli_num_rows($resultado) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                                                        <tr>
                                                            <td><?= $row['Id'] ?></td>
                                                            <td><?= $row['Fecha'] ?></td>
                                                            <td><?= $row['HoraInicio'] ?> - <?= $row['HoraFin'] ?></td>
                                                            <td><?= $row['Paciente'] ?></td>
                                                            <td><?= $row['Servicio'] ?></td>
                                                            <td><?= $row['Especialista'] ?></td>
                                                            <td>$<?= number_format($row['ValorTotal'], 0) ?></td>
                                                            <td>
                                                                <?php
                                                                $badge = match ($row['Estado']) {
                                                                    'ATENDIDA' => 'success',
                                                                    'CANCELADA' => 'danger',
                                                                    default => 'warning'
                                                                };
                                                                ?>
                                                                <span class="badge bg-<?= $badge ?>">
                                                                    <?= $row['Estado'] ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted">
                                                            No se encontraron citas
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <!-- PAGINACIÓN -->
                            <?php if ($totalPaginas > 1): ?>
                                <nav class="mt-4">
                                    <ul class="pagination justify-content-center">

                                        <!-- Flecha anterior -->
                                        <li class="page-item <?= $paginaActual <= 1 ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?page=<?= $paginaActual - 1 ?>&estado=<?= $estadoFiltro ?>&fecha=<?= $fechaFiltro ?>">
                                                «
                                            </a>
                                        </li>

                                        <!-- Números -->
                                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                            <li class="page-item <?= $paginaActual == $i ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="?page=<?= $i ?>&estado=<?= $estadoFiltro ?>&fecha=<?= $fechaFiltro ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <!-- Flecha siguiente -->
                                        <li class="page-item <?= $paginaActual >= $totalPaginas ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?page=<?= $paginaActual + 1 ?>&estado=<?= $estadoFiltro ?>&fecha=<?= $fechaFiltro ?>">
                                                »
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            <?php endif; ?>


                            <a href="Reportes.php" class="btn btn-outline-success" data-mdb-ripple-init
                                data-mdb-ripple-color="dark">Volver</a>




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