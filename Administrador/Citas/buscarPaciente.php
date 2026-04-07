<?php include('../../Conexiones/conexion.php');
$dato = $_POST['dato'];
$sql = "SELECT Id, Nombre, Apellido, NumeroDocumento FROM paciente WHERE NumeroDocumento LIKE '%$dato%' OR Nombre LIKE '%$dato%' OR Apellido LIKE '%$dato%'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) == 0) {
  echo "<div class='alert alert-warning'>No se encontraron pacientes</div>";
  exit;
}
echo "<ul class='list-group'>";
while ($row = mysqli_fetch_assoc($result)) {
  $nombre = $row['Nombre'] . " " . $row['Apellido'];
  echo " <li class='list-group-item d-flex justify-content-between'> $nombre - {$row['NumeroDocumento']} <button class='btn btn-sm btn-primary' onclick=\"seleccionarPaciente({$row['Id']}, '$nombre')\"> Seleccionar </button> </li>";
}
echo "</ul>";