<?php
include('../../Conexiones/conexion.php');

var_dump($_POST);

if (isset($_POST['servicioId'])) {
    $servicioId = intval($_POST['servicioId']);

    $consulta = "SELECT se.Id_Servicio AS Servicio, cp.Id AS IdEspecialista, cp.Nombre AS NombreEspecialista, cp.Apellido AS ApellidoEspecialista
                    FROM servicioespecialista se 
	                    INNER JOIN contratopersona cp
    		                    ON se.Id_Especialista = cp.Id
	                WHERE se.Id_Servicio = $servicioId";

    $result = mysqli_query($conexion, $consulta);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    echo "<option value=''>Seleccione un especialista</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['IdEspecialista'] . "'>" . $row['NombreEspecialista'] . " " . $row['ApellidoEspecialista'] . "</option>";
    }
}


