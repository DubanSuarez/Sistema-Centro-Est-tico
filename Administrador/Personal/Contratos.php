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
              <div class="row mb-4">
                <div class="col-md-6 text-md-start text-center">
                  <h5 class="fw-bold EstiloLetraTarjeta">Personal</h4>
                    <small class="text-muted">Gestión de especialistas y secretarias</small>
                </div>
                <div class="col-md-6 text-md-end text-center">
                  <a href="crear_personal.php" class="btn btn-primary">
                    + Nuevo personal
                  </a>
                </div>
              </div>
            </div>


            <?php
            if (isset($_GET['msg'])) {

              $mensajes = [
                'insertado' => ['success', '✅ El registro fue creado correctamente.'],
                'actualizado' => ['success', '✏️ La información fue actualizada correctamente.'],
                'activado' => ['success', '✅ El contrato fue activado correctamente.'],
                'desactivado' => ['warning', '🚫 El contrato fue desactivado correctamente.'],
                'error' => ['danger', '❌ Ocurrió un error, intenta nuevamente.']
              ];

              if (isset($mensajes[$_GET['msg']])) {
                [$tipo, $texto] = $mensajes[$_GET['msg']];
                echo "
      <div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
        $texto
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      </div>
    ";
              }
            }
            ?>



            <div class="card-body">

              <div class="card mb-4">
                <div class="card-body">
                  <form method="GET">
                    <div class="row g-3 align-items-end">

                      <!-- Rol -->
                      <div class="col-md-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                          <option value="">Todos</option>
                          <option value="Especialista" <?= ($_GET['rol'] ?? '') == 'Especialista' ? 'selected' : '' ?>>
                            Especialista</option>
                          <option value="Secretaria" <?= ($_GET['rol'] ?? '') == 'Secretaria' ? 'selected' : '' ?>>
                            Secretaria</option>
                        </select>
                      </div>

                      <!-- Estado contrato -->
                      <div class="col-md-3">
                        <label class="form-label">Estado contrato</label>
                        <select name="estado" class="form-select">
                          <option value="">Todos</option>
                          <option value="1" <?= ($_GET['estado'] ?? '1') === '1' ? 'selected' : '' ?>>Activos</option>
                          <option value="0" <?= ($_GET['estado'] ?? '') === '0' ? 'selected' : '' ?>>Inactivos</option>
                        </select>
                      </div>

                      <!-- Buscar (SE LIMPIA SOLO) -->
                      <div class="col-md-4">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Nombre o documento">
                      </div>

                      <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">Filtrar</button>
                      </div>

                    </div>
                  </form>
                </div>
              </div>


              <?php
              $limite = 5;
              $pagina = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
              $inicio = ($pagina - 1) * $limite;

              $where = [];

              // Rol
              if (!empty($_GET['rol'])) {
                $rol = mysqli_real_escape_string($conexion, $_GET['rol']);
                $where[] = "cp.Rol = '$rol'";
              }

              // Búsqueda (ignora estado)
              $buscando = false;
              if (!empty($_GET['buscar'])) {
                $buscar = mysqli_real_escape_string($conexion, $_GET['buscar']);
                $where[] = "(cp.Nombre LIKE '%$buscar%' 
            OR cp.Apellido LIKE '%$buscar%' 
            OR cp.NumeroDocumento LIKE '%$buscar%')";
                $buscando = true;
              }

              // Estado solo si no busca
              if (!$buscando) {
                $estado = $_GET['estado'] ?? '1';
                if ($estado !== '') {
                  $where[] = "cp.EstadoContrato = " . intval($estado);
                }
              }

              $whereSql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

              // Total
              $sqlTotal = "SELECT COUNT(*) total FROM contratopersona cp $whereSql";
              $total = mysqli_fetch_assoc(mysqli_query($conexion, $sqlTotal))['total'];
              $totalPaginas = ceil($total / $limite);

              // Consulta
              $sql = "
SELECT cp.Id, cp.Nombre, cp.Apellido, cp.NumeroDocumento,
       cp.Rol, cp.Especialidad, cp.NumeroTelefono, cp.EstadoContrato
FROM contratopersona cp
$whereSql
ORDER BY cp.Nombre ASC
LIMIT $inicio, $limite
";

              $resultado = mysqli_query($conexion, $sql);
              ?>



              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Nombre</th>
                      <th>Documento</th>
                      <th>Rol</th>
                      <th>Especialidad</th>
                      <th>Teléfono</th>
                      <th>Estado</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                          <td><strong><?= $row['Nombre'] . ' ' . $row['Apellido']; ?></strong></td>
                          <td><?= $row['NumeroDocumento']; ?></td>
                          <td><span class="badge bg-info"><?= $row['Rol']; ?></span></td>
                          <td><?= $row['Especialidad'] ?: 'No aplica'; ?></td>
                          <td><?= $row['NumeroTelefono']; ?></td>
                          <td>
                            <?= $row['EstadoContrato'] == 1
                              ? '<span class="badge bg-success">Activo</span>'
                              : '<span class="badge bg-secondary">Inactivo</span>' ?>
                          </td>

                          <td class="text-center">
                            <a href="ver_personal.php?id=<?= $row['Id']; ?>" class="btn btn-sm btn-outline-info">
                              <i class="fa fa-eye"></i>
                            </a>

                            <?php if ($row['EstadoContrato'] == 1): ?>
                              <a href="editar_personal.php?id=<?= $row['Id']; ?>" class="btn btn-sm btn-outline-warning">
                                <i class="fa fa-pen"></i>
                              </a>
                              <a href="cambiar_estado_personal.php?id=<?= $row['Id']; ?>&estado=0"
                                class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Desactivar este contrato?');">
                                <i class="fa fa-ban"></i>
                              </a>
                            <?php else: ?>
                              <a href="cambiar_estado_personal.php?id=<?= $row['Id']; ?>&estado=1"
                                class="btn btn-sm btn-outline-success" onclick="return confirm('¿Activar este contrato?');">
                                <i class="fa fa-check"></i>
                              </a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted">No se encontraron registros</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>





              <?php if ($totalPaginas > 1): ?>
                <nav>
                  <ul class="pagination justify-content-center">

                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $pagina - 1])) ?>">
                        &laquo;
                      </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                      <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                          <?= $i ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $pagina + 1])) ?>">
                        &raquo;
                      </a>
                    </li>

                  </ul>
                </nav>
              <?php endif; ?>









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