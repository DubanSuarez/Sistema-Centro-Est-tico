<?php
require_once('../../Conexiones/conexion.php');

$id = (int)$_POST['especialista'];

/* =========================================================
   AGENDA DEL ESPECIALISTA
   ✔ PENDIENTE (para prepararse)
   ✔ EN_PROCESO (para atender)
   ✔ Facturar = 0
========================================================= */

$sql = "
SELECT
    c.Id,
    c.Id_Paciente,
    CONCAT(p.Nombre,' ',p.Apellido) AS paciente,
    c.Fecha,
    c.HoraInicio,
    c.HoraFin,
    c.Estado,
    s.Nombre AS servicio

FROM cita c

INNER JOIN servicioespecialista se 
    ON se.Id = c.Id_ServicioEspecialista

INNER JOIN servicio s 
    ON s.Id = se.Id_Servicio

INNER JOIN paciente p 
    ON p.Id = c.Id_Paciente

WHERE 
    se.Id_Especialista = $id
    AND c.Facturar = 0
    AND c.Estado IN ('PENDIENTE','EN_PROCESO')

ORDER BY c.Fecha, c.HoraInicio
";

$resultado = $conexion->query($sql);

$eventos = [];

while($row = $resultado->fetch_assoc()){

    $eventos[] = [
        "id" => $row['Id'],
        "title" => $row['paciente']." - ".$row['servicio'],
        "start" => $row['Fecha']." ".$row['HoraInicio'],
        "end"   => $row['Fecha']." ".$row['HoraFin'],
        "estado" => $row['Estado'],
        "paciente" => $row['Id_Paciente']
    ];
}

echo json_encode($eventos);
?>
