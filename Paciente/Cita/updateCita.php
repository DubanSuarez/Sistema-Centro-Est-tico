<?php
include("../../Conexiones/conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: Cita.php");
    exit();
}

/* =========================
   VALIDAR CAMPOS
========================= */
if (
    !isset(
        $_POST['id'],
        $_POST['servicio'],
        $_POST['especialista'],
        $_POST['fecha'],
        $_POST['horaInicio']
    )
) {
    header("Location: Cita.php?msg=missing");
    exit();
}

$idCita         = intval($_POST['id']);
$idServicio     = intval($_POST['servicio']);
$idEspecialista = intval($_POST['especialista']);
$fecha          = mysqli_real_escape_string($conexion, $_POST['fecha']);
$horaInicioStr  = mysqli_real_escape_string($conexion, $_POST['horaInicio']);


/* =====================================
   🔴 VALIDAR ESTADO ACTUAL DE LA CITA
===================================== */
$sqlEstado = "SELECT Estado FROM cita WHERE Id = $idCita LIMIT 1";
$resEstado = mysqli_query($conexion, $sqlEstado);

if (!$resEstado || mysqli_num_rows($resEstado) === 0) {
    header("Location: Cita.php?msg=not_found");
    exit();
}

$estadoActual = mysqli_fetch_assoc($resEstado)['Estado'];

/* ❌ BLOQUEAR SI NO ES EDITABLE */
if ($estadoActual === 'EN_PROCESO' || $estadoActual === 'FACTURADA') {
    echo "
    <script>
        alert('❌ No puedes modificar una cita que está en progreso o facturada');
        window.location.href='Cita.php';
    </script>";
    exit();
}


/* =====================================
   SERVICIO - ESPECIALISTA
===================================== */
$sqlSE = "SELECT Id
          FROM servicioespecialista
          WHERE Id_Servicio = $idServicio
            AND Id_Especialista = $idEspecialista
          LIMIT 1";

$resSE = mysqli_query($conexion, $sqlSE);

if (!$resSE || mysqli_num_rows($resSE) === 0) {
    header("Location: Cita.php?msg=no_relation");
    exit();
}

$idServicioEspecialista = mysqli_fetch_assoc($resSE)['Id'];


/* =====================================
   DATOS DEL SERVICIO
===================================== */
$sqlServicio = "SELECT Nombre, Duracion, Costo, Descuento, Valor
                FROM servicio
                WHERE Id = $idServicio
                LIMIT 1";

$resServicio = mysqli_query($conexion, $sqlServicio);

if (!$resServicio) {
    header("Location: Cita.php?msg=service_error");
    exit();
}

$servicio = mysqli_fetch_assoc($resServicio);

$nombreServicio = $servicio['Nombre'];
$duracionMin    = intval($servicio['Duracion']);
$precio         = floatval($servicio['Costo']);
$descuento      = floatval($servicio['Descuento']);
$valorTotal     = floatval($servicio['Valor']);


/* =====================================
   CALCULAR HORAS
===================================== */
$horaInicio_ts = strtotime($horaInicioStr);
$horaInicio_db = date('H:i:s', $horaInicio_ts);
$horaFin_db    = date('H:i:s', $horaInicio_ts + ($duracionMin * 60));


/* =====================================
   ACTUALIZAR SOLO SI ES PENDIENTE
   (doble seguridad en el WHERE)
===================================== */
$sqlUpdate = "
UPDATE cita
SET
    Id_ServicioEspecialista = $idServicioEspecialista,
    Fecha = '$fecha',
    HoraInicio = '$horaInicio_db',
    HoraFin = '$horaFin_db',
    Precio = $precio,
    Descuento = $descuento,
    ValorTotal = $valorTotal,
    Servicio = '$nombreServicio'
WHERE Id = $idCita
AND Estado = 'PENDIENTE'
";

if (mysqli_query($conexion, $sqlUpdate) && mysqli_affected_rows($conexion) > 0) {

    echo "
    <script>
        alert('✏️ La cita fue actualizada correctamente');
        window.location.href = 'Cita.php';
    </script>";

} else {

    echo "
    <script>
        alert('❌ No se pudo actualizar la cita (puede que ya no sea editable)');
        window.location.href = 'Cita.php';
    </script>";
}
?>
