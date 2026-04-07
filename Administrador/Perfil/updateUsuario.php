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
                        if (!empty($foto) && file_exists("Img/" . $foto)) {
                            $fotoMenu = "Img/" . $foto;
                        } else {
                            $fotoMenu = "Img/user-default.png";
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
                            <div class="row gap-2">
                                <div class="col-md-12 d-flex justify-content-md-start justify-content-center">
                                    <h5 class=" mb-0 text-center EstiloLetraTarjeta">Cambiar contraseña</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">


                            <?php
                            $idUsuario = $_SESSION['id'];
                            $mensajeError = "";
                            $mensajeExito = "";

                            $consulta = "SELECT Contrasena FROM usuario WHERE Id = $idUsuario LIMIT 1";
                            $ejecutar = mysqli_query($conexion, $consulta);
                            $fila = mysqli_fetch_assoc($ejecutar);

                            if (!$fila) {
                                die("Usuario no encontrado");
                            }

                            if (isset($_POST['actualizar'])) {

                                $actual = trim($_POST['PasswordActual']);
                                $nueva = trim($_POST['PasswordNueva']);
                                $confirmar = trim($_POST['PasswordConfirm']);

                                if (empty($actual) || empty($nueva) || empty($confirmar)) {
                                    $mensajeError = "Todos los campos son obligatorios.";

                                } elseif ($actual !== $fila['Contrasena']) {
                                    // ✔ COMPARACIÓN DIRECTA
                                    $mensajeError = "La contraseña antigua no coincide con la registrada.";

                                } elseif ($nueva !== $confirmar) {
                                    $mensajeError = "La nueva contraseña y su confirmación no coinciden.";

                                } elseif (strlen($nueva) < 8) {
                                    $mensajeError = "La nueva contraseña debe tener mínimo 8 caracteres.";

                                } elseif ($nueva === $actual) {
                                    $mensajeError = "La nueva contraseña no puede ser igual a la anterior.";

                                } else {

                                    // ✔ GUARDAR TAL CUAL (SIN HASH)
                                    $update = "UPDATE usuario 
                   SET Contrasena='$nueva' 
                   WHERE Id=$idUsuario";

                                    mysqli_query($conexion, $update);

                                    $mensajeExito = "Contraseña actualizada correctamente.";
                                }
                            }
                            ?>





                            <div class="row justify-content-center">

                                <div class="col-md-4">
                                    <div class="alert alert-info small">
                                        <strong>Requisitos de la contraseña:</strong><br>
                                        • Mínimo 8 caracteres<br>
                                        • Al menos una letra mayúscula<br>
                                        • Al menos una letra minúscula<br>
                                        • Al menos un número<br>
                                        • No debe ser igual a la contraseña actual
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card p-4">

                                        <?php if ($mensajeError) { ?>
                                            <div class="alert alert-danger text-center">
                                                <?= $mensajeError ?>
                                            </div>
                                        <?php } ?>

                                        <?php if ($mensajeExito) { ?>
                                            <div class="alert alert-success text-center">
                                                <?= $mensajeExito ?>
                                            </div>
                                        <?php } ?>

                                        <form method="POST">

                                            <label class="form-label">Contraseña actual</label>
                                            <input type="password" name="PasswordActual" class="form-control" required>

                                            <label class="form-label mt-3">Nueva contraseña</label>
                                            <input type="password" name="PasswordNueva" class="form-control" required>

                                            <label class="form-label mt-3">Confirmar nueva contraseña</label>
                                            <input type="password" name="PasswordConfirm" class="form-control" required>

                                            <div class="row mt-4">

                                                <div class="col-md-6 text-center">
                                                    <a href="Perfil.php" class="btn btn-outline-success btn-rounded">
                                                        Cancelar
                                                    </a>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <button class="btn btn-outline-warning btn-rounded"
                                                        name="actualizar">
                                                        <i class="fas fa-save"></i> Actualizar contraseña
                                                    </button>
                                                </div>

                                            </div>

                                        </form>

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