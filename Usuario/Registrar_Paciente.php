<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../Conexiones/conexion.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Sanidad: verificar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Método no permitido');
}

// --- DATOS DE USUARIO ---
$Usuario    = $_POST['Usuario'] ?? '';
$Contrasena = $_POST['Contrasena'] ?? ''; // 🔴 Guardada en texto plano SOLO para pruebas
$Estado     = 1;                 // Activo
$IdRol      = 4;                 // Paciente
$Foto       = "imagenes/2.jpg";  // Por defecto

// --- DATOS DEL PACIENTE ---
$Nombre          = $_POST['Nombre'] ?? '';
$Apellido        = $_POST['Apellido'] ?? '';
$Genero          = $_POST['Genero'] ?? '';
$NumeroTelefono  = $_POST['NumeroTelefono'] ?? '';
$NumeroDocumento = $_POST['NumeroDocumento'] ?? '';
$FechaNacimiento = $_POST['FechaNacimiento'] ?? '';
$Direccion       = $_POST['Direccion'] ?? '';
$EstadoCivil     = $_POST['EstadoCivil'] ?? '';
$Ocupacion       = $_POST['Ocupacion'] ?? '';
$Enfermedad      = $_POST['Enfermedad'] ?? '';
$Estatura        = isset($_POST['Estatura']) && $_POST['Estatura'] !== '' ? (int)$_POST['Estatura'] : null;

// Construir NombreUsuario
$NombreUsuario = trim($Nombre . ' ' . $Apellido);

try {
  // ✅ Validar si el documento ya existe
  $sqlCheck = "SELECT COUNT(*) as total FROM paciente WHERE NumeroDocumento = ?";
  $stmtCheck = $conexion->prepare($sqlCheck);
  $stmtCheck->bind_param("s", $NumeroDocumento);
  $stmtCheck->execute();
  $result = $stmtCheck->get_result();
  $row = $result->fetch_assoc();

  if ($row['total'] > 0) {
    echo "
    <script>
      alert('⚠️ El número de documento ya está registrado');
      window.location.href = 'Form_Registro.php';
    </script>
    ";
    exit;
  }

  $conexion->begin_transaction();

  // USUARIO
  $sqlUsuario = "INSERT INTO usuario (Usuario, Contrasena, NombreUsuario, Foto, Estado, IdRol)
                 VALUES (?, ?, ?, ?, ?, ?)";
  $stmt1 = $conexion->prepare($sqlUsuario);
  $stmt1->bind_param("ssssii", $Usuario, $Contrasena, $NombreUsuario, $Foto, $Estado, $IdRol);
  $stmt1->execute();
  $IdUsuario = $conexion->insert_id;

  // PACIENTE
  $sqlPaciente = "INSERT INTO paciente
    (Id_Usuario, Nombre, Apellido, Genero, NumeroTelefono, NumeroDocumento, FechaNacimiento, Direccion, EstadoCivil, Ocupacion, Enfermedad, Estatura)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt2 = $conexion->prepare($sqlPaciente);
  $stmt2->bind_param(
    "issssssssssi",
    $IdUsuario,
    $Nombre,
    $Apellido,
    $Genero,
    $NumeroTelefono,
    $NumeroDocumento,
    $FechaNacimiento,
    $Direccion,
    $EstadoCivil,
    $Ocupacion,
    $Enfermedad,
    $Estatura
  );
  $stmt2->execute();

  $conexion->commit();

  // ✅ Mostrar modal de confirmación y redirigir
  echo "
  <script>
    alert('✅ Registro exitoso');
    window.location.href = 'Usuario.php';
  </script>
  ";

} catch (Throwable $e) {
  $conexion->rollback();
  http_response_code(500);
  echo "
  <script>
    alert('❌ Error en el registro: " . addslashes($e->getMessage()) . "');
    window.location.href = '../usuario.php';
  </script>
  ";
}
?>
