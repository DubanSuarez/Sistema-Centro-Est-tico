<?php
require_once('../../Conexiones/conexion.php');
session_start();

/* =========================================================
   OBTENER ESPECIALISTA DESDE SESIÓN (NO DESDE POST)
========================================================= */
$id_usuario = $_SESSION['id'];

$sqlEsp = "
SELECT Id 
FROM contratopersona
WHERE Id_Usuario = $id_usuario
LIMIT 1
";

$resEsp = mysqli_query($conexion, $sqlEsp);
$rowEsp = mysqli_fetch_assoc($resEsp);

$id_especialista = $rowEsp['Id'] ?? 0;


/* =========================================================
   VALIDAR ID CITA
========================================================= */
$id_cita     = intval($_POST['id_cita'] ?? 0);
$id_servicio = intval($_POST['id_servicio'] ?? 0);

if ($id_cita <= 0 || $id_especialista <= 0 || $id_servicio <= 0) {
    die("❌ Datos inválidos");
}


/* =========================================================
   VALIDAR QUE LA CITA LE PERTENECE AL ESPECIALISTA
   Y ESTÁ EN_PROCESO + Facturar = 0
========================================================= */
$sql_validar = "
SELECT c.Id
FROM cita c
INNER JOIN servicioespecialista se ON se.Id = c.Id_ServicioEspecialista
WHERE 
    c.Id = $id_cita
    AND se.Id_Especialista = $id_especialista
    AND c.Estado = 'EN_PROCESO'
    AND c.Facturar = 0
LIMIT 1
";

$res_validar = mysqli_query($conexion, $sql_validar);

if (mysqli_num_rows($res_validar) == 0) {
    echo "<script>
        alert('❌ Esta cita no puede ser atendida o no te pertenece');
        window.location.href='MiAgenda.php';
    </script>";
    exit;
}


/* =========================================================
   CAPTURAR DATOS
========================================================= */
function limpiar($conexion, $campo){
    return mysqli_real_escape_string($conexion, trim($campo ?? ''));
}

$tipo_piel       = limpiar($conexion, $_POST['tipo_piel']);
$fototipo        = limpiar($conexion, $_POST['fototipo']);
$estado_piel     = limpiar($conexion, $_POST['estado_piel']);
$diagnostico     = limpiar($conexion, $_POST['diagnostico_estetico']);
$procedimiento   = limpiar($conexion, $_POST['procedimiento_realizado']);
$observaciones   = limpiar($conexion, $_POST['observaciones']);
$recomendaciones = limpiar($conexion, $_POST['recomendaciones']);

$productos = isset($_POST['productos_utilizados'])
    ? limpiar($conexion, implode(', ', $_POST['productos_utilizados']))
    : '';

$equipos = isset($_POST['equipos_utilizados'])
    ? limpiar($conexion, implode(', ', $_POST['equipos_utilizados']))
    : '';

$reacciones = isset($_POST['reacciones'])
    ? limpiar($conexion, implode(', ', $_POST['reacciones']))
    : '';

$proxima_cita = !empty($_POST['proxima_cita'])
    ? "'" . limpiar($conexion, $_POST['proxima_cita']) . "'"
    : "NULL";


/* =========================================================
   TRANSACCIÓN
========================================================= */
mysqli_begin_transaction($conexion);

try {

    /* ================= INSERT VALORACIÓN ================= */
    $sql_valoracion = "
        INSERT INTO valoracion_estetica (
            id_cita,
            id_especialista,
            id_servicio,
            fecha,
            tipo_piel,
            fototipo,
            estado_piel,
            diagnostico_estetico,
            procedimiento_realizado,
            productos_utilizados,
            equipos_utilizados,
            observaciones,
            reacciones,
            recomendaciones,
            proxima_cita,
            estado,
            created_at
        ) VALUES (
            $id_cita,
            $id_especialista,
            $id_servicio,
            CURDATE(),
            '$tipo_piel',
            '$fototipo',
            '$estado_piel',
            '$diagnostico',
            '$procedimiento',
            '$productos',
            '$equipos',
            '$observaciones',
            '$reacciones',
            '$recomendaciones',
            $proxima_cita,
            'CERRADA',
            NOW()
        )
    ";

    if (!mysqli_query($conexion, $sql_valoracion)) {
        throw new Exception("Error al guardar valoración");
    }


    /* ================= ACTUALIZAR CITA ================= */
    $sql_update = "
        UPDATE cita
        SET 
            Estado = 'ATENDIDA',
            Facturar = 1
        WHERE Id = $id_cita
    ";

    if (!mysqli_query($conexion, $sql_update)) {
        throw new Exception("Error al actualizar cita");
    }


    mysqli_commit($conexion);

    echo "<script>
        alert('✅ Atención finalizada correctamente');
        window.location.href='MisCitas.php';
    </script>";

} catch (Exception $e) {

    mysqli_rollback($conexion);

    echo "<script>
        alert('❌ Error al guardar la atención');
        window.history.back();
    </script>";
}
?>
