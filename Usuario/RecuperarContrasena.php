<?php
session_start();
require_once('../Conexiones/conexion.php');

$usuarioEncontrado = null;
$mensaje = "";
$actualizado = false; // Para mostrar modal de éxito

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cedula']) && !isset($_POST['nueva'])) {
        $cedula = mysqli_real_escape_string($conexion, $_POST['cedula']);

        // 1) seguimos trayendo solo Id_Usuario con UNION (ya que las otras tablas tienen esquemas distintos)
        $consulta = "
            SELECT a.Id_Usuario FROM administrador a WHERE a.NumeroDocumento='$cedula'
            UNION
            SELECT c.Id_Usuario FROM contratopersona c WHERE c.NumeroDocumento='$cedula'
            UNION
            SELECT p.Id_Usuario FROM paciente p WHERE p.NumeroDocumento='$cedula'
        ";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $usuarioEncontrado = mysqli_fetch_assoc($resultado);
            $idUsuario = $usuarioEncontrado['Id_Usuario'];

            // 2) Buscar en la tabla 'usuario' el campo NombreUsuario (y otros como fallback)
            $idUsuarioEsc = mysqli_real_escape_string($conexion, $idUsuario);
            $sqlUser = "SELECT Usuario, Usuario FROM usuario WHERE Id='$idUsuarioEsc' LIMIT 1";
            $resUser = mysqli_query($conexion, $sqlUser);

            if ($resUser && mysqli_num_rows($resUser) > 0) {
                $rowUser = mysqli_fetch_assoc($resUser);

                // Prioriza NombreUsuario, si no existe usa otros campos conocidos
                $nombreUsuario = $rowUser['NombreUsuario']
                    ?? $rowUser['Usuario']
                    ?? $rowUser['Nombre']
                    ?? $rowUser['NombreCompleto']
                    ?? null;

                if ($nombreUsuario) {
                    $mensaje = "✅ Usuario encontrado: " . $nombreUsuario . ". Ingresa tu nueva contraseña.";
                } else {
                    // Si no hay ningún campo de nombre disponible, muestra al menos el ID
                    $mensaje = "✅ Usuario encontrado (ID: $idUsuario). Ingresa tu nueva contraseña.";
                }
            } else {
                // No encontró registro en la tabla usuario: mostramos el ID como fallback
                $mensaje = "✅ Usuario encontrado (ID: $idUsuario). Ingresa tu nueva contraseña.";
            }
        } else {
            $mensaje = "❌ No se encontró ninguna cuenta con esa cédula.";
        }

    } elseif (isset($_POST['nueva']) && isset($_POST['confirmar'])) {
        $idUsuario = $_POST['IdUsuario'] ?? null;
        $nueva = $_POST['nueva'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';

        if (!$idUsuario) {
            $mensaje = "❌ Falta el IdUsuario para actualizar.";
        } else if ($nueva === $confirmar) {
            // RECOMENDADO: hashear la contraseña en lugar de guardarla en texto plano
            // $hash = password_hash($nueva, PASSWORD_DEFAULT);
            // $update = "UPDATE usuario SET Contrasena='$hash' WHERE Id='" . mysqli_real_escape_string($conexion, $idUsuario) . "'";
            $update = "UPDATE usuario SET Contrasena='" . mysqli_real_escape_string($conexion, $nueva) . "' WHERE Id='" . mysqli_real_escape_string($conexion, $idUsuario) . "'";

            if (mysqli_query($conexion, $update)) {
                $actualizado = true; // Mostramos modal de éxito
            } else {
                $mensaje = "❌ Error al actualizar: " . mysqli_error($conexion);
            }
        } else {
            $mensaje = "❌ Las contraseñas no coinciden.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>

    <link rel="stylesheet" href="../Css/Estilos2025.css?v=<?php echo time(); ?>">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar">
        <div class="container">
            <img class="LogoMenu" src="../Img/Logo.svg">
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars Hamburguesa"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <ul class="navbar-nav BarraMenu mx-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item">
                        <a class="nav-link LetraMenu" href="PaginaInicio.Html"> Inicio </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link LetraMenu" href="#"> Servicios </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link LetraMenu" href="#"> Nosotros </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link LetraMenu" href="#"> Contactos </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container CajaContrasena">
        <div class="modal1">
            <div class="modal-content1">
                <h2>Recuperar Contraseña</h2>
                <p><?php echo $mensaje; ?></p>

                <?php if (!$usuarioEncontrado && !$actualizado): ?>
                    <form method="POST">
                        <label for="cedula">Número de Documento:</label>
                        <input type="number" id="documento" maxlength="12" required placeholder="Ingrese su documento"
                            name="cedula" required>
                        <button type="submit">Validar</button>
                    </form>
                <?php elseif ($usuarioEncontrado && !$actualizado): ?>
                    <form method="POST">
                        <input type="hidden" name="IdUsuario" value="<?php echo $usuarioEncontrado['Id_Usuario']; ?>">
                        <label>Nueva Contraseña:</label>
                        <input type="password" name="nueva" required>
                        <label>Confirmar Contraseña:</label>
                        <input type="password" name="confirmar" required>
                        <button type="submit">Actualizar</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>






    <div class="container botonvolver">
        <a href="Usuario.php">Volver</a>
    </div>








    <?php if ($actualizado): ?>
        <div class="success-modal">
            <div class="success-box">
                <h3>✅ Contraseña actualizada</h3>
                <p>Serás redirigido a la página de usuario en 3 segundos...</p>
            </div>
        </div>
        <script>
            setTimeout(function () {
                window.location.href = "Usuario.php";
            }, 3000);
        </script>
    <?php endif; ?>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>

    <script>
        // Inicialización sin "import"
        document.addEventListener("DOMContentLoaded", () => {
            console.log("MDB inicializado correctamente ✅");
        });
    </script>

</body>

</html>