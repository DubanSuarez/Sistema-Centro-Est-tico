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
                                <div class="col-md-6 text-md-start text-center">
                                    <h5 class="fw-bold EstiloLetraTarjeta">Editar Cita</h4>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">

                            <?php
                            if (!isset($_GET['id'])) {
                                die("No se proporcionó una cita válida.");
                            }

                            $idCita = intval($_GET['id']);

                            /* ===============================
                               CONSULTA COMPLETA DE LA CITA
                            =============================== */
                            $sql = "
SELECT 
    c.Id,
    c.Fecha,
    DATE_FORMAT(c.HoraInicio, '%H:%i') AS HoraInicio,

    p.Nombre   AS NombrePaciente,
    p.Apellido AS ApellidoPaciente,

    s.Id       AS Id_Servicio,
    se.Id_Especialista

FROM cita c
INNER JOIN paciente p 
    ON p.Id = c.Id_Paciente

INNER JOIN servicioespecialista se 
    ON se.Id = c.Id_ServicioEspecialista

INNER JOIN servicio s 
    ON s.Id = se.Id_Servicio

WHERE c.Id = $idCita
LIMIT 1
";

                            $result = mysqli_query($conexion, $sql);

                            if (!$result || mysqli_num_rows($result) === 0) {
                                die("No se encontró la cita.");
                            }

                            $cita = mysqli_fetch_assoc($result);
                            ?>


                            <form action="updateCita.php" method="POST" id="formEditarCita">

                                <!-- ID CITA -->
                                <input type="hidden" name="id" value="<?= $cita['Id'] ?>">

                                <div class="row justify-content-center">

                                    <!-- PACIENTE (SOLO LECTURA) -->
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Paciente</label>
                                        <input type="text" class="form-control"
                                            value="<?= $cita['NombrePaciente'] . ' ' . $cita['ApellidoPaciente'] ?>"
                                            readonly>
                                    </div>

                                    <!-- SERVICIO -->
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Servicio</label>
                                        <select name="servicio" id="servicio"
                                            class="form-select browser-default custom-select" required>
                                            <option value="">Seleccione un servicio</option>
                                            <?php
                                            $sql = "SELECT Id, Nombre FROM servicio";
                                            $res = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $selected = ($row['Id'] == $cita['Id_Servicio']) ? 'selected' : '';
                                                echo "<option value='{$row['Id']}' $selected>{$row['Nombre']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- ESPECIALISTA -->
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Especialista</label>
                                        <select name="especialista" id="especialista"
                                            class="form-select browser-default custom-select" required>
                                            <option value="">Seleccione un especialista</option>
                                        </select>
                                    </div>

                                    <!-- FECHA -->
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" value="<?= $cita['Fecha'] ?>"
                                            class="form-control" required>
                                    </div>

                                    <!-- HORA -->
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <label class="form-label">Hora</label>
                                        <select name="horaInicio" id="hora"
                                            class="form-select browser-default custom-select" required>
                                            <option value="">Seleccione una hora</option>
                                        </select>
                                    </div>

                                    <!-- BOTÓN -->
                                    <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-warning">
                                            Actualizar cita
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <!-- VOLVER -->
                            <div class="volver">
                                <a href="RegistroCitas.php" class="btn btn-success" data-mdb-ripple-init
                                    data-mdb-ripple-color="dark">
                                    <b class="ver"> Volver </b>
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

    <!----  esto activa el buscador y demas funciones ---->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!--- Valida el servicio, los especialistas y el horario -->

<script>
$('#servicio').change(function () {
    let servicioId = $(this).val();
    $('#especialista').html('<option value="">Seleccione un especialista</option>');
    $('#hora').html('<option value="">Seleccione una hora</option>');

    if (servicioId) {
        $.post('getEspecialistas.php', { servicioId }, function (data) {
            $('#especialista').html(data);
            $('#especialista')
                .val('<?= $cita['Id_Especialista'] ?>')
                .trigger('change');
        });
    }
});

$('#fecha, #servicio, #especialista').change(function () {
    let fecha = $('#fecha').val();
    let servicioId = $('#servicio').val();
    let especialistaId = $('#especialista').val();

    if (fecha && servicioId && especialistaId) {
        $.post(
            'getHorarios.php',
            { fecha, servicioId, especialistaId },
            function (data) {
                $('#hora').html(data);
                $('#hora').val('<?= $cita['HoraInicio'] ?>');
            }
        );
    }
});

$(document).ready(function () {
    $('#servicio').trigger('change');
});

</script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>