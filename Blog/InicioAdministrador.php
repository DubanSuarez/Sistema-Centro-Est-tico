<?php
session_start();
require_once('../Conexiones/conexion.php');
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

					<a href="../Blog/InicioAdministrador.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-house me-3 IconosMenu"></i>
						<span>Inicio</span>
					</a>

					<a href="../Administrador/Personal/Contratos.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-users-gear me-3 IconosMenu"></i>
						<span>Equipo</span>
					</a>

					<a href="../Administrador/Servicios/Servicios.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-spa me-3 IconosMenu"></i>
						<span>Rituales</span>
					</a>

					<a href="../Administrador/Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-user me-3 IconosMenu"></i>
						<span>Pacientes</span>
					</a>


					<a href="../Administrador/Citas/RegistroCitas.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-calendar-days me-3 IconosMenu"></i>
						<span>Agenda</span>
					</a>

					<a href="../Administrador/HC/ControlCitas.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-clock me-3 IconosMenu"></i>
						<span>Agenda de hoy</span>
					</a>

					<a href="../Administrador/Facturas/FacturarAdmin.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-file-invoice-dollar me-3 IconosMenu"></i>
						<span>Nueva factura</span>
					</a>

					<a href="../Administrador/Facturas/FacturasAdmin.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fa-solid fa-folder-open me-3 IconosMenu"></i>
						<span>Facturas</span>
					</a>

					<a href="../Administrador/Reportes/Reportes.php" class="list-group-item py-2 OpcionMenu"
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
					<img src="../Img/LogoMenu.svg" class="LogoSplendor" alt="" loading="lazy" />
				</a>
				<!-- Right links -->
				<ul class="navbar-nav ms-auto d-flex flex-row">
					<!-- Avatar -->
					<li class="nav-item dropdown BotonMiCuenta">
						<?php
						// VALIDAR FOTO PARA EL MENÚ
						if (!empty($foto) && file_exists("../Administrador/Perfil/Img/" . $foto)) {
							$fotoMenu = "../Administrador/Perfil/Img/" . $foto;
						} else {
							$fotoMenu = "../Administrador/Perfil/Img/user-default.png";
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
								<a class="dropdown-item" href="../Administrador/Perfil/Perfil.php">
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
							<div class="row">
								<div class="col-md-9 d-flex justify-content-md-start justify-content-center">
									<h5 class=" mb-0 text-center EstiloLetraTarjeta">Novedades y Promociones</h5>

								</div>
								<div class="col-md-3">
									<!-- BOTÓN CREAR -->
									<a href=" crear_publicacion.php" class="btn btn-primary">
									<i class="fa-solid fa-plus"></i> Nueva publicación
									</a>
								</div>
							</div>

						</div>


						<div class="card-body">




							<!--Alertas-->
							<?php
							if (isset($_GET['msg'])) {

								$mensajes = [
									'creado' => ['success', '✅ La publicación fue creada correctamente.'],
									'editado' => ['success', '✏️ Los datos quedaron totalmente actualizados.'],
									'eliminado' => ['warning', '🗑️ La publicación fue eliminada correctamente.'],
									'error' => ['danger', '❌ Ocurrió un error, intenta nuevamente.']
								];

								if (isset($mensajes[$_GET['msg']])) {
									[$tipo, $texto] = $mensajes[$_GET['msg']];

									echo "
        <div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
            $texto
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
								}
							}
							?>





							<?php
							/* ===============================
							   ALERTAS DE PROCESOS
							================================ */
							if (isset($_GET['msg'])) {
								$mensajes = [
									'creado' => '✅ La publicación fue creada correctamente.',
									'editado' => '✏️ La publicación fue actualizada correctamente.',
									'eliminado' => '🗑️ La publicación fue eliminada correctamente.',
									'error' => '❌ Ocurrió un error en el proceso.'
								];

								if (isset($mensajes[$_GET['msg']])) {
									echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
										. $mensajes[$_GET['msg']] .
										'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
								}
							}

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

														<!-- ACCIONES -->
														<div class="mt-3 d-grid gap-2">
															<a href="updateblog.php?id=<?= $row['Id'] ?>"
																class="btn btn-outline-warning btn-sm">
																<i class="fa-solid fa-pen"></i> Editar
															</a>

															<a href="eliminar_publicacion.php?id=<?= $row['Id'] ?>"
																class="btn btn-outline-danger btn-sm"
																onclick="return confirm('¿Seguro que deseas eliminar esta publicación?')">
																<i class="fa-solid fa-trash"></i> Eliminar
															</a>
														</div>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

<?php
unset($_SESSION["Error"]);
?>