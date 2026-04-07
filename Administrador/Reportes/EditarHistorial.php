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



    <?php
    require_once('../../Conexiones/conexion.php');

    $id = (int) $_GET['id'];
    $mensaje = "";


    /* ======================================================
       GUARDAR (INSERT o UPDATE)
    ====================================================== */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $estatura = $_POST['estatura'];
        $peso = $_POST['peso'];
        $alergias = $_POST['alergias'];
        $enfermedades = $_POST['enfermedades'];
        $medicamentos = $_POST['medicamentos'];
        $antecedentes = $_POST['antecedentes'];
        $embarazo = $_POST['embarazo'];

        // verificar si existe historial
        $check = $conexion->query("
        SELECT id 
        FROM historial_clinico 
        WHERE id_paciente = $id
    ");

        if ($check->num_rows > 0) {

            /* ========= UPDATE ========= */
            $conexion->query("
            UPDATE historial_clinico SET
                Estatura = '$estatura',
                Peso = '$peso',
                alergias = '$alergias',
                enfermedades = '$enfermedades',
                medicamentos = '$medicamentos',
                antecedentes_relevantes = '$antecedentes',
                embarazo_lactancia = '$embarazo',
                updated_at = NOW()
            WHERE id_paciente = $id
        ");

            $mensaje = "actualizado";

        } else {

            /* ========= INSERT ========= */
            $conexion->query("
            INSERT INTO historial_clinico
            (id_paciente,Estatura,Peso,alergias,enfermedades,medicamentos,antecedentes_relevantes,embarazo_lactancia,created_at,updated_at)
            VALUES
            ($id,'$estatura','$peso','$alergias','$enfermedades','$medicamentos','$antecedentes','$embarazo',NOW(),NOW())
        ");

            $mensaje = "creado";
        }
    }


    /* ======================================================
       PACIENTE + HISTORIAL
    ====================================================== */
    $sql = "
SELECT 
    p.Nombre,
    p.Apellido,
    p.NumeroDocumento,
    p.NumeroTelefono,
    h.*
FROM paciente p
LEFT JOIN historial_clinico h ON h.id_paciente = p.Id
WHERE p.Id = $id
";

    $data = $conexion->query($sql)->fetch_assoc();
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
                                <div class="row mb-4">
                                    <div class="col-md-6 text-md-start text-center">
                                        <h5 class="fw-bold EstiloLetraTarjeta">
                                            Editar Historia Clínica - <?= $data['Nombre'] . ' ' . $data['Apellido'] ?>
                                        </h5>
                                        <small class="text-muted">
                                            Actualiza la información médica del paciente
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">





                            <!-- ALERTAS -->
                            <?php if ($mensaje == "creado"): ?>
                                <div class="alert alert-success mt-3">Historial clínico creado correctamente</div>
                            <?php endif; ?>

                            <?php if ($mensaje == "actualizado"): ?>
                                <div class="alert alert-primary mt-3">Historial clínico actualizado correctamente</div>
                            <?php endif; ?>


                            <form method="POST" class="mt-4">

                                <div class="row g-3">

                                    <!-- INFO PACIENTE (solo lectura) -->
                                    <div class="col-12">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <b>Documento:</b> <?= $data['NumeroDocumento'] ?> |
                                                <b>Teléfono:</b> <?= $data['NumeroTelefono'] ?>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- ESTATURA -->
                                    <div class="col-md-3">
                                        <label class="form-label">Estatura (cm)</label>
                                        <input type="number" step="0.01" name="estatura" class="form-control"
                                            value="<?= $data['Estatura'] ?>">
                                    </div>


                                    <!-- PESO -->
                                    <div class="col-md-3">
                                        <label class="form-label">Peso (kg)</label>
                                        <input type="number" step="0.01" name="peso" class="form-control"
                                            value="<?= $data['Peso'] ?>">
                                    </div>


                                    <!-- EMBARAZO -->
                                    <div class="col-md-6">
                                        <label class="form-label">Embarazo / Lactancia</label>
                                        <select name="embarazo" class="form-select">
                                            <option value="">No aplica</option>
                                            <option value="Sí" <?= ($data['embarazo_lactancia'] == "Sí") ? 'selected' : '' ?>>Sí</option>
                                            <option value="No" <?= ($data['embarazo_lactancia'] == "No") ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>


                                    <!-- ALERGIAS -->
                                    <div class="col-md-6">
                                        <label class="form-label">Alergias</label>
                                        <textarea name="alergias" class="form-control"
                                            rows="2"><?= $data['alergias'] ?></textarea>
                                    </div>


                                    <!-- ENFERMEDADES -->
                                    <div class="col-md-6">
                                        <label class="form-label">Enfermedades</label>
                                        <textarea name="enfermedades" class="form-control"
                                            rows="2"><?= $data['enfermedades'] ?></textarea>
                                    </div>


                                    <!-- MEDICAMENTOS -->
                                    <div class="col-md-6">
                                        <label class="form-label">Medicamentos</label>
                                        <textarea name="medicamentos" class="form-control"
                                            rows="2"><?= $data['medicamentos'] ?></textarea>
                                    </div>


                                    <!-- ANTECEDENTES -->
                                    <div class="col-md-6">
                                        <label class="form-label">Antecedentes relevantes</label>
                                        <textarea name="antecedentes" class="form-control"
                                            rows="2"><?= $data['antecedentes_relevantes'] ?></textarea>
                                    </div>


                                    <!-- BOTONES -->
                                    <div class="col-12 text-end mt-3">

                                        <button class="btn btn-warning" data-mdb-ripple-init>
                                            <i class="fa fa-save"></i> Guardar cambios
                                        </button>

                                    </div>

                                </div>
                            </form>






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