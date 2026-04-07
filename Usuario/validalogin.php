<?php
session_start();
require_once('../Conexiones/conexion.php');

if (isset($_POST['txtusr'])) {

	$txtusuario = addslashes($_POST['txtusr']);
	$txtcontra = addslashes($_POST['txtpwd']);

	$consulta="select * from usuario where Usuario='".$txtusuario."' and Contrasena=BINARY'".$txtcontra."' and Estado=1 ";


	$sql=mysqli_query($conexion, $consulta);
	$res=mysqli_fetch_assoc($sql);
	$num=mysqli_num_rows($sql);

	$_SESSION['id']=$res['Id'];
	$_SESSION['nombre']=$res['NombreUsuario'];
	$_SESSION['foto']=$res['Foto'];
	$_SESSION['email']=$res['Usuario'];
	$_SESSION['contra']=$res['Contrasena'];
	$_SESSION['rol']=$res['IdRol'];


	$rol = $res['IdRol'];


	if ($num!=0) {

		if($rol == 1) { 
			header('location: ../Blog/InicioEspecialista.php'); 
		} if($rol == 2) { 
			header('location: ../Blog/InicioSecretaria.php'); 
		}if($rol == 3){
			header('location: ../Blog/InicioAdministrador.php');
		}if($rol == 4){
			header('location: ../Blog/InicioPaciente.php');
		}

	}
	else{
		$_SESSION['Error']="Error de usuario y contraseña";
		header('Location: Usuario.php');
	}

}
?>