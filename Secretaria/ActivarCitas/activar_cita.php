<?php
session_start();
require_once('../../Conexiones/conexion.php');

// Validar sesión (admin)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    echo "
        <script>
            alert('❌ Sesión no válida');
            window.location.href = '../Usuario/Usuario.php';
        </script>
    ";
    exit();
}

// Validar ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "
        <script>
            alert('❌ ID de cita no válido');
            window.location.href = 'ControlCitas.php';
        </script>
    ";
    exit();
}

$idCita = intval($_GET['id']);

// Verificar estado actual
$sqlCheck = "SELECT Estado FROM cita WHERE Id = $idCita";
$resCheck = mysqli_query($conexion, $sqlCheck);

if (!$resCheck || mysqli_num_rows($resCheck) == 0) {
    echo "
        <script>
            alert('❌ La cita no existe');
            window.location.href = 'ControlCitas.php';
        </script>
    ";
    exit();
}

$cita = mysqli_fetch_assoc($resCheck);

// Solo activar si está pendiente
if ($cita['Estado'] !== 'PENDIENTE') {
    echo "
        <script>
            alert('⚠️ Esta cita no puede activarse');
            window.location.href = 'ControlCitas.php';
        </script>
    ";
    exit();
}

// Actualizar estado
$sqlUpdate = "
    UPDATE cita 
    SET Estado = 'EN_PROCESO'
    WHERE Id = $idCita
";

if (mysqli_query($conexion, $sqlUpdate)) {

    echo "
        <script>
            alert('✅ La cita fue activada correctamente');
            window.location.href = 'ControlCitas.php';
        </script>
    ";

} else {

    echo "
        <script>
            alert('❌ Error al activar la cita');
            window.history.back();
        </script>
    ";
}
