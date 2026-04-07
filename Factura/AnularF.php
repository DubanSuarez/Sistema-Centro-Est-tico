<?php
session_start();
require_once('../Conexiones/conexion.php');

$rut=$_REQUEST['Anular'];
$consulta="UPDATE factura SET FacturaAnulada=1 WHERE Id='$rut' ";
mysqli_query($conexion, $consulta);

echo "<script>window.open('FacturasGuardadas.php','_self')</script>";


?>
