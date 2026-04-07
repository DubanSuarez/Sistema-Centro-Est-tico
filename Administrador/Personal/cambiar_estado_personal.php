<?php
require_once('../../Conexiones/conexion.php');

$idContrato = intval($_GET['id']);
$estado = intval($_GET['estado']); // 1 = activo | 0 = inactivo

// ===============================
// OBTENER ID_USUARIO DEL CONTRATO
// ===============================
$consulta = mysqli_query(
    $conexion,
    "SELECT Id_Usuario FROM contratopersona WHERE Id = $idContrato"
);

if (!$consulta || mysqli_num_rows($consulta) === 0) {
    header("Location: Contratos.php?msg=error");
    exit;
}

$data = mysqli_fetch_assoc($consulta);
$idUsuario = $data['Id_Usuario'];

// ===============================
// ACTUALIZAR ESTADO DEL CONTRATO
// ===============================
$updateContrato = mysqli_query(
    $conexion,
    "UPDATE contratopersona 
     SET EstadoContrato = $estado 
     WHERE Id = $idContrato"
);

// ===============================
// ACTUALIZAR ESTADO DEL USUARIO
// ===============================
$updateUsuario = mysqli_query(
    $conexion,
    "UPDATE usuario 
     SET Estado = $estado 
     WHERE Id = $idUsuario"
);

// ===============================
// VALIDAR RESULTADO
// ===============================
if ($updateContrato && $updateUsuario) {
    header("Location: Contratos.php?msg=" . ($estado == 1 ? 'activado' : 'desactivado'));
} else {
    header("Location: Contratos.php?msg=error");
}

exit;
