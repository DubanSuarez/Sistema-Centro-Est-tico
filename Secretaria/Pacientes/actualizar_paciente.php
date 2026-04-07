<?php
session_start();
require_once("../../Conexiones/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idPaciente   = intval($_POST['id_paciente']);
    $nombre       = trim($_POST['nombre']);
    $apellido     = trim($_POST['apellido']);
    $genero       = $_POST['genero'];
    $telefono     = trim($_POST['telefono']);
    $direccion    = trim($_POST['direccion']);
    $estadoCivil  = $_POST['estado_civil'];
    $ocupacion    = trim($_POST['ocupacion']);

    $sql = "UPDATE paciente SET
                Nombre = ?,
                Apellido = ?,
                Genero = ?,
                NumeroTelefono = ?,
                Direccion = ?,
                EstadoCivil = ?,
                Ocupacion = ?
            WHERE Id = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "sssssssi",
        $nombre,
        $apellido,
        $genero,
        $telefono,
        $direccion,
        $estadoCivil,
        $ocupacion,
        $idPaciente
    );

    if ($stmt->execute()) {
        echo "
            <script>
                alert('✅ Datos del paciente actualizados correctamente');
                window.location.href = 'Pacientes.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('❌ Error al actualizar el paciente');
                window.history.back();
            </script>
        ";
    }
}
?>
