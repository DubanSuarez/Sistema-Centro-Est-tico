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
                                        <h5 class="fw-bold EstiloLetraTarjeta">Reporte de Servicios</h5>
                                        <small class="text-muted">
                                            Análisis de servicios más solicitados y rentabilidad
                                        </small>
                                    </div>


                                </div>


                            </div>
                        </div>


                        <div class="card-body">


                            <?php
                            /* ================== FILTROS ================== */
                            $where = [];

                            if (!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_fin'])) {
                                $inicio = mysqli_real_escape_string($conexion, $_GET['fecha_inicio']) . " 00:00:00";
                                $fin = mysqli_real_escape_string($conexion, $_GET['fecha_fin']) . " 23:59:59";
                                $where[] = "c.Fecha BETWEEN '$inicio' AND '$fin'";
                            }

                            if (!empty($_GET['tipo_servicio'])) {
                                $tipo = mysqli_real_escape_string($conexion, $_GET['tipo_servicio']);
                                $where[] = "s.TipoServicio = '$tipo'";
                            }

                            $whereSQL = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

                            /* ================== PAGINACIÓN ================== */
                            $por_pagina = 10;
                            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $pagina = max($pagina, 1);
                            $offset = ($pagina - 1) * $por_pagina;

                            /* ================== TOTAL REGISTROS ================== */
                            $sql_total = "
SELECT COUNT(DISTINCT s.Id) AS total
FROM detalle_factura df
INNER JOIN cita c ON c.Id = df.Id_Cita
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
$whereSQL
";
                            $res_total = mysqli_query($conexion, $sql_total);
                            $total_filas = mysqli_fetch_assoc($res_total)['total'];
                            $total_paginas = ceil($total_filas / $por_pagina);

                            /* ================== CONSULTA PRINCIPAL ================== */
                            $sql = "
SELECT 
    s.Nombre AS Servicio,
    s.TipoServicio,
    COUNT(df.Id) AS Cantidad,
    SUM(df.Total) AS TotalGenerado
FROM detalle_factura df
INNER JOIN cita c ON c.Id = df.Id_Cita
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
$whereSQL
GROUP BY s.Id
ORDER BY Cantidad DESC
LIMIT $offset, $por_pagina
";
                            $resultado = mysqli_query($conexion, $sql);

                            /* ================== TIPOS DE SERVICIO ================== */
                            $tipos = mysqli_query($conexion, "SELECT DISTINCT TipoServicio FROM servicio");
                            ?>

                            <!-- ================== FILTROS ================== -->
                            <form method="GET" class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Fecha inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        value="<?= $_GET['fecha_inicio'] ?? '' ?>">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Fecha fin</label>
                                    <input type="date" name="fecha_fin" class="form-control"
                                        value="<?= $_GET['fecha_fin'] ?? '' ?>">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Tipo de servicio</label>
                                    <select name="tipo_servicio" class="form-select">
                                        <option value="">Todos</option>
                                        <?php while ($t = mysqli_fetch_assoc($tipos)): ?>
                                            <option value="<?= $t['TipoServicio'] ?>" <?= ($_GET['tipo_servicio'] ?? '') == $t['TipoServicio'] ? 'selected' : '' ?>>
                                                <?= $t['TipoServicio'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i> Filtrar
                                    </button>
                                </div>
                            </form>

                            <!-- ================== TABLA ================== -->
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Servicio</th>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                            <th>Total Generado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($resultado) > 0): ?>
                                            <?php $i = $offset + 1; ?>
                                            <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Servicio'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['TipoServicio'] ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">
                                                            <?= $row['Cantidad'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="fw-bold">
                                                        $
                                                        <?= number_format($row['TotalGenerado'], 0) ?>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    No hay datos para los filtros seleccionados
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ================== PAGINACIÓN ================== -->
                            <nav class="mt-3">
                                <ul class="pagination justify-content-center">

                                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link"
                                            href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina - 1])) ?>">
                                            &laquo;
                                        </a>
                                    </li>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                                            <a class="page-link"
                                                href="?<?= http_build_query(array_merge($_GET, ['pagina' => $i])) ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?= $pagina >= $total_paginas ? 'disabled' : '' ?>">
                                        <a class="page-link"
                                            href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina + 1])) ?>">
                                            &raquo;
                                        </a>
                                    </li>

                                </ul>
                            </nav>










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