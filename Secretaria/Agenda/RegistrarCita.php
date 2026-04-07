<?php
include('../../Conexiones/conexion.php');
session_start();

/* =====================================
   VALIDAR MÉTODO
===================================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: Cita.php");
    exit();
}

/* =====================================
   RECIBIR DATOS
===================================== */
$paciente = intval($_POST['paciente'] ?? 0);
$servicioId = intval($_POST['servicio'] ?? 0);
$especialistaId = intval($_POST['especialista'] ?? 0);
$fecha = $_POST['txtFecha'] ?? '';
$horaInicioStr = $_POST['txtHora'] ?? '';

/* =====================================
   VALIDACIÓN BÁSICA
===================================== */
if (
    !$paciente ||
    !$servicioId ||
    !$especialistaId ||
    !$fecha ||
    !$horaInicioStr
) {
    header("Location: Agenda.php?msg=missing");
    exit();
}

/* =====================================
   OBTENER SERVICIO - ESPECIALISTA
===================================== */
$sql = "SELECT Id
        FROM servicioespecialista
        WHERE Id_Servicio = $servicioId
          AND Id_Especialista = $especialistaId
        LIMIT 1";

$res = mysqli_query($conexion, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: Cita.php?msg=no_relation");
    exit();
}

$idServicioEspecialista = mysqli_fetch_assoc($res)['Id'];

/* =====================================
   DATOS DEL SERVICIO
===================================== */
$sql = "SELECT
            Nombre,
            Duracion,
            Costo,
            Descuento,
            Valor
        FROM servicio
        WHERE Id = $servicioId
        LIMIT 1";

$res = mysqli_query($conexion, $sql);
$servicio = mysqli_fetch_assoc($res);

$nombreServicio = $servicio['Nombre'];
$duracionMin = intval($servicio['Duracion']);
$precio = floatval($servicio['Costo']);
$descuento = floatval($servicio['Descuento']);
$valorTotal = floatval($servicio['Valor']);

/* =====================================
   CALCULAR HORAS
===================================== */
$horaInicio_ts = strtotime($horaInicioStr);
$horaInicio_db = date('H:i:s', $horaInicio_ts);
$horaFin_db = date('H:i:s', $horaInicio_ts + ($duracionMin * 60));

/* =====================================
   INSERTAR CITA
===================================== */
$sqlInsert = "
INSERT INTO cita (
    Id_ServicioEspecialista,
    Id_Paciente,
    Fecha,
    HoraInicio,
    HoraFin,
    Estado,
    Facturar,
    Precio,
    Descuento,
    ValorTotal,
    Servicio
) VALUES (
    $idServicioEspecialista,
    $paciente,
    '$fecha',
    '$horaInicio_db',
    '$horaFin_db',
    'PENDIENTE',
    0,
    $precio,
    $descuento,
    $valorTotal,
    '$nombreServicio'
)";

if (mysqli_query($conexion, $sqlInsert)) {

    echo "
    <script>
        alert('✅ La cita fue registrada correctamente');
        window.location.href = 'Agenda.php';
    </script>
    ";
    exit();

} else {

    echo "
    <script>
        alert('❌ Error al registrar la cita');
        window.history.back();
    </script>
    ";
    exit();
}
