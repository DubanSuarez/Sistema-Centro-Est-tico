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
						data-mdb-ripple-init><i class="fa-solid fa-house fa-fw me-3 IconosMenu">
						</i><span>Inicio</span>
					</a>
					<a href="../Administrador/Personal/Contratos.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="far fa-address-book me-3 IconosMenu">
						</i><span>Personal</span>
					</a>
					<a href="../Administrador/Servicios/Servicios.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="fa-solid fa-spa me-3 IconosMenu">
						</i><span>Rituales</span>
					</a>
					<a href="../Administrador/Paciente/Pacientes.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="fas fa-users me-3 IconosMenu">
						</i><span>Pacientes</span>
					</a>
					<a href="../Administrador/Citas/RegistroCitas.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="fas fa-calendar fa-fw me-3 IconosMenu">
						</i><span>Citas</span>
					</a>
					<a href="../Administrador/Facturas/CitasFacturadas.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init>
						<i class="fas fa-layer-group me-3 IconosMenu">
						</i><span>Facturas</span>
					</a>
					<a href="../Administrador/Servicios/Reporte.php" class="list-group-item py-2 OpcionMenu"
						data-mdb-ripple-init><i class="fab fa-buromobelexperte me-3 IconosMenu">
						</i><span>Reportes</span>
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
							<div class="row gap-2">
								<div class="col-md-6 d-flex justify-content-md-start justify-content-center">
									<h5 class=" mb-0 text-center EstiloLetraTarjeta">Crear nueva publicación</h5>
								</div>
							</div>
						</div>


						<div class="card-body">

							<form action="insert_publicacion.php" method="POST" enctype="multipart/form-data">

								<input type="hidden" name="id_admin" value="<?= $idAdministrador ?>">

								<!-- TITULO -->
								<div class="mb-3">
									<label class="form-label">Título</label>
									<input type="text" name="titulo" class="form-control" required>
								</div>

								<!-- RESUMEN -->
								<div class="mb-3">
									<label class="form-label">Resumen</label>
									<textarea name="resumen" class="form-control" rows="2" required></textarea>
								</div>

								<!-- CONTENIDO -->
								<div class="mb-3">
									<label class="form-label">Contenido</label>
									<textarea name="comentario" class="form-control" rows="5" required></textarea>
								</div>

								<!-- IMAGEN -->
								<div class="mb-3">
									<label class="form-label">Imagen</label>
									<input type="file" name="imagen" class="form-control" accept="image/*">
								</div>

								<!-- TIPO -->
								<div class="mb-3">
									<label class="form-label">Tipo</label>
									<select name="tipo" class="form-select" required>
										<option value="">Seleccione</option>
										<option value="NOTICIA">Noticia</option>
										<option value="OFERTA">Oferta</option>
										<option value="DESCUENTO">Descuento</option>
									</select>
								</div>

								<!-- DESTACADO -->
								<div class="form-check mb-3">
									<input class="form-check-input" type="checkbox" name="destacado" value="1">
									<label class="form-check-label">
										Marcar como destacado
									</label>
								</div>

								<!-- FECHA FIN -->
								<div class="mb-3">
									<label class="form-label">Fecha fin (opcional)</label>
									<input type="date" name="fecha_fin" class="form-control">
								</div>

								<!-- BOTONES -->
								<div class="d-flex justify-content-between mt-5 mb-5">
									<a href="InicioAdministrador.php" class="btn btn-outline-success"
										data-mdb-ripple-init data-mdb-ripple-color="dark">
										Cancelar
									</a>
									<button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init
										data-mdb-ripple-color="dark">
										<i class="fa-solid fa-save"></i> Publicar
									</button>
								</div>

							</form>




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