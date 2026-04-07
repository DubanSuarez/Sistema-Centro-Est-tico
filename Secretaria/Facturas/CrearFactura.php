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
                                <div class="col-md-6 text-md-start text-center">
                                    <h5 class="fw-bold EstiloLetraTarjeta">
                                        Vista previa de la factura
                                    </h5>
                                    <small class="text-muted">
                                        Revisión y confirmación antes de generar la factura
                                    </small>
                                </div>

                            </div>
                        </div>

                        <div class="card-body">
                            <?php

                            /* ================= VALIDACIONES ================= */
                            if (
                                !isset($_POST['citas']) ||
                                !is_array($_POST['citas']) ||
                                empty($_POST['citas'])
                            ) {
                                echo "<script>
        alert('No hay citas seleccionadas para facturar.');
        window.location.href = 'Facturar.php';
    </script>";
                                exit;
                            }

                            $citasIds = array_map('intval', $_POST['citas']);

                            /* ================= TRAER CITAS + PACIENTE ================= */
                            $placeholders = implode(',', array_fill(0, count($citasIds), '?'));
                            $types = str_repeat('i', count($citasIds));

                            $sql = "
SELECT 
    c.Id,
    c.Fecha,
    c.Servicio,
    c.Precio,
    c.Descuento,
    p.Id AS IdPaciente,
    p.Nombre,
    p.Apellido,
    p.NumeroDocumento
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
WHERE c.Id IN ($placeholders)
  AND c.Estado = 'ATENDIDA'
  AND c.Facturar = 1
ORDER BY c.Fecha ASC
";

                            $stmt = $conexion->prepare($sql);
                            $stmt->bind_param($types, ...$citasIds);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows === 0) {
                                echo "<script>
        alert('Las citas seleccionadas no son válidas.');
        window.location.href = 'Facturar.php';
    </script>";
                                exit;
                            }

                            /* ================= PROCESAR DATOS ================= */
                            $citas = [];
                            $subtotal = 0;
                            $totalDescuento = 0;
                            $paciente = null;
                            $idPacienteBase = null;

                            while ($row = $result->fetch_assoc()) {

                                if ($idPacienteBase === null) {
                                    $idPacienteBase = $row['IdPaciente'];
                                    $paciente = [
                                        'Id' => $row['IdPaciente'],
                                        'Nombre' => $row['Nombre'],
                                        'Apellido' => $row['Apellido'],
                                        'Documento' => $row['NumeroDocumento']
                                    ];
                                } elseif ($row['IdPaciente'] !== $idPacienteBase) {
                                    echo "<script>
            alert('No se pueden facturar citas de pacientes diferentes.');
            window.location.href = 'Facturar.php';
        </script>";
                                    exit;
                                }

                                $precio = (float) $row['Precio'];
                                $porcentaje = (float) $row['Descuento'];

                                $descuentoPesos = $precio * ($porcentaje / 100);
                                $valorTotal = $precio - $descuentoPesos;

                                $subtotal += $precio;
                                $totalDescuento += $descuentoPesos;

                                $row['ValorTotal'] = $valorTotal;
                                $citas[] = $row;
                            }

                            $totalGeneral = $subtotal - $totalDescuento;
                            ?>



                            <div class="card shadow-4">
                                <div class="card-body">

                                    <h6 class="mb-3">Datos del paciente</h6>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <input class="form-control"
                                                value="<?= $paciente['Nombre'] . ' ' . $paciente['Apellido'] ?>"
                                                disabled>
                                            <small class="text-muted">Paciente</small>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" value="<?= $paciente['Documento'] ?>" disabled>
                                            <small class="text-muted">Documento</small>
                                        </div>
                                    </div>

                                    <h6 class="mb-3">Servicios</h6>

                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Servicio</th>
                                                <th class="text-end">Precio</th>
                                                <th class="text-end">Desc.</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($citas as $c): ?>
                                                <tr>
                                                    <td><?= date('d/m/Y', strtotime($c['Fecha'])) ?></td>
                                                    <td><?= $c['Servicio'] ?></td>
                                                    <td class="text-end">$<?= number_format($c['Precio'], 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-end"><?= $c['Descuento'] ?>%</td>
                                                    <td class="text-end fw-bold">
                                                        $<?= number_format($c['ValorTotal'], 0, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <div class="row justify-content-end mt-4">
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-between">
                                                <span>Subtotal</span>
                                                <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <span>Descuentos</span>
                                                <span>-$<?= number_format($totalDescuento, 0, ',', '.') ?></span>
                                            </div>

                                            <hr>

                                            <div class="d-flex justify-content-between fw-bold fs-5">
                                                <span>Total</span>
                                                <span>$<?= number_format($totalGeneral, 0, ',', '.') ?></span>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- CONFIRMAR -->
                                    <form method="POST" action="ProcesarFactura.php" class="mt-4">

                                        <?php foreach ($citasIds as $id): ?>
                                            <input type="hidden" name="citas[]" value="<?= $id ?>">
                                        <?php endforeach; ?>

                                        <input type="hidden" name="id_paciente" value="<?= $paciente['Id'] ?>">

                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Método de pago</label>
                                                <select name="metodo_pago" class="form-select" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="EFECTIVO">Efectivo</option>
                                                    <option value="TARJETA">Tarjeta</option>
                                                    <option value="TRANSFERENCIA">Transferencia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button class="btn btn-success btn-lg">
                                                Confirmar y crear factura
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                            <br>
                            <a href="Facturar.php" class="btn btn-success" data-mdb-ripple-init>Volver</a>

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