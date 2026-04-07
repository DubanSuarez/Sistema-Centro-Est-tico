<?php
session_start();
require_once('../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 4)) {
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
    <link rel="stylesheet" href="../Css/style2025.css?v=<?php echo time(); ?>">
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
    $consul = "SELECT p.Foto, p.Nombre, p.Apellido, u.Usuario, p.Id FROM paciente p 
  INNER JOIN usuario u ON p.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
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
                    <a href="../Blog/InicioPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
                            class="fa-solid fa-house fa-fw me-3 IconosMenu">
                        </i><span>Inicio</span>
                    </a>
                    <a href="../Servicios/ReportesPaciente.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init><i class="fa-solid fa-spa me-3 IconosMenu">
                        </i><span>Rituales</span>
                    </a>
                    <a href="../Cita/Cita.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
                            class="fas fa-calendar fa-fw me-3 IconosMenu">
                        </i><span>Citas</span>
                    </a>
                    <a href="../Paciente/CodigoHC.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa-solid fa-folder-open me-3 IconosMenu">
                        </i><span>Historial Clinico</span>
                    </a>
                    <a href="../Cita/FacturasGuardadas.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init><i class="fa-solid fa-receipt me-3 IconosMenu">
                        </i><span>Facturas</span>
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
                    <img src="../Img/LogoMenu.svg" class="LogoSplendor" alt="" loading="lazy" />
                </a>
                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Avatar -->
                    <li class="nav-item dropdown BotonMiCuenta">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                            <img class="rounded-circle" height="26" loading="lazy"
                                src="data:image/jpg;base64,<?php echo base64_encode($foto); ?>">
                            <b class="NomMiCuenta"> Mi cuenta </b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="../Paciente/Perfil.php">
                                    <i class="fa-solid fa-user me-2"></i> Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../Usuario/salir.php">
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
                        <div class=" text-center contenercitas">
                            <h5 class="mb-0 text-center EstiloLetraTarjeta">Novedades y Promociones</h5>
                            <p class="text-muted">Entérate de lo nuevo en Lotus Splendor</p>
                        </div>


                    </div>
                    <div class="card-body">
                        <?php
                        /* ===============================
                           VALIDAR ID PUBLICACIÓN
                        ================================ */
                        if (!isset($_GET['id'])) {
                            die("Publicación no válida.");
                        }

                        $idPublicacion = (int) $_GET['id'];

                        /* ===============================
                           TRAER PUBLICACIÓN
                        ================================ */
                        $sql = "
    SELECT 
        b.Titulo,
        b.Resumen,
        b.Comentario,
        b.Tipo,
        b.Destacado,
        b.Imagen,
        b.FechaPublicacion,
        u.Usuario AS Autor
    FROM blog b
    INNER JOIN usuario u ON b.Id_Administrador = u.Id
    WHERE b.Id = ?
      AND b.Activo = 1
      AND (b.FechaFin IS NULL OR b.FechaFin >= CURDATE())
    LIMIT 1
";

                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("i", $idPublicacion);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 0) {
                            die("Publicación no encontrada o no disponible.");
                        }

                        $publicacion = $result->fetch_assoc();

                        /* ===============================
                           BADGE SEGÚN TIPO
                        ================================ */
                        $badgeClass = match ($publicacion['Tipo']) {
                            'OFERTA' => 'bg-primary',
                            'DESCUENTO' => 'bg-danger',
                            default => 'bg-info'
                        };
                        ?>


                        <h2><?= htmlspecialchars($publicacion['Titulo']) ?></h2>

                        <span class="badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($publicacion['Tipo']) ?>
                        </span>

                        <p class="text-muted mt-2">
                            Publicado el <?= date('d/m/Y', strtotime($publicacion['FechaPublicacion'])) ?>
                            · Por <?= htmlspecialchars($publicacion['Autor']) ?>
                        </p>

                        <?php if (!empty($publicacion['Imagen'])): ?>
                            <img src="<?= htmlspecialchars($publicacion['Imagen']) ?>" class="img-fluid rounded mb-4">
                        <?php endif; ?>

                        <p class="fw-semibold">
                            <?= nl2br(htmlspecialchars($publicacion['Resumen'])) ?>
                        </p>

                        <hr>

                        <div class="mt-3">
                            <?= nl2br(htmlspecialchars($publicacion['Comentario'])) ?>
                        </div>



                        <!-- ACCIONES -->
                        <div class="d-flex justify-content-end gap-2 mb-4 mt-4">
                            <a href="InicioPaciente.php" class="btn btn-primary">
                                Volver
                            </a>
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

</body>

</html>

<?php
unset($_SESSION["Error"]);
?>