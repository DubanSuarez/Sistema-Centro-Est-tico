<?php
require_once('../../Conexiones/conexion.php');

/* ====== DATOS ====== */
$id         = (int) ($_POST['Id'] ?? 0);
$nombre     = trim($_POST['Nombre'] ?? '');
$duracion   = (int) ($_POST['Duracion'] ?? 0);
$costo      = (float) ($_POST['Costo'] ?? 0);
$descuento  = (int) ($_POST['Descuento'] ?? 0);
$tipo       = $_POST['TipoServicio'] ?? '';
$desc       = trim($_POST['Descripcion'] ?? '');

/* ====== VALIDACIONES ====== */
if ($id <= 0 || $nombre === '' || $duracion <= 0 || $costo <= 0 || $tipo === '') {
    echo "<script>alert('❌ Datos inválidos'); window.history.back();</script>";
    exit();
}

/* ====== CÁLCULO ====== */
$valor = $costo - ($costo * $descuento / 100);

/* ====== FOTO ACTUAL ====== */
$sql_foto = "SELECT Foto FROM servicio WHERE Id = $id";
$res_foto = mysqli_query($conexion, $sql_foto);
$fila = mysqli_fetch_assoc($res_foto);

$foto_actual = $fila['Foto'] ?? 'default.png';

/* ====== NUEVA FOTO ====== */
$foto_final = $foto_actual;

if (!empty($_FILES['Foto']['name'])) {

    $extension = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($extension, $permitidas)) {
        echo "<script>alert('❌ Formato de imagen no permitido'); window.history.back();</script>";
        exit();
    }

    $nueva_foto = uniqid('serv_') . '.' . $extension;
    $ruta_nueva = __DIR__ . '/../../Img/Servicios/' . $nueva_foto;

    if (move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta_nueva)) {

        /* ====== BORRAR FOTO ANTERIOR (SEGURA) ====== */
        $ruta_anterior = __DIR__ . '/../../Img/Servicios/' . $foto_actual;

        if (
            !empty($foto_actual) &&
            $foto_actual !== 'default.png' &&
            file_exists($ruta_anterior)
        ) {
            unlink($ruta_anterior);
        }

        $foto_final = $nueva_foto;
    }
}

/* ====== UPDATE ====== */
$sql = "UPDATE servicio SET
    Nombre       = '$nombre',
    Duracion     = '$duracion',
    Costo        = '$costo',
    Descuento    = '$descuento',
    Valor        = '$valor',
    Descripcion  = '$desc',
    Foto         = '$foto_final',
    TipoServicio = '$tipo'
WHERE Id = $id";

if (mysqli_query($conexion, $sql)) {
    echo "
        <script>
            alert('✅ Servicio actualizado correctamente');
            window.location.href = 'Servicios.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('❌ Error al actualizar el servicio');
            window.history.back();
        </script>
    ";
}
