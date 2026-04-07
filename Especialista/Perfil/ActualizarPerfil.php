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


                        <div class="card-body">




                            <?php
                            $idUsuario = $_SESSION['id'] ?? 0;

                            $mensajeError = "";
                            $mensajeExito = "";

                            if ($idUsuario <= 0) {
                                die("<div class='alert alert-danger text-center'>Sesión no válida</div>");
                            }

                            /* =========================
                               OBTENER DATOS ACTUALES
                            ========================= */
                            $stmt = $conexion->prepare("
    SELECT *
    FROM contratopersona
    WHERE Id_Usuario = ?
    LIMIT 1
");

                            $stmt->bind_param("i", $idUsuario);
                            $stmt->execute();
                            $resultado = $stmt->get_result();
                            $especialista = $resultado->fetch_assoc();

                            if (!$especialista) {
                                die("<div class='alert alert-danger text-center'>Especialista no encontrado</div>");
                            }


                            /* =========================
                               ACTUALIZAR PERFIL
                            ========================= */
                            if (isset($_POST['guardar'])) {

                                $nombre = trim($_POST['Nombre']);
                                $apellido = trim($_POST['Apellido']);
                                $telefono = trim($_POST['NumeroTelefono']);
                                $direccion = trim($_POST['Direccion']);
                                $genero = trim($_POST['Genero']);
                                $fechaNacimiento = $_POST['FechaNacimiento'];
                                $especialidad = trim($_POST['Especialidad']);
                                $telefonoFamiliar = trim($_POST['TelefonoFamiliar']);
                                $estadoCivil = trim($_POST['EstadoCivil']);
                                $enfermedad = trim($_POST['Enfermedad']);

                                if ($nombre == "" || $apellido == "") {

                                    $mensajeError = "Nombre y apellido son obligatorios.";

                                } else {

                                    $update = $conexion->prepare("
            UPDATE contratopersona SET
                Nombre = ?,
                Apellido = ?,
                NumeroTelefono = ?,
                Direccion = ?,
                Genero = ?,
                FechaNacimiento = ?,
                Especialidad = ?,
                TelefonoFamiliar = ?,
                EstadoCivil = ?,
                Enfermedad = ?
            WHERE Id_Usuario = ?
        ");

                                    $update->bind_param(
                                        "ssssssssssi",
                                        $nombre,
                                        $apellido,
                                        $telefono,
                                        $direccion,
                                        $genero,
                                        $fechaNacimiento,
                                        $especialidad,
                                        $telefonoFamiliar,
                                        $estadoCivil,
                                        $enfermedad,
                                        $idUsuario
                                    );

                                    if ($update->execute()) {

                                        $mensajeExito = "Perfil actualizado correctamente.";

                                        // refrescar datos
                                        header("Refresh:1");

                                    } else {
                                        $mensajeError = "Error al actualizar el perfil.";
                                    }

                                    $update->close();
                                }
                            }
                            ?>


                            <div class="row justify-content-center">

                                <div class="col-lg-10">

                                    <?php if ($mensajeError): ?>
                                        <div class="alert alert-danger text-center shadow-sm">
                                            <?= $mensajeError ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($mensajeExito): ?>
                                        <div class="alert alert-success text-center shadow-sm">
                                            <?= $mensajeExito ?>
                                        </div>
                                    <?php endif; ?>


                                    <form method="POST">

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" name="Nombre" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['Nombre']) ?>" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Apellido</label>
                                                <input type="text" name="Apellido" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['Apellido']) ?>" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Teléfono</label>
                                                <input type="text" name="NumeroTelefono" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['NumeroTelefono']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Dirección</label>
                                                <input type="text" name="Direccion" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['Direccion']) ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Género</label>
                                                <select name="Genero" class="form-select">
                                                    <option value="Masculino" <?= $especialista['Genero'] == "Masculino" ? "selected" : "" ?>>Masculino</option>
                                                    <option value="Femenino" <?= $especialista['Genero'] == "Femenino" ? "selected" : "" ?>>Femenino</option>
                                                    <option value="Otro" <?= $especialista['Genero'] == "Otro" ? "selected" : "" ?>>Otro</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Fecha nacimiento</label>
                                                <input type="date" name="FechaNacimiento" class="form-control"
                                                    value="<?= $especialista['FechaNacimiento'] ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Estado civil</label>
                                                <input type="text" name="EstadoCivil" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['EstadoCivil']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Especialidad</label>
                                                <input type="text" name="Especialidad" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['Especialidad']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Teléfono familiar</label>
                                                <input type="text" name="TelefonoFamiliar" class="form-control"
                                                    value="<?= htmlspecialchars($especialista['TelefonoFamiliar']) ?>">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Enfermedad / Observaciones</label>
                                                <textarea name="Enfermedad" class="form-control"
                                                    rows="3"><?= htmlspecialchars($especialista['Enfermedad']) ?></textarea>
                                            </div>

                                        </div>


                                        <div class="row mt-4">

                                            <div class="col-md-6 text-center">
                                                <a href="Perfil.php"
                                                    class="btn btn-outline-secondary rounded-pill px-4">
                                                    Cancelar
                                                </a>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <button type="submit" name="guardar"
                                                    class="btn btn-primary rounded-pill px-4 shadow-sm">
                                                    <i class="fas fa-save"></i> Guardar cambios
                                                </button>
                                            </div>

                                        </div>

                                    </form>

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