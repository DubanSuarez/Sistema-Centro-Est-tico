<?php
require_once('../../Conexiones/conexion.php');

/* ====== VALIDACIÓN ====== */
$id_servicio = (int) ($_POST['Id_Servicio'] ?? 0);
$especialistas = $_POST['especialistas'] ?? [];

if ($id_servicio <= 0) {
    header("Location: Servicios.php");
    exit();
}

/* ====== PASO 1: DESACTIVAR TODOS LOS ESPECIALISTAS DEL SERVICIO ====== */
/* ⚠️ NO SE BORRA NADA, SOLO SE MARCA COMO INACTIVO */
$sql_desactivar = "
    UPDATE servicioespecialista
    SET Activo = 0
    WHERE Id_Servicio = $id_servicio
";
mysqli_query($conexion, $sql_desactivar);

/* ====== PASO 2: ACTIVAR / INSERTAR LOS SELECCIONADOS ====== */
if (!empty($especialistas)) {

    foreach ($especialistas as $id_especialista) {

        $id_especialista = (int) $id_especialista;

        /* ¿Ya existe la relación? */
        $sql_existe = "
            SELECT Id
            FROM servicioespecialista
            WHERE Id_Servicio = $id_servicio
              AND Id_Especialista = $id_especialista
            LIMIT 1
        ";
        $res_existe = mysqli_query($conexion, $sql_existe);

        if (mysqli_num_rows($res_existe) > 0) {

            /* 👉 EXISTE → SE REACTIVA */
            $sql_update = "
                UPDATE servicioespecialista
                SET Activo = 1
                WHERE Id_Servicio = $id_servicio
                  AND Id_Especialista = $id_especialista
            ";
            mysqli_query($conexion, $sql_update);

        } else {

            /* 👉 NO EXISTE → SE INSERTA */
            $sql_insert = "
                INSERT INTO servicioespecialista
                (Id_Servicio, Id_Especialista, Activo)
                VALUES
                ($id_servicio, $id_especialista, 1)
            ";
            mysqli_query($conexion, $sql_insert);
        }
    }
}

/* ====== MENSAJE Y REDIRECCIÓN ====== */
echo "
<script>
    alert('✅ Especialistas asignados correctamente');
    window.location.href = 'Servicios.php';
</script>
";
exit();
