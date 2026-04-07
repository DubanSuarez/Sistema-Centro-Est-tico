<?php
session_start();
require_once('../Conexiones/conexion.php');
session_destroy();
header('Location: Usuario.php');
?>