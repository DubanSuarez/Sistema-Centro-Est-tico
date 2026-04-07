<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 1)) {
    $error = $_SESSION['Error'];
    $_SESSION['Error'] = "Sesion no iniciada";
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
                    <a href="../../Blog/InicioEspecialista.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-house me-3 IconosMenu"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="../Agenda/MiAgenda.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar-check me-3 IconosMenu"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="../Agenda/MisCitas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar me-3 IconosMenu"></i>
                        <span>Mis citas</span>
                    </a>
                    <a href="../Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-user me-3 IconosMenu"></i>
                        <span>Pacientes</span>
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
                            <div class="row gap-2">
                                <div class="col-md-12 d-flex justify-content-md-start justify-content-center">
                                    <h5 class=" mb-0 text-center EstiloLetraTarjeta">Perfil</h5>
                                </div>
                            </div>
                        </div>


                        <?php
                        /* =====================================================
                           SUBIR FOTO PERFIL
                        ===================================================== */
                        if (isset($_POST['btnFoto']) && isset($_FILES['foto'])) {

                            $id_usuario = (int) $_SESSION['id'];

                            $nombre = $_FILES['foto']['name'];
                            $tmp = $_FILES['foto']['tmp_name'];

                            if ($tmp != "") {

                                $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
                                $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

                                if (in_array($ext, $permitidas)) {

                                    $nuevoNombre = "especialista_" . $id_usuario . "." . $ext;
                                    $ruta = "../../Img/Personal/" . $nuevoNombre;

                                    move_uploaded_file($tmp, $ruta);

                                    $conexion->query("
                UPDATE contratopersona
                SET Foto = '$nuevoNombre'
                WHERE Id_Usuario = $id_usuario
            ");

                                    header("Location: Perfil.php?ok=foto");
                                    exit;
                                }
                            }
                        }

                        ?>



                        <div class="card-body">

                            <?php if (isset($_GET['ok'])): ?>
                                <div class="alert alert-success text-center">
                                    Foto actualizada correctamente
                                </div>
                            <?php endif; ?>



                            <?php
                            $id_usuario = (int) ($_SESSION['id'] ?? 0);

                            $sql = "
SELECT *
FROM contratopersona
WHERE Id_Usuario = $id_usuario
AND EstadoContrato = 1
LIMIT 1
";

                            $res = $conexion->query($sql);

                            if (!$res || $res->num_rows === 0) {
                                die("<div class='alert alert-danger'>Perfil no encontrado</div>");
                            }

                            $esp = $res->fetch_assoc();

                            /* ========= EDAD ========= */
                            $edad = 0;
                            if (!empty($esp['FechaNacimiento'])) {
                                $edad = date_diff(
                                    date_create($esp['FechaNacimiento']),
                                    date_create('today')
                                )->y;
                            }

                            /* ========= FOTO ========= */
                            $baseRuta = '../../Img/Personal/';
                            $archivo = !empty($esp['Foto']) ? $esp['Foto'] : 'user-default.png';

                            if (!file_exists($baseRuta . $archivo)) {
                                $archivo = 'user-default.png';
                            }

                            $foto = $baseRuta . $archivo;
                            ?>


                            <style>
                                .perfil-card {
                                    border-radius: 18px;
                                }

                                .avatar-perfil {
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                    object-fit: cover;
                                    border: 4px solid #e9ecef;
                                }

                                .section-title {
                                    font-weight: 600;
                                    color: #0d6efd;
                                    margin-top: 25px;
                                    margin-bottom: 12px;
                                }
                            </style>



                            <div class="row g-4">
                                <!-- ================= FOTO + RESUMEN ================= -->
                                <div class="col-md-4">

                                    <div class="card shadow-sm border-0 perfil-card text-center p-4">

                                        <!-- ===== FOTO ===== -->
                                        <form method="POST" enctype="multipart/form-data">

                                            <img src="<?= htmlspecialchars($foto) ?>"
                                                class="avatar-perfil mb-3 shadow-sm">

                                            <div class="mb-2">
                                                <input type="file" name="foto" class="form-control form-control-sm"
                                                    accept="image/*" required>
                                            </div>

                                            <button name="btnFoto"
                                                class="btn btn-outline-primary btn-sm rounded-pill w-100">
                                                <i class="fas fa-camera me-1"></i> Cambiar foto
                                            </button>

                                        </form>


                                        <!-- ===== NOMBRE ===== -->
                                        <hr class="my-4">

                                        <h4 class="fw-bold mb-1">
                                            <?= htmlspecialchars($esp['Nombre'] . ' ' . $esp['Apellido']) ?>
                                        </h4>

                                        <span class="badge bg-primary mb-2">
                                            <?= htmlspecialchars($esp['Rol']) ?>
                                        </span>

                                        <p class="text-muted small mb-3">
                                            <?= $edad ?> años
                                        </p>


                                        <!-- ================= SEGURIDAD ================= -->
                                        <div class="card border-0 bg-light p-3 shadow-sm">

                                            <small class="text-muted d-block mb-1">
                                                Correo de acceso
                                            </small>

                                            <div class="fw-semibold mb-3 text-truncate">
                                                <?php $resUser = $conexion->query("SELECT Usuario FROM usuario WHERE Id = $id_usuario LIMIT 1");
                                                $email = $resUser->fetch_assoc()['Usuario'] ?? '';
                                                ?>
                                                <?= htmlspecialchars($email) ?>
                                            </div>

                                            <a href="ActualizarCorreo.php"
                                                class="btn btn-outline-primary btn-sm rounded-pill mb-2 w-100">
                                                <i class="fas fa-envelope me-1"></i> Cambiar correo
                                            </a>

                                            <a href="CambiarPassword.php"
                                                class="btn btn-outline-secondary btn-sm rounded-pill w-100">
                                                <i class="fas fa-key me-1"></i> Cambiar contraseña
                                            </a>

                                        </div>

                                    </div>

                                </div>





                                <!-- ================= DATOS ================= -->
                                <div class="col-md-8">

                                    <form action="ActualizarPerfil.php" method="POST">

                                        <!-- ================= PERSONALES ================= -->
                                        <h5 class="section-title">
                                            <i class="fas fa-user"></i> Información personal
                                        </h5>

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label>Nombre</label>
                                                <input class="form-control" name="Nombre"
                                                    value="<?= htmlspecialchars($esp['Nombre']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Apellido</label>
                                                <input class="form-control" name="Apellido"
                                                    value="<?= htmlspecialchars($esp['Apellido']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Documento</label>
                                                <input class="form-control" name="NumeroDocumento"
                                                    value="<?= htmlspecialchars($esp['NumeroDocumento']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Teléfono</label>
                                                <input class="form-control" name="NumeroTelefono"
                                                    value="<?= htmlspecialchars($esp['NumeroTelefono']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Género</label>
                                                <input class="form-control"
                                                    value="<?= htmlspecialchars($esp['Genero']) ?>" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Fecha nacimiento</label>
                                                <input type="date" class="form-control" name="FechaNacimiento"
                                                    value="<?= htmlspecialchars($esp['FechaNacimiento']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Dirección</label>
                                                <input class="form-control" name="Direccion"
                                                    value="<?= htmlspecialchars($esp['Direccion']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Estado civil</label>
                                                <input class="form-control" name="EstadoCivil"
                                                    value="<?= htmlspecialchars($esp['EstadoCivil']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Teléfono familiar</label>
                                                <input class="form-control" name="TelefonoFamiliar"
                                                    value="<?= htmlspecialchars($esp['TelefonoFamiliar']) ?>">
                                            </div>

                                        </div>



                                        <!-- ================= LABORALES ================= -->
                                        <h5 class="section-title">
                                            <i class="fas fa-briefcase"></i> Información laboral
                                        </h5>

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label>Especialidad</label>
                                                <input class="form-control" name="Especialidad"
                                                    value="<?= htmlspecialchars($esp['Especialidad']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Fecha contrato</label>
                                                <input type="date" class="form-control"
                                                    value="<?= htmlspecialchars($esp['FechaContrato']) ?>" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Horario</label>
                                                <input class="form-control"
                                                    value="<?= substr($esp['HoraInicial'], 0, 5) ?> - <?= substr($esp['HoraFinal'], 0, 5) ?>"
                                                    readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Forma de pago</label>
                                                <input class="form-control"
                                                    value="<?= htmlspecialchars($esp['FormaPago']) ?>" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Valor pago</label>
                                                <input class="form-control"
                                                    value="$ <?= number_format($esp['ValorPago']) ?>" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Estado contrato</label>
                                                <input class="form-control"
                                                    value="<?= $esp['EstadoContrato'] ? 'Activo' : 'Inactivo' ?>"
                                                    readonly>
                                            </div>

                                        </div>



                                        <!-- BOTÓN -->
                                        <div class="text-end mt-4">
                                            <button class="btn btn-success px-4">
                                                <i class="fas fa-save"></i> Actualizar datos
                                            </button>
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