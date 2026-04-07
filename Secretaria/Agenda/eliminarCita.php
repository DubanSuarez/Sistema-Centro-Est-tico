<?php
include('../../Conexiones/conexion.php');
session_start();

/* =====================================
   VALIDAR MÉTODO
===================================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit();
}

/* =====================================
   VALIDAR ID
===================================== */
if (empty($_POST['id'])) {
    http_response_code(400);
    echo "Falta el ID de la cita";
    exit();
}

$idCita = intval($_POST['id']);

/* =====================================
   CANCELAR CITA (NO ELIMINAR)
===================================== */
$sql = "
UPDATE cita
SET Estado = 'CANCELADA'
WHERE Id = $idCita
  AND Estado = 'PENDIENTE'
  AND Facturar = 0
";

if (mysqli_query($conexion, $sql)) {

    if (mysqli_affected_rows($conexion) > 0) {
        echo "✅ Cita cancelada correctamente";
    } else {
        http_response_code(403);
        echo "⚠️ Esta cita no se puede cancelar.
- Puede estar facturada
- Ya fue cancelada
- O no está en estado pendiente";
    }

} else {
    http_response_code(500);
    echo "❌ Error al cancelar la cita";
}
