<?php
require_once('../../Conexiones/conexion.php');

// ===============================
// VALIDAR CONTRASEÑAS
// ===============================
if ($_POST['Contrasena'] !== $_POST['ConfirmarContrasena']) {
    echo "<script>
        alert('Las contraseñas no coinciden');
        window.history.back();
    </script>";
    exit;
}

// ===============================
// CREAR USUARIO
// ===============================
$IdRol   = $_POST['IdRol'];
$Usuario = $_POST['Usuario'];
$Contrasena = password_hash($_POST['Contrasena'], PASSWORD_DEFAULT);
$EstadoUsuario = 1;

$insertUsuario = mysqli_query($conexion, "
    INSERT INTO usuario (IdRol, Usuario, Contrasena, Estado)
    VALUES ('$IdRol', '$Usuario', '$Contrasena', '$EstadoUsuario')
");

if (!$insertUsuario) {
    echo "<script>
        alert('Error al crear el usuario');
        window.history.back();
    </script>";
    exit;
}

$IdUsuario = mysqli_insert_id($conexion);

// ===============================
// OBTENER NOMBRE DEL ROL
// ===============================
$consultaRol = mysqli_query(
    $conexion,
    "SELECT Nombre FROM rol WHERE Id = '$IdRol'"
);

if (!$consultaRol || mysqli_num_rows($consultaRol) === 0) {
    echo "<script>
        alert('Rol no encontrado');
        window.history.back();
    </script>";
    exit;
}

$rolData = mysqli_fetch_assoc($consultaRol);
$Rol = $rolData['Nombre'];

// ===============================
// FOTO POR DEFECTO (SOLO NOMBRE)
// ===============================
$Foto = 'default.jpg'; // 👈 SOLO el nombre del archivo

// ===============================
// DATOS DEL FORMULARIO
// ===============================
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$NumeroDocumento = $_POST['NumeroDocumento'];
$FechaContrato = $_POST['FechaContrato'];

$ValorPago = !empty($_POST['ValorPago']) ? $_POST['ValorPago'] : null;
$FormaPago = !empty($_POST['FormaPago']) ? $_POST['FormaPago'] : null;

$HoraInicial = !empty($_POST['HoraInicial']) ? $_POST['HoraInicial'] : null;
$HoraFinal   = !empty($_POST['HoraFinal']) ? $_POST['HoraFinal'] : null;

$Genero = $_POST['Genero'];
$NumeroTelefono = $_POST['NumeroTelefono'];
$FechaNacimiento = $_POST['FechaNacimiento'];
$Direccion = $_POST['Direccion'];

$Especialidad = !empty($_POST['Especialidad']) ? $_POST['Especialidad'] : null;

$TelefonoFamiliar = $_POST['TelefonoFamiliar'];
$EstadoCivil = $_POST['EstadoCivil'];
$Enfermedad = $_POST['Enfermedad'];

$EstadoContrato = 1;

// ===============================
// INSERT CONTRATO
// ===============================
$insertContrato = mysqli_query($conexion, "
INSERT INTO contratopersona (
    Id_Usuario,
    Rol,
    Nombre,
    Apellido,
    NumeroDocumento,
    FechaContrato,
    ValorPago,
    FormaPago,
    HoraInicial,
    HoraFinal,
    Genero,
    NumeroTelefono,
    FechaNacimiento,
    Direccion,
    Especialidad,
    TelefonoFamiliar,
    EstadoCivil,
    Enfermedad,
    Foto,
    EstadoContrato
) VALUES (
    '$IdUsuario',
    '$Rol',
    '$Nombre',
    '$Apellido',
    '$NumeroDocumento',
    '$FechaContrato',
    ".($ValorPago === null ? "NULL" : "'$ValorPago'").",
    ".($FormaPago === null ? "NULL" : "'$FormaPago'").",
    ".($HoraInicial === null ? "NULL" : "'$HoraInicial'").",
    ".($HoraFinal === null ? "NULL" : "'$HoraFinal'").",
    '$Genero',
    '$NumeroTelefono',
    '$FechaNacimiento',
    '$Direccion',
    ".($Especialidad === null ? "NULL" : "'$Especialidad'").",
    '$TelefonoFamiliar',
    '$EstadoCivil',
    '$Enfermedad',
    '$Foto',
    '$EstadoContrato'
)
");

if (!$insertContrato) {
    echo "<script>
        alert('Error al registrar el contrato');
        window.history.back();
    </script>";
    exit;
}

// ===============================
// ALERTA Y REDIRECCIÓN
// ===============================
echo "<script>
    alert('Contrato registrado correctamente');
    window.location.href = 'Contratos.php';
</script>";
