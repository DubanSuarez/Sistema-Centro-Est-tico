<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 1)) {
    $error = $_SESSION['Error'];
    $_SESSION['Error'] = "Sesion no iniciada";
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
                    <a href="../../Blog/InicioEspecialista.php" class="list-group-item py-2 OpcionMenu"
                        data-mdb-ripple-init>
                        <i class="fa-solid fa-house me-3 IconosMenu"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="../Agenda/MiAgenda.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar-check me-3 IconosMenu"></i>
                        <span>Agenda</span>
                    </a>
                    <a href="../Agenda/MisCitas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-calendar me-3 IconosMenu"></i>
                        <span>Mis citas</span>
                    </a>
                    <a href="../Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
                        <i class="fa fa-user me-3 IconosMenu"></i>
                        <span>Pacientes</span>
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
                                <div class="col-md-6 text-md-start text-center">
                                    <h5 class="fw-bold EstiloLetraTarjeta">Atención de Cita</h4>
                                        <small class="text-muted">Gestión diaria de citas y atención al paciente</small>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">


                            <?php

                            $id_cita = intval($_GET['id']);

                            /* =========================================================
                               DATOS DE LA CITA
                            ========================================================= */
                            $sql_cita = "
SELECT 
    c.Id,
    c.Fecha,
    c.HoraInicio,
    c.HoraFin,
    c.Estado,

    p.Id AS id_paciente,
    p.Nombre AS PacienteNombre,
    p.Apellido AS PacienteApellido,

    s.Id AS id_servicio,
    s.Nombre AS Servicio,

    cp.Id AS id_especialista,
    cp.Nombre AS EspNombre,
    cp.Apellido AS EspApellido

FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
INNER JOIN contratopersona cp ON cp.Id = se.Id_Especialista
WHERE c.Id = $id_cita
LIMIT 1
";

                            $res_cita = mysqli_query($conexion, $sql_cita);
                            $cita = mysqli_fetch_assoc($res_cita);

                            if (!$cita) {
                                header('Location: MiAgenda.php');
                                exit;
                            }


                            /* =========================================================
                               HISTORIAL CLÍNICO
                            ========================================================= */
                            $sql_historial = "
SELECT * FROM historial_clinico
WHERE id_paciente = {$cita['id_paciente']}
LIMIT 1
";
                            $res_historial = mysqli_query($conexion, $sql_historial);
                            $historial = mysqli_fetch_assoc($res_historial);

                            ?>






                            <!-- ================= DATOS DE LA CITA ================= -->
                            <div class="card mb-4">
                                <div class="card-header fw-bold">
                                    <i class="fas fa-calendar-check"></i> Información de la cita
                                </div>
                                <div class="card-body row g-3">

                                    <div class="col-md-3">
                                        <label class="form-label">Fecha</label>
                                        <input class="form-control" value="<?= $cita['Fecha'] ?>" readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Hora</label>
                                        <input class="form-control"
                                            value="<?= date('H:i', strtotime($cita['HoraInicio'])) ?>" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Paciente</label>
                                        <input class="form-control"
                                            value="<?= htmlspecialchars($cita['PacienteNombre'] . ' ' . $cita['PacienteApellido']) ?>"
                                            readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Servicio</label>
                                        <input class="form-control" value="<?= htmlspecialchars($cita['Servicio']) ?>"
                                            readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Especialista</label>
                                        <input class="form-control"
                                            value="<?= htmlspecialchars($cita['EspNombre'] . ' ' . $cita['EspApellido']) ?>"
                                            readonly>
                                    </div>

                                </div>
                            </div>


                            <!-- ================= HISTORIAL CLÍNICO ================= -->
                            <div class="card mb-4">
                                <div class="card-header fw-bold">
                                    <i class="fas fa-notes-medical"></i> Historial clínico
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="guardar_historial.php">

                                        <input type="hidden" name="id_paciente" value="<?= $cita['id_paciente'] ?>">
                                        <input type="hidden" name="id_cita" value="<?= $cita['Id'] ?>">

                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label>Estatura</label>
                                                <input type="text" name="Estatura" class="form-control"
                                                    value="<?= $historial['Estatura'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Peso</label>
                                                <input type="text" name="Peso" class="form-control"
                                                    value="<?= $historial['Peso'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Alergias</label>
                                                <input type="text" name="alergias" class="form-control"
                                                    value="<?= $historial['alergias'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Enfermedades</label>
                                                <input type="text" name="enfermedades" class="form-control"
                                                    value="<?= $historial['enfermedades'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Medicamentos</label>
                                                <input type="text" name="medicamentos" class="form-control"
                                                    value="<?= $historial['medicamentos'] ?? '' ?>">
                                            </div>

                                            <div class="col-md-12">
                                                <label>Antecedentes relevantes</label>
                                                <textarea name="antecedentes_relevantes"
                                                    class="form-control"><?= $historial['antecedentes_relevantes'] ?? '' ?></textarea>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Embarazo / Lactancia</label>
                                                <textarea name="embarazo_lactancia"
                                                    class="form-control"><?= $historial['embarazo_lactancia'] ?? '' ?></textarea>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary mt-3">
                                            <i class="fas fa-save"></i> Guardar historial
                                        </button>

                                    </form>
                                </div>
                            </div>


                            <!-- ================= VALORACIÓN ESTÉTICA ================= -->
                            <div class="card mb-5">
                                <div class="card-header fw-bold">
                                    <i class="fas fa-spa"></i> Valoración estética
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="guardar_valoracion.php">

                                        <input type="hidden" name="id_cita" value="<?= $cita['Id'] ?>">
                                        <input type="hidden" name="id_especialista"
                                            value="<?= $cita['id_especialista'] ?>">
                                        <input type="hidden" name="id_servicio" value="<?= $cita['id_servicio'] ?>">

                                        <div class="row g-3">

                                            <!-- TIPO DE PIEL -->
                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de piel</label>
                                                <select name="tipo_piel" class="form-select" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Seca">Seca</option>
                                                    <option value="Grasa">Grasa</option>
                                                    <option value="Mixta">Mixta</option>
                                                    <option value="Sensible">Sensible</option>
                                                </select>
                                            </div>

                                            <!-- FOTOTIPO -->
                                            <div class="col-md-4">
                                                <label class="form-label">Fototipo (Fitzpatrick)</label>
                                                <select name="fototipo" class="form-select">
                                                    <option value="">Seleccione</option>
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                    <option value="III">III</option>
                                                    <option value="IV">IV</option>
                                                    <option value="V">V</option>
                                                    <option value="VI">VI</option>
                                                </select>
                                            </div>

                                            <!-- ESTADO DE LA PIEL -->
                                            <div class="col-md-4">
                                                <label class="form-label">Estado de la piel</label>
                                                <select name="estado_piel" class="form-select">
                                                    <option value="">Seleccione</option>
                                                    <option value="Sana">Sana</option>
                                                    <option value="Acné">Acné</option>
                                                    <option value="Manchas">Manchas</option>
                                                    <option value="Rosácea">Rosácea</option>
                                                    <option value="Deshidratada">Deshidratada</option>
                                                    <option value="Fotoenvejecida">Fotoenvejecida</option>
                                                </select>
                                            </div>

                                            <!-- DIAGNÓSTICO -->
                                            <div class="col-md-12">
                                                <label class="form-label">Diagnóstico estético</label>
                                                <textarea name="diagnostico_estetico" class="form-control" rows="2"
                                                    required></textarea>
                                            </div>

                                            <!-- PROCEDIMIENTO -->
                                            <div class="col-md-12">
                                                <label class="form-label">Procedimiento realizado</label>
                                                <textarea name="procedimiento_realizado" class="form-control" rows="2"
                                                    required></textarea>
                                            </div>

                                            <!-- PRODUCTOS -->
                                            <div class="col-md-6">
                                                <label class="form-label">Productos utilizados</label><br>

                                                <?php
                                                $productos = ['Ácido hialurónico', 'Vitamina C', 'Ácido glicólico', 'Retinol', 'Mascarilla hidratante'];
                                                foreach ($productos as $p):
                                                    ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="productos_utilizados[]" value="<?= $p ?>">
                                                        <label class="form-check-label"><?= $p ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- EQUIPOS -->
                                            <div class="col-md-6">
                                                <label class="form-label">Equipos utilizados</label><br>

                                                <?php
                                                $equipos = ['Radiofrecuencia', 'Ultrasonido', 'Alta frecuencia', 'Vacuum', 'Luz pulsada'];
                                                foreach ($equipos as $e):
                                                    ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="equipos_utilizados[]" value="<?= $e ?>">
                                                        <label class="form-check-label"><?= $e ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- OBSERVACIONES -->
                                            <div class="col-md-12">
                                                <label class="form-label">Observaciones</label>
                                                <textarea name="observaciones" class="form-control" rows="2"></textarea>
                                            </div>

                                            <!-- REACCIONES -->
                                            <div class="col-md-6">
                                                <label class="form-label">Reacciones presentadas</label><br>
                                                <?php
                                                $reacciones = ['Eritema', 'Ardor', 'Enrojecimiento', 'Edema', 'Ninguna'];
                                                foreach ($reacciones as $r):
                                                    ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="reacciones[]"
                                                            value="<?= $r ?>">
                                                        <label class="form-check-label"><?= $r ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- RECOMENDACIONES -->
                                            <div class="col-md-6">
                                                <label class="form-label">Recomendaciones</label>
                                                <textarea name="recomendaciones" class="form-control"
                                                    rows="2"></textarea>
                                            </div>

                                            <!-- PRÓXIMA CITA -->
                                            <div class="col-md-6">
                                                <label class="form-label">Próxima cita sugerida</label>
                                                <input type="date" name="proxima_cita" class="form-control">
                                            </div>

                                        </div>

                                        <div class="text-end mt-4">
                                            <button class="btn btn-success"
                                                onclick="return confirm('¿Finalizar atención y marcar cita como ATENDIDA?')">
                                                <i class="fas fa-check"></i> Finalizar atención
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <a href="MisCitas.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>







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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- ------------------------------------------------- -->



    <!-- Full Calendar -->




</body>

</html>

<?php
unset($_SESSION["Error"]);
?>