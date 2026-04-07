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
                                        <h5 class="fw-bold EstiloLetraTarjeta">Reporte de Historiales Clínicos</h5>
                                        <small class="text-muted">
                                            Seguimiento médico y estético de pacientes registrados
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">


                            <?php

                            /* ======================================================
                               CONFIGURACIÓN
                            ====================================================== */
                            $por_pagina = 8;
                            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $pagina = ($pagina < 1) ? 1 : $pagina;
                            $offset = ($pagina - 1) * $por_pagina;


                            /* ======================================================
                               FILTROS
                            ====================================================== */
                            $busqueda = $_GET['busqueda'] ?? '';
                            $estado = $_GET['estado'] ?? 'todos';

                            $where = "WHERE 1=1";

                            if ($busqueda != '') {
                                $busqueda = $conexion->real_escape_string($busqueda);

                                $where .= " AND (
        p.Nombre LIKE '%$busqueda%' OR
        p.Apellido LIKE '%$busqueda%' OR
        p.NumeroDocumento LIKE '%$busqueda%'
    )";
                            }

                            if ($estado == "con") {
                                $where .= " AND h.id IS NOT NULL";
                            } elseif ($estado == "sin") {
                                $where .= " AND h.id IS NULL";
                            }


                            /* ======================================================
                               TOTAL REGISTROS
                            ====================================================== */
                            $sql_total = "
SELECT COUNT(DISTINCT p.Id) total
FROM paciente p
LEFT JOIN historial_clinico h ON h.id_paciente = p.Id
$where
";

                            $total = $conexion->query($sql_total)->fetch_assoc()['total'];
                            $total_paginas = ceil($total / $por_pagina);


                            /* ======================================================
                               CONSULTA PRINCIPAL (CORREGIDA)
                            ====================================================== */
                            $sql = "
SELECT 
    p.Id,
    p.Nombre,
    p.Apellido,
    p.NumeroDocumento,
    h.id AS historial_id,

    COUNT(DISTINCT v.id) AS total_valoraciones,
    MAX(v.fecha) AS ultima_valoracion

FROM paciente p

LEFT JOIN historial_clinico h ON h.id_paciente = p.Id

/* 🔥 RELACIÓN CORRECTA */
LEFT JOIN cita c ON c.Id_Paciente = p.Id
LEFT JOIN valoracion_estetica v ON v.id_cita = c.Id

$where

GROUP BY p.Id
ORDER BY p.Nombre ASC
LIMIT $offset, $por_pagina
";

                            $resultado = $conexion->query($sql);
                            ?>


                            <!-- ======================================================
     FILTROS
====================================================== -->

                            <form method="GET" class="row g-3 mb-4">

                                <div class="col-md-5">
                                    <input type="text" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>"
                                        class="form-control" placeholder="Buscar por nombre, apellido o documento...">
                                </div>

                                <div class="col-md-3">
                                    <select name="estado" class="form-select">
                                        <option value="todos" <?= $estado == "todos" ? 'selected' : '' ?>>Todos</option>
                                        <option value="con" <?= $estado == "con" ? 'selected' : '' ?>>Con historial
                                        </option>
                                        <option value="sin" <?= $estado == "sin" ? 'selected' : '' ?>>Sin historial
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>

                                <div class="col-md-2">
                                    <a href="Reporte_hc.php" class="btn btn-secondary w-100">
                                        Limpiar
                                    </a>
                                </div>

                            </form>


                            <!-- ======================================================
     TABLA
====================================================== -->

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Paciente</th>
                                            <th>Documento</th>
                                            <th>Historial</th>
                                            <th>Valoraciones</th>
                                            <th>Última atención</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php while ($row = $resultado->fetch_assoc()): ?>

                                            <tr>

                                                <td>
                                                    <?= $row['Nombre'] . ' ' . $row['Apellido'] ?>
                                                </td>

                                                <td>
                                                    <?= $row['NumeroDocumento'] ?>
                                                </td>

                                                <!-- HISTORIAL -->
                                                <td>
                                                    <?php if ($row['historial_id']) { ?>
                                                        <span class="badge bg-success">Con historial</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-danger">Sin historial</span>
                                                    <?php } ?>
                                                </td>

                                                <!-- VALORACIONES -->
                                                <td>
                                                    <span class="badge bg-info">
                                                        <?= $row['total_valoraciones'] ?>
                                                    </span>
                                                </td>

                                                <!-- ÚLTIMA -->
                                                <td>
                                                    <?= $row['ultima_valoracion'] ?: '-' ?>
                                                </td>

                                                <!-- ACCIONES -->
                                                <td>

                                                    <?php if ($row['historial_id']) { ?>

                                                        <a href="SeguimientoPaciente.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fa fa-notes-medical"></i>
                                                        </a>


                                                        <a href="EditarHistorial.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-outline-warning">
                                                            <i class="fa fa-pen"></i>
                                                        </a>

                                                    <?php } else { ?>

                                                        <a href="CrearHistorial.php?id=<?= $row['Id'] ?>"
                                                            class="btn btn-sm btn-outline-success">
                                                            <i class="fa fa-plus"></i> Crear
                                                        </a>

                                                    <?php } ?>

                                                </td>

                                            </tr>

                                        <?php endwhile; ?>

                                    </tbody>

                                </table>
                            </div>


                            <!-- ======================================================
     PAGINACIÓN
====================================================== -->
                            <nav>
                                <ul class="pagination justify-content-center">

                                    <?php if ($pagina > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina - 1 ?>&busqueda=<?= urlencode($busqueda) ?>&estado=<?= $estado ?>">
                                                «
                                            </a>
                                        </li>
                                    <?php endif; ?>


                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                                            <a class="page-link"
                                                href="?pagina=<?= $i ?>&busqueda=<?= urlencode($busqueda) ?>&estado=<?= $estado ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>


                                    <?php if ($pagina < $total_paginas): ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="?pagina=<?= $pagina + 1 ?>&busqueda=<?= urlencode($busqueda) ?>&estado=<?= $estado ?>">
                                                »
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </nav>



                            <a href="Reportes.php" class="btn btn-outline-success" data-mdb-ripple-init
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