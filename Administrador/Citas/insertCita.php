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
                                    <h5 class="fw-bold EstiloLetraTarjeta">Crear Cita</h4>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">


                            <!-- BUSCAR PACIENTE -->
                            <div class="card mb-4">
                                <div class="card-body"> <label>Buscar paciente (Documento o nombre)</label>
                                    <div class="input-group"> <input type="text" id="buscarPaciente"
                                            class="form-control" placeholder="Ej: 10223344 o Ana"> <button
                                            class="btn btn-primary" type="button" id="btnBuscarPaciente"> Buscar
                                        </button> </div>
                                    <div id="resultadoPaciente" class="mt-3"></div>
                                </div>
                            </div>
                            <form action="RegistrarCita.php" method="POST" id="formCita" style="display:none;"> <input
                                    type="hidden" name="paciente" id="pacienteId">
                                <div class="row"> <!-- SERVICIO -->
                                    <div class="col-md-4"> <label>Servicio</label> <select name="servicio" id="servicio"
                                            class="browser-default form-control" required>
                                            <option value="">Seleccione un servicio</option>
                                            <?php $consulta = "SELECT * FROM servicio";
                                            $ejecutar = mysqli_query($conexion, $consulta);
                                            while ($res = mysqli_fetch_assoc($ejecutar)) {
                                                echo "<option value='{$res['Id']}'>{$res['Nombre']}</option>";
                                            } ?>
                                        </select> </div> <!-- ESPECIALISTA -->
                                    <div class="col-md-4"> <label>Especialista</label> <select name="especialista"
                                            id="especialista" class="browser-default form-control" required>
                                            <option value="">Seleccione un especialista</option>
                                        </select> </div> <!-- FECHA -->
                                    <div class="col-md-4"> <label>Fecha</label> <input type="date" name="txtFecha"
                                            id="fecha" class="form-control" required> </div> <!-- HORA -->
                                    <div class="col-md-4 mt-3"> <label>Hora</label> <select name="txtHora" id="hora"
                                            class="browser-default form-control" required>
                                            <option value="">Seleccione una hora</option>
                                        </select> </div>
                                    <div class="col-12 text-center mt-4"> <button class="btn btn-success"
                                            type="submit">Registrar cita</button> </div>
                                </div>
                            </form>

                            <br>

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



    <br><br><br>
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

    <script>
        $('#btnBuscarPaciente').click(function () {
            let valor = $('#buscarPaciente').val();

            if (valor === '') {
                alert('Ingrese un dato para buscar');
                return;
            }

            $.ajax({
                url: 'buscarPaciente.php',
                type: 'POST',
                data: { dato: valor },
                success: function (response) {
                    $('#resultadoPaciente').html(response);
                },
                error: function () {
                    alert('Error en la petición AJAX');
                }
            });
        });

        function seleccionarPaciente(id, nombre) {
            $('#pacienteId').val(id);
            $('#resultadoPaciente').html(
                `<div class="alert alert-success">
      Paciente seleccionado: <b>${nombre}</b>
    </div>`
            );
            $('#formCita').show();
        }
    </script>


    <!--- Valida el servicio, los especialistas y el horario -->
    <script>
        // Cuando cambie el servicio, cargar especialistas
        $('#servicio').change(function () {
            var servicioId = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'getEspecialistas.php',
                data: { servicioId: servicioId },
                success: function (response) {
                    $('#especialista').html(response);
                }
            });
        });


        // Cuando cambien servicio, especialista o fecha, cargar horarios disponibles
        $('#fecha, #servicio, #especialista').change(function () {
            var fecha = $('#fecha').val();
            var servicioId = $('#servicio').val();
            var especialistaId = $('#especialista').val();

            if (fecha && servicioId && especialistaId) {
                $.ajax({
                    type: 'POST',
                    url: 'getHorarios.php',
                    data: { servicioId: servicioId, especialistaId: especialistaId, fecha: fecha },
                    success: function (response) {
                        $('#hora').html(response);
                    }
                });
            }
        });
    </script>




</body>

</html>

<?php
unset($_SESSION["Error"]);
?>