<?php
session_start();
require_once("../../Conexiones/conexion.php");

if (!isset($_GET['id'], $_GET['estado'])) {
    echo "
        <script>
            alert('❌ Datos inválidos');
            window.location.href = 'Pacientes.php';
        </script>
    ";
    exit;
}

$idPaciente  = intval($_GET['id']);
$nuevoEstado = intval($_GET['estado']); // 1 = activo, 0 = inactivo

/* ==========================
   OBTENER ID_USUARIO
========================== */
$sql = "SELECT Id_Usuario FROM paciente WHERE Id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idPaciente);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "
        <script>
            alert('❌ Paciente no encontrado');
            window.location.href = 'Pacientes.php';
        </script>
    ";
    exit;
}

$paciente = $resultado->fetch_assoc();
$idUsuario = $paciente['Id_Usuario'];

/* ==========================
   ACTUALIZAR ESTADO
========================== */
$sqlUpdate = "UPDATE usuario SET Estado = ? WHERE Id = ?";
$stmtUpdate = $conexion->prepare($sqlUpdate);
$stmtUpdate->bind_param("ii", $nuevoEstado, $idUsuario);

if ($stmtUpdate->execute()) {

    if ($nuevoEstado == 1) {
        $mensaje = "✅ El paciente fue ACTIVADO correctamente";
    } else {
        $mensaje = "🚫 El paciente fue DESACTIVADO correctamente";
    }

    echo "
        <script>
            alert('$mensaje');
            window.location.href = 'Pacientes.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('❌ Error al cambiar el estado del paciente');
            window.location.href = 'Pacientes.php';
        </script>
    ";
}
