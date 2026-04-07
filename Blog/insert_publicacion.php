<?php
session_start();
require_once('../Conexiones/conexion.php');

/* ===============================
   VALIDAR ADMIN
================================ */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    die("Acceso no autorizado");
}

$idUsuario = intval($_SESSION['id']);

$consultaAdmin = mysqli_query($conexion, "
    SELECT Id FROM administrador 
    WHERE Id_usuario = $idUsuario
");

if (mysqli_num_rows($consultaAdmin) == 0) {
    die("Error: este usuario no está registrado como administrador");
}

$filaAdmin = mysqli_fetch_assoc($consultaAdmin);
$idAdministrador = $filaAdmin['Id'];

/* ===============================
   DATOS
================================ */
$titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
$resumen = mysqli_real_escape_string($conexion, $_POST['resumen']);
$comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);
$tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);

$destacado = isset($_POST['destacado']) ? 1 : 0;
$activo = 1;

$fechaPublicacion = date('Y-m-d');
$fechaHora = date('Y-m-d H:i:s');
$fechaFin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;

/* ===============================
   IMAGEN
================================ */
$rutaImagen = null;

if (!empty($_FILES['imagen']['name'])) {

    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
        header("Location: InicioAdministrador.php?msg=error");
        exit;
    }

    $carpeta = "publicacion/";
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $nombreImagen = 'pub_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

    $rutaImagen = $carpeta . $nombreImagen;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        header("Location: InicioAdministrador.php?msg=error");
        exit;
    }
}

/* ===============================
   INSERT
================================ */
$sql = "
INSERT INTO blog (
    Id_Administrador,
    Titulo,
    Resumen,
    Comentario,
    Imagen,
    Tipo,
    Activo,
    Destacado,
    FechaPublicacion,
    FechaFin,
    FechaHora
) VALUES (
    $idAdministrador,
    '$titulo',
    '$resumen',
    '$comentario',
    " . ($rutaImagen ? "'$rutaImagen'" : "NULL") . ",
    '$tipo',
    $activo,
    $destacado,
    '$fechaPublicacion',
    " . ($fechaFin ? "'$fechaFin'" : "NULL") . ",
    '$fechaHora'
)
";

if (mysqli_query($conexion, $sql)) {
    header("Location: InicioAdministrador.php?msg=creado");
    exit;
} else {
    header("Location: InicioAdministrador.php?msg=error");
    exit;
}
