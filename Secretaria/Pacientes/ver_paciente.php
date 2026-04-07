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
            <!-- Section: Main chart -->
            <section class="mb-4">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="card-header">
                            <div class="row mb-4">
                                <div class="col-md-6 text-md-start">
                                    <h5 class="fw-bold EstiloLetraTarjeta mb-0">
                                        <i class="fas fa-user-md me-2"></i>
                                        Atención de Pacientes
                                    </h5>
                                    <small class="text-muted">
                                        Control de citas, atención clínica e historial de pacientes
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <?php
                            include("../../Conexiones/conexion.php");

                            $id = $_GET['id'] ?? 0;

                            /* ========================
                               PACIENTE + USUARIO
                            ========================*/
                            $sql = "SELECT 
p.*,
u.Usuario,
u.Estado as EstadoUsuario
FROM paciente p
INNER JOIN usuario u ON u.Id = p.Id_Usuario
WHERE p.Id = $id";

                            $res = $conexion->query($sql);
                            $p = $res->fetch_assoc();

                            if (!$p) {
                                echo "<div class='alert alert-danger'>Paciente no encontrado</div>";
                                exit;
                            }

                            /* ========================
                               HISTORIAL
                            ========================*/
                            $sqlH = "SELECT * FROM historial_clinico 
WHERE id_paciente = $id 
ORDER BY id DESC LIMIT 1";

                            $resH = $conexion->query($sqlH);
                            $h = $resH->fetch_assoc();
                            ?>

                            <!-- BOTON VOLVER -->
                            <div class="mb-3">
                                <a href="pacientes.php" class="btn btn-dark">
                                    ← Volver
                                </a>
                            </div>

                            <div class="row">

                                <!-- FOTO -->
                                <div class="col-md-3 text-center">

                                    <?php
                                    $rutaFoto = "../../Img/Pacientes/" . $p['Foto'];
                                    if (!empty($p['Foto']) && file_exists($rutaFoto)) {
                                        ?>
                                        <img src="<?php echo $rutaFoto; ?>" class="img-fluid rounded shadow"
                                            style="height:220px;width:220px;object-fit:cover;">
                                    <?php } else { ?>
                                        <img src="../../Img/user.png" class="img-fluid rounded shadow"
                                            style="height:220px;width:220px;object-fit:cover;">
                                    <?php } ?>

                                    <h4 class="mt-3 fw-bold">
                                        <?php echo $p['Nombre'] . " " . $p['Apellido']; ?>
                                    </h4>

                                    <?php if ($p['EstadoUsuario'] == 1) { ?>
                                        <span class="badge bg-success">Usuario activo</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">Usuario inactivo</span>
                                    <?php } ?>

                                </div>


                                <!-- DATOS -->
                                <div class="col-md-9">

                                    <h5 class="fw-bold text-primary">Datos personales</h5>

                                    <div class="row">

                                        <div class="col-md-4 mt-2">
                                            <b>Usuario login:</b><br>
                                            <?php echo $p['Usuario']; ?>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <b>Documento:</b><br>
                                            <?php echo $p['NumeroDocumento']; ?>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <b>Teléfono:</b><br>
                                            <?php echo $p['NumeroTelefono']; ?>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <b>Fecha nacimiento:</b><br>
                                            <?php echo $p['FechaNacimiento']; ?>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <b>Género:</b><br>
                                            <?php echo $p['Genero']; ?>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <b>Estado civil:</b><br>
                                            <?php echo $p['EstadoCivil']; ?>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <b>Ocupación:</b><br>
                                            <?php echo $p['Ocupacion']; ?>
                                        </div>

                                        <div class="col-md-8 mt-3">
                                            <b>Dirección:</b><br>
                                            <?php echo $p['Direccion']; ?>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <b>Fecha registro:</b><br>
                                            <?php echo $p['FechaRegistro']; ?>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <hr>

                            <!-- HISTORIAL CLINICO -->
                            <h5 class="fw-bold text-success">Historial clínico</h5>

                            <?php if ($h) { ?>

                                <div class="row">

                                    <div class="col-md-2">
                                        <b>Estatura:</b><br>
                                        <?php echo $h['Estatura'] ?: 'No registra'; ?> cm
                                    </div>

                                    <div class="col-md-2">
                                        <b>Peso:</b><br>
                                        <?php echo $h['Peso'] ?: 'No registra'; ?> kg
                                    </div>

                                    <div class="col-md-8">
                                        <b>Alergias:</b><br>
                                        <?php echo $h['alergias'] ?: 'No registra'; ?>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <b>Enfermedades:</b><br>
                                        <?php echo $h['enfermedades'] ?: 'No registra'; ?>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <b>Medicamentos:</b><br>
                                        <?php echo $h['medicamentos'] ?: 'No registra'; ?>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <b>Antecedentes relevantes:</b><br>
                                        <?php echo $h['antecedentes_relevantes'] ?: 'No registra'; ?>
                                    </div>

                                </div>

                            <?php } else { ?>
                                <div class="alert alert-warning">Paciente sin historial clínico</div>
                            <?php } ?>

                            <hr>
                            <!-- VALORACIONES -->
                            <h5 class="fw-bold text-dark">Valoraciones estéticas</h5>

                            <?php
                            /* =========================
                               PAGINACION
                            =========================*/
                            $por_pagina = 5;
                            $pagina = $_GET['pagina_val'] ?? 1;
                            if ($pagina < 1) {
                                $pagina = 1;
                            }

                            $inicio = ($pagina - 1) * $por_pagina;

                            /* TOTAL */
                            $sqlTotal = "SELECT COUNT(*) as total
FROM valoracion_estetica v
LEFT JOIN cita c ON v.id_cita = c.Id
WHERE c.Id_Paciente = $id";

                            $total = $conexion->query($sqlTotal)->fetch_assoc()['total'];
                            $total_paginas = ceil($total / $por_pagina);

                            /* CONSULTA PAGINADA */
                            $sqlV = "SELECT 
v.*, 
c.Servicio,
u.Usuario as Especialista
FROM valoracion_estetica v
LEFT JOIN cita c ON v.id_cita = c.Id
LEFT JOIN usuario u ON v.id_especialista = u.Id
WHERE c.Id_Paciente = $id
ORDER BY v.fecha DESC
LIMIT $inicio,$por_pagina";

                            $resV = $conexion->query($sqlV);
                            ?>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle shadow-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Servicio</th>
                                            <th>Especialista</th>
                                            <th>Diagnóstico</th>
                                            <th>Estado</th>
                                            <th width="120">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($resV->num_rows == 0) {
                                            echo "<tr><td colspan='6' class='text-center'>Sin valoraciones</td></tr>";
                                        }

                                        while ($v = $resV->fetch_assoc()) {
                                            ?>

                                            <tr>
                                                <td><?php echo date("d/m/Y", strtotime($v['fecha'])); ?></td>
                                                <td><?php echo $v['Servicio']; ?></td>
                                                <td><?php echo $v['Especialista']; ?></td>
                                                <td><?php echo substr($v['diagnostico_estetico'], 0, 45); ?>...</td>
                                                <td>
                                                    <span class="badge bg-success"><?php echo $v['estado']; ?></span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal<?php echo $v['id']; ?>">
                                                        Ver
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- MODAL BONITO -->
                                            <div class="modal fade" id="modal<?php echo $v['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                    <div class="modal-content">

                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title">
                                                                Ficha estética completa
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <!-- INFO GENERAL -->
                                                            <div class="card mb-3 shadow-sm">
                                                                <div class="card-header bg-primary text-white fw-bold">
                                                                    Información general
                                                                </div>
                                                                <div class="card-body row">
                                                                    <div class="col-md-3">
                                                                        <b>Fecha:</b><br><?php echo $v['fecha']; ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <b>Servicio:</b><br><?php echo $v['Servicio']; ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <b>Especialista:</b><br><?php echo $v['Especialista']; ?>
                                                                    </div>
                                                                    <div class="col-md-3"><b>Estado:</b><br>
                                                                        <span
                                                                            class="badge bg-success"><?php echo $v['estado']; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- PIEL -->
                                                            <div class="card mb-3 shadow-sm">
                                                                <div class="card-header bg-dark text-white fw-bold">
                                                                    Evaluación de piel
                                                                </div>
                                                                <div class="card-body row">
                                                                    <div class="col-md-6"><b>Tipo
                                                                            piel:</b><br><?php echo $v['tipo_piel']; ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <b>Fototipo:</b><br><?php echo $v['fototipo']; ?>
                                                                    </div>
                                                                    <div class="col-md-12 mt-3"><b>Estado
                                                                            piel:</b><br><?php echo $v['estado_piel']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- PROCEDIMIENTO -->
                                                            <div class="card mb-3 shadow-sm">
                                                                <div class="card-header bg-success text-white fw-bold">
                                                                    Procedimiento realizado
                                                                </div>
                                                                <div class="card-body">
                                                                    <b>Diagnóstico estético:</b><br>
                                                                    <?php echo $v['diagnostico_estetico']; ?><br><br>

                                                                    <b>Procedimiento:</b><br>
                                                                    <?php echo $v['procedimiento_realizado']; ?><br><br>

                                                                    <b>Productos utilizados:</b><br>
                                                                    <?php echo $v['productos_utilizados']; ?><br><br>

                                                                    <b>Equipos utilizados:</b><br>
                                                                    <?php echo $v['equipos_utilizados']; ?>
                                                                </div>
                                                            </div>

                                                            <!-- OBSERVACIONES -->
                                                            <div class="card mb-3 shadow-sm">
                                                                <div class="card-header bg-warning fw-bold">
                                                                    Seguimiento
                                                                </div>
                                                                <div class="card-body">
                                                                    <b>Observaciones:</b><br>
                                                                    <?php echo $v['observaciones']; ?><br><br>

                                                                    <b>Reacciones:</b><br>
                                                                    <?php echo $v['reacciones']; ?><br><br>

                                                                    <b>Recomendaciones:</b><br>
                                                                    <?php echo $v['recomendaciones']; ?><br><br>

                                                                    <b>Próxima cita:</b>
                                                                    <?php echo $v['proxima_cita']; ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINACION PRO -->
                            <?php if ($total_paginas > 1) { ?>
                                <nav class="mt-3">
                                    <ul class="pagination justify-content-center">

                                        <?php if ($pagina > 1) { ?>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="?id=<?php echo $id; ?>&pagina_val=<?php echo $pagina - 1; ?>">
                                                    « Anterior
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                                            <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?id=<?php echo $id; ?>&pagina_val=<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if ($pagina < $total_paginas) { ?>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="?id=<?php echo $id; ?>&pagina_val=<?php echo $pagina + 1; ?>">
                                                    Siguiente »
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </nav>
                            <?php } ?>







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

    <!-- ---------- INCLUYE ESTO (una sola vez) ---------- -->

    <!-- FullCalendar CSS (v5+) -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 JS (usa bundle que incluye popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- ------------------------------------------------- -->





</body>

</html>

<?php
unset($_SESSION["Error"]);
?>