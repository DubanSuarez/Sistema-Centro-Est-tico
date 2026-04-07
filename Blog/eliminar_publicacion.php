<?php
session_start();
require_once('../Conexiones/conexion.php');

/* ===============================
   VALIDAR ADMIN
================================ */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    die("Acceso no autorizado");
}

$id = intval($_GET['id']);

/* ===============================
   OBTENER IMAGEN
================================ */
$res = mysqli_query($conexion, "SELECT Imagen FROM blog WHERE Id = $id");
$img = mysqli_fetch_assoc($res);

if ($img && !empty($img['Imagen']) && file_exists($img['Imagen'])) {
    unlink($img['Imagen']); // eliminar imagen física
}

/* ===============================
   DELETE
================================ */
$sql = "DELETE FROM blog WHERE Id = $id";

if (mysqli_query($conexion, $sql)) {
    header("Location: InicioAdministrador.php?msg=eliminado");
    exit;
} else {
    header("Location: InicioAdministrador.php?msg=error");
    exit;
}
