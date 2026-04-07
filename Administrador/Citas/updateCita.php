<?php
include("../../Conexiones/conexion.php");
session_start();

/* =====================================
   VALIDAR MÉTODO
===================================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: RegistroCitas.php");
    exit();
}

/* =====================================
   VALIDAR DATOS
===================================== */
if (
    empty($_POST['id']) ||
    empty($_POST['servicio']) ||
    empty($_POST['especialista']) ||
    empty($_POST['fecha']) ||
    empty($_POST['horaInicio'])
) {
    header("Location: RegistroCitas.php?msg=missing");
    exit();
}

$idCita         = intval($_POST['id']);
$idServicio     = intval($_POST['servicio']);
$idEspecialista = intval($_POST['especialista']);
$fecha          = $_POST['fecha'];
$horaInicioStr  = $_POST['horaInicio'];

/* =====================================
   VALIDAR SERVICIO - ESPECIALISTA
===================================== */
$sqlSE = "
SELECT Id
FROM servicioespecialista
WHERE Id_Servicio = $idServicio
  AND Id_Especialista = $idEspecialista
LIMIT 1
";

$resSE = mysqli_query($conexion, $sqlSE);

if (!$resSE || mysqli_num_rows($resSE) === 0) {
    header("Location: RegistroCitas.php?msg=no_relation");
    exit();
}

$idServicioEspecialista = mysqli_fetch_assoc($resSE)['Id'];

/* =====================================
   OBTENER DATOS DEL SERVICIO
===================================== */
$sqlServicio = "
SELECT 
    Nombre,
    Duracion,
    Costo,
    Descuento,
    Valor
FROM servicio
WHERE Id = $idServicio
LIMIT 1
";

$resServicio = mysqli_query($conexion, $sqlServicio);

if (!$resServicio || mysqli_num_rows($resServicio) === 0) {
    header("Location: RegistroCitas.php?msg=error");
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
   ACTUALIZAR CITA
===================================== */
$sqlUpdate = "
UPDATE cita
SET
    Id_ServicioEspecialista = $idServicioEspecialista,
    Fecha       = '$fecha',
    HoraInicio  = '$horaInicio_db',
    HoraFin     = '$horaFin_db',
    Estado      = 'PENDIENTE',
    Precio      = $precio,
    Descuento   = $descuento,
    ValorTotal  = $valorTotal,
    Servicio    = '$nombreServicio'
WHERE Id = $idCita
";

if (mysqli_query($conexion, $sqlUpdate)) {
    echo "
    <script>
        alert('✏️ La cita fue actualizada correctamente');
        window.location.href = 'RegistroCitas.php';
    </script>";
} else {
    echo "
    <script>
        alert('❌ Error al actualizar la cita');
        window.history.back();
    </script>";
}
