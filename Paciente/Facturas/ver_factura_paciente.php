<?php
session_start();
require_once('../../Conexiones/conexion.php');
require_once('datos_empresa.php');

/* 🔐 Seguridad */
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 4) {
    header("Location: ../../Usuario/Usuario.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Factura no válida.");
}

$idFactura = intval($_GET['id']);

/* 🧑 Obtener paciente */
$sqlPaciente = "
SELECT p.Id 
FROM paciente p
INNER JOIN usuario u ON p.Id_Usuario = u.Id
WHERE u.Id = ?
LIMIT 1
";
$stmtPaciente = $conexion->prepare($sqlPaciente);
$stmtPaciente->bind_param("i", $_SESSION['id']);
$stmtPaciente->execute();
$resPaciente = $stmtPaciente->get_result();

if ($resPaciente->num_rows === 0) {
    die("Paciente no encontrado.");
}

$idPaciente = $resPaciente->fetch_assoc()['Id'];

/* 📄 Factura */
$sqlFactura = "
SELECT f.*, p.Nombre, p.Apellido, p.NumeroDocumento
FROM factura f
INNER JOIN paciente p ON f.Id_Paciente = p.Id
WHERE f.Id = ? AND f.Id_Paciente = ?
";
$stmtFactura = $conexion->prepare($sqlFactura);
$stmtFactura->bind_param("ii", $idFactura, $idPaciente);
$stmtFactura->execute();
$factura = $stmtFactura->get_result()->fetch_assoc();

if (!$factura) {
    die("Acceso denegado.");
}

/* 📑 Detalle */
$sqlDetalle = "
SELECT c.Servicio, df.Precio, c.Descuento, df.Total
FROM detalle_factura df
INNER JOIN cita c ON df.Id_Cita = c.Id
WHERE df.Id_Factura = ?
";
$stmtDetalle = $conexion->prepare($sqlDetalle);
$stmtDetalle->bind_param("i", $idFactura);
$stmtDetalle->execute();
$detalles = $stmtDetalle->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura <?= $factura['numero_factura'] ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f5f5f5; font-size:14px; }
.factura { background:#fff; padding:30px; max-width:900px; margin:auto; }

@media print {
    body { background:#fff; }
    .no-print { display:none; }
}
</style>
</head>

<body>

<div class="factura shadow-sm">

<!-- EMPRESA -->
<div class="row mb-4">
    <div class="col-6">
        <img src="../../Img/<?= $EMPRESA['logo'] ?>" style="max-height:40px;">
        <p class="mb-0"><b><?= $EMPRESA['nombre'] ?></b></p>
        <p class="mb-0">NIT: <?= $EMPRESA['nit'] ?></p>
        <p class="mb-0"><?= $EMPRESA['direccion'] ?></p>
        <p class="mb-0"><?= $EMPRESA['telefono'] ?></p>
        <p><?= $EMPRESA['email'] ?></p>
    </div>
    <div class="col-6 text-end">
        <h4>FACTURA</h4>
        <p><b>N°:</b> <?= $factura['numero_factura'] ?></p>
        <p><b>Fecha:</b> <?= date('d/m/Y', strtotime($factura['FechaHora'])) ?></p>
        <p><b>Estado:</b> <?= $factura['Estado'] ?></p>
    </div>
</div>

<hr>

<!-- PACIENTE -->
<p><b>Paciente:</b> <?= $factura['Nombre'] . ' ' . $factura['Apellido'] ?></p>
<p><b>Documento:</b> <?= $factura['NumeroDocumento'] ?></p>
<p><b>Método de pago:</b> <?= $factura['Metodo_Pago'] ?></p>

<!-- DETALLE -->
<table class="table table-bordered mt-3">
<thead class="table-light">
<tr>
    <th>Servicio</th>
    <th class="text-end">Precio</th>
    <th class="text-end">Desc.</th>
    <th class="text-end">Total</th>
</tr>
</thead>
<tbody>
<?php while($d = $detalles->fetch_assoc()): ?>
<tr>
    <td><?= $d['Servicio'] ?></td>
    <td class="text-end">$<?= number_format($d['Precio'],0,',','.') ?></td>
    <td class="text-end"><?= $d['Descuento'] ?>%</td>
    <td class="text-end">$<?= number_format($d['Total'],0,',','.') ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<!-- TOTALES -->
<div class="row justify-content-end">
<div class="col-4">
<table class="table">
<tr><th>Subtotal</th><td class="text-end">$<?= number_format($factura['Subtotal'],0,',','.') ?></td></tr>
<tr><th>Descuento</th><td class="text-end">$<?= number_format($factura['Descuento'],0,',','.') ?></td></tr>
<tr class="table-light">
<th>Total</th>
<td class="text-end fw-bold">$<?= number_format($factura['Total'],0,',','.') ?></td>
</tr>
</table>
</div>
</div>

<!-- ACCIONES -->
<div class="text-end mt-4 no-print">
    <button onclick="window.print()" class="btn btn-outline-secondary">🖨️ Imprimir / Guardar PDF</button>
    <a href="FacturasGuardadas.php" class="btn btn-primary">Volver</a>
</div>

</div>

</body>
</html>
