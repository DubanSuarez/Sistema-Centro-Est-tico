<?php
require_once('../../Conexiones/conexion.php');
session_start();

// Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
  http_response_code(403);
  echo json_encode([]);
  exit;
}

$sql = "
SELECT 
  c.Id,
  c.Fecha,
  c.HoraInicio,
  c.HoraFin,
  c.Estado,
  p.Nombre AS PacienteNombre,
  p.Apellido AS PacienteApellido,
  s.Nombre AS ServicioNombre
FROM cita c
INNER JOIN paciente p ON p.Id = c.Id_Paciente
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
INNER JOIN servicio s ON s.Id = se.Id_Servicio
";

$result = mysqli_query($conexion, $sql);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {

  $events[] = [
    'id'    => $row['Id'],
    'title' => $row['PacienteNombre'].' '.$row['PacienteApellido'].' - '.$row['ServicioNombre'],
    'start' => $row['Fecha'].'T'.$row['HoraInicio'],
    'end'   => $row['HoraFin'] ? $row['Fecha'].'T'.$row['HoraFin'] : null,

    // 👇 AQUÍ VA TODO LO EXTRA
    'extendedProps' => [
      'estado'   => $row['Estado'],
      'paciente' => $row['PacienteNombre'].' '.$row['PacienteApellido'],
      'servicio' => $row['ServicioNombre']
    ]
  ];
}

echo json_encode($events);
