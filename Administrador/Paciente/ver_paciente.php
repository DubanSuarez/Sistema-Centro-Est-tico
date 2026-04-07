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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Detalle del paciente</h4>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">

                            <?php

                            $idPaciente = intval($_GET['id']);

                            /* ==========================
                               CONSULTAR DATOS DEL PACIENTE
                            ========================== */
                            $sql = "SELECT 
    p.Id,
    p.Nombre,
    p.Apellido,
    p.Genero,
    p.NumeroTelefono,
    p.NumeroDocumento,
    p.FechaNacimiento,
    p.Direccion,
    p.EstadoCivil,
    p.Ocupacion,
    p.FechaRegistro,
    p.Foto,
    u.Usuario,
    u.Estado AS EstadoUsuario
FROM paciente p
INNER JOIN usuario u ON p.Id_Usuario = u.Id
WHERE p.Id = ?";


                            $stmt = $conexion->prepare($sql);
                            $stmt->bind_param("i", $idPaciente);
                            $stmt->execute();
                            $resultado = $stmt->get_result();

                            if ($resultado->num_rows === 0) {
                                header("Location: Pacientes.php");
                                exit;
                            }

                            $paciente = $resultado->fetch_assoc();
                            ?>

                            <div class="row mb-4 align-items-center">

                                <div class="col-md-3 text-center">
                                    <?php
                                    $fotoBD = $paciente['Foto'] ?? '';
                                    $ruta = "../../Img/" . $fotoBD;

                                    if (!file_exists($ruta) || empty($fotoBD)) {
                                        $ruta = "../../Img/Pacientes/defaultPaciente.jpg";
                                    }
                                    ?>
                                    <img src="<?= $ruta ?>" alt="Foto paciente" class="rounded-circle shadow"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>

                                <div class="col-md-9">
                                    <h4 class="mb-1">
                                        <?= $paciente['Nombre'] . " " . $paciente['Apellido'] ?>
                                    </h4>
                                    <p class="text-muted mb-0">
                                        Usuario: <strong><?= $paciente['Usuario'] ?></strong>
                                    </p>

                                    <?php
                                    $estado = $paciente['EstadoUsuario'] ?? 0;

                                    if ($estado == 1) {
                                        $textoEstado = "Activo";
                                        $claseEstado = "bg-success";
                                        $iconoEstado = "✔";
                                    } else {
                                        $textoEstado = "Inactivo";
                                        $claseEstado = "bg-danger";
                                        $iconoEstado = "✖";
                                    }
                                    ?>


                                    <span class="badge rounded-pill <?= $claseEstado ?> px-3 py-2 shadow-sm mt-2">
                                        <?= $textoEstado ?>
                                    </span>
                                </div>

                            </div>

                            <hr>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Documento</label>
                                    <p class="form-control-plaintext"><?= $paciente['NumeroDocumento'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fecha nacimiento</label>
                                    <p class="form-control-plaintext"><?= $paciente['FechaNacimiento'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Género</label>
                                    <p class="form-control-plaintext"><?= $paciente['Genero'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Teléfono</label>
                                    <p class="form-control-plaintext"><?= $paciente['NumeroTelefono'] ?></p>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Dirección</label>
                                    <p class="form-control-plaintext"><?= $paciente['Direccion'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Estado civil</label>
                                    <p class="form-control-plaintext"><?= $paciente['EstadoCivil'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Ocupación</label>
                                    <p class="form-control-plaintext"><?= $paciente['Ocupacion'] ?></p>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fecha de registro</label>
                                    <p class="form-control-plaintext"><?= $paciente['FechaRegistro'] ?></p>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer justify-content-center text-center mt-4 mb-4">
                            <a href="Pacientes.php" class="btn btn-outline-success" data-mdb-ripple-init
                                data-mdb-ripple-color="dark">Volver</a>
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