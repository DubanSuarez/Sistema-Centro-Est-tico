<?php
session_start();
require_once("../../Conexiones/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ==========================
       DATOS DEL FORMULARIO
    ========================== */
    $nombre           = trim($_POST['nombre']);
    $apellido         = trim($_POST['apellido']);
    $genero           = $_POST['genero'];
    $telefono         = trim($_POST['telefono']);
    $documento        = trim($_POST['documento']);
    $fechaNacimiento  = $_POST['fecha_nacimiento'];
    $direccion        = trim($_POST['direccion']);
    $estadoCivil      = $_POST['estado_civil'];
    $ocupacion        = trim($_POST['ocupacion']);
    $usuario          = trim($_POST['usuario']);

    /* ==========================
       CONFIGURACIÓN FIJA
    ========================== */
    $idRol       = 4; // Rol PACIENTE
    $estado      = 1; // Usuario ACTIVO
    $fotoDefault = "defaultPaciente.jpg"; // Imagen por defecto
    $contrasena  = password_hash($documento, PASSWORD_DEFAULT);

    /* ==========================
       VALIDACIÓN BÁSICA
    ========================== */
    if (
        empty($nombre) || empty($apellido) || empty($documento) ||
        empty($usuario) || empty($fechaNacimiento)
    ) {
        echo "
            <script>
                alert('❌ Faltan campos obligatorios');
                window.history.back();
            </script>
        ";
        exit;
    }

    /* ==========================
       INSERTAR USUARIO
    ========================== */
    $sqlUsuario = "INSERT INTO usuario (IdRol, Usuario, Contrasena, Estado)
                   VALUES (?, ?, ?, ?)";

    $stmtUsuario = $conexion->prepare($sqlUsuario);
    $stmtUsuario->bind_param("issi", $idRol, $usuario, $contrasena, $estado);

    if (!$stmtUsuario->execute()) {
        echo "
            <script>
                alert('❌ Error al crear el usuario');
                window.history.back();
            </script>
        ";
        exit;
    }

    $idUsuario = $stmtUsuario->insert_id;

    /* ==========================
       INSERTAR PACIENTE
    ========================== */
    $sqlPaciente = "INSERT INTO paciente (
                        Id_Usuario,
                        Nombre,
                        Apellido,
                        Genero,
                        NumeroTelefono,
                        NumeroDocumento,
                        FechaNacimiento,
                        Direccion,
                        EstadoCivil,
                        Ocupacion,
                        FechaRegistro,
                        Foto
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

    $stmtPaciente = $conexion->prepare($sqlPaciente);
    $stmtPaciente->bind_param(
        "issssssssss",
        $idUsuario,
        $nombre,
        $apellido,
        $genero,
        $telefono,
        $documento,
        $fechaNacimiento,
        $direccion,
        $estadoCivil,
        $ocupacion,
        $fotoDefault
    );

    if ($stmtPaciente->execute()) {
        echo "
            <script>
                alert('✅ Paciente y usuario registrados correctamente');
                window.location.href = 'Pacientes.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('❌ Error al registrar el paciente');
                window.history.back();
            </script>
        ";
    }
}
?>
