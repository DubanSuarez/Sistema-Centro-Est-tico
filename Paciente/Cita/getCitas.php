<?php
include('../../Conexiones/conexion.php');
session_start();

$pacientehc = $_SESSION['id'];

// Consultar citas del paciente
$query = "SELECT cita.Id, cita.Fecha, cita.HoraInicio, cita.HoraFin, cita.Estado,
                 paciente.Nombre AS Paciente,
                 servicio.Nombre AS Servicio
          FROM cita
          INNER JOIN paciente ON paciente.Id = cita.Id_Paciente
          INNER JOIN usuario ON usuario.Id = paciente.Id_Usuario
          INNER JOIN servicioespecialista se ON se.Id = cita.Id_ServicioEspecialista
          INNER JOIN servicio ON servicio.Id = se.Id_Servicio
          WHERE usuario.Id = '$pacientehc' AND cita.Facturar = 0";

$result = mysqli_query($conexion, $query);

$events = [];

while($row = mysqli_fetch_assoc($result)){
    $events[] = [
        'id'    => $row['Id'],
        'title' => $row['Paciente']." - ".$row['Servicio'],
        'start' => $row['Fecha']."T".$row['HoraInicio'],  // inicio cita
        'end'   => $row['Fecha']."T".$row['HoraFin'],     // fin cita
        'estado' => $row['Estado']
    ];
}

echo json_encode($events);
?>
