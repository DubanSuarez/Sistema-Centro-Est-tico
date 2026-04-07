<?php
include('../../Conexiones/conexion.php');

if (isset($_POST['servicioId'], $_POST['especialistaId'], $_POST['fecha'])) {
    $servicioId = intval($_POST['servicioId']);
    $especialistaId = intval($_POST['especialistaId']);
    $fecha = $_POST['fecha'];

    // 1. Obtener duración del servicio (en minutos)
    $duracion = 30;
    $sql = "SELECT Duracion FROM servicio WHERE Id = $servicioId";
    $res = mysqli_query($conexion, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        $duracion = intval($row['Duracion']);
    }

    // 2. Obtener citas ya ocupadas (inicio y fin) para ese especialista en esa fecha
    $ocupadas = [];
    $sql = "SELECT HoraInicio, HoraFin 
            FROM cita 
            WHERE Fecha = '$fecha' 
              AND Id_ServicioEspecialista IN (
                SELECT Id 
                FROM servicioespecialista 
                WHERE Id_Especialista = $especialistaId 
                  AND Id_Servicio = $servicioId
              )";
    $res = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $ocupadas[] = [
            "inicio" => strtotime($row['HoraInicio']),
            "fin"    => strtotime($row['HoraFin'])
        ];
    }

    // 3. Definir bloques laborales (mañana y tarde)
    $bloques = [
        ['08:00', '12:00'],
        ['14:00', '19:00']
    ];

    $horarios = [];
    foreach ($bloques as $bloque) {
        $inicio = strtotime($bloque[0]);
        $fin = strtotime($bloque[1]);

        while ($inicio + ($duracion * 60) <= $fin) {
            $horaFin = $inicio + ($duracion * 60);
            $disponible = true;

            // Verificar choques con citas ocupadas
            foreach ($ocupadas as $cita) {
                if (
                    ($inicio >= $cita["inicio"] && $inicio < $cita["fin"]) || // empieza dentro de otra cita
                    ($horaFin > $cita["inicio"] && $horaFin <= $cita["fin"]) || // termina dentro de otra cita
                    ($inicio <= $cita["inicio"] && $horaFin >= $cita["fin"])   // abarca completamente otra cita
                ) {
                    $disponible = false;
                    break;
                }
            }

            if ($disponible) {
                // Guardar inicio y fin en formato 12h
                $horaInicioFmt = date("g:i A", $inicio);
                $horaFinFmt = date("g:i A", $horaFin);

                // En value solo va la hora de inicio, en texto se muestra el rango
                $horarios[] = [
                    "inicioValue" => date("H:i", $inicio), // para guardar en DB
                    "texto"       => "$horaInicioFmt - $horaFinFmt"
                ];
            }

            // Avanzar en intervalos de 30 minutos
            $inicio += 30 * 60;
        }
    }

    // 4. Imprimir resultados
    echo "<option value=''>Seleccione una hora</option>";
    foreach ($horarios as $h) {
        echo "<option value='{$h['inicioValue']}'>{$h['texto']}</option>";
    }
}
?>
