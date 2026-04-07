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

              <h5 class="mb-0 text-center EstiloLetraTarjeta">Facturas</h5>
            </div>
          </div>
          <div class="card-body">
            <?php
            /* ======================================================
               ⚙️ FILTROS + PAGINACIÓN PRO
            ====================================================== */

            $buscar = $_GET['buscar'] ?? '';
            $estado = $_GET['estado'] ?? '';
            $metodo = $_GET['metodo'] ?? '';
            $fechaInicio = $_GET['inicio'] ?? '';
            $fechaFin = $_GET['fin'] ?? '';

            $porPagina = 6;
            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
            $pagina = max($pagina, 1);
            $offset = ($pagina - 1) * $porPagina;

            /* ========================
               WHERE DINÁMICO
            ======================== */

            $where = " WHERE Id_Paciente = ? ";
            $params = [$idusua];
            $types = "i";

            if ($buscar != '') {
              $where .= " AND numero_factura LIKE ? ";
              $params[] = "%$buscar%";
              $types .= "s";
            }

            if ($estado != '') {
              $where .= " AND Estado = ? ";
              $params[] = $estado;
              $types .= "s";
            }

            if ($metodo != '') {
              $where .= " AND Metodo_Pago = ? ";
              $params[] = $metodo;
              $types .= "s";
            }

            if ($fechaInicio != '' && $fechaFin != '') {
              $where .= " AND DATE(FechaHora) BETWEEN ? AND ? ";
              $params[] = $fechaInicio;
              $params[] = $fechaFin;
              $types .= "ss";
            }

            /* ========================
               TOTAL REGISTROS
            ======================== */

            $sqlTotal = "SELECT COUNT(*) total FROM factura $where";
            $stmtTotal = $conexion->prepare($sqlTotal);
            $stmtTotal->bind_param($types, ...$params);
            $stmtTotal->execute();
            $totalReg = $stmtTotal->get_result()->fetch_assoc()['total'];

            $totalPaginas = ceil($totalReg / $porPagina);

            /* ========================
               CONSULTA PRINCIPAL
            ======================== */

            $sqlFacturas = "
SELECT Id, numero_factura, FechaHora, Total, Estado, Metodo_Pago
FROM factura
$where
ORDER BY FechaHora DESC
LIMIT $porPagina OFFSET $offset
";

            $stmt = $conexion->prepare($sqlFacturas);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $facturas = $stmt->get_result();
            ?>



            <!-- =====================================================
      🎨 FILTROS VISUALES
===================================================== -->

            <form method="GET" class="row g-3 mb-4 align-items-end">

              <div class="col-md-2">
                <label class="form-label small">Buscar factura</label>
                <input type="text" name="buscar" value="<?= $buscar ?>" class="form-control" placeholder="N° factura">
              </div>

              <div class="col-md-2">
                <label class="form-label small">Estado</label>
                <select name="estado" class="form-select">
                  <option value="">Todos</option>
                  <option value="PAGADA" <?= $estado == 'PAGADA' ? 'selected' : '' ?>>Pagada</option>
                  <option value="ANULADA" <?= $estado == 'ANULADA' ? 'selected' : '' ?>>Anulada</option>
                </select>
              </div>

              <div class="col-md-2">
                <label class="form-label small">Método</label>
                <select name="metodo" class="form-select">
                  <option value="">Todos</option>
                  <option value="EFECTIVO" <?= $metodo == 'EFECTIVO' ? 'selected' : '' ?>>Efectivo</option>
                  <option value="TARJETA" <?= $metodo == 'TARJETA' ? 'selected' : '' ?>>Tarjeta</option>
                  <option value="TRANSFERENCIA" <?= $metodo == 'TRANSFERENCIA' ? 'selected' : '' ?>>Transferencia</option>
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

              <!-- BOTONES -->
              <div class="col-md-2">
                <button class="btn btn-primary">
                  <i class="fa fa-filter"></i>
                </button>

                <a href="FacturasGuardadas.php" class="btn btn-outline-secondary">
                  <i class="fa fa-eraser"></i>
                </a>
              </div>

            </form>



            <?php if ($facturas->num_rows > 0): ?>

              <div class="table-responsive">

                <table class="table table-hover align-middle text-center shadow-sm">
                  <thead class="table-light">
                    <tr>
                      <th>#</th>
                      <th>Factura</th>
                      <th>Fecha</th>
                      <th>Método</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $i = $offset + 1;
                    while ($row = $facturas->fetch_assoc()): ?>
                      <tr>

                        <td><?= $i++ ?></td>

                        <td>
                          <b class="text-primary"><?= $row['numero_factura'] ?></b>
                        </td>

                        <td><?= date('d/m/Y H:i', strtotime($row['FechaHora'])) ?></td>

                        <td><?= $row['Metodo_Pago'] ?></td>

                        <td class="fw-bold text-success">
                          $<?= number_format($row['Total'], 0, ',', '.') ?>
                        </td>

                        <td>
                          <?php
                          switch ($row['Estado']) {
                            case 'PAGADA':
                              $badge = 'bg-success';
                              break;
                            case 'ANULADA':
                              $badge = 'bg-danger';
                              break;
                            default:
                              $badge = 'bg-secondary';
                          }
                          ?>
                          <span class="badge <?= $badge ?>">
                            <?= $row['Estado'] ?>
                          </span>
                        </td>

                        <td>
                          <a href="ver_factura_paciente.php?id=<?= $row['Id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                          </a>
                        </td>

                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>



              <!-- =====================================================
      📄 PAGINACIÓN PRO
===================================================== -->

              <nav class="mt-4">
                <ul class="pagination justify-content-center">

                  <?php if ($pagina > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina - 1])) ?>">
                        «
                      </a>
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
                      <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['pagina' => $pagina + 1])) ?>">
                        »
                      </a>
                    </li>
                  <?php endif; ?>

                </ul>
              </nav>

              <p class="text-center text-muted small">
                Mostrando <?= $facturas->num_rows ?> de <?= $totalReg ?> facturas
              </p>


            <?php else: ?>

              <div class="alert alert-info text-center shadow-sm">
                <i class="fa fa-receipt fa-2x mb-2"></i><br>
                No tienes facturas registradas.
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