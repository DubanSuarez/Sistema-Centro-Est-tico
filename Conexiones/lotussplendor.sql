-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2026 a las 20:25:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lotussplendor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Genero` varchar(250) NOT NULL,
  `NumeroTelefono` varchar(255) NOT NULL,
  `NumeroDocumento` varchar(255) NOT NULL,
  `FechaNacimiento` varchar(250) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `EstadoCivil` varchar(255) NOT NULL,
  `Ocupacion` varchar(255) NOT NULL,
  `Enfermedad` varchar(255) NOT NULL,
  `Estatura` varchar(255) NOT NULL,
  `Peso` varchar(255) NOT NULL,
  `Foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Id`, `Id_Usuario`, `Nombre`, `Apellido`, `Genero`, `NumeroTelefono`, `NumeroDocumento`, `FechaNacimiento`, `Direccion`, `EstadoCivil`, `Ocupacion`, `Enfermedad`, `Estatura`, `Peso`, `Foto`) VALUES
(1, 6, 'Duban', 'Suarez', 'Masculino', '3114772542', '1193577504', '2001-11-19', 'Mazana D casa 13 - San Francisco', 'Soltero', 'Ingeniero de Sistemas', 'Ninguna', '1.65', '61', 'admin_6_1771362295.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `Id` int(11) NOT NULL,
  `Id_Administrador` int(11) NOT NULL,
  `Titulo` varchar(250) NOT NULL,
  `Resumen` varchar(255) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  `Imagen` varchar(250) NOT NULL,
  `Tipo` varchar(255) NOT NULL,
  `Activo` varchar(255) NOT NULL,
  `Destacado` varchar(255) NOT NULL,
  `FechaPublicacion` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `FechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`Id`, `Id_Administrador`, `Titulo`, `Resumen`, `Comentario`, `Imagen`, `Tipo`, `Activo`, `Destacado`, `FechaPublicacion`, `FechaFin`, `FechaHora`) VALUES
(1, 1, 'Limpieza facial profunda: renueva tu piel', 'Elimina impurezas y luce una piel fresca, hidratada y saludable.', 'La limpieza facial profunda es un tratamiento esencial para mantener la piel libre de impurezas, células muertas y exceso de grasa. Este procedimiento ayuda a prevenir el acné, mejorar la textura de la piel y darle un aspecto más luminoso.\r\n\r\nEn nuestro c', 'publicacion/pub_1773769476_1985.jpg', 'NOTICIA', '1', '0', '0000-00-00', NULL, '2026-03-17 18:41:43'),
(4, 1, 'Masajes relajantes para cuerpo y mente', 'Libera el estrés y mejora tu bienestar con nuestros masajes especializados.', 'Nuestros masajes relajantes están diseñados para aliviar tensiones musculares, mejorar la circulación y brindarte una experiencia de relajación total.\r\n\r\nContamos con diferentes técnicas adaptadas a tus necesidades, creando un ambiente tranquilo y armonio', 'publicacion/pub_1773770179_7576.jpg', 'NOTICIA', '1', '0', '2026-03-17', NULL, '2026-03-17 18:56:19'),
(5, 1, '30% OFF en masajes relajantes – ¡Desconéctate del estrés!', 'Relájate y renueva tu energía con un 30% de descuento en masajes.', 'Disfruta de un 30% de descuento en nuestros masajes relajantes y regálate un momento de bienestar total. Este tratamiento ayuda a aliviar tensiones musculares, reducir el estrés y mejorar la circulación.\r\n\r\nContamos con un ambiente tranquilo y profesional', 'publicacion/pub_1773770612_6626.jpg', 'DESCUENTO', '1', '1', '2026-03-17', '2026-03-26', '2026-03-17 19:03:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Id` int(11) NOT NULL,
  `Id_ServicioEspecialista` int(11) NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `Estado` varchar(11) DEFAULT NULL,
  `Facturar` varchar(11) DEFAULT NULL,
  `Precio` varchar(20) NOT NULL,
  `Descuento` varchar(250) NOT NULL,
  `ValorTotal` varchar(255) NOT NULL,
  `Servicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`Id`, `Id_ServicioEspecialista`, `Id_Paciente`, `Fecha`, `HoraInicio`, `HoraFin`, `Estado`, `Facturar`, `Precio`, `Descuento`, `ValorTotal`, `Servicio`) VALUES
(1, 1, 1, '2025-09-17', '10:00:00', '11:00:00', '0', '0', '0', '', '', ''),
(2, 2, 1, '2025-09-18', '16:30:00', '18:00:00', '0', '0', '0', '', '', ''),
(6, 2, 1, '2026-01-10', '10:30:00', '12:00:00', '0', '0', '0', '', '', ''),
(7, 3, 1, '2026-01-09', '16:30:00', '17:50:00', '0', '0', '0', '', '', ''),
(8, 5, 1, '2026-01-09', '18:00:00', '19:00:00', '0', '0', '0', '', '', ''),
(9, 1, 2, '2026-01-12', '09:00:00', '10:00:00', '0', '0', '0', '', '', ''),
(10, 2, 2, '2026-01-20', '11:00:00', '12:00:00', '0', '0', '0', '', '', ''),
(11, 3, 2, '2026-02-01', '15:00:00', '16:00:00', '0', '0', '0', '', '', ''),
(12, 2, 3, '2026-01-13', '10:00:00', '11:00:00', '0', '0', '0', '', '', ''),
(13, 4, 3, '2026-01-22', '14:00:00', '15:00:00', '0', '0', '0', '', '', ''),
(14, 5, 3, '2026-02-05', '16:00:00', '17:00:00', '0', '0', '0', '', '', ''),
(15, 3, 4, '2026-01-14', '09:30:00', '10:30:00', '0', '0', '0', '', '', ''),
(16, 1, 4, '2026-01-25', '13:00:00', '14:00:00', '0', '0', '0', '', '', ''),
(17, 6, 4, '2026-02-08', '17:00:00', '18:00:00', '0', '0', '0', '', '', ''),
(18, 4, 5, '2026-01-15', '08:00:00', '09:00:00', '0', '0', '0', '', '', ''),
(19, 5, 5, '2026-01-27', '12:00:00', '13:00:00', '0', '0', '0', '', '', ''),
(20, 2, 5, '2026-02-17', '18:00:00', '19:00:00', 'FACTURADA', '0', '80000', '0', '80000', 'Limpieza Facial'),
(21, 6, 1, '2026-02-17', '17:00:00', '18:00:00', 'FACTURADA', '0', '80000', '10', '-720000', 'Limpieza Facial'),
(22, 2, 1, '2026-02-17', '14:00:00', '15:30:00', 'FACTURADA', '0', '90000', '15', '-1260000', 'Consulta Nutricional'),
(23, 2, 1, '2026-03-08', '15:30:00', '17:00:00', 'PENDIENTE', '0', '90000', '15', '-1260000', 'Consulta Nutricional'),
(24, 5, 2, '2026-03-06', '16:30:00', '17:30:00', 'CANCELADA', '0', '110000', '15', '110000', 'Microdermoabrasión'),
(25, 15, 3, '2026-03-17', '14:30:00', '15:30:00', 'FACTURADA', '0', '120000', '10', '120000', 'Peeling Químico'),
(26, 8, 4, '2026-03-28', '10:30:00', '11:00:00', 'CANCELADA', '0', '100000', '10', '100000', 'Consulta Dermatológica'),
(27, 17, 6, '2026-03-29', '17:30:00', '18:30:00', 'EN_PROCESO', '0', '110000', '15', '110000', 'Microdermoabrasión'),
(28, 11, 2, '2026-03-28', '15:30:00', '16:30:00', 'EN_PROCESO', '0', '50000', '0', '50000', 'Depilación con Cera'),
(29, 4, 4, '2026-03-06', '09:00:00', '11:00:00', 'PENDIENTE', '0', '70000', '10', '70000', 'Masaje Descontracturante'),
(30, 3, 6, '2026-03-08', '15:30:00', '16:50:00', 'FACTURADA', '0', '150000', '20', '150000', 'Tratamiento Antiedad'),
(31, 13, 2, '2026-03-23', '15:00:00', '17:00:00', 'CANCELADA', '0', '85000', '50', '85000', 'Exfoliación Corporal'),
(32, 14, 4, '2026-03-23', '09:30:00', '11:30:00', 'PENDIENTE', '0', '85000', '50', '85000', 'Exfoliación Corporal'),
(33, 11, 6, '2026-03-26', '10:30:00', '11:30:00', 'ATENDIDA', '0', '50000', '0', '50000', 'Depilación con Cera'),
(34, 12, 2, '2026-03-12', '09:30:00', '10:30:00', 'PENDIENTE', '0', '50000', '0', '50000', 'Depilación con Cera'),
(35, 2, 5, '2026-03-21', '09:00:00', '10:30:00', 'EN_PROCESO', '0', '90000', '15', '-1260000', 'Consulta Nutricional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratopersona`
--

CREATE TABLE `contratopersona` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellido` varchar(80) NOT NULL,
  `NumeroDocumento` varchar(15) NOT NULL,
  `FechaContrato` date NOT NULL,
  `ValorPago` varchar(20) NOT NULL,
  `FormaPago` varchar(50) NOT NULL,
  `HoraInicial` varchar(15) NOT NULL,
  `HoraFinal` varchar(15) NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `NumeroTelefono` varchar(15) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Especialidad` varchar(100) NOT NULL,
  `TelefonoFamiliar` varchar(15) NOT NULL,
  `EstadoCivil` varchar(20) NOT NULL,
  `Enfermedad` varchar(50) NOT NULL,
  `Foto` varchar(250) NOT NULL,
  `EstadoContrato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `contratopersona`
--

INSERT INTO `contratopersona` (`Id`, `Id_Usuario`, `Rol`, `Nombre`, `Apellido`, `NumeroDocumento`, `FechaContrato`, `ValorPago`, `FormaPago`, `HoraInicial`, `HoraFinal`, `Genero`, `NumeroTelefono`, `FechaNacimiento`, `Direccion`, `Especialidad`, `TelefonoFamiliar`, `EstadoCivil`, `Enfermedad`, `Foto`, `EstadoContrato`) VALUES
(1, 1, 'Especialista', 'Ana', 'Ramírez', '2011111111', '2025-01-01', '3000000', 'Transferencia', '08:00:00', '17:00:00', 'Femenino', '3111111111', '1980-02-10', 'Carrera 1', '', '3201111111', 'Soltero(a)', 'Ninguna', '', '1'),
(2, 2, 'Especialista', 'Andrés', 'Torres', '2022222222', '2025-02-01', '2000000', 'Efectivo', '09:00:00', '18:00:00', 'Masculino', '3222222222', '1985-06-20', 'Carrera 2', 'Dermatología', '3302222222', 'Soltero', 'Ninguna', 'especialista_2.jpg', '1'),
(3, 3, 'Especialista', 'Laura', 'Méndez', '2033333333', '2025-03-01', '2200000', 'Transferencia', '08:30:00', '16:30:00', 'Femenino', '3333333333', '1988-09-15', 'Carrera 3', 'Estética', '3403333333', 'Casada', 'Ninguna', '', '1'),
(4, 4, 'Especialista', 'Paola', 'Suárez', '2044444444', '2025-04-01', '1500000', 'Efectivo', '07:00:00', '15:00:00', 'Femenino', '3444444444', '1990-12-25', 'Carrera 4', 'Administración', '3504444444', 'Soltera', 'Ninguna', '', '1'),
(5, 5, 'Especialista', 'Diego', 'Cruz', '2055555555', '2025-05-01', '2100000', 'Transferencia', '10:00:00', '19:00:00', 'Masculino', '3555555555', '1982-04-12', 'Carrera 5', 'Nutrición', '3605555555', 'Casado', 'Ninguna', '', '1'),
(6, 11, 'Secretaria', 'Paula', 'Camacho', '1236549870', '2026-02-17', '1800000', 'Transferencia', '08:00', '15:30', 'Femenino', '3115468821', '1996-02-27', 'Cr 15 #26-32', 'Servicio al Cliente', '312648755', 'Soltero(a)', 'Ninguna', 'especialista_11.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `Id` int(11) NOT NULL,
  `Id_Factura` int(11) NOT NULL,
  `Id_Cita` int(11) NOT NULL,
  `Precio` varchar(250) NOT NULL,
  `Cantidad` varchar(255) NOT NULL,
  `Total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`Id`, `Id_Factura`, `Id_Cita`, `Precio`, `Cantidad`, `Total`) VALUES
(1, 1, 21, '80000', '1', '72000'),
(2, 1, 22, '90000', '1', '76500'),
(3, 2, 25, '120000', '1', '108000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `Id` int(11) NOT NULL,
  `Id_Especialista` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_final` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  `Observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`Id`, `Id_Especialista`, `fecha`, `hora_inicio`, `hora_final`, `estado`, `Observaciones`) VALUES
(1, 1, '2025-09-17', '08:00', '12:00', 0, NULL),
(2, 1, '2025-09-17', '14:00', '18:00', 0, NULL),
(3, 2, '2025-09-17', '08:00', '12:00', 0, NULL),
(4, 2, '2025-09-17', '14:00', '18:00', 0, NULL),
(5, 3, '2025-09-18', '08:00', '12:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `Id` int(11) NOT NULL,
  `numero_factura` varchar(255) NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `FechaHora` datetime NOT NULL,
  `Subtotal` varchar(255) NOT NULL,
  `Descuento` varchar(255) NOT NULL,
  `Total` varchar(255) NOT NULL,
  `Metodo_Pago` varchar(255) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Usuario_Crea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`Id`, `numero_factura`, `Id_Paciente`, `FechaHora`, `Subtotal`, `Descuento`, `Total`, `Metodo_Pago`, `Estado`, `Usuario_Crea`) VALUES
(1, 'FAC-20260217235025', 1, '2026-02-17 17:50:25', '170000', '21500', '148500', 'EFECTIVO', 'PAGADA', 11),
(2, 'FAC-20260317194627', 3, '2026-03-17 13:46:27', '120000', '12000', '108000', 'TRANSFERENCIA', 'PAGADA', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico`
--

CREATE TABLE `historial_clinico` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `Estatura` varchar(255) NOT NULL,
  `Peso` varchar(255) NOT NULL,
  `alergias` text DEFAULT NULL,
  `enfermedades` text DEFAULT NULL,
  `medicamentos` text DEFAULT NULL,
  `antecedentes_relevantes` text DEFAULT NULL,
  `embarazo_lactancia` enum('SI','NO','NO APLICA') DEFAULT 'NO APLICA',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `historial_clinico`
--

INSERT INTO `historial_clinico` (`id`, `id_paciente`, `Estatura`, `Peso`, `alergias`, `enfermedades`, `medicamentos`, `antecedentes_relevantes`, `embarazo_lactancia`, `created_at`, `updated_at`) VALUES
(1, 1, '1.76', '68', 'Ninguna', 'Ninguna', 'Ninguno', 'Sin antecedentes relevantes', 'NO', '2026-01-09 16:15:45', '2026-02-17 17:46:54'),
(2, 2, '', '', 'Penicilina', 'Asma', 'Inhalador', 'Asma desde la infancia', 'NO', '2026-01-09 16:15:45', '2026-01-09 16:15:45'),
(3, 3, '1.76', '68', 'Ninguna', 'Ninguna', 'Ninguno', 'Sin antecedentes relevantes', 'NO', '2026-01-09 16:15:45', '2026-03-17 13:44:59'),
(4, 4, '', '', 'Polen', 'Dermatitis', 'Antihistamínicos', 'Piel sensible', 'NO', '2026-01-09 16:15:45', '2026-01-09 16:15:45'),
(5, 5, '1.72', '72', 'Ninguna', 'Hipertensión leve', 'Losartán', 'Control médico periódico', 'NO', '2026-01-09 16:15:45', '2026-02-17 17:57:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellido` varchar(80) NOT NULL,
  `Genero` varchar(20) NOT NULL,
  `NumeroTelefono` varchar(15) NOT NULL,
  `NumeroDocumento` varchar(15) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `EstadoCivil` varchar(50) NOT NULL,
  `Ocupacion` text NOT NULL,
  `FechaRegistro` varchar(250) NOT NULL,
  `Foto` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`Id`, `Id_Usuario`, `Nombre`, `Apellido`, `Genero`, `NumeroTelefono`, `NumeroDocumento`, `FechaNacimiento`, `Direccion`, `EstadoCivil`, `Ocupacion`, `FechaRegistro`, `Foto`) VALUES
(1, 1, 'Juan Pablo', 'Amaya Acuña', 'Masculino', '3125632489', '102459357', '2001-08-03', 'Paraíso', 'Soltero', 'Ingeniero Civil', '', 'paciente_1.jpg'),
(2, 2, 'María', 'López', 'Femenino', '3002222222', '1022222222', '1992-07-20', 'Calle 2', 'Casada', 'Docente', '', 'maria.jpg'),
(3, 3, 'Carlos', 'García', 'Masculino', '3003333333', '1033333333', '1985-03-10', 'Calle 3', 'Soltero', 'Diseñador', '', 'carlos.jpg'),
(4, 4, 'Laura', 'Ramírez', 'Femenino', '3004444444', '1044444444', '1998-12-01', 'Calle 4', 'Soltera', 'Estudiante', '', 'laura.jpg'),
(5, 5, 'Pedro', 'Martínez', 'Masculino', '3005555555', '1055555555', '1995-09-09', 'Calle 5', 'Casado', 'Contador', '', 'pedro.jpg'),
(6, 12, 'Steven', 'Lopez Cardenas', 'Masculino', '321564889', '12023658974', '1999-02-17', 'Cr 15 #26-32', 'Casado', 'Arquitecto', '2026-02-17 17:52:58', '../../Paciente/Img/defaultPaciente.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id`, `Nombre`) VALUES
(1, 'Especialista'),
(2, 'Secretaria'),
(3, 'Administrador'),
(4, 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `Id` int(11) NOT NULL,
  `Id_Administrador` int(11) NOT NULL,
  `Nombre` varchar(225) NOT NULL,
  `Duracion` varchar(10) NOT NULL,
  `Costo` float NOT NULL,
  `Descuento` float NOT NULL,
  `Valor` float NOT NULL,
  `Descripcion` text NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `TipoServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`Id`, `Id_Administrador`, `Nombre`, `Duracion`, `Costo`, `Descuento`, `Valor`, `Descripcion`, `Foto`, `TipoServicio`) VALUES
(1, 1, 'Limpieza Facial', '60', 80000, 10, -720000, 'Tratamiento de limpieza facial profunda para piel grasa o mixta.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(2, 1, 'Masaje Relajante', '85', 60000, 50, -240000, 'Masaje corporal relajante con aromaterapia.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(3, 1, 'Consulta Nutricional', '90', 90000, 15, -1260000, 'Evaluación nutricional y plan de alimentación personalizado.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(4, 1, 'Peeling Químico', '60', 120000, 10, 120000, 'Exfoliación química para mejorar la textura de la piel.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(5, 1, 'Tratamiento Antiedad', '80', 150000, 20, 150000, 'Terapia rejuvenecedora para disminuir líneas de expresión.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(6, 1, 'Depilación con Cera', '60', 50000, 0, 50000, 'Depilación corporal con cera natural.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(7, 1, 'Masaje Descontracturante', '120', 70000, 10, 70000, 'Masaje profundo para aliviar contracturas musculares.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(8, 1, 'Exfoliación Corporal', '120', 85000, 50, 85000, 'Exfoliación completa del cuerpo con sales minerales.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(9, 1, 'Microdermoabrasión', '60', 110000, 15, 110000, 'Tratamiento estético para eliminar células muertas y cicatrices.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0),
(10, 1, 'Consulta Dermatológica', '30', 100000, 10, 100000, 'Revisión médica especializada para diagnóstico de la piel.', '????\0JFIF\0\0H\0H\0\0??XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ ?\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0??\0\0\0\0\0?-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0?\0\0\0lwtpt\0\0?\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0d', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicioespecialista`
--

CREATE TABLE `servicioespecialista` (
  `Id` int(11) NOT NULL,
  `Id_Servicio` int(11) NOT NULL,
  `Id_Especialista` int(11) NOT NULL,
  `Activo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `servicioespecialista`
--

INSERT INTO `servicioespecialista` (`Id`, `Id_Servicio`, `Id_Especialista`, `Activo`) VALUES
(1, 1, 1, '1'),
(2, 3, 2, '1'),
(3, 5, 3, '1'),
(4, 7, 4, '1'),
(5, 9, 5, '1'),
(6, 1, 2, '1'),
(7, 10, 4, '1'),
(8, 10, 5, '1'),
(9, 3, 1, '1'),
(10, 3, 5, '1'),
(11, 6, 2, '1'),
(12, 6, 3, '1'),
(13, 8, 1, '1'),
(14, 8, 3, '1'),
(15, 4, 2, '1'),
(16, 4, 4, '1'),
(17, 9, 3, '1'),
(18, 2, 2, '1'),
(19, 2, 4, '1'),
(20, 7, 5, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Usuario` varchar(80) NOT NULL,
  `Contrasena` varchar(50) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `IdRol`, `Usuario`, `Contrasena`, `Estado`) VALUES
(1, 4, 'Juanpa@gmail.com', '123', 1),
(2, 1, 'Andres@gmail.com', '123', 1),
(3, 4, 'mlopez@gmail.com\r\n', '654321', 1),
(4, 4, 'lolo@gmail.com\r\n', 'sec2025', 1),
(5, 4, 'cgarcia@gmail.com\r\n', 'pass789', 1),
(6, 3, 'duban@gmail.com', '123', 1),
(7, 2, 'atorres', 'esp123', 1),
(8, 2, 'lmendez', 'esp456', 1),
(9, 3, 'psuarez', 'sec789', 1),
(10, 2, 'dcruz', 'esp321', 1),
(11, 2, 'Pau@gmail.com', '123', 1),
(12, 4, 'Steven@gmail.com', '$2y$10$70tG3Mq5.5yBwoWu7wy91OrMZoJvXx8wlJuAzQ6PzYx', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion_estetica`
--

CREATE TABLE `valoracion_estetica` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `tipo_piel` varchar(50) DEFAULT NULL,
  `fototipo` varchar(20) DEFAULT NULL,
  `estado_piel` text DEFAULT NULL,
  `diagnostico_estetico` text DEFAULT NULL,
  `procedimiento_realizado` text DEFAULT NULL,
  `productos_utilizados` text DEFAULT NULL,
  `equipos_utilizados` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `reacciones` text DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `proxima_cita` date DEFAULT NULL,
  `estado` enum('ABIERTA','CERRADA') DEFAULT 'ABIERTA',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `valoracion_estetica`
--

INSERT INTO `valoracion_estetica` (`id`, `id_cita`, `id_especialista`, `id_servicio`, `fecha`, `tipo_piel`, `fototipo`, `estado_piel`, `diagnostico_estetico`, `procedimiento_realizado`, `productos_utilizados`, `equipos_utilizados`, `observaciones`, `reacciones`, `recomendaciones`, `proxima_cita`, `estado`, `created_at`, `updated_at`) VALUES
(16, 1, 1, 1, '2026-01-09 16:27:07', 'Mixta', 'III', 'Deshidratación en zona T', 'Piel deshidratada con leve sensibilidad', 'Limpieza facial profunda', 'Gel limpiador, mascarilla hidratante', 'Vapor ozono, espátula ultrasónica', 'Buena tolerancia al procedimiento', 'Sin reacciones adversas', 'Uso diario de protector solar', '2025-10-01', 'CERRADA', '2026-01-09 16:27:07', '2026-01-09 16:27:07'),
(17, 2, 2, 2, '2026-01-09 16:27:07', 'Grasa', 'IV', 'Poros dilatados y brillo excesivo', 'Acné leve', 'Limpieza profunda antiacné', 'Espuma seborreguladora, tónico calmante', 'Alta frecuencia', 'Se controló el sebo', 'Leve enrojecimiento', 'Evitar maquillaje por 24h', '2025-10-05', 'CERRADA', '2026-01-09 16:27:07', '2026-01-09 16:27:07'),
(18, 6, 3, 3, '2026-01-09 16:27:07', 'Seca', 'II', 'Manchas solares visibles', 'Hiperpigmentación leve', 'Peeling químico superficial', 'Ácido mandélico, crema regeneradora', 'Ninguno', 'Procedimiento exitoso', 'Ligera descamación', 'Hidratación constante', '2026-01-25', 'CERRADA', '2026-01-09 16:27:07', '2026-01-09 16:27:07'),
(19, 7, 4, 4, '2026-01-09 16:27:07', 'Mixta', 'III', 'Flacidez facial', 'Pérdida de elasticidad', 'Radiofrecuencia facial', 'Gel conductor reafirmante', 'Radiofrecuencia', 'Respuesta favorable', 'Sin reacciones', 'Sesiones mensuales', '2026-01-30', 'CERRADA', '2026-01-09 16:27:07', '2026-01-09 16:27:07'),
(20, 8, 5, 5, '2026-01-09 16:27:07', 'Normal', 'III', 'Piel opaca', 'Falta de luminosidad', 'Vitaminas faciales', 'Cóctel vitamínico', 'Dermapen', 'Piel más luminosa', 'Leve enrojecimiento', 'Uso de crema calmante', '2026-02-05', 'ABIERTA', '2026-01-09 16:27:07', '2026-01-09 16:27:07'),
(21, 9, 1, 6, '2026-01-09 16:29:05', 'Grasa', 'IV', 'Brillo excesivo', 'Exceso de sebo', 'Control seborregulador', 'Gel purificante', 'Alta frecuencia', 'Buena respuesta', 'Sin reacción', 'Limpieza diaria', '2026-01-25', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(22, 10, 2, 7, '2026-01-09 16:29:05', 'Mixta', 'III', 'Poros dilatados', 'Acné moderado', 'Limpieza profunda', 'Espuma antiacné', 'Vapor ozono', 'Procedimiento tolerado', 'Leve enrojecimiento', 'Evitar sol 48h', '2026-01-28', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(23, 11, 3, 8, '2026-01-09 16:29:05', 'Seca', 'II', 'Manchas postacné', 'Hiperpigmentación', 'Peeling suave', 'Ácido láctico', 'Ninguno', 'Descamación leve', 'Ligera resequedad', 'Uso de hidratante', '2026-02-01', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(24, 12, 4, 9, '2026-01-09 16:29:05', 'Sensible', 'II', 'Enrojecimiento', 'Rosácea leve', 'Tratamiento calmante', 'Gel calmante', 'Luz LED', 'Mejora visible', 'Sin reacción', 'Productos suaves', '2026-02-03', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(25, 13, 5, 10, '2026-01-09 16:29:05', 'Normal', 'III', 'Piel apagada', 'Falta de luminosidad', 'Oxigenoterapia', 'Suero revitalizante', 'Oxígeno facial', 'Piel más luminosa', 'Sin reacción', 'Uso de vitaminas', '2026-02-06', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(26, 14, 1, 1, '2026-01-09 16:29:05', 'Mixta', 'III', 'Deshidratación', 'Piel deshidratada', 'Hidratación profunda', 'Mascarilla hidratante', 'Vapor', 'Buena absorción', 'Sin reacción', 'Tomar más agua', '2026-02-08', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(27, 15, 2, 2, '2026-01-09 16:29:05', 'Normal', 'IV', 'Ojeras', 'Pigmentación oscura', 'Despigmnentación', 'Crema aclarante', 'Dermapen', 'Resultado progresivo', 'Leve ardor', 'Uso nocturno', '2026-02-10', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(28, 16, 3, 3, '2026-01-09 16:29:05', 'Mixta', 'III', 'Arrugas finas', 'Envejecimiento temprano', 'Rejuvenecimiento facial', 'Suero antiedad', 'Radiofrecuencia', 'Buena respuesta', 'Sin reacción', 'Sesiones mensuales', '2026-02-15', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(29, 17, 4, 4, '2026-01-09 16:29:05', 'Grasa', 'IV', 'Acné activo', 'Inflamación leve', 'Tratamiento antiacné', 'Gel antibacteriano', 'Alta frecuencia', 'Reducción inflamación', 'Leve enrojecimiento', 'Evitar manipulación', '2026-02-18', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(30, 18, 5, 5, '2026-01-09 16:29:05', 'Normal', 'III', 'Flacidez corporal', 'Pérdida de firmeza', 'Radiofrecuencia corporal', 'Gel reafirmante', 'Radiofrecuencia', 'Mejora visible', 'Sin reacción', 'Continuar sesiones', '2026-02-20', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(31, 19, 1, 6, '2026-01-09 16:29:05', 'Mixta', 'III', 'Celulitis leve', 'Textura irregular', 'Drenaje linfático', 'Aceite corporal', 'Vacumterapia', 'Buena tolerancia', 'Leve enrojecimiento', 'Beber agua', '2026-02-22', 'CERRADA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(32, 20, 2, 7, '2026-01-09 16:29:05', 'Seca', 'II', 'Estrías leves', 'Pérdida de elasticidad', 'Tratamiento regenerativo', 'Crema regeneradora', 'Dermapen', 'Proceso gradual', 'Leve sensibilidad', 'Uso continuo', '2026-02-25', 'ABIERTA', '2026-01-09 16:29:05', '2026-01-09 16:29:05'),
(33, 22, 2, 3, '2026-02-17 00:00:00', 'Grasa', 'IV', 'Rosácea', 'fdsfdsfdsf', 'dsfsdfdsfdsf', 'Vitamina C, Retinol', 'Radiofrecuencia, Ultrasonido', 'sdfdsfdsf', 'Ardor, Edema', 'dfdfdsfdsf', '2026-02-19', 'CERRADA', '2026-02-17 17:47:20', '2026-02-17 17:47:20'),
(34, 21, 2, 1, '2026-02-17 00:00:00', 'Mixta', 'IV', 'Rosácea', 'addfdfsdfds', 'fdsfdsfsdfsd', 'Vitamina C, Retinol', 'Luz pulsada', 'dfdsf', 'Ardor, Enrojecimiento', 'dsfdsfdsfsdfdsf', NULL, 'CERRADA', '2026-02-17 17:47:47', '2026-02-17 17:47:47'),
(37, 25, 2, 4, '2026-03-17 00:00:00', 'Seca', 'III', 'Rosácea', 'dasdas', 'dasdasdsa', 'Vitamina C, Retinol', 'Vacuum', 'asdasd', 'Ardor', 'asdasdsa', NULL, 'CERRADA', '2026-03-17 13:45:15', '2026-03-17 13:45:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Administrador` (`Id_Administrador`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Servicio` (`Id_ServicioEspecialista`),
  ADD KEY `Id_Paciente` (`Id_Paciente`);

--
-- Indices de la tabla `contratopersona`
--
ALTER TABLE `contratopersona`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Factura` (`Id_Factura`,`Id_Cita`),
  ADD KEY `Id_Cita` (`Id_Cita`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Especialista` (`Id_Especialista`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Administrador` (`Id_Administrador`);

--
-- Indices de la tabla `servicioespecialista`
--
ALTER TABLE `servicioespecialista`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Servicio` (`Id_Servicio`,`Id_Especialista`),
  ADD KEY `Id_Especialista` (`Id_Especialista`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `valoracion_estetica`
--
ALTER TABLE `valoracion_estetica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_cita` (`id_cita`),
  ADD KEY `fk_valoracion_especialista` (`id_especialista`),
  ADD KEY `fk_valoracion_servicio` (`id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `contratopersona`
--
ALTER TABLE `contratopersona`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `servicioespecialista`
--
ALTER TABLE `servicioespecialista`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `valoracion_estetica`
--
ALTER TABLE `valoracion_estetica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`Id_Administrador`) REFERENCES `administrador` (`Id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`Id_Paciente`) REFERENCES `paciente` (`Id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`Id_ServicioEspecialista`) REFERENCES `servicioespecialista` (`Id`);

--
-- Filtros para la tabla `contratopersona`
--
ALTER TABLE `contratopersona`
  ADD CONSTRAINT `contratopersona_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`Id_Cita`) REFERENCES `cita` (`Id`);

--
-- Filtros para la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`Id_Especialista`) REFERENCES `contratopersona` (`Id`);

--
-- Filtros para la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD CONSTRAINT `fk_historial_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`Id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`Id_Administrador`) REFERENCES `administrador` (`Id`);

--
-- Filtros para la tabla `servicioespecialista`
--
ALTER TABLE `servicioespecialista`
  ADD CONSTRAINT `servicioespecialista_ibfk_1` FOREIGN KEY (`Id_Especialista`) REFERENCES `contratopersona` (`Id`),
  ADD CONSTRAINT `servicioespecialista_ibfk_2` FOREIGN KEY (`Id_Servicio`) REFERENCES `servicio` (`Id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`Id`);

--
-- Filtros para la tabla `valoracion_estetica`
--
ALTER TABLE `valoracion_estetica`
  ADD CONSTRAINT `fk_valoracion_cita` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_valoracion_especialista` FOREIGN KEY (`id_especialista`) REFERENCES `contratopersona` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_valoracion_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
