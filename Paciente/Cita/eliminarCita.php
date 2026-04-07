<?php
include('../../Conexiones/conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit();
}

if (!isset($_POST['id'])) {
    http_response_code(400);
    echo "Falta el ID de la cita";
    exit();
}

$idCita = intval($_POST['id']);

/* =====================================
   CANCELAR CITA (NO ELIMINAR)
   Solo si está PENDIENTE y no facturada
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
        echo "Cita cancelada correctamente";
    } else {
        http_response_code(403);
        echo "Esta cita no se puede cancelar porque ya fue pagada, facturada, cancelada o no se encuentra en estado pendiente. 
Si la cita está cancelada, puedes actualizarla para activarla nuevamente o agendar una nueva cita sin ningún problema.";

    }

} else {
    http_response_code(500);
    echo "Error al cancelar la cita: " . mysqli_error($conexion);
}
