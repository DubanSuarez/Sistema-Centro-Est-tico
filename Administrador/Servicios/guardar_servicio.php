<?php
require_once('../../Conexiones/conexion.php');

/* ====== ID ADMINISTRADOR FIJO ====== */
$id_admin = 1; // ID real en la tabla administrador

/* ====== DATOS ====== */
$nombre    = trim($_POST['Nombre'] ?? '');
$duracion  = (int) ($_POST['Duracion'] ?? 0);
$costo     = (float) ($_POST['Costo'] ?? 0);
$descuento = (int) ($_POST['Descuento'] ?? 0);
$tipo      = $_POST['TipoServicio'] ?? '';
$desc      = trim($_POST['Descripcion'] ?? '');

/* ====== VALIDACIONES ====== */
if ($nombre === '' || $duracion <= 0 || $costo <= 0 || $tipo === '') {
  echo "
    <script>
      alert('⚠️ Datos incompletos');
      window.history.back();
    </script>
  ";
  exit();
}

/* ====== CÁLCULO ====== */
$valor = $costo - ($costo * $descuento / 100);

/* ====== FOTO ====== */
$foto = 'default.png';

if (!empty($_FILES['Foto']['name'])) {

  $extension = strtolower(pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION));
  $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

  if (!in_array($extension, $permitidas)) {
    echo "
      <script>
        alert('❌ Formato de imagen no permitido');
        window.history.back();
      </script>
    ";
    exit();
  }

  $foto = uniqid('serv_') . '.' . $extension;
  $ruta_destino = __DIR__ . '/../../Img/Servicios/' . $foto;

  if (!move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta_destino)) {
    echo "
      <script>
        alert('❌ Error al subir la imagen');
        window.history.back();
      </script>
    ";
    exit();
  }
}

/* ====== INSERT ====== */
$sql = "INSERT INTO servicio
(Id_Administrador, Nombre, Duracion, Costo, Descuento, Valor, Descripcion, Foto, TipoServicio)
VALUES
(1,'$nombre','$duracion','$costo','$descuento','$valor','$desc','$foto','$tipo')";

/* ====== RESULTADO (NO ES ADORNO) ====== */
if (mysqli_query($conexion, $sql)) {
  echo "
    <script>
      alert('✅ Servicio guardado correctamente');
      window.location.href = 'Servicios.php';
    </script>
  ";
} else {
  echo "
    <script>
      alert('❌ Error al guardar el servicio');
      window.history.back();
    </script>
  ";
}
