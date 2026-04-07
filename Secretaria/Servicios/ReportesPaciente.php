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

        <section class="mb-4">
            <div class="card">

                <div class="card-header py-3">
                    <h5 class="mb-0 text-center EstiloLetraTarjeta">Servicios</h5>
                </div>

                <div class="card-body">

                    <?php
                    /* =========================
                       PAGINACIÓN
                    ========================= */
                    $por_pagina = 6;
                    $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
                    if ($pagina < 1) $pagina = 1;

                    $inicio = ($pagina - 1) * $por_pagina;


                    /* =========================
                       CONSULTA
                    ========================= */
                    $consulta = "
                        SELECT Id, Nombre, Descripcion, Costo, Descuento, Foto
                        FROM servicio
                        ORDER BY Id DESC
                        LIMIT $inicio, $por_pagina
                    ";

                    $resultado = mysqli_query($conexion, $consulta);

                    $rutaBase = "../../Img/Servicios/";
                    ?>


                    <style>
                        .servicio-card {
                            border-radius: 18px;
                            transition: .25s ease;
                        }

                        .servicio-card:hover {
                            transform: translateY(-6px);
                            box-shadow: 0 10px 25px rgba(0,0,0,.12);
                        }

                        .servicio-img {
                            height: 220px;
                            object-fit: cover;
                            border-top-left-radius: 18px;
                            border-top-right-radius: 18px;
                        }

                        .precio-final {
                            font-size: 1.3rem;
                            font-weight: 700;
                            color: #198754;
                        }

                        .precio-antiguo {
                            text-decoration: line-through;
                            color: #6c757d;
                            font-size: .9rem;
                        }
                    </style>


                    <!-- ================= GRID SERVICIOS ================= -->
                    <div class="row g-4">

                        <?php while ($row = mysqli_fetch_assoc($resultado)):

                            $costo = (float)$row['Costo'];
                            $descuento = (float)$row['Descuento'];

                            $precio_final = $descuento > 0
                                ? $costo - ($costo * $descuento)
                                : $costo;

                            /* ===== IMAGEN DESDE CARPETA ===== */
                            $archivo = !empty($row['Foto']) ? $row['Foto'] : 'sin_imagen.png';

                            if (!file_exists($rutaBase . $archivo)) {
                                $archivo = 'sin_imagen.png';
                            }

                            $imagen = $rutaBase . $archivo;
                        ?>

                            <div class="col-lg-4 col-md-6">

                                <div class="card servicio-card shadow-sm h-100 border-0">

                                    <!-- IMAGEN -->
                                    <img src="<?= $imagen ?>" class="servicio-img">

                                    <div class="card-body d-flex flex-column text-center">

                                        <h5 class="fw-bold">
                                            <?= htmlspecialchars($row['Nombre']) ?>
                                        </h5>

                                        <p class="text-muted small mb-3">
                                            <?= htmlspecialchars($row['Descripcion']) ?>
                                        </p>

                                        <div class="mt-auto">

                                            <!-- PRECIO -->
                                            <?php if ($descuento > 0): ?>

                                                <div class="mb-2">
                                                    <span class="precio-antiguo">
                                                        $<?= number_format($costo) ?>
                                                    </span>
                                                    <br>
                                                    <span class="precio-final">
                                                        $<?= number_format($precio_final) ?>
                                                    </span>
                                                    <br>
                                                    <span class="badge bg-warning text-dark">
                                                        <?= intval($descuento * 100) ?>% OFF
                                                    </span>
                                                </div>

                                            <?php else: ?>

                                                <div class="precio-final mb-2">
                                                    $<?= number_format($precio_final) ?>
                                                </div>

                                            <?php endif; ?>


                                            <!-- BOTÓN -->
                                            <a href="../Agenda/Agenda.php?= $row['Id'] ?>"
                                                class="btn btn-primary w-100 rounded-pill">
                                                <i class="fas fa-calendar-plus me-1"></i>
                                                Agendar cita
                                            </a>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        <?php endwhile; ?>

                    </div>



                    <?php
                    /* =========================
                       TOTAL PÁGINAS
                    ========================= */
                    $total_query = mysqli_query($conexion, "SELECT COUNT(*) total FROM servicio");
                    $total = mysqli_fetch_assoc($total_query)['total'];
                    $total_paginas = ceil($total / $por_pagina);
                    ?>


                    <!-- ================= PAGINACIÓN ================= -->
                    <nav class="mt-5">
                        <ul class="pagination justify-content-center">

                            <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">
                                    &laquo;
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">
                                    &raquo;
                                </a>
                            </li>

                        </ul>
                    </nav>

                </div>
            </div>
        </section>

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