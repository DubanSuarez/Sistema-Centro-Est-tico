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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Gestión de facturas</h4>
                                        <small class="text-muted">Control administrativo de facturación</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php
                            // =====================
// FILTROS
// =====================
                            $buscar = $_GET['buscar'] ?? '';
                            $estado = $_GET['estado'] ?? '';
                            $desde = $_GET['desde'] ?? '';
                            $hasta = $_GET['hasta'] ?? '';

                            // =====================
// PAGINACIÓN
// =====================
                            $pagina = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
                            $limite = 5;
                            $offset = ($pagina - 1) * $limite;

                            // =====================
// WHERE dinámico
// =====================
                            $where = "1=1";

                            if ($buscar !== '') {
                                $buscar = $conexion->real_escape_string($buscar);
                                $where .= " AND (
        p.Nombre LIKE '%$buscar%' 
        OR p.Apellido LIKE '%$buscar%' 
        OR p.NumeroDocumento LIKE '%$buscar%'
    )";
                            }

                            if ($estado !== '') {
                                $estado = $conexion->real_escape_string($estado);
                                $where .= " AND f.Estado = '$estado'";
                            }

                            if ($desde !== '' && $hasta !== '') {
                                $where .= " AND DATE(f.FechaHora) BETWEEN '$desde' AND '$hasta'";
                            }
                            ?>

                            <!-- ===================== -->
                            <!-- FORMULARIO DE FILTROS -->
                            <!-- ===================== -->
                            <form method="GET" class="row g-3 mb-4">

                                <div class="col-md-4">
                                    <input type="text" name="buscar" class="form-control"
                                        placeholder="Buscar paciente o documento"
                                        value="<?= htmlspecialchars($buscar) ?>">
                                </div>

                                <div class="col-md-2">
                                    <input type="date" name="desde" class="form-control"
                                        value="<?= htmlspecialchars($desde) ?>">
                                </div>

                                <div class="col-md-2">
                                    <input type="date" name="hasta" class="form-control"
                                        value="<?= htmlspecialchars($hasta) ?>">
                                </div>

                                <div class="col-md-2">
                                    <select name="estado" class="form-select">
                                        <option value="">Todos</option>
                                        <option value="PAGADA" <?= $estado === 'PAGADA' ? 'selected' : '' ?>>PAGADA
                                        </option>
                                        <option value="ANULADA" <?= $estado === 'ANULADA' ? 'selected' : '' ?>>ANULADA
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2 d-grid">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
                                </div>

                            </form>

                            <!-- ===================== -->
                            <!-- TABLA DE FACTURAS -->
                            <!-- ===================== -->
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sql = "
            SELECT 
                f.Id,
                f.FechaHora,
                f.Total,
                f.Estado,
                p.Nombre,
                p.Apellido
            FROM factura f
            INNER JOIN paciente p ON p.Id = f.Id_Paciente
            WHERE $where
            ORDER BY f.FechaHora DESC
            LIMIT $limite OFFSET $offset
        ";

                                    $result = $conexion->query($sql);

                                    if ($result && $result->num_rows > 0):
                                        while ($row = $result->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td><?= $row['Id'] ?></td>

                                                <td><?= date('d/m/Y H:i', strtotime($row['FechaHora'])) ?></td>

                                                <td><?= htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']) ?></td>

                                                <td>
                                                    $<?= number_format($row['Total'], 0, ',', '.') ?>
                                                </td>

                                                <td>
                                                    <?php if ($row['Estado'] === 'PAGADA'): ?>
                                                        <span class="badge bg-success">PAGADA</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">ANULADA</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <!-- VER FACTURA -->
                                                    <a href="VerFactura.php?id=<?= $row['Id'] ?>" class="btn btn-sm btn-info">
                                                        👁 Ver
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No se encontraron facturas
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>



                            <?php
                            // =====================
// TOTAL PARA PAGINACIÓN
// =====================
                            $sql_total = "
    SELECT COUNT(*) AS total
    FROM factura f
    INNER JOIN paciente p ON p.Id = f.Id_Paciente
    WHERE $where
";

                            $total_registros = $conexion->query($sql_total)->fetch_assoc()['total'];
                            $total_paginas = ceil($total_registros / $limite);
                            ?>

                            <!-- ===================== -->
                            <!-- PAGINACIÓN -->
                            <!-- ===================== -->
                            <?php if ($total_paginas > 1): ?>
                                <nav>
                                    <ul class="pagination justify-content-center">

                                        <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=1&buscar=<?= urlencode($buscar) ?>&estado=<?= $estado ?>&desde=<?= $desde ?>&hasta=<?= $hasta ?>">
                                                ⏮
                                            </a>
                                        </li>

                                        <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina - 1 ?>&buscar=<?= urlencode($buscar) ?>&estado=<?= $estado ?>&desde=<?= $desde ?>&hasta=<?= $hasta ?>">
                                                ◀
                                            </a>
                                        </li>

                                        <?php
                                        $rango = 2;
                                        $inicio = max(1, $pagina - $rango);
                                        $fin = min($total_paginas, $pagina + $rango);

                                        for ($i = $inicio; $i <= $fin; $i++):
                                            ?>
                                            <li class="page-item <?= $i === $pagina ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="?pagina=<?= $i ?>&buscar=<?= urlencode($buscar) ?>&estado=<?= $estado ?>&desde=<?= $desde ?>&hasta=<?= $hasta ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina + 1 ?>&buscar=<?= urlencode($buscar) ?>&estado=<?= $estado ?>&desde=<?= $desde ?>&hasta=<?= $hasta ?>">
                                                ▶
                                            </a>
                                        </li>

                                        <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $total_paginas ?>&buscar=<?= urlencode($buscar) ?>&estado=<?= $estado ?>&desde=<?= $desde ?>&hasta=<?= $hasta ?>">
                                                ⏭
                                            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>