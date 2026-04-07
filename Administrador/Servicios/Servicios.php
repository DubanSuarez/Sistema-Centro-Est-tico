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
  <!-- Iconos -->
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
                  <h5 class="fw-bold EstiloLetraTarjeta">Servicios</h4>
                    <small class="text-muted">Gestión de Servicios</small>
                </div>
                <div class="col-md-6 text-md-end text-center">
                  <a href="crear_servicio.php" class="btn btn-primary">
                    + Nuevo Servicio
                  </a>
                </div>
              </div>
            </div>

            <?php

            /* ====== PAGINACIÓN ====== */
            $por_pagina = 5;
            $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
            $pagina = ($pagina < 1) ? 1 : $pagina;
            $offset = ($pagina - 1) * $por_pagina;

            /* ====== FILTROS ====== */
            $buscar = isset($_GET['buscar']) ? trim(mysqli_real_escape_string($conexion, $_GET['buscar'])) : '';
            $tipo = isset($_GET['tipo']) ? mysqli_real_escape_string($conexion, $_GET['tipo']) : '';
            $duracion = (isset($_GET['duracion']) && $_GET['duracion'] !== '')
              ? (int) $_GET['duracion']
              : null;

            /* ====== WHERE DINÁMICO ====== */
            $where = "WHERE 1=1";

            if ($buscar !== '') {
              $where .= " AND Nombre LIKE '%$buscar%'";
            }

            if ($tipo !== '') {
              $where .= " AND TipoServicio = '$tipo'";
            }

            if ($duracion !== null) {
              $where .= " AND Duracion = $duracion";
            }

            /* ====== TOTAL REGISTROS ====== */
            $sql_total = "SELECT COUNT(*) AS total FROM servicio $where";
            $res_total = mysqli_query($conexion, $sql_total);
            $total_registros = mysqli_fetch_assoc($res_total)['total'];
            $total_paginas = ceil($total_registros / $por_pagina);

            /* ====== CONSULTA PRINCIPAL ====== */
            $sql = "SELECT * FROM servicio
        $where
        ORDER BY Nombre ASC
        LIMIT $por_pagina OFFSET $offset";

            $resultado = mysqli_query($conexion, $sql);

            /* ====== VALIDACIÓN ====== */
            if (!$resultado) {
              die("Error en la consulta: " . mysqli_error($conexion));
            }
            ?>



            <div class="card-body">

              <form method="GET" class="card mb-4">
                <div class="card-body">
                  <div class="row g-3">

                    <div class="col-md-4">
                      <label class="form-label">Buscar servicio</label>
                      <input type="text" name="buscar" class="form-control" value="<?= htmlspecialchars($buscar) ?>"
                        placeholder="Nombre del servicio">
                    </div>

                    <div class="col-md-3">
                      <label class="form-label">Tipo de servicio</label>
                      <select name="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="Facial" <?= ($tipo == 'Facial') ? 'selected' : '' ?>>Facial</option>
                        <option value="Corporal" <?= ($tipo == 'Corporal') ? 'selected' : '' ?>>Corporal</option>
                        <option value="Capilar" <?= ($tipo == 'Capilar') ? 'selected' : '' ?>>Capilar</option>
                        <option value="Otro" <?= ($tipo == 'Otro') ? 'selected' : '' ?>>Otro</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label class="form-label">Duración</label>
                      <select name="duracion" class="form-select">
                        <option value="">Todas</option>
                        <option value="30" <?= ($duracion == 30) ? 'selected' : '' ?>>30 min</option>
                        <option value="45" <?= ($duracion == 45) ? 'selected' : '' ?>>45 min</option>
                        <option value="60" <?= ($duracion == 60) ? 'selected' : '' ?>>60 min</option>
                        <option value="90" <?= ($duracion == 90) ? 'selected' : '' ?>>90 min</option>
                      </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end gap-2">
                      <button class="btn btn-primary w-100"> Filtrar
                        <i class="bi bi-search"></i>
                      </button>
                      <a href="Servicios.php" class="btn btn-outline-secondary w-100">
                        Limpiar
                      </a>
                    </div>

                  </div>
                </div>
              </form>

              <table class="table table-hover align-middle">
                <thead class="table-light">
                  <tr class="text-center">
                    <th>Foto</th>
                    <th class="text-start">Nombre</th>
                    <th>Tipo</th>
                    <th>Duración</th>
                    <th>Costo</th>
                    <th>Descuento</th>
                    <th>Valor Final</th>
                    <th>Acciones</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <?php while ($servicio = mysqli_fetch_assoc($resultado)): ?>
                      <tr>

                        <!-- FOTO -->
                        <td class="text-center">
                          <?php
                          $foto = $servicio['Foto'];
                          $ruta = "../../Img/Servicios/" . $foto;
                          ?>
                          <?php if (!empty($foto) && file_exists($ruta)): ?>
                            <img src="<?= $ruta ?>" width="55" height="55" class="rounded-circle border object-fit-cover">
                          <?php else: ?>
                            <span class="text-muted fst-italic">Sin foto</span>
                          <?php endif; ?>
                        </td>

                        <!-- NOMBRE -->
                        <td class="fw-semibold">
                          <?= htmlspecialchars($servicio['Nombre']) ?>
                        </td>

                        <!-- TIPO -->
                        <td class="text-center">
                          <?php
                          $colores = [
                            'Facial' => 'primary',
                            'Corporal' => 'success',
                            'Capilar' => 'warning',
                            'Otro' => 'secondary'
                          ];
                          $color = $colores[$servicio['TipoServicio']] ?? 'dark';
                          ?>
                          <span class="badge bg-<?= $color ?>">
                            <?= $servicio['TipoServicio'] ?>
                          </span>
                        </td>

                        <!-- DURACIÓN -->
                        <td class="text-center">
                          <?= $servicio['Duracion'] ?> min
                        </td>

                        <!-- COSTO -->
                        <td class="text-end">
                          $ <?= number_format($servicio['Costo'], 0, ',', '.') ?>
                        </td>

                        <!-- DESCUENTO -->
                        <td class="text-center">
                          <?php if ($servicio['Descuento'] > 0): ?>
                            <span class="badge bg-success">
                              <?= $servicio['Descuento'] ?>%
                            </span>
                          <?php else: ?>
                            <span class="badge bg-secondary">
                              Sin descuento
                            </span>
                          <?php endif; ?>
                        </td>

                        <!-- VALOR FINAL -->
                        <td class="text-end fw-bold text-success">
                          $ <?= number_format($servicio['Valor'], 0, ',', '.') ?>
                        </td>

                        <!-- ACCIONES -->
                        <td class="text-center">
                          <!-- VER DETALLE -->
                          <a href="ver_servicio.php?id=<?= $servicio['Id'] ?>" class="btn btn-sm btn-outline-info"
                            title="Ver detalle">
                            <i class="bi bi-eye"></i>
                          </a>

                          <!-- ASIGNAR ESPECIALISTAS -->
                          <a href="asignar_especialistas.php?id=<?= $servicio['Id'] ?>"
                            class="btn btn-sm btn-outline-primary" title="Asignar especialistas">
                            <i class="bi bi-people"></i>
                          </a>

                          <!-- EDITAR -->
                          <a href="editar_servicio.php?id=<?= $servicio['Id'] ?>" class="btn btn-sm btn-outline-warning"
                            title="Editar">
                            <i class="bi bi-pencil"></i>
                          </a>

                          <!-- ELIMINAR -->
                          <a href="eliminar_servicio.php?id=<?= $servicio['Id'] ?>"
                            onclick="return confirm('¿Eliminar este servicio?')" class="btn btn-sm btn-outline-danger"
                            title="Eliminar">
                            <i class="bi bi-trash"></i>
                          </a>
                        </td>


                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle"></i> No hay servicios registrados
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>





              <?php if ($total_paginas > 1): ?>
                <nav class="mt-4">
                  <ul class="pagination justify-content-center">

                    <!-- Flecha atrás -->
                    <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                      <a class="page-link"
                        href="?pagina=<?= $pagina - 1 ?>&buscar=<?= $buscar ?>&tipo=<?= $tipo ?>&duracion=<?= $duracion ?>">
                        &laquo;
                      </a>
                    </li>

                    <!-- Números -->
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                      <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                        <a class="page-link"
                          href="?pagina=<?= $i ?>&buscar=<?= $buscar ?>&tipo=<?= $tipo ?>&duracion=<?= $duracion ?>">
                          <?= $i ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <!-- Flecha adelante -->
                    <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                      <a class="page-link"
                        href="?pagina=<?= $pagina + 1 ?>&buscar=<?= $buscar ?>&tipo=<?= $tipo ?>&duracion=<?= $duracion ?>">
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