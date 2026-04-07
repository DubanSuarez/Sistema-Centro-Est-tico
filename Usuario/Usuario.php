<?php
session_start();
require_once('../Conexiones/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> Lotus Splendor </title>
  <link rel="stylesheet" href="../Css/Estilos2025.css?v=<?php echo time(); ?>">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">
      <img class="LogoMenu" src="../Img/Logo.svg">
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars Hamburguesa"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <ul class="navbar-nav BarraMenu mx-auto mb-2 mb-lg-0 gap-3">
          <li class="nav-item">
            <a class="nav-link LetraMenu" href="PaginaInicio.php"> Inicio </a>
          </li>
          <li class="nav-item">
            <a class="nav-link LetraMenu" href="#"> Servicios </a>
          </li>
          <li class="nav-item">
            <a class="nav-link LetraMenu" href="#"> Nosotros </a>
          </li>
          <li class="nav-item">
            <a class="nav-link LetraMenu" href="#"> Contactos </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>





  <!-- Seccion Login -->

  <section class="view">

    <!-- Content -->
    <div class="container">
      <div class="row">


        <!--Grid column-->
        <div class="col-xl-6 col-md-6 col-sm-12 col-xl-5 CajaInfoLS">
          <img class="LogoLS" src="../img/LogoLotusSplendo.svg">
          <h1 class="TituloLogo">
            Lotus Splendor
          </h1>
          <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
          <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">
            Somos un grupo de profesionales en el área de la salud y la belleza, desarrollamos e implementamos
            experiencias innovadoras que generan beneficio y bienestar
            para nuestros clientes.</h6>
        </div>
        <!--Grid column-->




        <!--Grid column-->
        <div class="col-xl-6 col-md-6 col-sm-12 col-xl-5  CajaLogin">
          <!--Form-->
          <div class="CardInfo">
            <div class="card-body">
              <!--Header-->
              <div class="text-center TituloForm">
                <h3 class="white-text mb-4 mt-2">
                  <i class="fa fa-user white-text"></i>
                  Iniciar sesión
                </h3>
                <hr class="hr-light">
              </div>
              <!--Body-->
              <form method="post" action="validalogin.php">
                <div class="md-form">

                  <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" id="inputEmail3" placeholder="Correo@electronico" name="txtusr"
                      aria-describedby="emailHelp" required>
                  </div>

                  <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="txtpwd" placeholder="Password" required="">
                  </div>



                  <div class="text-center mt-4">
                    <div class="d-flex justify-content-around TextoRegistro">
                      <!-- Forgot password -->
                      <a href="RecuperarContrasena.php" class="white-text"> ¿Se te olvidó tu contraseña? </a>
                      <p>
                        <a href="Form_Registro.php" class="white-text"> Registrarse </a>
                      </p>
                    </div>
                    <!-- Sign in button -->
                    <button class="btn colorEn btn-block my-3" type="submit" name="Ingresar"> Ingresar </button>
                    <!-- Register -->
                    <?php
                    if (isset($_SESSION["Error"])) {
                      $error = $_SESSION["Error"];
                      echo "<span>$error</span>";
                    }
                    ?>
                    <hr class="hr-light mb-4 mt-4">
              </form>
            </div>
          </div>
        </div>
        <!--/.Form-->
      </div>
    </div>

  </section>



  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js">
  </script>

  <script>
    // Initialization for ES Users
    import { Collapse, Ripple, initMDB } from "mdb-ui-kit";

    initMDB({ Collapse, Ripple });
  </script>


  <script>
    new WOW().init();
  </script>

</body>

</html>
<?php
unset($_SESSION["Error"]);
?>