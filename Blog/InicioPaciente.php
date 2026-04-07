<?php
session_start();
require_once('../Conexiones/conexion.php');
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
  <link rel="stylesheet" href="../Css/style2025.css?v=<?php echo time(); ?>">
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

  $rutaBase = "../Img/Pacientes/"; // 👈 AJUSTA si tu carpeta es otra
  
  if (!empty($fotoBD) && file_exists(__DIR__ . "/$rutaBase$fotoBD")) {
    $fotoMenu = $rutaBase . $fotoBD;
  } else {
    $fotoMenu = "../Img/Pacientes/user-default.png";
  }
  ?>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 Lolo">
          <a href="../Blog/InicioPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-house fa-fw me-3 IconosMenu">
            </i><span>Inicio</span>
          </a>
          <a href="../Paciente/Servicios/ReportesPaciente.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fa-solid fa-spa me-3 IconosMenu">
            </i><span>Rituales</span>
          </a>
          <a href="../Paciente/Cita/Cita.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
              class="fas fa-calendar fa-fw me-3 IconosMenu">
            </i><span>Citas</span>
          </a>
          <a href="../Paciente/Archivo/CodigoHC.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init>
            <i class="fa-solid fa-folder-open me-3 IconosMenu">
            </i><span>Historial Clinico</span>
          </a>
          <a href="../Paciente/Facturas/FacturasGuardadas.php" class="list-group-item py-2 OpcionMenu" data-mdb-ripple-init><i
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
          <img src="../Img/LogoMenu.svg" class="LogoSplendor" alt="" loading="lazy" />
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
                <a class="dropdown-item" href="../Paciente/Perfil/Perfil.php">
                  <i class="fa-solid fa-user me-2"></i> Perfil
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../Usuario/salir.php">
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
							<div class="row gap-2">
								<div class="col-md-6 d-flex justify-content-md-start justify-content-center"">
									<h5 class=" mb-0 text-center EstiloLetraTarjeta">Novedades y Promociones</h5>
								</div>
							</div>

						</div>


						<div class="card-body">

							<?php

							/* ===============================
							   PAGINACIÓN
							================================ */
							$porPagina = 6;
							$pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
							$inicio = ($pagina - 1) * $porPagina;

							/* ===============================
							   TOTAL PUBLICACIONES
							================================ */
							$totalSql = "SELECT COUNT(*) total FROM blog";
							$totalRes = $conexion->query($totalSql);
							$totalRegistros = $totalRes->fetch_assoc()['total'];
							$totalPaginas = ceil($totalRegistros / $porPagina);

							/* ===============================
							   TRAER PUBLICACIONES
							================================ */
							$sql = "
SELECT 
    b.Id,
    b.Titulo,
    b.Resumen,
    b.Tipo,
    b.Activo,
    b.Destacado,
    b.FechaPublicacion,
    b.Imagen,
    u.Usuario AS Autor
FROM blog b
INNER JOIN usuario u ON b.Id_Administrador = u.Id
ORDER BY b.FechaHora DESC
LIMIT $inicio, $porPagina
";
							$result = $conexion->query($sql);
							?>


							<!-- GRID -->
							<div class="row g-4">

								<?php if ($result->num_rows > 0): ?>
									<?php while ($row = $result->fetch_assoc()): ?>

										<?php
										$tipo = strtoupper(trim($row['Tipo'] ?? ''));

										$badgeClass = match ($tipo) {
											'OFERTA' => 'bg-primary',
											'DESCUENTO' => 'bg-danger',
											'NOTICIA' => 'bg-info',
											default => 'bg-secondary'
										};
										?>

										<div class="col-md-6 col-lg-4">
											<div class="card h-100 shadow-sm">

												<!-- IMAGEN -->
												<?php if (!empty($row['Imagen'])): ?>
													<img src="<?= htmlspecialchars($row['Imagen']) ?>" class="card-img-top"
														style="height:200px; object-fit:cover;">
												<?php else: ?>
													<div class="d-flex align-items-center justify-content-center bg-light"
														style="height:200px;">
														<i class="fa-solid fa-spa fa-3x text-muted"></i>
													</div>
												<?php endif; ?>

												<div class="card-body d-flex flex-column">

													<!-- BADGES -->
													<div class="mb-2">
														<span class="badge <?= $badgeClass ?>">
															<?= $tipo ?: 'SIN TIPO' ?>
														</span>

														<?php if ($row['Destacado']): ?>
															<span class="badge bg-warning text-dark">Destacado</span>
														<?php endif; ?>

														<?php if (!$row['Activo']): ?>
															<span class="badge bg-secondary">Inactivo</span>
														<?php endif; ?>
													</div>

													<!-- TITULO -->
													<h5 class="card-title"><?= htmlspecialchars($row['Titulo']) ?></h5>

													<!-- RESUMEN -->
													<p class="card-text text-muted small">
														<?= htmlspecialchars($row['Resumen']) ?>
													</p>

													<!-- FOOTER -->
													<div class="mt-auto">
														<small class="text-muted">
															<i class="fa-regular fa-calendar"></i>
															<?= date('d/m/Y', strtotime($row['FechaPublicacion'])) ?>
														</small>
													</div>

												</div>
											</div>
										</div>

									<?php endwhile; ?>
								<?php else: ?>
									<div class="col-12">
										<div class="alert alert-info text-center">
											No hay publicaciones registradas.
										</div>
									</div>
								<?php endif; ?>

							</div>

							<!-- PAGINACIÓN -->
							<?php if ($totalPaginas > 1): ?>

								<nav class="mt-5">
									<ul class="pagination justify-content-center align-items-center">

										<!-- IR AL INICIO -->
										<li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
											<a class="page-link" href="?page=1" title="Primera página">
												<i class="fa-solid fa-angles-left"></i>
											</a>
										</li>

										<!-- ANTERIOR -->
										<li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
											<a class="page-link" href="?page=<?= $pagina - 1 ?>" title="Página anterior">
												<i class="fa-solid fa-angle-left"></i>
											</a>
										</li>

										<?php
										/* ===============================
										   RANGO DE NÚMEROS
										================================ */
										$rango = 2; // páginas a mostrar a cada lado
										$inicioPag = max(1, $pagina - $rango);
										$finPag = min($totalPaginas, $pagina + $rango);

										for ($i = $inicioPag; $i <= $finPag; $i++):
											?>
											<li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
												<a class="page-link" href="?page=<?= $i ?>">
													<?= $i ?>
												</a>
											</li>
										<?php endfor; ?>

										<!-- SIGUIENTE -->
										<li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
											<a class="page-link" href="?page=<?= $pagina + 1 ?>" title="Página siguiente">
												<i class="fa-solid fa-angle-right"></i>
											</a>
										</li>

										<!-- IR AL FINAL -->
										<li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : '' ?>">
											<a class="page-link" href="?page=<?= $totalPaginas ?>" title="Última página">
												<i class="fa-solid fa-angles-right"></i>
											</a>
										</li>

									</ul>
								</nav>

							<?php endif; ?>




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

</body>

</html>

<?php
unset($_SESSION["Error"]);
?>