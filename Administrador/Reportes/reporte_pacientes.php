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
                                        <h5 class="fw-bold EstiloLetraTarjeta">Reporte de Pacientes</h5>
                                        <small class="text-muted">
                                            Análisis de citas y consumo de servicios por paciente
                                        </small>
                                    </div>



                                </div>


                            </div>
                        </div>


                        <div class="card-body">



                            <?php
                            /* ================== FILTROS ================== */
                            $paciente = $_GET['paciente'] ?? '';
                            $fecha_inicio = $_GET['fecha_inicio'] ?? '';
                            $fecha_fin = $_GET['fecha_fin'] ?? '';
                            $genero = $_GET['genero'] ?? '';
                            $tipo_cliente = $_GET['tipo_cliente'] ?? '';

                            /* ================== WHERE DINÁMICO ================== */
                            $where = "WHERE c.Estado = 'ATENDIDA' AND c.Facturar = 1";

                            if ($paciente != '') {
                                $where .= " AND p.Id = '$paciente'";
                            }

                            if ($genero != '') {
                                $where .= " AND p.Genero = '$genero'";
                            }

                            if ($fecha_inicio != '' && $fecha_fin != '') {
                                $where .= " AND c.Fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
                            }

                            /* ================== PAGINACIÓN ================== */
                            $por_pagina = 10;
                            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $pagina = max($pagina, 1);
                            $offset = ($pagina - 1) * $por_pagina;

                            /* ================== TOTAL REGISTROS ================== */
                            $sql_total = "
SELECT COUNT(*) AS total FROM (
    SELECT p.Id
    FROM cita c
    INNER JOIN paciente p ON p.Id = c.Id_Paciente
    $where
    GROUP BY p.Id
) t
";

                            $res_total = mysqli_query($conexion, $sql_total);
                            $total_filas = mysqli_fetch_assoc($res_total)['total'];
                            $total_paginas = ceil($total_filas / $por_pagina);

                            /* ================== CONSULTA PRINCIPAL ================== */
                            $sql = "
SELECT 
    p.Id,
    CONCAT(p.Nombre,' ',p.Apellido) AS Paciente,
    p.NumeroTelefono,
    p.Genero,
    COUNT(c.Id) AS TotalCitas,
    SUM(c.ValorTotal) AS TotalGastado,
    MAX(c.Fecha) AS UltimaVisita
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
$where
GROUP BY p.Id
HAVING
    ('$tipo_cliente' = '' OR
    ('$tipo_cliente' = 'NUEVO' AND COUNT(c.Id) = 1) OR
    ('$tipo_cliente' = 'RECURRENTE' AND COUNT(c.Id) BETWEEN 2 AND 5) OR
    ('$tipo_cliente' = 'FRECUENTE' AND COUNT(c.Id) > 5)
    )
ORDER BY TotalGastado DESC
LIMIT $offset, $por_pagina
";

                            $resultado = mysqli_query($conexion, $sql);
                            ?>

                            <!-- ================== FILTROS ================== -->
                            <form method="GET" class="row g-3 mb-4">

                                <div class="col-md-3">
                                    <label class="form-label">Paciente</label>
                                    <select name="paciente" class="form-select">
                                        <option value="">Todos</option>
                                        <?php
                                        $pac = mysqli_query($conexion, "
                SELECT Id, CONCAT(Nombre,' ',Apellido) AS NombreCompleto
                FROM paciente
                ORDER BY Nombre
            ");
                                        while ($p = mysqli_fetch_assoc($pac)):
                                            ?>
                                            <option value="<?= $p['Id'] ?>" <?= $paciente == $p['Id'] ? 'selected' : '' ?>>
                                                <?= $p['NombreCompleto'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Género</label>
                                    <select name="genero" class="form-select">
                                        <option value="">Todos</option>
                                        <option value="M" <?= $genero == 'M' ? 'selected' : '' ?>>Masculino</option>
                                        <option value="F" <?= $genero == 'F' ? 'selected' : '' ?>>Femenino</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Tipo de cliente</label>
                                    <select name="tipo_cliente" class="form-select">
                                        <option value="">Todos</option>
                                        <option value="NUEVO" <?= $tipo_cliente == 'NUEVO' ? 'selected' : '' ?>>Nuevo
                                        </option>
                                        <option value="RECURRENTE" <?= $tipo_cliente == 'RECURRENTE' ? 'selected' : '' ?>>
                                            Recurrente</option>
                                        <option value="FRECUENTE" <?= $tipo_cliente == 'FRECUENTE' ? 'selected' : '' ?>>
                                            Frecuente</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Desde</label>
                                    <input type="date" name="fecha_inicio" value="<?= $fecha_inicio ?>"
                                        class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Hasta</label>
                                    <input type="date" name="fecha_fin" value="<?= $fecha_fin ?>" class="form-control">
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">Filtrar</button>
                                </div>

                            </form>

                            <!-- ================== TABLA ================== -->
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Paciente</th>
                                            <th>Teléfono</th>
                                            <th>Género</th>
                                            <th>Citas</th>
                                            <th>Tipo</th>
                                            <th>Última visita</th>
                                            <th>Total gastado</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (mysqli_num_rows($resultado) > 0): ?>
                                            <?php $i = $offset + 1; ?>
                                            <?php while ($row = mysqli_fetch_assoc($resultado)): ?>

                                                <?php
                                                $tipo = match (true) {
                                                    $row['TotalCitas'] == 1 => ['Nuevo', 'secondary'],
                                                    $row['TotalCitas'] <= 5 => ['Recurrente', 'info'],
                                                    default => ['Frecuente', 'success']
                                                };
                                                ?>

                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['Paciente'] ?></td>
                                                    <td><?= $row['NumeroTelefono'] ?></td>
                                                    <td><?= $row['Genero'] ?></td>
                                                    <td><span class="badge bg-primary"><?= $row['TotalCitas'] ?></span></td>
                                                    <td><span class="badge bg-<?= $tipo[1] ?>"><?= $tipo[0] ?></span></td>
                                                    <td><?= $row['UltimaVisita'] ?></td>
                                                    <td class="fw-bold">$<?= number_format($row['TotalGastado'], 0) ?></td>
                                                </tr>

                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    No hay información para los filtros seleccionados
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>

                            <!-- ================== PAGINACIÓN ================== -->
                            <?php $params = $_GET; ?>

                            <nav class="mt-3">
                                <ul class="pagination justify-content-center">

                                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link"
                                            href="?<?= http_build_query(array_merge($params, ['pagina' => $pagina - 1])) ?>">&laquo;</a>
                                    </li>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                                            <a class="page-link"
                                                href="?<?= http_build_query(array_merge($params, ['pagina' => $i])) ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?= $pagina >= $total_paginas ? 'disabled' : '' ?>">
                                        <a class="page-link"
                                            href="?<?= http_build_query(array_merge($params, ['pagina' => $pagina + 1])) ?>">&raquo;</a>
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