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
                        <div class="card-header py-3">
                            <div class="row mb-4">
                                <h5 class="fw-bold EstiloLetraTarjeta">Detalle de factura</h5>
                                <small class="text-muted">Información completa de la facturación realizada</small>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php

                            if (!isset($_GET['id'])) {
                                header('Location: FacturasAdmin.php');
                                exit;
                            }

                            $idFactura = (int) $_GET['id'];

                            /* ==========================
                               DATOS DE LA FACTURA
                            ========================== */
                            $sqlFactura = "
    SELECT 
        f.Id,
        f.numero_factura,
        f.FechaHora,
        f.Subtotal,
        f.Descuento,
        f.Total,
        f.Metodo_Pago,
        f.Estado,
        p.Nombre,
        p.Apellido,
        p.NumeroDocumento,
        p.NumeroTelefono
    FROM factura f
    INNER JOIN paciente p ON p.Id = f.Id_Paciente
    WHERE f.Id = $idFactura
";

                            $factura = $conexion->query($sqlFactura)->fetch_assoc();

                            if (!$factura) {
                                echo "<div class='alert alert-danger'>Factura no encontrada</div>";
                                exit;
                            }

                            /* ==========================
                               DETALLE DE LA FACTURA
                            ========================== */
                            $sqlDetalle = "
    SELECT
        c.Servicio,
        c.Fecha,
        c.HoraInicio,
        c.HoraFin,
        c.Descuento,
        df.Cantidad,
        df.Precio,
        df.Total
    FROM detalle_factura df
    INNER JOIN cita c ON c.Id = df.Id_Cita
    WHERE df.Id_Factura = $idFactura
";

                            $detalle = $conexion->query($sqlDetalle);

                            ?>

                            <!-- ENCABEZADO -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="fw-bold mb-0">Factura #<?= $factura['numero_factura'] ?></h4>

                                        <?php if ($factura['Estado'] === 'PAGADA'): ?>
                                            <span class="badge bg-success fs-6">PAGADA</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger fs-6">ANULADA</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Paciente:</strong>
                                                <?= $factura['Nombre'] . ' ' . $factura['Apellido'] ?>
                                            </p>
                                            <p class="mb-1"><strong>Documento:</strong>
                                                <?= $factura['NumeroDocumento'] ?>
                                            </p>
                                            <p class="mb-1"><strong>Teléfono:</strong>
                                                <?= $factura['NumeroTelefono'] ?>
                                            </p>
                                        </div>

                                        <div class="col-md-6 text-md-end">
                                            <p class="mb-1"><strong>Fecha:</strong>
                                                <?= date('d/m/Y H:i', strtotime($factura['FechaHora'])) ?>
                                            </p>
                                            <p class="mb-1"><strong>Método de pago:</strong>
                                                <?= $factura['Metodo_Pago'] ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- DETALLE -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">

                                    <h5 class="fw-bold mb-3">Detalle de servicios</h5>

                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Servicio</th>
                                                <th>Fecha / Hora</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-end">Precio</th>
                                                <th class="text-end">Descuento</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if ($detalle && $detalle->num_rows > 0): ?>
                                                <?php while ($row = $detalle->fetch_assoc()): ?>

                                                    <?php
                                                    // Cálculos
                                                    $precio = $row['Precio'];
                                                    $cantidad = $row['Cantidad'];
                                                    $porcentaje = $row['Descuento']; // porcentaje
                                                    $subtotal = $precio * $cantidad;
                                                    $valor_desc = ($subtotal * $porcentaje) / 100;
                                                    $total_final = $subtotal - $valor_desc;
                                                    ?>

                                                    <tr>
                                                        <td><?= htmlspecialchars($row['Servicio']) ?></td>

                                                        <td>
                                                            <?= date('d/m/Y', strtotime($row['Fecha'])) ?><br>
                                                            <small class="text-muted">
                                                                <?= substr($row['HoraInicio'], 0, 5) ?> -
                                                                <?= substr($row['HoraFin'], 0, 5) ?>
                                                            </small>
                                                        </td>

                                                        <td class="text-center"><?= $cantidad ?></td>

                                                        <td class="text-end">
                                                            $<?= number_format($precio, 0, ',', '.') ?>
                                                        </td>

                                                        <td class="text-end">
                                                            <?php if ($porcentaje > 0): ?>
                                                                <span class="text-danger">
                                                                    <?= $porcentaje ?>% <br>
                                                                    <small>
                                                                        (-$<?= number_format($valor_desc, 0, ',', '.') ?>)
                                                                    </small>
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="text-muted">0%</span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td class="text-end fw-bold">
                                                            $<?= number_format($total_final, 0, ',', '.') ?>
                                                        </td>
                                                    </tr>

                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        No hay servicios asociados
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>

                            <!-- TOTALES -->
                            <div class="card shadow-sm">
                                <div class="card-body">

                                    <div class="row justify-content-end">
                                        <div class="col-md-4">

                                            <p class="d-flex justify-content-between">
                                                <span>Subtotal:</span>
                                                <strong>$<?= number_format($factura['Subtotal'], 0, ',', '.') ?></strong>
                                            </p>

                                            <p class="d-flex justify-content-between">
                                                <span>Descuento:</span>
                                                <strong>$<?= number_format($factura['Descuento'], 0, ',', '.') ?></strong>
                                            </p>

                                            <hr>

                                            <p class="d-flex justify-content-between fs-5">
                                                <span>Total:</span>
                                                <strong class="text-success">
                                                    $<?= number_format($factura['Total'], 0, ',', '.') ?>
                                                </strong>
                                            </p>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- BOTONES -->
                            <div class="text-end mt-4">
                                <a href="Facturas.php" class="btn btn-secondary">
                                    ⬅ Volver
                                </a>

                                <button class="btn btn-primary" onclick="window.print()">
                                    🖨 Imprimir
                                </button>
                                <a href="FacturaPDF.php?id=<?= $factura['Id'] ?>" class="btn btn-danger">
                                    📄 Descargar PDF
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>