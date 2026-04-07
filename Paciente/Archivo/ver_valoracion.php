<?php
session_start();
require_once('../../Conexiones/conexion.php');
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
    $consul = "SELECT p.Foto, p.Nombre, p.Apellido, u.Usuario, p.Id FROM paciente p 
  INNER JOIN usuario u ON p.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
    $ejecu = mysqli_query($conexion, $consul);
    $Fil = mysqli_fetch_assoc($ejecu);
    $idusua = $Fil['Id'];
    $nombre = $Fil['Nombre'];
    $apellido = $Fil['Apellido'];
    $email = $Fil['Usuario'];
    $fotoBD = $Fil['Foto'];

    /* ================================
       RUTA FOTO (SIN file_exists)
    ================================ */

    $rutaBase = "../../Img/Pacientes/"; // 👈 AJUSTA si tu carpeta es otra
    
    if (!empty($fotoBD) && file_exists(__DIR__ . "/$rutaBase$fotoBD")) {
        $fotoMenu = $rutaBase . $fotoBD;
    } else {
        $fotoMenu = "../../Img/Pacientes/user-default.png";
    }
    ?>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4 Lolo">
                    <a href="../../Blog/InicioPaciente.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init><i class="fa-solid fa-house fa-fw me-3 IconosMenu">
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
                    <a href="../Archivo/CodigoHC.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa-solid fa-folder-open me-3 IconosMenu">
                        </i><span>Historial Clinico</span>
                    </a>
                    <a href="../Facturas/FacturasGuardadas.php" class="list-group-item py-2 OpcionMenu"
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
                        <div class="contenercitas">
                            <h5 class="mb-0 text-center EstiloLetraTarjeta">Detalle de la valoración</h5>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php
                        // ==== // 🔐 VALIDAR SESIÓN // =====
                        if (!isset($_SESSION['id'])) {
                            header("Location: ../login.php");
                            exit;
                        }

                        // ======// 🔍 VALIDAR ID VALORACIÓN// ======
                        if (!isset($_GET['id'])) {
                            echo "Valoración no válida.";
                            exit;
                        }

                        $valoracionId = (int) $_GET['id'];

                        // =====// 🧍 OBTENER ID PACIENTE DESDE LOGIN// =======
                        $stmtUser = $conexion->prepare("
    SELECT p.Id, p.Nombre, p.Apellido, p.Foto, u.Usuario
    FROM paciente p
    INNER JOIN usuario u ON p.Id_Usuario = u.Id
    WHERE u.Id = ?
");
                        $stmtUser->bind_param("i", $_SESSION['id']);
                        $stmtUser->execute();
                        $resUser = $stmtUser->get_result();

                        if ($resUser->num_rows === 0) {
                            echo "Paciente no encontrado.";
                            exit;
                        }

                        $usuario = $resUser->fetch_assoc();
                        $pacienteId = $usuario['Id'];

                        // ====// 📌 CONSULTA VALORACIÓN// =====
                        $stmt = $conexion->prepare("
    SELECT 
        vl.fecha,
        vl.tipo_piel,
        vl.fototipo,
        vl.estado_piel,
        vl.diagnostico_estetico,
        vl.procedimiento_realizado,
        vl.productos_utilizados,
        vl.equipos_utilizados,
        vl.observaciones,
        vl.reacciones,
        vl.recomendaciones,
        vl.proxima_cita,
        vl.estado,
        s.Nombre AS servicio,
        cp.Nombre AS especialistanom,
        cp.Apellido AS especialistaape
    FROM valoracion_estetica vl
    INNER JOIN cita c ON vl.id_cita = c.Id
    INNER JOIN servicio s ON vl.id_servicio = s.Id
    INNER JOIN servicioespecialista se ON vl.id_especialista = se.Id
    INNER JOIN contratopersona cp ON se.Id_Especialista = cp.Id
    WHERE vl.id = ?
      AND c.Id_Paciente = ?
    LIMIT 1
");

                        $stmt->bind_param("ii", $valoracionId, $pacienteId);
                        $stmt->execute();
                        $resultado = $stmt->get_result();

                        if ($resultado->num_rows === 0) {
                            echo "No tienes permiso para ver esta valoración.";
                            exit;
                        }

                        $val = $resultado->fetch_assoc();

                        // ====// 🔁 ESTADO// ======
                        $textoEstado = $val['estado'] === 'ABIERTA' ? 'En seguimiento' : 'Finalizada';
                        $claseEstado = $val['estado'] === 'ABIERTA' ? 'bg-warning' : 'bg-success';

                        // =====// 📋 CONSULTA HISTORIAL CLÍNICO// ====
                        $stmtHC = $conexion->prepare("
    SELECT 
        alergias,
        enfermedades,
        medicamentos,
        antecedentes_relevantes,
        embarazo_lactancia
    FROM historial_clinico
    WHERE id_paciente = ?
    LIMIT 1
");

                        $stmtHC->bind_param("i", $pacienteId);
                        $stmtHC->execute();
                        $resHC = $stmtHC->get_result();
                        $hc = $resHC->num_rows > 0 ? $resHC->fetch_assoc() : null;
                        ?>

                        <div class="container mt-4 mb-5">

                            <!-- ======================================================
        HEADER RESUMEN
    ======================================================= -->
                            <div class="card shadow-sm mb-4 border-0">
                                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

                                    <div>
                                        <h5 class="mb-1 fw-bold text-primary">
                                            <i class="fa fa-file-medical me-2"></i>
                                            Valoración estética
                                        </h5>

                                        <small class="text-muted">
                                            <?= date('d/m/Y H:i', strtotime($val['fecha'])) ?>
                                            • <?= $val['servicio'] ?>
                                            • <?= $val['especialistanom'] . ' ' . $val['especialistaape'] ?>
                                        </small>
                                    </div>

                                    <span class="badge <?= $claseEstado ?> fs-6 px-3 py-2">
                                        <?= $textoEstado ?>
                                    </span>
                                </div>
                            </div>



                            <!-- ======================================================
        GRID PRINCIPAL
    ======================================================= -->
                            <div class="row g-4">

                                <!-- ======================================================
            IZQUIERDA
        ======================================================= -->
                                <div class="col-lg-6">

                                    <!-- HISTORIAL -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-notes-medical me-2"></i>Historial clínico
                                        </div>
                                        <div class="card-body small">

                                            <?php if ($hc): ?>

                                                <p><b>Alergias:</b> <?= $hc['alergias'] ?: 'Ninguna' ?></p>
                                                <p><b>Enfermedades:</b> <?= $hc['enfermedades'] ?: 'Ninguna' ?></p>
                                                <p><b>Medicamentos:</b> <?= $hc['medicamentos'] ?: 'Ninguno' ?></p>

                                                <p><b>Embarazo / Lactancia:</b>
                                                    <span
                                                        class="badge <?= $hc['embarazo_lactancia'] == 'SI' ? 'bg-danger' : 'bg-success' ?>">
                                                        <?= $hc['embarazo_lactancia'] ?>
                                                    </span>
                                                </p>

                                                <p><b>Antecedentes:</b><br>
                                                    <?= nl2br($hc['antecedentes_relevantes'] ?: 'Sin antecedentes') ?>
                                                </p>

                                            <?php else: ?>
                                                <div class="alert alert-warning mb-0">
                                                    Sin historial clínico registrado
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>



                                    <!-- VALORACIÓN PIEL -->
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-spa me-2"></i>Valoración de la piel
                                        </div>
                                        <div class="card-body small">
                                            <p><b>Tipo:</b> <?= $val['tipo_piel'] ?? 'No registrado' ?></p>
                                            <p><b>Fototipo:</b> <?= $val['fototipo'] ?? 'No registrado' ?></p>

                                            <p><b>Estado:</b><br>
                                                <?= nl2br($val['estado_piel'] ?? 'No registrado') ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>



                                <!-- ======================================================
            DERECHA
        ======================================================= -->
                                <div class="col-lg-6">

                                    <!-- DIAGNÓSTICO -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-stethoscope me-2"></i>Diagnóstico
                                        </div>
                                        <div class="card-body small">
                                            <?= nl2br($val['diagnostico_estetico'] ?? 'No registrado') ?>
                                        </div>
                                    </div>


                                    <!-- PROCEDIMIENTO -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-syringe me-2"></i>Procedimiento realizado
                                        </div>
                                        <div class="card-body small">
                                            <?= nl2br($val['procedimiento_realizado'] ?? 'No registrado') ?>
                                        </div>
                                    </div>


                                    <!-- PRODUCTOS -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-flask me-2"></i>Productos y equipos
                                        </div>
                                        <div class="card-body small">

                                            <p><b>Productos:</b><br>
                                                <?= nl2br($val['productos_utilizados'] ?? 'No registrado') ?>
                                            </p>

                                            <p><b>Equipos:</b><br>
                                                <?= nl2br($val['equipos_utilizados'] ?? 'No registrado') ?>
                                            </p>

                                        </div>
                                    </div>


                                    <!-- OBSERVACIONES -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-comment-medical me-2"></i>Observaciones
                                        </div>
                                        <div class="card-body small">
                                            <p><b>Observaciones:</b><br>
                                                <?= nl2br($val['observaciones'] ?? 'No registrado') ?>
                                            </p>

                                            <p><b>Reacciones:</b><br>
                                                <?= nl2br($val['reacciones'] ?? 'No registrado') ?>
                                            </p>
                                        </div>
                                    </div>


                                    <!-- RECOMENDACIONES -->
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light fw-bold">
                                            <i class="fa fa-lightbulb me-2"></i>Recomendaciones
                                        </div>
                                        <div class="card-body small">
                                            <?= nl2br($val['recomendaciones'] ?? 'No registrado') ?>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <!-- ======================================================
        FOOTER ACCIONES
    ======================================================= -->
                            <div class="text-center mt-4">

                                <a href="CodigoHC.php" class="btn btn-danger me-2">
                                    <i class="fa fa-arrow-left"></i> Volver
                                </a>

                                <button onclick="window.print()" class="btn btn-primary">
                                    <i class="fa fa-print"></i> Imprimir
                                </button>

                            </div>

                        </div>




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