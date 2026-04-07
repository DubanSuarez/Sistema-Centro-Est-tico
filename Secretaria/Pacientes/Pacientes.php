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
                        <div class="card-header">
                            <div class="row mb-4">
                                <div class="col-md-9 text-md-start">
                                    <h4 class="fw-bold text-dark">
                                        <i class="fa-solid fa-users me-2"></i> Gestión de Pacientes
                                    </h4>
                                    <small class="text-muted">
                                        Administración de citas, atención clínica e historial médico
                                    </small>

                                </div>
                                <div class="col-md-3 text-md-start">
                                    <a href="CrearPaciente.php" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Nuevo paciente
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php
                            /* =========================
                               FILTROS
                            =========================*/
                            $busqueda = $_GET['busqueda'] ?? '';
                            $genero = $_GET['genero'] ?? '';
                            $estado = $_GET['estado'] ?? '1'; // por defecto solo activos
                            $fecha_inicio = $_GET['fecha_inicio'] ?? '';
                            $fecha_fin = $_GET['fecha_fin'] ?? '';

                            /* =========================
                               PAGINACION
                            =========================*/
                            $limite = 8;
                            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            if ($pagina < 1)
                                $pagina = 1;

                            $inicio = ($pagina - 1) * $limite;

                            /* =========================
                               WHERE
                            =========================*/
                            $where = "WHERE r.Id = 4";

                            if (!empty($busqueda)) {
                                $where .= " AND (
p.Nombre LIKE '%$busqueda%' OR
p.Apellido LIKE '%$busqueda%' OR
p.NumeroDocumento LIKE '%$busqueda%' OR
p.NumeroTelefono LIKE '%$busqueda%'
)";
                            }

                            if (!empty($genero)) {
                                $where .= " AND p.Genero='$genero'";
                            }

                            if ($estado !== '') {
                                $where .= " AND u.Estado='$estado'";
                            }

                            if (!empty($fecha_inicio) && !empty($fecha_fin)) {
                                $where .= " AND DATE(p.FechaRegistro) BETWEEN '$fecha_inicio' AND '$fecha_fin'";
                            }

                            /* =========================
                               TOTAL
                            =========================*/
                            $sql_total = "SELECT COUNT(*) total
FROM paciente p
INNER JOIN usuario u ON u.Id=p.Id_Usuario
INNER JOIN rol r ON r.Id=u.IdRol
$where";

                            $total = $conexion->query($sql_total)->fetch_assoc()['total'];
                            $total_paginas = ceil($total / $limite);

                            /* =========================
                               CONSULTA
                            =========================*/
                            $sql = "SELECT 
p.*,
u.Estado as EstadoUsuario,
TIMESTAMPDIFF(YEAR,p.FechaNacimiento,CURDATE()) as Edad
FROM paciente p
INNER JOIN usuario u ON u.Id=p.Id_Usuario
INNER JOIN rol r ON r.Id=u.IdRol
$where
ORDER BY p.Id DESC
LIMIT $inicio,$limite";

                            $pacientes = $conexion->query($sql);
                            ?>


                            <!-- ================= FILTROS PRO ================= -->
                            <form method="GET" class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-2">
                                            <label class="form-label fw-semibold">Buscar</label>
                                            <input type="text" name="busqueda" class="form-control"
                                                placeholder="Nombre, documento o teléfono"
                                                value="<?= htmlspecialchars($busqueda) ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label fw-semibold">Género</label>
                                            <select name="genero" class="form-select">
                                                <option value="">Todos</option>
                                                <option value="Masculino" <?= $genero == 'Masculino' ? 'selected' : '' ?>>
                                                    Masculino</option>
                                                <option value="Femenino" <?= $genero == 'Femenino' ? 'selected' : '' ?>>
                                                    Femenino</option>
                                                <option value="Otro" <?= $genero == 'Otro' ? 'selected' : '' ?>>Otro
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label fw-semibold">Estado</label>
                                            <select name="estado" class="form-select">
                                                <option value="1" <?= $estado == '1' ? 'selected' : '' ?>>Activos</option>
                                                <option value="0" <?= $estado == '0' ? 'selected' : '' ?>>Inactivos
                                                </option>
                                                <option value="">Todos</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label fw-semibold">Desde</label>
                                            <input type="date" name="fecha_inicio" class="form-control"
                                                value="<?= $fecha_inicio ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label fw-semibold">Hasta</label>
                                            <input type="date" name="fecha_fin" class="form-control"
                                                value="<?= $fecha_fin ?>">
                                        </div>

                                        <!-- BOTONES -->
                                        <div class="col-md-2 mb-1 d-flex gap-2 align-items-end justify-content-end">
                                            <button class="btn btn-primary" title="Buscar">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a href="Pacientes.php" class="btn btn-secondary">
                                                <i class="fa fa-eraser"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </form>


                            <!-- ================= TABLA ================= -->
                            <div class="card shadow border-0">
                                <div class="card-body p-0">

                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">

                                            <thead style="background:#f8f9fa;">
                                                <tr class="text-secondary">
                                                    <th>Foto</th>
                                                    <th>Paciente</th>
                                                    <th>Documento</th>
                                                    <th>Teléfono</th>
                                                    <th>Género</th>
                                                    <th>Edad</th>
                                                    <th>Estado</th>
                                                    <th>Registro</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php if ($pacientes->num_rows > 0): ?>
                                                    <?php while ($p = $pacientes->fetch_assoc()): ?>

                                                        <tr>

                                                            <td>
                                                                <?php
                                                                $foto = !empty($p['Foto'])
                                                                    ? "../../Img/Pacientes/" . $p['Foto']
                                                                    : "../../Img/Pacientes/asidefaultPaciente.jpg";
                                                                ?>
                                                                <img src="<?= $foto ?>"
                                                                    style="width:45px;height:45px;border-radius:50%;object-fit:cover;border:2px solid #eee;">
                                                            </td>

                                                            <td>
                                                                <div class="fw-bold text-dark">
                                                                    <?= $p['Nombre'] . ' ' . $p['Apellido'] ?>
                                                                </div>
                                                            </td>

                                                            <td><?= $p['NumeroDocumento'] ?></td>
                                                            <td><?= $p['NumeroTelefono'] ?></td>
                                                            <td><?= $p['Genero'] ?></td>
                                                            <td><?= $p['Edad'] ?? '-' ?></td>

                                                            <td>
                                                                <?php if ($p['EstadoUsuario'] == 1) { ?>
                                                                    <span class="badge bg-success-subtle text-success fw-semibold">
                                                                        <i class="fa fa-check-circle"></i> Activo
                                                                    </span>
                                                                <?php } else { ?>
                                                                    <span class="badge bg-danger-subtle text-danger fw-semibold">
                                                                        <i class="fa fa-times-circle"></i> Inactivo
                                                                    </span>
                                                                <?php } ?>
                                                            </td>

                                                            <td><?= date('d/m/Y', strtotime($p['FechaRegistro'])) ?></td>

                                                            <td class="text-center">

                                                                <a href="ver_paciente.php?id=<?= $p['Id'] ?>"
                                                                    class="btn btn-sm btn-outline-dark" title="Ver">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                <a href="editar_paciente.php?id=<?= $p['Id'] ?>"
                                                                    class="btn btn-sm btn-outline-primary" title="Editar">
                                                                    <i class="fa fa-pen"></i>
                                                                </a>

                                                            </td>

                                                        </tr>

                                                    <?php endwhile; ?>
                                                <?php else: ?>

                                                    <tr>
                                                        <td colspan="9" class="text-center py-5">
                                                            <i class="fa fa-user-slash fa-2x text-secondary mb-2"></i><br>
                                                            No hay pacientes registrados
                                                        </td>
                                                    </tr>

                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <!-- ================= PAGINACION PRO ================= -->
                            <?php if ($total_paginas > 1): ?>
                                <nav class="mt-4">
                                    <ul class="pagination justify-content-center">

                                        <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina - 1 ?>&busqueda=<?= $busqueda ?>&genero=<?= $genero ?>&estado=<?= $estado ?>&fecha_inicio=<?= $fecha_inicio ?>&fecha_fin=<?= $fecha_fin ?>">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                        </li>

                                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                            <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="?pagina=<?= $i ?>&busqueda=<?= $busqueda ?>&genero=<?= $genero ?>&estado=<?= $estado ?>&fecha_inicio=<?= $fecha_inicio ?>&fecha_fin=<?= $fecha_fin ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina + 1 ?>&busqueda=<?= $busqueda ?>&genero=<?= $genero ?>&estado=<?= $estado ?>&fecha_inicio=<?= $fecha_inicio ?>&fecha_fin=<?= $fecha_fin ?>">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            <?php endif; ?>



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