<?php
session_start();
require_once('../../Conexiones/conexion.php');

/* ================= VALIDAR SESION ================= */
if (!isset($_SESSION['id'])) {
    die("Error: usuario no autenticado");
}

$usuarioCrea = (int) $_SESSION['id'];

/* ================= VALIDACIONES ================= */
if (
    !isset($_POST['citas']) ||
    empty($_POST['citas']) ||
    !isset($_POST['id_paciente']) ||
    !isset($_POST['metodo_pago'])
) {
    echo "<script>
        alert('Datos incompletos para crear la factura');
        window.location.href = 'FacturarAdmin.php';
    </script>";
    exit;
}

$citasIds   = array_map('intval', $_POST['citas']);
$idPaciente = (int) $_POST['id_paciente'];
$metodoPago = $_POST['metodo_pago'];

/* ================= TRAER CITAS VALIDAS ================= */
$placeholders = implode(',', array_fill(0, count($citasIds), '?'));
$types = str_repeat('i', count($citasIds));

$sql = "
SELECT Id, Precio, Descuento
FROM cita
WHERE Id IN ($placeholders)
  AND Estado = 'ATENDIDA'
  AND Facturar = 1
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param($types, ...$citasIds);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Las citas no son válidas o ya fueron facturadas");
}

/* ================= CALCULOS ================= */
$subtotal = 0;
$totalDescuento = 0;
$totalGeneral = 0;
$citas = [];

while ($row = $result->fetch_assoc()) {

    $precio = (float)$row['Precio'];
    $porcentaje = (float)$row['Descuento'];

    $descuentoPesos = $precio * ($porcentaje / 100);
    $valorTotal = $precio - $descuentoPesos;

    $subtotal += $precio;
    $totalDescuento += $descuentoPesos;
    $totalGeneral += $valorTotal;

    $row['ValorTotal'] = $valorTotal;
    $citas[] = $row;
}

/* ================= TRANSACCION ================= */
$conexion->begin_transaction();

try {

    $numeroFactura = 'FAC-' . date('YmdHis');

    /* ===== INSERT FACTURA ===== */
    $sqlFactura = "
        INSERT INTO factura
        (numero_factura, Id_Paciente, FechaHora, Subtotal, Descuento, Total, Metodo_Pago, Estado, Usuario_Crea)
        VALUES (?, ?, NOW(), ?, ?, ?, ?, 'PAGADA', ?)
    ";

    $stmtFactura = $conexion->prepare($sqlFactura);
    $stmtFactura->bind_param(
        "sidddsi",
        $numeroFactura,
        $idPaciente,
        $subtotal,
        $totalDescuento,
        $totalGeneral,
        $metodoPago,
        $usuarioCrea
    );
    $stmtFactura->execute();

    $idFactura = $conexion->insert_id;

    /* ===== INSERT DETALLE ===== */
    $stmtDetalle = $conexion->prepare("
        INSERT INTO detalle_factura
        (Id_Factura, Id_Cita, Precio, Cantidad, Total)
        VALUES (?, ?, ?, 1, ?)
    ");

    /* ===== ACTUALIZAR CITA A FACTURADA ===== */
    $stmtUpdate = $conexion->prepare("
        UPDATE cita 
        SET Facturar = 0, Estado = 'FACTURADA'
        WHERE Id = ?
    ");

    foreach ($citas as $cita) {

        /* insertar detalle */
        $stmtDetalle->bind_param(
            "iidd",
            $idFactura,
            $cita['Id'],
            $cita['Precio'],
            $cita['ValorTotal']
        );
        $stmtDetalle->execute();

        /* actualizar estado cita */
        $stmtUpdate->bind_param("i", $cita['Id']);
        $stmtUpdate->execute();
    }

    $conexion->commit();

     echo "<script>
        alert('Factura creada correctamente');
        window.location.href = 'FacturasAdmin.php';
    </script>";
    exit;

} catch (Throwable $e) {

    $conexion->rollback();
    die("ERROR AL CREAR FACTURA: " . $e->getMessage());
}
?>
