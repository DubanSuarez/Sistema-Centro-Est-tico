<?php
require_once('../../Conexiones/conexion.php');

if (!isset($_GET['id'])) {
    echo "<script>
        alert('Factura no válida');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;
}

$idFactura = (int) $_GET['id'];

/* ==========================
   VALIDAR FACTURA
========================== */
$sql = "
    SELECT Estado 
    FROM factura 
    WHERE Id = $idFactura
";

$result = mysqli_query($conexion, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>
        alert('La factura no existe');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;
}

$factura = mysqli_fetch_assoc($result);

/* ==========================
   SOLO REABRIR SI ESTÁ ANULADA
========================== */
if ($factura['Estado'] !== 'ANULADA') {
    echo "<script>
        alert('Solo se pueden reabrir facturas anuladas');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;
}

/* ==========================
   REABRIR FACTURA
========================== */
$update = "
    UPDATE factura 
    SET Estado = 'PAGADA'
    WHERE Id = $idFactura
";

// ===============================
// EJECUTAR
// ===============================
if (mysqli_query($conexion, $update)) {

    echo "<script>
        alert('Factura reabierta correctamente');
        window.location.href = 'FacturasAdmin.php';
    </script>";

} else {

    echo "<script>
        alert('Error al reabrir la factura');
        window.history.back();
    </script>";
}

exit;
