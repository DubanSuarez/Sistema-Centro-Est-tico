<?php
require_once('../../Conexiones/conexion.php');
session_start();

/* =========================================================
   VALIDAR IDS PRINCIPALES
========================================================= */
$id_cita         = isset($_POST['id_cita']) ? intval($_POST['id_cita']) : 0;
$id_especialista = isset($_POST['id_especialista']) ? intval($_POST['id_especialista']) : 0;
$id_servicio     = isset($_POST['id_servicio']) ? intval($_POST['id_servicio']) : 0;

if ($id_cita <= 0 || $id_especialista <= 0 || $id_servicio <= 0) {
    echo "<script>
        alert('❌ Datos inválidos para la valoración');
        window.history.back();
    </script>";
    exit;
}

/* =========================================================
   DATOS DE LA VALORACIÓN
========================================================= */
$tipo_piel       = mysqli_real_escape_string($conexion, trim($_POST['tipo_piel'] ?? ''));
$fototipo        = mysqli_real_escape_string($conexion, trim($_POST['fototipo'] ?? ''));
$estado_piel     = mysqli_real_escape_string($conexion, trim($_POST['estado_piel'] ?? ''));

$diagnostico     = mysqli_real_escape_string($conexion, trim($_POST['diagnostico_estetico'] ?? ''));
$procedimiento   = mysqli_real_escape_string($conexion, trim($_POST['procedimiento_realizado'] ?? ''));
$observaciones   = mysqli_real_escape_string($conexion, trim($_POST['observaciones'] ?? ''));
$recomendaciones = mysqli_real_escape_string($conexion, trim($_POST['recomendaciones'] ?? ''));

/* =========================================================
   CHECKBOX / MULTISELECT → TEXTO
========================================================= */
$productos = isset($_POST['productos_utilizados']) && is_array($_POST['productos_utilizados'])
    ? mysqli_real_escape_string($conexion, implode(', ', $_POST['productos_utilizados']))
    : '';

$equipos = isset($_POST['equipos_utilizados']) && is_array($_POST['equipos_utilizados'])
    ? mysqli_real_escape_string($conexion, implode(', ', $_POST['equipos_utilizados']))
    : '';

$reacciones = isset($_POST['reacciones']) && is_array($_POST['reacciones'])
    ? mysqli_real_escape_string($conexion, implode(', ', $_POST['reacciones']))
    : '';

/* =========================================================
   FECHA PRÓXIMA CITA
========================================================= */
$proxima_cita = !empty($_POST['proxima_cita'])
    ? "'" . mysqli_real_escape_string($conexion, $_POST['proxima_cita']) . "'"
    : "NULL";

/* =========================================================
   INICIAR TRANSACCIÓN
========================================================= */
mysqli_begin_transaction($conexion);

try {

    /* =====================================================
       INSERTAR VALORACIÓN ESTÉTICA
    ===================================================== */
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
        throw new Exception('Error al guardar la valoración estética');
    }

    /* =====================================================
       ACTUALIZAR CITA (ATENDIDA + FACTURABLE)
    ===================================================== */
    $sql_update_cita = "
        UPDATE cita
        SET 
            Estado = 'ATENDIDA',
            Facturar = 1
        WHERE Id = $id_cita
    ";

    if (!mysqli_query($conexion, $sql_update_cita)) {
        throw new Exception('Error al actualizar la cita');
    }

    /* =====================================================
       CONFIRMAR TRANSACCIÓN
    ===================================================== */
    mysqli_commit($conexion);

    echo "<script>
        alert('✅ Atención finalizada. Cita lista para facturación');
        window.location.href = '../HC/ControlCitas.php';
    </script>";

} catch (Exception $e) {

    mysqli_rollback($conexion);

    echo "<script>
        alert('❌ Ocurrió un error al finalizar la atención');
        window.history.back();
    </script>";
}
?>
