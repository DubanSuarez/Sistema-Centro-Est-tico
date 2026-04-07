<?php
session_start();
require_once('../Conexiones/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>

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

    <div class="container TituloRegistro">
        <h2>Registro de Paciente</h2>
    </div>

    <div class="container">
        <form class="CajaRegistro" action="Registrar_Paciente.php" method="POST" enctype="multipart/form-data">

            <div class="FormuPaciente">
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" required>

                <label for="Apellido">Apellido</label>
                <input type="text" id="Apellido" name="Apellido" required>

                <label for="Genero">Género</label>
                <select id="Genero" name="Genero" required>
                    <option value="">Seleccione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>

                <label for="NumeroTelefono">Número de Teléfono</label>
                <input type="tel" id="NumeroTelefono" name="NumeroTelefono" pattern="[0-9]{10}"
                    title="Debe contener 10 dígitos" required>

                <label for="NumeroDocumento">Número de Documento</label>
                <input type="text" id="NumeroDocumento" name="NumeroDocumento" required>


                <label for="FechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" id="FechaNacimiento" name="FechaNacimiento" required>

            </div>

            <div class="FormuPaciente">

                <label for="Direccion">Dirección</label>
                <input type="text" id="Direccion" name="Direccion" required>

                <label for="EstadoCivil">Estado Civil</label>
                <select id="EstadoCivil" name="EstadoCivil" required>
                    <option value="">Seleccione...</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Viudo">Viudo</option>
                </select>

                <label for="Ocupacion">Ocupación</label>
                <input type="text" id="Ocupacion" name="Ocupacion" required>

                <label for="Enfermedad">Enfermedad</label>
                <input type="text" id="Enfermedad" name="Enfermedad" required>

                <label for="Estatura">Estatura (cm)</label>
                <input type="number" id="Estatura" name="Estatura" min="50" max="250" required>

            </div>

            <div class="FormUser">

                <div class="CAjaRGLogin">

                    <label for="Usuario" class="TextoCajaEmail">Correo Electrónico</label>
                    <input type="email" id="Usuario" name="Usuario" placeholder="ejemplo@gmail.com" required>

                    <label for="Contrasena" class="TextoCajaEmail">Contraseña</label>
                    <input type="password" id="Contrasena" name="Contrasena" minlength="6" required>

                    <button type="submit" class="btn_registrar">Registrar</button>

                </div>
            </div>

        </form>


        <div class="container botonvolver">
            <a href="Usuario.php">Volver</a>
        </div>

    </div>

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