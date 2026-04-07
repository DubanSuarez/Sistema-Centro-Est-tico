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
                                <div class="col-md-6 text-md-start text-center">
                                    <h5 class="fw-bold EstiloLetraTarjeta">Reportes</h5>
                                    <small class="text-muted">Análisis de citas, ingresos y desempeño</small>
                                </div>

                            </div>
                        </div>


                        <div class="card-body">

                            <div class="row g-4 mt-3">

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_citas.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-primary text-white me-3">
                                                        <i class="bi bi-calendar-event"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Reporte de Citas</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Consulta citas por fecha, estado y volumen de atención.
                                                </p>
                                                <span class="text-primary fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_ingresos.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-success text-white me-3">
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Reporte de Ingresos</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Control de facturación, ingresos mensuales y rentabilidad.
                                                </p>
                                                <span class="text-success fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_servicios.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-info text-white me-3">
                                                        <i class="bi bi-heart-pulse"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Servicios más solicitados</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Identifica los servicios con mayor demanda.
                                                </p>
                                                <span class="text-info fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_especialistas.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-danger text-white me-3">
                                                        <i class="bi bi-person-badge"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Reporte de Especialistas</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Mide el desempeño y carga laboral.
                                                </p>
                                                <span class="text-danger fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_pacientes.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-warning text-white me-3">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Reporte de Pacientes</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Pacientes nuevos, recurrentes y frecuentes.
                                                </p>
                                                <span class="text-warning fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="reporte_hc.php" class="text-decoration-none">
                                        <div class="card shadow-sm h-100 border-0 reporte-card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-box bg-secondary text-white me-3">
                                                        <i class="fa-solid fa-file-medical"></i>
                                                    </div>
                                                    <h5 class="mb-0 fw-semibold">Historiales Clínicos</h5>
                                                </div>
                                                <p class="text-muted mb-3">
                                                    Controla antecedentes, diagnósticos y seguimiento clínico de los pacientes.
                                                </p>
                                                <span class="text-secondary fw-medium">
                                                    Ver reporte <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>