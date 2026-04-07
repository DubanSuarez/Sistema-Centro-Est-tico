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
    <!-- Iconos -->
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
	<a href="../../Blog/InicioAdministrador.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
		<i class="fa-solid fa-house me-3 IconosMenu"></i>
		<span>Inicio</span>
	</a>
	<a href="../../Administrador/Personal/Contratos.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
		<i class="fa-solid fa-users-gear me-3 IconosMenu"></i>
		<span>Equipo</span>
	</a>
	<a href="../../Administrador/Servicios/Servicios.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
		<i class="fa-solid fa-spa me-3 IconosMenu"></i>
		<span>Rituales</span>
	</a>
	<a href="../../Administrador/Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
		<i class="fa-solid fa-user me-3 IconosMenu"></i>
		<span>Pacientes</span>
	</a>
	<a href="../../Administrador/Citas/RegistroCitas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
		<i class="fa-solid fa-calendar-days me-3 IconosMenu"></i>
		<span>Agenda</span>
	</a>
	<a href="../../Administrador/HC/ControlCitas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
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
	<a href="../../Administrador/Reportes/Reportes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
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


                            <?php

$id_servicio = $_GET['id'] ?? 0;
if ($id_servicio <= 0) {
    header("Location: Servicios.php");
    exit();
}

/* ====== SERVICIO ACTUAL ====== */
$sql_servicio = "SELECT Nombre FROM servicio WHERE Id = $id_servicio";
$res_servicio = mysqli_query($conexion, $sql_servicio);
$servicio = mysqli_fetch_assoc($res_servicio);

/* ====== ESPECIALISTAS ACTIVOS ====== */
$sql_especialistas = "
    SELECT Id, Nombre, Apellido, Especialidad, Foto
    FROM contratopersona
    WHERE Rol = 'Especialista'
      AND EstadoContrato = '1'
";
$especialistas = mysqli_query($conexion, $sql_especialistas);

/* ====== ESPECIALISTAS ASIGNADOS (ACTIVOS) A ESTE SERVICIO ====== */
$sql_asignados = "
    SELECT Id_Especialista
    FROM servicioespecialista
    WHERE Id_Servicio = $id_servicio
      AND Activo = 1
";
$res_asignados = mysqli_query($conexion, $sql_asignados);

$asignados = [];
while ($row = mysqli_fetch_assoc($res_asignados)) {
    $asignados[] = $row['Id_Especialista'];
}
?>

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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Asignación de Especialistas</h4>
                                        <small class="text-muted">Servicio: <strong><?= htmlspecialchars($servicio['Nombre']) ?></strong></small>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                  

<form action="guardar_asignacion.php" method="POST">
    <input type="hidden" name="Id_Servicio" value="<?= $id_servicio ?>">

    <div class="row g-3">

        <?php if (mysqli_num_rows($especialistas) > 0): ?>
            <?php while ($esp = mysqli_fetch_assoc($especialistas)): ?>

                <?php
                $checked = in_array($esp['Id'], $asignados);

                $foto = !empty($esp['Foto'])
                    ? "../../Img/Especialistas/" . $esp['Foto']
                    : "../../Img/default-user.png";

                /* ====== SERVICIOS ACTIVOS QUE PRESTA ESTE ESPECIALISTA ====== */
                $sql_servicios_esp = "
                    SELECT s.Nombre
                    FROM servicioespecialista se
                    INNER JOIN servicio s ON s.Id = se.Id_Servicio
                    WHERE se.Id_Especialista = {$esp['Id']}
                      AND se.Activo = 1
                ";
                $res_servicios_esp = mysqli_query($conexion, $sql_servicios_esp);
                ?>

                <div class="col-md-4 col-lg-3">
                    <label class="card h-100 shadow-sm <?= $checked ? 'border border-success' : '' ?>"
                           style="cursor:pointer">

                        <div class="card-body text-center position-relative">

                            <!-- CHECK -->
                            <div class="form-check position-absolute top-0 end-0 m-2">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="especialistas[]"
                                       value="<?= $esp['Id'] ?>"
                                       <?= $checked ? 'checked' : '' ?>>
                            </div>

                            <!-- FOTO -->
                            <img src="<?= $foto ?>"
                                 class="rounded-circle mb-2"
                                 width="80"
                                 height="80"
                                 style="object-fit:cover">

                            <!-- NOMBRE -->
                            <h6 class="mb-0">
                                <?= htmlspecialchars($esp['Nombre'] . ' ' . $esp['Apellido']) ?>
                            </h6>

                            <!-- ESPECIALIDAD -->
                            <small class="text-muted d-block mb-2">
                                <?= $esp['Especialidad'] ?: 'Especialista' ?>
                            </small>

                            <!-- SERVICIOS QUE PRESTA -->
                            <div class="text-start mt-2">
                                <small class="fw-semibold text-muted">
                                    Servicios que presta:
                                </small>

                                <?php if (mysqli_num_rows($res_servicios_esp) > 0): ?>
                                    <ul class="list-unstyled mb-0 mt-1 small">
                                        <?php while ($srv = mysqli_fetch_assoc($res_servicios_esp)): ?>
                                            <li>
                                                • <?= htmlspecialchars($srv['Nombre']) ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php else: ?>
                                    <small class="text-muted fst-italic">
                                        Sin servicios asignados
                                    </small>
                                <?php endif; ?>
                            </div>

                            <!-- BADGE -->
                            <?php if ($checked): ?>
                                <div class="mt-2">
                                    <span class="badge bg-success">
                                        Ya presta este servicio
                                    </span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </label>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-muted">No hay especialistas activos</p>
        <?php endif; ?>

    </div>

    <div class="mt-4 text-end">
        <a href="Servicios.php" class="btn btn-secondary">
            Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            Guardar asignación
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