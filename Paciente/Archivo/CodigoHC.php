<?php
session_start();
require_once('../../Conexiones/conexion.php');
$rol = $_SESSION['rol'];
if (($rol != 4)) {
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
  $consul = "SELECT p.Foto, p.Nombre, p.Apellido, u.Usuario, p.Id FROM paciente p 
  INNER JOIN usuario u ON p.Id_Usuario = u.Id WHERE u.Id  = " . $_SESSION['id'];
  $ejecu = mysqli_query($conexion, $consul);
  $Fil = mysqli_fetch_assoc($ejecu);
  $idusua = $Fil['Id'];
  $nombre = $Fil['Nombre'];
  $apellido = $Fil['Apellido'];
  $email = $Fil['Usuario'];
  $fotoBD = $Fil['Foto'];

  /* ================================
     RUTA FOTO (SIN file_exists)
  ================================ */

  $rutaBase = "../../Img/Pacientes/"; // 👈 AJUSTA si tu carpeta es otra
  
  if (!empty($fotoBD) && file_exists(__DIR__ . "/$rutaBase$fotoBD")) {
    $fotoMenu = $rutaBase . $fotoBD;
  } else {
    $fotoMenu = "../../Img/Pacientes/user-default.png";
  }
  ?>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 Lolo">
          <a href="../../Blog/InicioPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-house fa-fw me-3 IconosMenu">
            </i><span>Inicio</span>
          </a>
          <a href="../Servicios/ReportesPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-spa me-3 IconosMenu">
            </i><span>Rituales</span>
          </a>
          <a href="../Cita/Cita.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fas fa-calendar fa-fw me-3 IconosMenu">
            </i><span>Citas</span>
          </a>
          <a href="../Archivo/CodigoHC.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
            <i class="fa-solid fa-folder-open me-3 IconosMenu">
            </i><span>Historial Clinico</span>
          </a>
          <a href="../Facturas/FacturasGuardadas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-receipt me-3 IconosMenu">
            </i><span>Facturas</span>
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
            <div class="contenercitas">

              <h5 class="mb-0 text-center EstiloLetraTarjeta">Historias Clinicas</h5>
            </div>


          </div>
          <div class="card-body">
            <?php
            /* =====================================================
               ⚙️ FILTROS + PAGINACIÓN
            ===================================================== */

            $pacienteId = $_SESSION['id'];

            $buscar = $_GET['buscar'] ?? '';
            $estado = $_GET['estado'] ?? '';
            $fechaInicio = $_GET['inicio'] ?? '';
            $fechaFin = $_GET['fin'] ?? '';

            $porPagina = 6;
            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
            $pagina = max($pagina, 1);
            $offset = ($pagina - 1) * $porPagina;

            /* ======================
               WHERE DINÁMICO
            ====================== */

            $where = " WHERE c.Id_Paciente = ? ";
            $params = [$pacienteId];
            $types = "i";

            if ($buscar != '') {
              $where .= " AND (s.Nombre LIKE ? OR cp.Nombre LIKE ? OR cp.Apellido LIKE ?) ";
              $params[] = "%$buscar%";
              $params[] = "%$buscar%";
              $params[] = "%$buscar%";
              $types .= "sss";
            }

            if ($estado != '') {
              $where .= " AND vl.estado = ? ";
              $params[] = $estado;
              $types .= "s";
            }

            if ($fechaInicio && $fechaFin) {
              $where .= " AND DATE(vl.fecha) BETWEEN ? AND ? ";
              $params[] = $fechaInicio;
              $params[] = $fechaFin;
              $types .= "ss";
            }

            /* ======================
               TOTAL REGISTROS
            ====================== */

            $sqlTotal = "
SELECT COUNT(*) total
FROM valoracion_estetica vl
INNER JOIN cita c ON vl.id_cita = c.Id
INNER JOIN servicio s ON vl.id_servicio = s.Id
INNER JOIN servicioespecialista se ON vl.id_especialista = se.Id
INNER JOIN contratopersona cp ON se.Id_Especialista = cp.Id
$where
";

            $stmtTotal = $conexion->prepare($sqlTotal);
            $stmtTotal->bind_param($types, ...$params);
            $stmtTotal->execute();
            $totalReg = $stmtTotal->get_result()->fetch_assoc()['total'];

            $totalPaginas = ceil($totalReg / $porPagina);

            /* ======================
               CONSULTA PRINCIPAL
            ====================== */

            $sql = "
SELECT 
    vl.id,
    vl.fecha,
    vl.tipo_piel,
    vl.estado,
    s.Nombre AS servicio,
    cp.Nombre AS especialistanom,
    cp.Apellido AS especialistaape
FROM valoracion_estetica vl
INNER JOIN cita c ON vl.id_cita = c.Id
INNER JOIN servicio s ON vl.id_servicio = s.Id
INNER JOIN servicioespecialista se ON vl.id_especialista = se.Id
INNER JOIN contratopersona cp ON se.Id_Especialista = cp.Id
$where
ORDER BY vl.fecha DESC
LIMIT $porPagina OFFSET $offset
";

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $resultado = $stmt->get_result();
            ?>



            <!-- =====================================================
      🎨 FILTROS
===================================================== -->

            <form method="GET" class="row g-3 mb-4 align-items-end">

              <div class="col-md-4">
                <label class="form-label small">Buscar servicio o especialista</label>
                <input type="text" name="buscar" value="<?= $buscar ?>" class="form-control"
                  placeholder="Servicio o especialista">
              </div>

              <div class="col-md-2">
                <label class="form-label small">Estado</label>
                <select name="estado" class="form-select">
                  <option value="">Todos</option>
                  <option value="ABIERTA" <?= $estado == 'ABIERTA' ? 'selected' : '' ?>>En seguimiento</option>
                  <option value="CERRADA" <?= $estado == 'CERRADA' ? 'selected' : '' ?>>Finalizada</option>
                </select>
              </div>

              <div class="col-md-2">
                <label class="form-label small">Desde</label>
                <input type="date" name="inicio" value="<?= $fechaInicio ?>" class="form-control">
              </div>

              <div class="col-md-2">
                <label class="form-label small">Hasta</label>
                <input type="date" name="fin" value="<?= $fechaFin ?>" class="form-control">
              </div>

              <div class="col-md-2">
                <button class="btn btn-primary">
                  <i class="fa fa-filter"></i>
                </button>

                <a href="CodigoHC.php" class="btn btn-outline-secondary">
                  <i class="fa fa-eraser"></i>
                </a>
              </div>

            </form>



            <?php if ($resultado->num_rows > 0): ?>

              <div class="table-responsive">

                <table class="table table-hover align-middle text-center shadow-sm">

                  <thead class="table-light">
                    <tr>
                      <th>#</th>
                      <th>Fecha</th>
                      <th>Servicio</th>
                      <th>Especialista</th>
                      <th>Piel</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $i = $offset + 1;
                    while ($row = $resultado->fetch_assoc()):

                      if ($row['estado'] == 'ABIERTA') {
                        $textoEstado = 'En seguimiento';
                        $claseEstado = 'bg-warning';
                      } else {
                        $textoEstado = 'Finalizada';
                        $claseEstado = 'bg-success';
                      }
                      ?>

                      <tr>
                        <td><?= $i++ ?></td>

                        <td><?= date('d/m/Y H:i', strtotime($row['fecha'])) ?></td>

                        <td class="fw-bold text-primary">
                          <?= $row['servicio'] ?>
                        </td>

                        <td>
                          <?= $row['especialistanom'] . ' ' . $row['especialistaape'] ?>
                        </td>

                        <td><?= $row['tipo_piel'] ?? '—' ?></td>

                        <td>
                          <span class="badge <?= $claseEstado ?>">
                            <?= $textoEstado ?>
                          </span>
                        </td>

                        <td>
                          <a href="ver_valoracion.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                          </a>
                        </td>

                      </tr>

                    <?php endwhile; ?>
                  </tbody>

                </table>
              </div>



              <!-- =====================================================
      PAGINACIÓN
===================================================== -->

              <nav class="mt-4">
                <ul class="pagination justify-content-center">

                  <?php if ($pagina > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina - 1])) ?>">«</a>
                    </li>
                  <?php endif; ?>

                  <?php for ($p = 1; $p <= $totalPaginas; $p++): ?>
                    <li class="page-item <?= $p == $pagina ? 'active' : '' ?>">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['pagina' => $p])) ?>">
                        <?= $p ?>
                      </a>
                    </li>
                  <?php endfor; ?>

                  <?php if ($pagina < $totalPaginas): ?>
                    <li class="page-item">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina + 1])) ?>">»</a>
                    </li>
                  <?php endif; ?>

                </ul>
              </nav>

              <p class="text-center text-muted small">
                Mostrando <?= $resultado->num_rows ?> de <?= $totalReg ?> historias clínicas
              </p>

            <?php else: ?>

              <div class="alert alert-info text-center shadow-sm">
                <i class="fa fa-folder-open fa-2x mb-2"></i><br>
                Aún no tienes valoraciones registradas.
              </div>

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

</body>

</html>

<?php
unset($_SESSION["Error"]);
?>