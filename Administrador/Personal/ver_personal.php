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
                                    <h4 class="fw-bold EstiloLetraTarjeta">Información del Personal</h4>
                                    <small class="text-muted">
                                        Datos del contrato y personales
                                    </small>
                                </div>
                            </div>
                        </div>



                        <?php
                        if (!isset($_GET['id'])) {
                            header("Location: Contratos.php");
                            exit;
                        }

                        $id = intval($_GET['id']);

                        $consulta = mysqli_query(
                            $conexion,
                            "SELECT * FROM contratopersona WHERE Id = $id"
                        );

                        if (mysqli_num_rows($consulta) === 0) {
                            header("Location: Contratos.php");
                            exit;
                        }

                        $p = mysqli_fetch_assoc($consulta);
                        ?>

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">

                                    <!-- PERFIL -->
                                    <div class="card mb-4 shadow-2-strong">
                                        <div class="card-body text-center">

                                            <img src="FotoPersonal/default.jpg" class="rounded-circle mb-3 shadow"
                                                height="130" alt="Foto personal">

                                            <h5 class="fw-bold mb-0">
                                                <?= $p['Nombre'] ?> <?= $p['Apellido'] ?>
                                            </h5>

                                            <span
                                                class="badge <?= $p['EstadoContrato'] == 1 ? 'bg-success' : 'bg-danger' ?> mt-2">
                                                <?= $p['EstadoContrato'] == 1 ? 'Activo' : 'Inactivo' ?>
                                            </span>

                                            <p class="text-muted mt-2 mb-0">
                                                <?= $p['Rol'] ?>
                                            </p>

                                        </div>
                                    </div>

                                    <!-- DATOS PERSONALES -->
                                    <div class="card mb-4">
                                        <div class="card-header fw-bold">
                                            Datos personales
                                        </div>

                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Documento</small>
                                                    <div class="fw-semibold"><?= $p['NumeroDocumento'] ?></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Género</small>
                                                    <div class="fw-semibold"><?= $p['Genero'] ?></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Teléfono</small>
                                                    <div class="fw-semibold"><?= $p['NumeroTelefono'] ?></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Fecha de nacimiento</small>
                                                    <div class="fw-semibold"><?= $p['FechaNacimiento'] ?></div>
                                                </div>

                                                <div class="col-md-12">
                                                    <small class="text-muted">Dirección</small>
                                                    <div class="fw-semibold"><?= $p['Direccion'] ?></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- DATOS DEL CONTRATO -->
                                    <div class="card mb-4">
                                        <div class="card-header fw-bold">
                                            Información del contrato
                                        </div>

                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-4 mb-3">
                                                    <small class="text-muted">Fecha contrato</small>
                                                    <div class="fw-semibold"><?= $p['FechaContrato'] ?></div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <small class="text-muted">Forma de pago</small>
                                                    <div class="fw-semibold"><?= $p['FormaPago'] ?></div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <small class="text-muted">Valor pago</small>
                                                    <div class="fw-semibold">
                                                        <?= $p['ValorPago'] ? '$' . number_format($p['ValorPago']) : '—' ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Horario</small>
                                                    <div class="fw-semibold">
                                                        <?= $p['HoraInicial'] ?> - <?= $p['HoraFinal'] ?>
                                                    </div>
                                                </div>

                                                <?php if (!empty($p['Especialidad'])) { ?>
                                                    <div class="col-md-6 mb-3">
                                                        <small class="text-muted">Área / Especialidad</small>
                                                        <div class="fw-semibold"><?= $p['Especialidad'] ?></div>
                                                    </div>
                                                <?php } ?>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Teléfono familiar</small>
                                                    <div class="fw-semibold"><?= $p['TelefonoFamiliar'] ?></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <small class="text-muted">Estado civil</small>
                                                    <div class="fw-semibold"><?= $p['EstadoCivil'] ?></div>
                                                </div>

                                                <div class="col-md-12">
                                                    <small class="text-muted">Enfermedad</small>
                                                    <div class="fw-semibold">
                                                        <?= !empty($p['Enfermedad']) ? $p['Enfermedad'] : '—' ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- BOTÓN -->
                                    <div class="text-center">
                                        <a href="Contratos.php" class="btn btn-outline-success">
                                            Volver
                                        </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>