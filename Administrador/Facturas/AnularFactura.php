<?php
require_once('../../Conexiones/conexion.php');

/* ==========================
   VALIDAR ID
========================== */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        alert('Factura no válida');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;
}

$idFactura = (int) $_GET['id'];

/* ==========================
   VERIFICAR FACTURA
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
   SOLO ANULAR SI ESTÁ ACTIVA
========================== */
if ($factura['Estado'] !== 'PAGADA') {
    echo "<script>
        alert('Solo se pueden anular facturas pagas');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;
}

/* ==========================
   ANULAR FACTURA
========================== */
$sqlUpdate = "
    UPDATE factura 
    SET Estado = 'ANULADA'
    WHERE Id = $idFactura
";

// ===============================
// EJECUTAR
// ===============================
if (mysqli_query($conexion, $sqlUpdate)) {

    echo "<script>
        alert('Factura anulada correctamente');
        window.location.href = 'FacturasAdmin.php';
    </script>";

} else {

    echo "<script>
        alert('Error al anular la factura');
        window.history.back();
    </script>";
}

exit;
