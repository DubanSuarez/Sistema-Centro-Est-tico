<?php
require_once('../../Conexiones/conexion.php');

/* ====== ID ====== */
$id = $_GET['id'] ?? 0;

if ($id <= 0) {
  echo "
    <script>
      alert('❌ Servicio inválido');
      window.location.href = 'Servicios.php';
    </script>
  ";
  exit();
}

/* ====== OBTENER FOTO ====== */
$sql_foto = "SELECT Foto FROM servicio WHERE Id = $id";
$res = mysqli_query($conexion, $sql_foto);

if (!$res || mysqli_num_rows($res) == 0) {
  echo "
    <script>
      alert('❌ El servicio no existe');
      window.location.href = 'Servicios.php';
    </script>
  ";
  exit();
}

$fila = mysqli_fetch_assoc($res);
$foto = $fila['Foto'];

/* ====== ELIMINAR REGISTRO ====== */
$sql_delete = "DELETE FROM servicio WHERE Id = $id";

if (mysqli_query($conexion, $sql_delete)) {

  // eliminar imagen si no es default
  if (!empty($foto) && $foto !== 'default.png') {
    $ruta = __DIR__ . '/../../Img/Servicios/' . $foto;
    if (file_exists($ruta)) {
      unlink($ruta);
    }
  }

  echo "
    <script>
      alert('🗑️ Servicio eliminado correctamente');
      window.location.href = 'Servicios.php';
    </script>
  ";
} else {
  echo "
    <script>
      alert('❌ Error al eliminar el servicio');
      window.location.href = 'Servicios.php';
    </script>
  ";
}
