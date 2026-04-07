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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Facturación administrativa</h5>
                                    <small class="text-muted">
                                        Gestión y control de citas pendientes de facturar
                                    </small>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">





                            <?php
                            require_once('../../Conexiones/conexion.php');

                            /* ===============================
                               FILTROS
                            ================================ */
                            $paciente = $_GET['paciente'] ?? '';
                            $fecha = $_GET['fecha'] ?? '';

                            /* 👉 Si no hay fecha, usar HOY por defecto */
                            if (empty($fecha)) {
                                $fecha = date('Y-m-d');
                            }
                            ?>


                            <!-- ===============================
     FORMULARIO FILTROS
================================ -->
                            <form method="GET" class="row g-3 mb-3">

                                <div class="col-md-5">
                                    <label class="form-label">Paciente</label>
                                    <input type="text" name="paciente" class="form-control"
                                        placeholder="Nombre, apellido o documento"
                                        value="<?= htmlspecialchars($paciente) ?>">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" name="fecha" class="form-control"
                                        value="<?= htmlspecialchars($fecha) ?>">
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">
                                        🔍 Buscar
                                    </button>
                                </div>

                            </form>

                            <?php
                            /* ===============================
                               CONSTRUCCIÓN WHERE
                            ================================ */
                            $where = "
    c.Estado = 'ATENDIDA'
    AND c.Facturar = 1
    AND c.Fecha = '$fecha'
";

                            if (!empty($paciente)) {
                                $paciente = $conexion->real_escape_string($paciente);
                                $where .= "
        AND (
            p.Nombre LIKE '%$paciente%'
            OR p.Apellido LIKE '%$paciente%'
            OR p.NumeroDocumento LIKE '%$paciente%'
        )
    ";
                            }
                            ?>

                            <!-- ===============================
     LISTADO CITAS
================================ -->
                            <form action="CrearFactura.php" method="POST">

                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th>Fecha</th>
                                            <th>Paciente</th>
                                            <th>Servicio</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sql = "
SELECT 
    c.Id,
    c.Fecha,
    c.Servicio,
    c.Precio,
    p.Nombre,
    p.Apellido
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
WHERE $where
ORDER BY c.Fecha ASC
";

                                        $result = $conexion->query($sql);

                                        if ($result && $result->num_rows > 0):
                                            while ($row = $result->fetch_assoc()):
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <input type="checkbox" name="citas[]" value="<?= $row['Id'] ?>">
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($row['Fecha'])) ?></td>
                                                    <td><?= $row['Nombre'] . ' ' . $row['Apellido'] ?></td>
                                                    <td><?= $row['Servicio'] ?></td>
                                                    <td>$<?= number_format($row['Precio'], 0, ',', '.') ?></td>
                                                </tr>

                                                <?php
                                            endwhile;
                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    No hay citas pendientes de facturar para esta búsqueda
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                    </tbody>
                                </table>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        Continuar
                                    </button>
                                </div>

                            </form>












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