<?php
require_once('../../Conexiones/conexion.php');

$id_paciente = intval($_POST['id_paciente']);
$id_cita     = intval($_POST['id_cita']);

$estatura    = trim($_POST['Estatura']);
$peso        = trim($_POST['Peso']);
$alergias    = trim($_POST['alergias']);
$enfermedades = trim($_POST['enfermedades']);
$medicamentos = trim($_POST['medicamentos']);
$antecedentes = trim($_POST['antecedentes_relevantes']);
$embarazo     = trim($_POST['embarazo_lactancia']);

/* ================= VALIDACIÓN ================= */
if ($id_paciente <= 0) {
    echo "<script>
        alert('❌ Paciente inválido');
        window.history.back();
    </script>";
    exit;
}

/* ================= EXISTE HISTORIAL ================= */
$sql_check = "
SELECT id FROM historial_clinico
WHERE id_paciente = $id_paciente
LIMIT 1
";
$res_check = mysqli_query($conexion, $sql_check);
$existe = mysqli_num_rows($res_check) > 0;

/* ================= INSERT / UPDATE ================= */
if ($existe) {

    // UPDATE
    $sql = "
    UPDATE historial_clinico SET
        Estatura = '$estatura',
        Peso = '$peso',
        alergias = '$alergias',
        enfermedades = '$enfermedades',
        medicamentos = '$medicamentos',
        antecedentes_relevantes = '$antecedentes',
        embarazo_lactancia = '$embarazo',
        updated_at = NOW()
    WHERE id_paciente = $id_paciente
    ";

    $mensaje = '✅ Historial clínico actualizado correctamente';

} else {

    // INSERT
    $sql = "
    INSERT INTO historial_clinico (
        id_paciente,
        Estatura,
        Peso,
        alergias,
        enfermedades,
        medicamentos,
        antecedentes_relevantes,
        embarazo_lactancia,
        created_at
    ) VALUES (
        $id_paciente,
        '$estatura',
        '$peso',
        '$alergias',
        '$enfermedades',
        '$medicamentos',
        '$antecedentes',
        '$embarazo',
        NOW()
    )
    ";

    $mensaje = '✅ Historial clínico creado correctamente';
}

/* ================= EJECUTAR ================= */
if (mysqli_query($conexion, $sql)) {

    echo "
    <script>
        alert('$mensaje');
        window.location.href = 'AtenderCita.php?id=$id_cita';
    </script>
    ";

} else {

    echo "
    <script>
        alert('❌ Error al guardar el historial clínico');
        window.history.back();
    </script>
    ";
}
