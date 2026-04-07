<?php
session_start();
require_once('../Conexiones/conexion.php');

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    die("Acceso no autorizado");
}

$id = intval($_POST['id']);

$titulo     = mysqli_real_escape_string($conexion, $_POST['titulo']);
$resumen    = mysqli_real_escape_string($conexion, $_POST['resumen']);
$comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);
$tipo       = mysqli_real_escape_string($conexion, $_POST['tipo']);

$destacado = isset($_POST['destacado']) ? 1 : 0;
$activo    = isset($_POST['activo']) ? 1 : 0;
$fechaFin  = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;

/* ===============================
   IMAGEN (SOLO SI SE SUBE OTRA)
================================ */
$imagenSql = "";

if (!empty($_FILES['imagen']['name'])) {

    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
        header("Location: publicacionadministrador.php?msg=error");
        exit;
    }

    // carpeta donde se guardan las imágenes
    $carpeta = "publicacion/";
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $nombreImagen = 'pub_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

    // 👉 ESTA es la ruta que se guarda en la BD
    $rutaBD = $carpeta . $nombreImagen;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaBD)) {
        header("Location: publicacionadministrador.php?msg=error");
        exit;
    }

    // eliminar imagen anterior si existe
    $resImg = mysqli_query($conexion, "SELECT Imagen FROM blog WHERE Id = $id");
    $imgOld = mysqli_fetch_assoc($resImg)['Imagen'];

    if (!empty($imgOld) && file_exists($imgOld)) {
        unlink($imgOld);
    }

    $imagenSql = ", Imagen = '$rutaBD'";
}

/* ===============================
   UPDATE
================================ */
$sql = "
UPDATE blog SET
    Titulo = '$titulo',
    Resumen = '$resumen',
    Comentario = '$comentario',
    Tipo = '$tipo',
    Destacado = $destacado,
    Activo = $activo,
    FechaFin = " . ($fechaFin ? "'$fechaFin'" : "NULL") . "
    $imagenSql
WHERE Id = $id
";

if (mysqli_query($conexion, $sql)) {
    // 👉 ALERTA DE ÉXITO
    header("Location: InicioAdministrador.php?msg=editado");
    exit;
} else {
    header("Location: InicioAdministrador.php?msg=error");
    exit;
}
