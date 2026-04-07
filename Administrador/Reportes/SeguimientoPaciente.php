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
    <!-- Iconos bootstrap -->
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
                                <div class="row mb-4">
                                    <div class="col-md-6 text-md-start text-center">
                                        <h5 class="fw-bold EstiloLetraTarjeta">Historia Clínica del Paciente</h5>
                                        <small class="text-muted">
                                            Detalle completo de historial médico y valoraciones estéticas
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">


                            <?php

                            $id = (int) $_GET['id'];

                            /* ======================================================
                               PAGINACIÓN
                            ====================================================== */
                            $por_pagina = 5;
                            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $pagina = ($pagina < 1) ? 1 : $pagina;
                            $offset = ($pagina - 1) * $por_pagina;


                            /* ======================================================
                               PACIENTE + HISTORIAL
                            ====================================================== */
                            $sql_paciente = "
SELECT 
    p.*,
    h.Estatura,
    h.Peso,
    h.alergias,
    h.enfermedades,
    h.medicamentos,
    h.antecedentes_relevantes,
    h.embarazo_lactancia
FROM paciente p
LEFT JOIN historial_clinico h ON h.id_paciente = p.Id
WHERE p.Id = $id
";

                            $paciente = $conexion->query($sql_paciente)->fetch_assoc();


                            /* ======================================================
                               TOTAL VALORACIONES
                            ====================================================== */
                            $sql_total = "
SELECT COUNT(*) total
FROM valoracion_estetica v
INNER JOIN cita c ON c.Id = v.id_cita
WHERE c.Id_Paciente = $id
";

                            $total = $conexion->query($sql_total)->fetch_assoc()['total'];
                            $total_paginas = ceil($total / $por_pagina);


                            /* ======================================================
                               VALORACIONES + NOMBRE ESPECIALISTA
                            ====================================================== */
                            $sql_val = "
SELECT 
    v.*,
    CONCAT(cp.Nombre,' ',cp.Apellido) AS especialista_nombre,
    cp.Especialidad
FROM valoracion_estetica v
INNER JOIN cita c ON c.Id = v.id_cita
LEFT JOIN contratopersona cp ON cp.Id = v.id_especialista
WHERE c.Id_Paciente = $id
ORDER BY v.fecha DESC
LIMIT $offset, $por_pagina
";

                            $valoraciones = $conexion->query($sql_val);
                            ?>











                            <div class="card-body">

                                <!-- ======================================================
   FICHA PACIENTE
====================================================== -->

                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">

                                        <h5 class="fw-bold mb-3">
                                            <i class="fa-solid fa-user"></i>
                                            <?= $paciente['Nombre'] . ' ' . $paciente['Apellido'] ?>
                                        </h5>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <small class="text-muted">Documento</small><br>
                                                <?= $paciente['NumeroDocumento'] ?>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted">Teléfono</small><br>
                                                <?= $paciente['NumeroTelefono'] ?>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted">Registro</small><br>
                                                <?= $paciente['FechaRegistro'] ?>
                                            </div>

                                            <hr class="my-3">

                                            <div class="col-md-2"><b>Estatura:</b> <?= $paciente['Estatura'] ?: '-' ?>
                                            </div>
                                            <div class="col-md-2"><b>Peso:</b> <?= $paciente['Peso'] ?: '-' ?></div>
                                            <div class="col-md-4"><b>Alergias:</b> <?= $paciente['alergias'] ?: '-' ?>
                                            </div>
                                            <div class="col-md-4"><b>Enfermedades:</b>
                                                <?= $paciente['enfermedades'] ?: '-' ?></div>

                                            <div class="col-12 mt-2">
                                                <b>Medicamentos / Antecedentes:</b>
                                                <?= $paciente['medicamentos'] . ' | ' . $paciente['antecedentes_relevantes'] ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!-- ======================================================
   TABLA VALORACIONES
====================================================== -->

                                <h6 class="fw-bold mb-3">
                                    <i class="fa-solid fa-notes-medical"></i>
                                    Seguimiento de Valoraciones
                                </h6>

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Diagnóstico</th>
                                                <th>Procedimiento</th>
                                                <th>Especialista</th>
                                                <th>Estado</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php while ($v = $valoraciones->fetch_assoc()): ?>

                                                <tr>

                                                    <td><?= $v['fecha'] ?></td>
                                                    <td><?= $v['diagnostico_estetico'] ?></td>
                                                    <td><?= $v['procedimiento_realizado'] ?></td>

                                                    <td>
                                                        <?= $v['especialista_nombre'] ?><br>
                                                        <small class="text-muted"><?= $v['Especialidad'] ?></small>
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-success"><?= $v['estado'] ?></span>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#modal<?= $v['id'] ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>

                                                </tr>


                                                <!-- ======================================================
   MODAL COMPLETO
====================================================== -->

                                                <div class="modal fade" id="modal<?= $v['id'] ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h6 class="modal-title">
                                                                    Valoración del <?= $v['fecha'] ?>
                                                                </h6>
                                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <h6 class="fw-bold">Diagnóstico</h6>
                                                                <p><b>Tipo piel:</b> <?= $v['tipo_piel'] ?></p>
                                                                <p><b>Fototipo:</b> <?= $v['fototipo'] ?></p>
                                                                <p><b>Estado piel:</b> <?= $v['estado_piel'] ?></p>
                                                                <p><b>Diagnóstico:</b> <?= $v['diagnostico_estetico'] ?></p>

                                                                <hr>

                                                                <h6 class="fw-bold">Procedimiento</h6>
                                                                <p><b>Procedimiento:</b>
                                                                    <?= $v['procedimiento_realizado'] ?></p>
                                                                <p><b>Productos:</b> <?= $v['productos_utilizados'] ?></p>
                                                                <p><b>Equipos:</b> <?= $v['equipos_utilizados'] ?></p>

                                                                <hr>

                                                                <h6 class="fw-bold">Seguimiento</h6>
                                                                <p><b>Observaciones:</b> <?= $v['observaciones'] ?></p>
                                                                <p><b>Reacciones:</b> <?= $v['reacciones'] ?></p>
                                                                <p><b>Recomendaciones:</b> <?= $v['recomendaciones'] ?></p>
                                                                <p><b>Próxima cita:</b> <?= $v['proxima_cita'] ?></p>

                                                                <hr>

                                                                <h6 class="fw-bold">Información general</h6>
                                                                <p><b>Especialista:</b> <?= $v['especialista_nombre'] ?></p>
                                                                <p><b>Servicio ID:</b> <?= $v['id_servicio'] ?></p>
                                                                <p><b>Estado:</b> <?= $v['estado'] ?></p>
                                                                <p><b>Creado:</b> <?= $v['created_at'] ?></p>
                                                                <p><b>Actualizado:</b> <?= $v['updated_at'] ?></p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endwhile; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- ======================================================
   PAGINACIÓN MEJORADA
====================================================== -->

                                <?php if ($total_paginas > 1): ?>

                                    <nav>
                                        <ul class="pagination justify-content-center mt-4">

                                            <!-- PRIMERA -->
                                            <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                                <a class="page-link" href="?id=<?= $id ?>&pagina=1">
                                                    &laquo;
                                                </a>
                                            </li>

                                            <!-- ANTERIOR -->
                                            <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                                <a class="page-link" href="?id=<?= $id ?>&pagina=<?= $pagina - 1 ?>">
                                                    &lsaquo;
                                                </a>
                                            </li>


                                            <?php
                                            $inicio = max(1, $pagina - 2);
                                            $fin = min($total_paginas, $pagina + 2);

                                            for ($i = $inicio; $i <= $fin; $i++):
                                                ?>

                                                <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                                                    <a class="page-link" href="?id=<?= $id ?>&pagina=<?= $i ?>">
                                                        <?= $i ?>
                                                    </a>
                                                </li>

                                            <?php endfor; ?>


                                            <!-- SIGUIENTE -->
                                            <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                                <a class="page-link" href="?id=<?= $id ?>&pagina=<?= $pagina + 1 ?>">
                                                    &rsaquo;
                                                </a>
                                            </li>

                                            <!-- ÚLTIMA -->
                                            <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                                <a class="page-link" href="?id=<?= $id ?>&pagina=<?= $total_paginas ?>">
                                                    &raquo;
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>

                                <?php endif; ?>













                                <a href="reporte_hc.php" class="btn btn-outline-success" data-mdb-ripple-init
                                    data-mdb-ripple-color="dark">Volver</a>

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