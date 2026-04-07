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
                        if (!empty($foto) && file_exists("Img/" . $foto)) {
                            $fotoMenu = "Img/" . $foto;
                        } else {
                            $fotoMenu = "Img/user-default.png";
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




	<!-- Información -->
	<main style="margin-top: 58px">
		<div class="container pt-4">
			<!-- Section: Main chart -->
			<section class="mb-4">
				<div class="card">
					<div class="card-header py-3">
						<div class="card-header py-3">
							<div class="row gap-2">
								<div class="col-md-12 d-flex justify-content-md-start justify-content-center">
									<h5 class=" mb-0 text-center EstiloLetraTarjeta">Actualizar Perfil del Administrador</h5>
								</div>
							</div>
						</div>

						<div class="card-body">
							<?php
							$idAdmin = intval($_GET['actualizar']);

							/* ===============================
							   TRAER DATOS
							================================ */

							$consulta = "
SELECT a.*, u.Usuario
FROM administrador a
INNER JOIN usuario u ON a.Id_Usuario = u.Id
WHERE a.Id = $idAdmin
LIMIT 1
";

							$ejecutar = mysqli_query($conexion, $consulta);
							$Fila = mysqli_fetch_assoc($ejecutar);

							if (!$Fila) {
								die("Administrador no encontrado");
							}

							$mensajeError = "";

							/* ===============================
							   ACTUALIZAR
							================================ */

							if (isset($_POST['actualizar'])) {

								/* USUARIO */
								$Usuario = trim($_POST['Usuario']);
								$UsuarioConfirm = trim($_POST['UsuarioConfirm']);

								if ($Usuario !== $UsuarioConfirm) {
									$mensajeError = "El usuario no coincide. Verifica e intenta de nuevo.";
								} else {

									/* ADMIN */
									$Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
									$Apellido = mysqli_real_escape_string($conexion, $_POST['Apellido']);
									$Genero = $_POST['Genero'];
									$NumeroTelefono = $_POST['NumeroTelefono'];
									$NumeroDocumento = $_POST['NumeroDocumento'];
									$FechaNacimiento = $_POST['FechaNacimiento'];
									$Direccion = mysqli_real_escape_string($conexion, $_POST['Direccion']);
									$EstadoCivil = $_POST['EstadoCivil'];
									$Ocupacion = mysqli_real_escape_string($conexion, $_POST['Ocupacion']);
									$Enfermedad = mysqli_real_escape_string($conexion, $_POST['Enfermedad']);
									$Estatura = $_POST['Estatura'];
									$Peso = $_POST['Peso'];

									/* ===============================
									   TRANSACCIÓN
									================================ */

									mysqli_begin_transaction($conexion);

									try {

										/* UPDATE ADMINISTRADOR */
										$updateAdmin = "
                UPDATE administrador SET
                    Nombre='$Nombre',
                    Apellido='$Apellido',
                    Genero='$Genero',
                    NumeroTelefono='$NumeroTelefono',
                    NumeroDocumento='$NumeroDocumento',
                    FechaNacimiento='$FechaNacimiento',
                    Direccion='$Direccion',
                    EstadoCivil='$EstadoCivil',
                    Ocupacion='$Ocupacion',
                    Enfermedad='$Enfermedad',
                    Estatura='$Estatura',
                    Peso='$Peso'
                WHERE Id=$idAdmin
            ";

										mysqli_query($conexion, $updateAdmin);

										/* UPDATE USUARIO SOLO SI CAMBIÓ */
										if ($Usuario !== $Fila['Usuario']) {
											$updateUsuario = "
                    UPDATE usuario 
                    SET Usuario='$Usuario'
                    WHERE Id={$Fila['Id_Usuario']}
                ";
											mysqli_query($conexion, $updateUsuario);
										}

										mysqli_commit($conexion);

										header("Location: Perfil.php?actualizado=1");
										exit;


									} catch (Exception $e) {
										mysqli_rollback($conexion);
										$mensajeError = "Error al actualizar los datos.";
									}
								}
							}
							?>



										<?php if ($mensajeError) { ?>
											<div class="alert alert-danger text-center">
												<?= $mensajeError ?>
											</div>
										<?php } ?>

										<form method="POST">
											<div class="row g-3">

												<!-- USUARIO -->
												<div class="row">
													<div class="col-md-6">
														<label class="form-label fw-semibold mt-2">Usuario /
															Email</label>
														<input class="form-control" name="Usuario"
															value="<?= $Fila['Usuario'] ?>" required>
													</div>
													<div class="col-md-6">
														<label class="form-label fw-semibold mt-2">
															Confirmar usuario
														</label>
														<input class="form-control" name="UsuarioConfirm"
															placeholder="Vuelve a escribir el usuario" required>
													</div>
												</div>
												<hr>

												<!-- COLUMNA 1 -->
												<div class="col-md-4">
													<label class="form-label">Nombre</label>
													<input class="form-control" name="Nombre"
														value="<?= $Fila['Nombre'] ?>">

													<label class="form-label">Apellido</label>
													<input class="form-control" name="Apellido"
														value="<?= $Fila['Apellido'] ?>">

													<label class="form-label">Género</label>
													<select class="form-control" name="Genero">
														<option <?= $Fila['Genero'] == "Masculino" ? 'selected' : '' ?>>
															Masculino</option>
														<option <?= $Fila['Genero'] == "Femenino" ? 'selected' : '' ?>>
															Femenino
														</option>
														<option <?= $Fila['Genero'] == "Otro" ? 'selected' : '' ?>>Otro
														</option>
													</select>

													<label class="form-label">Teléfono</label>
													<input class="form-control" name="NumeroTelefono"
														value="<?= $Fila['NumeroTelefono'] ?>">
												</div>

												<!-- COLUMNA 2 -->
												<div class="col-md-4">
													<label class="form-label">Documento</label>
													<input class="form-control" name="NumeroDocumento"
														value="<?= $Fila['NumeroDocumento'] ?>">

													<label class="form-label">Fecha de nacimiento</label>
													<input type="date" class="form-control" name="FechaNacimiento"
														value="<?= $Fila['FechaNacimiento'] ?>">

													<label class="form-label">Dirección</label>
													<input class="form-control" name="Direccion"
														value="<?= $Fila['Direccion'] ?>">

													<label class="form-label">Estado civil</label>
													<input class="form-control" name="EstadoCivil"
														value="<?= $Fila['EstadoCivil'] ?>">
												</div>

												<!-- COLUMNA 3 -->
												<div class="col-md-4">
													<label class="form-label">Ocupación</label>
													<input class="form-control" name="Ocupacion"
														value="<?= $Fila['Ocupacion'] ?>">

													<label class="form-label">Enfermedad</label>
													<input class="form-control" name="Enfermedad"
														value="<?= $Fila['Enfermedad'] ?>">

													<label class="form-label">Estatura (cm)</label>
													<input class="form-control" name="Estatura"
														value="<?= $Fila['Estatura'] ?>">

													<label class="form-label">Peso (kg)</label>
													<input class="form-control" name="Peso"
														value="<?= $Fila['Peso'] ?>">
												</div>

												<!-- BOTONES -->
												<div class="col-md-12 text-center mt-5 mb-4">
													<a href="Perfil.php" class="btn btn-outline-success btn-rounded"
														data-mdb-ripple-init data-mdb-ripple-color="dark">
														Cancelar
													</a>

													<button class="btn btn-outline-warning btn-rounded"
														data-mdb-ripple-init data-mdb-ripple-color="dark"
														name="actualizar">
														<i class="fas fa-save"></i> Guardar cambios
													</button>

												</div>

											</div>
										</form>




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