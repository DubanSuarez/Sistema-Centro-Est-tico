<?php
session_start();
require_once('../../Conexiones/conexion.php');

// ===============================
// VALIDAR ID
// ===============================
if (!isset($_POST['IdContrato'])) {
  header("Location: Contratos.php");
  exit;
}

$idContrato = intval($_POST['IdContrato']);

// ===============================
// DATOS PERSONALES
// ===============================
$Rol = $_POST['Rol'];
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$NumeroDocumento = $_POST['NumeroDocumento'];
$Genero = $_POST['Genero'];
$NumeroTelefono = $_POST['NumeroTelefono'];
$FechaNacimiento = $_POST['FechaNacimiento'];
$Direccion = $_POST['Direccion'];

// ===============================
// DATOS DEL CONTRATO
// ===============================
$FechaContrato = $_POST['FechaContrato'];
$ValorPago = !empty($_POST['ValorPago']) ? $_POST['ValorPago'] : null;
$FormaPago = $_POST['FormaPago'];
$HoraInicial = !empty($_POST['HoraInicial']) ? $_POST['HoraInicial'] : null;
$HoraFinal = !empty($_POST['HoraFinal']) ? $_POST['HoraFinal'] : null;
$Especialidad = !empty($_POST['Especialidad']) ? $_POST['Especialidad'] : null;
$TelefonoFamiliar = $_POST['TelefonoFamiliar'];
$EstadoCivil = $_POST['EstadoCivil'];
$Enfermedad = $_POST['Enfermedad'];

// ===============================
// UPDATE CONTRATO
// ===============================
$sql = "
UPDATE contratopersona SET
  Rol = '$Rol',
  Nombre = '$Nombre',
  Apellido = '$Apellido',
  NumeroDocumento = '$NumeroDocumento',
  Genero = '$Genero',
  NumeroTelefono = '$NumeroTelefono',
  FechaNacimiento = '$FechaNacimiento',
  Direccion = '$Direccion',
  FechaContrato = '$FechaContrato',
  ValorPago = " . ($ValorPago === null ? "NULL" : "'$ValorPago'") . ",
  FormaPago = '$FormaPago',
  HoraInicial = " . ($HoraInicial === null ? "NULL" : "'$HoraInicial'") . ",
  HoraFinal = " . ($HoraFinal === null ? "NULL" : "'$HoraFinal'") . ",
  Especialidad = " . ($Especialidad === null ? "NULL" : "'$Especialidad'") . ",
  TelefonoFamiliar = '$TelefonoFamiliar',
  EstadoCivil = '$EstadoCivil',
  Enfermedad = '$Enfermedad'
WHERE Id = $idContrato
";

// ===============================
// EJECUTAR
// ===============================
if (mysqli_query($conexion, $sql)) {

  echo "<script>
    alert('Contrato actualizado correctamente');
    window.location.href = 'Contratos.php';
  </script>";

} else {

  echo "<script>
    alert('Error al actualizar el contrato');
    window.history.back();
  </script>";

}
