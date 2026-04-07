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
          <a href="../../Blog/InicioAdministrador.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
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

              <img src="<?= $fotoMenu ?>" class="rounded-circle" height="26" loading="lazy" alt="Foto perfil">

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
              <div class="row mb-4 align-items-center">
                <div class="col-md-8 text-md-start text-center">
                  <h4 class="fw-bold EstiloLetraTarjeta mb-1">
                    Registrar Contrato de Personal
                  </h4>
                  <small class="text-muted">
                    Creación de contrato para especialistas y secretarias
                  </small>
                </div>
              </div>


            </div>


            <div class="card-body">


              <?php

              // Solo Especialista y Secretaria
              $roles = mysqli_query(
                $conexion,
                "SELECT * FROM rol WHERE Nombre IN ('Especialista','Secretaria')"
              );
              ?>

              <form action="insertar_personal.php" method="POST" id="formPersonal">

                <h5 class="mb-3">Datos de Usuario</h5>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label>Rol</label>
                    <select name="IdRol" id="rol" class="form-select" required>
                      <option value="">— Seleccione rol —</option>
                      <?php while ($r = mysqli_fetch_assoc($roles)) { ?>
                        <option value="<?= $r['Id'] ?>"><?= $r['Nombre'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Usuario</label>
                    <input type="text" name="Usuario" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="Contrasena" id="pass1" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Confirmar Contraseña</label>
                    <input type="password" name="ConfirmarContrasena" id="pass2" class="form-control" required>
                    <small id="errorPass" class="text-danger d-none">Las contraseñas no coinciden</small>
                  </div>
                </div>

                <hr>

                <h5 class="mb-3">Datos Personales</h5>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label>Nombre</label>
                    <input type="text" name="Nombre" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Apellido</label>
                    <input type="text" name="Apellido" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Número Documento</label>
                    <input type="text" name="NumeroDocumento" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Género</label>
                    <select name="Genero" class="form-select" required>
                      <option value="">— Seleccione género —</option>
                      <option>Femenino</option>
                      <option>Masculino</option>
                      <option>No binario</option>
                      <option>Prefiere no decirlo</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="NumeroTelefono" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Fecha Nacimiento</label>
                    <input type="date" name="FechaNacimiento" class="form-control">
                  </div>

                  <div class="col-md-12 mb-3">
                    <label>Dirección</label>
                    <input type="text" name="Direccion" class="form-control">
                  </div>
                </div>

                <hr>

                <h5 class="mb-3">Datos del Contrato</h5>

                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label>Fecha Contrato</label>
                    <input type="date" name="FechaContrato" class="form-control" required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label>Valor Pago</label>
                    <input type="number" name="ValorPago" class="form-control">
                  </div>

                  <div class="col-md-4 mb-3">
                    <label>Forma de Pago</label>
                    <select name="FormaPago" class="form-select" required>
                      <option value="">— Seleccione —</option>
                      <option>Efectivo</option>
                      <option>Transferencia</option>
                      <option>Consignación</option>
                      <option>Mixto</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Hora Inicio</label>
                    <input type="time" name="HoraInicial" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Hora Fin</label>
                    <input type="time" name="HoraFinal" class="form-control">
                  </div>

                  <!-- ESPECIALIDAD (SOLO ESPECIALISTA) -->
                  <div class="col-md-6 mb-3" id="campoEspecialidad">
                    <label class="form-label">
                      Área / Especialidad
                    </label>

                    <select name="Especialidad" class="form-select">
                      <option value="">— Seleccione un área —</option>
                      <option>Servicio al Cliente</option>
                      <option>Estética Facial</option>
                      <option>Estética Corporal</option>
                      <option>Cosmetología</option>
                      <option>Masoterapia</option>
                      <option>Depilación</option>
                      <option>Uñas / Manicure / Pedicure</option>
                      <option>Maquillaje Profesional</option>
                      <option>Pestañas y Cejas</option>
                      <option>Tratamientos Capilares</option>
                      <option>SPA</option>
                    </select>
                  </div>


                  <div class="col-md-6 mb-3">
                    <label>Teléfono Familiar</label>
                    <input type="text" name="TelefonoFamiliar" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Estado Civil</label>
                    <select name="EstadoCivil" class="form-select">
                      <option value="">— Seleccione —</option>
                      <option>Soltero(a)</option>
                      <option>Casado(a)</option>
                      <option>Unión libre</option>
                      <option>Separado(a)</option>
                      <option>Divorciado(a)</option>
                      <option>Viudo(a)</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Enfermedad</label>
                    <input type="text" name="Enfermedad" class="form-control">
                  </div>

                  <div class="col-md-12 text-center mt-5">
                    <button type="submit" class="btn btn-outline-warning" data-mdb-ripple-init
                      data-mdb-ripple-color="dark">
                      Registrar Personal
                    </button>
                  </div>
                </div>

              </form>

              <div class="col-md-12 mt-5 mb-2">
                <a href="Contratos.php" class="btn btn-outline-success" data-mdb-ripple-init
                  data-mdb-ripple-color="dark">
                  Volver
                </a>
              </div>


            </div>
          </div>
      </section>
      <!-- Section: Main chart -->
    </div>
  </main>



  <br><br>
  <footer class=" bg-body-tertiary text-center text-lg-start">
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