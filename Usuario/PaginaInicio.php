<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/Estilos.css?v=<?php echo time(); ?>">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar">
            <div class="container">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img class="LogoMenu me-2" src="../Img/Logo.svg" height="40">
                </a>

                <!-- BOTON HAMBURGUESA -->
                <button class="navbar-toggler" type="button" data-mdb-collapse-init
                    data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars Hamburguesa"></i>
                </button>

                <!-- CONTENIDO -->
                <div class="collapse navbar-collapse" id="navbarButtonsExample">

                    <!-- MENÚ CENTRADO -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4 text-center">
                        <li class="nav-item">
                            <a class="nav-link LetraMenu active" href="PaginaInicio.Html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link LetraMenu" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link LetraMenu" href="#">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link LetraMenu" href="#">Contactos</a>
                        </li>
                    </ul>

                    <!-- BOTÓN DERECHA -->
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <a href="Usuario.php" class="btn btn-login d-flex align-items-center gap-2">
                            <i class="fas fa-user"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    </div>

                </div>
            </div>
        </nav>
        <!-- Navbar -->
         
        <!-- Background image -->
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-white TextoBanner text-start" data-mdb-theme="dark">

                                <h2 class="mb-3">Tu momento de paz comienza aquí</h2>
                                <h5 class="mb-4">
                                    Sumérgete en un espacio de calma, belleza y bienestar — creado especialmente para
                                    ti.
                                </h5>
                                <a class="Btn-Banner btn-Estilo1 btn-lg me-2" href="#">
                                    Reserva Aquí
                                </a>
                                <a class="Btn-Banner btn-Estilo2 btn-lg" href="#">
                                    Explorar Servicios
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background image -->
    </header>
    <!--Main Navigation-->


    <div class="container SeccionCard">
        <div class="card mb-3 CardMover" style="max-width: 800px;">
            <div class="row g-0">

                <!-- Imagen -->
                <div class="col-12 col-md-6 CardImg">
                </div>


                <!-- Texto -->
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="card-body CardText">
                        <h3 class="card-title">
                            Descubre el verdadero equilibrio en <b>Lotus Splendor</b>
                        </h3>
                        <div class="TextoCardG">
                            <p class="card-text">
                                En Lotus Splendror creemos que la belleza florece desde el equilibrio.
                                Nuestro centro combina estética avanzada y bienestar integral,
                                ofreciendo tratamientos personalizados, faciales, masajes y mucho más.
                                <br>
                                Renueva tu cuerpo, mente y piel en un entorno de armonía y confianza.
                                Haz del autocuidado una experiencia transformadora.
                            </p>
                        </div>
                        <a href="#" class="BtnCard">Conoce más</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <br>


    <!-- Background image -->

    <div class="FondoCards">

        <div class="container TitulosGrandes">
            <h5>Servicios</h5>
            <h3>Belleza y <b>Bienestar,</b> En Equilibrio.</h3>
            <h5>Tratamientos diseñados para cuidar de ti, por dentro y por fuera. Tu piel, tu cuerpo y tu mente en
                perfecta
                armonía.</h5>
        </div>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <div class="container my-5">
            <div class="row g-4 justify-content-center">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 ImgCards">
                        <img src="../Img/ImgCard1.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cuidado de Uñas</h5>
                            <p class="card-text">Manicure & Pedicure exclusivo</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 ImgCards">
                        <img src="../Img/ImgCard2.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cuidado Facial</h5>
                            <p class="card-text">Facial Radiante y Luminoso</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 ImgCards">
                        <img src="../Img/ImgCard3.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cuerpo & Bienestar</h5>
                            <p class="card-text">Masaje con Aromaterapia</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 ImgCards">
                        <img src="../Img/ImgCard4.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cuerpo & Bienestar</h5>
                            <p class="card-text">Masaje con Aromaterapia</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>





    <div class="container SeccionContactos">
        <div class="Contactos">
            <h5>¿Tienes alguna duda?</h5>
            <h1>HABLA CON NOSOTROS</h1>
            <p>No pierdas más tiempo y ponte en contacto con nuestro equipo de especialistas. Será un placer ayudarte.
            </p>
            <div class="BtnContactos">
                <a href="#" class="btn-Cell"> <i class="fa-brands fa-whatsapp"></i> (00) 0000-0000 </a>
                <a href="#" class="btn-Cell"> <i class="fa-solid fa-phone-volume"></i> (00) 0000-0000 </a>
                <a href="#" class="btnCorreo"> <i class="fa-solid fa-envelope"></i> contato@buenobeauty.com </a>
            </div>
        </div>
        <div class="Correo">
            <h4>Formulário de Contacto</h4>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Nome completo" required>
                </div>
                <div class="form-row">
                    <input type="text" placeholder="Celular/Whatsapp" required>
                    <input type="email" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                    <textarea placeholder="Mensagem" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Enviar Mensagem »</button>
            </form>
        </div>
    </div>





    <footer class="footer">
        <div class="container ContenedorFooter">

            <div class="footer-container">
                <!-- Columna 1 -->
                <div class="footer-col">
                    <h2 class="TextFooter"> Lotus Splendor</h2>
                    <p>
                        En Lotus Splendor cuidamos de ti con tratamientos personalizados y un
                        ambiente pensado para tu bienestar.
                    </p>
                </div>

                <!-- Columna 2 -->
                <div class="footer-col">
                    <h3>Empresa</h3>
                    <ul>
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Servicios</a></li>
                    </ul>
                </div>

                <!-- Columna 3 -->
                <div class="footer-col">
                    <h3>Servicios</h3>
                    <ul>
                        <li><a href="#">Cuidado de uñas</a></li>
                        <li><a href="#">Cuidado facial</a></li>
                        <li><a href="#">Cuerpo & Bienestar</a></li>
                        <li><a href="#">Tratamiento corporal</a></li>
                    </ul>
                </div>

                <!-- Columna 4 -->
                <div class="footer-col">
                    <h3>Contacto</h3>
                    <ul>
                        <li><a href="#">Habla con nosotros</a></li>
                        <li><a href="#">Agendar cita</a></li>
                        <li><i class="fa-solid fa-phone-volume"></i> (00) 0000-0000</li>
                        <li><i class="fa-brands fa-whatsapp"></i> (00) 0000-0000</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Línea inferior -->
        <div class="footer-bottom">
            Lotus Splendor © Todos los derechos reservados
        </div>
    </footer>














    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js">
    </script>

    <script>
        // Initialization for ES Users
        import { Collapse, Ripple, initMDB } from "mdb-ui-kit";

        initMDB({ Collapse, Ripple });
    </script>

</body>

</html>