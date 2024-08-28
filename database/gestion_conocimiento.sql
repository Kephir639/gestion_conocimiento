-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2024 a las 15:54:14
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
-- Base de datos: `gestion_conocimiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`, `estado`, `updated_at`, `created_at`) VALUES
(2, 'Administrativo', 1, '2024-07-22 20:26:02', '2024-07-22 20:26:02'),
(3, 'Aprendiz', 0, '2024-07-22 20:26:14', '2024-07-22 20:26:14'),
(4, 'Dinamizador SENNOVA', 1, '2024-07-22 20:26:51', '2024-07-22 20:26:51'),
(5, 'Aprendiz', 0, '2024-07-22 20:28:30', '2024-07-22 20:28:30'),
(6, 'Dinamizador SENNOVA', 1, '2024-07-22 20:31:10', '2024-07-22 20:31:10'),
(10, 'Instructor', 1, '2024-07-31 19:34:30', '2024-07-31 19:34:30'),
(13, 'cdsc', 1, '2024-07-31 21:32:52', '2024-07-31 21:32:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_formacion`
--

CREATE TABLE `centro_formacion` (
  `id_centro` int(11) NOT NULL,
  `codigo_centro` varchar(25) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controladores`
--

CREATE TABLE `controladores` (
  `id_controlador` int(11) NOT NULL,
  `nombre_controlador` varchar(255) NOT NULL,
  `displayController` varchar(255) NOT NULL,
  `display_icon` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `controladores`
--

INSERT INTO `controladores` (`id_controlador`, `nombre_controlador`, `displayController`, `display_icon`) VALUES
(1, 'usuario_controller', 'usuario', ''),
(2, 'rol_controller', 'rol', ''),
(3, 'cargo_controller', 'cargo', ''),
(4, 'centro_controller', 'centro', ''),
(5, 'grupo_controller', 'grupo', ''),
(6, 'lineas_controller', 'lineas', ''),
(7, 'redes_controller', 'redes', ''),
(8, 'semillero_controller', 'semillero', ''),
(9, 'proyecto_controller', 'proyecto', ''),
(10, 'informe_controller', 'informe', ''),
(11, 'auditoria_controller', 'auditoria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(2) UNSIGNED NOT NULL,
  `departamento` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `departamento`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLÁNTICO'),
(11, 'BOGOTÁ, D.C.'),
(13, 'BOLÍVAR'),
(15, 'BOYACÁ'),
(17, 'CALDAS'),
(18, 'CAQUETÁ'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CÓRDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCÓ'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'NORTE DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(91, 'AMAZONAS'),
(94, 'GUAINÍA'),
(95, 'GUAVIARE'),
(97, 'VAUPÉS'),
(99, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_doctorado`
--

CREATE TABLE `detalle_doctorado` (
  `id_detalle_doctorado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_doctorado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_maestria`
--

CREATE TABLE `detalle_maestria` (
  `id_detalle_maestria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_maestria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_profesion`
--

CREATE TABLE `detalle_profesion` (
  `id_detalle_profesion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorados`
--

CREATE TABLE `doctorados` (
  `id_doctorado` int(11) NOT NULL,
  `nombre_doctorado` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `doctorados`
--

INSERT INTO `doctorados` (`id_doctorado`, `nombre_doctorado`) VALUES
(1, 'Doctorado en Administración'),
(2, 'Doctorado en Agroecología'),
(3, 'Doctorado en Arte y Arquitectura'),
(4, 'Doctorado en Biotecnología'),
(5, 'Doctorado en Ciencia y Tecnología de Alimentos'),
(6, 'Doctorado en Ciencias Agrarias - Entomología'),
(7, 'Doctorado en Ciencias Agrarias - Fisiología de Cultivos'),
(8, 'Doctorado en Ciencias Agrarias - Fitopatología'),
(9, 'Doctorado en Ciencias Agrarias - Genética y Fitomejoramiento'),
(10, 'Doctorado en Ciencias Agrarias - Gestión y Desarrollo Rural'),
(11, 'Doctorado en Ciencias Agrarias - Malherbología'),
(12, 'Doctorado en Ciencias Agrarias - Suelos y Aguas'),
(13, 'Doctorado en Ciencias Biomédicas'),
(14, 'Doctorado en Ciencias Económicas'),
(15, 'Doctorado en Ciencias Farmacéuticas'),
(16, 'Doctorado en Ciencias - Astronomía'),
(17, 'Doctorado en Ciencias - Biología'),
(18, 'Doctorado en Ciencias - Bioquímica'),
(19, 'Doctorado en Ciencias - Estadística'),
(20, 'Doctorado en Ciencias - Física'),
(21, 'Doctorado en Ciencias - Matemática'),
(22, 'Doctorado en Ciencias - Química'),
(23, 'Doctorado en Derecho'),
(24, 'Doctorado en Enfermería'),
(25, 'Doctorado en Estudios Ambientales'),
(26, 'Doctorado en Filosofía'),
(27, 'Doctorado en Geografía'),
(28, 'Doctorado en Geociencias'),
(29, 'Doctorado en Historia'),
(30, 'Doctorado en Ingeniería - Ciencia y Tecnología de Materiales'),
(31, 'Doctorado en Ingeniería - Industria y Organizaciones'),
(32, 'Doctorado en Ingeniería - Ingeniería Civil'),
(33, 'Doctorado en Ingeniería - Ingeniería Eléctrica'),
(34, 'Doctorado en Ingeniería - Ingeniería Mecánica y Mecatrónica'),
(35, 'Doctorado en Ingeniería - Ingeniería Química'),
(36, 'Doctorado en Ingeniería - Sistemas y Computación'),
(37, 'Facultad de Artes'),
(38, 'Facultad de Ciencias'),
(39, 'Facultad de Ciencias Agrarias'),
(40, 'Facultad de Ciencias Económicas'),
(41, 'Facultad de Ciencias Humanas'),
(42, 'Facultad de Derecho, Ciencias Políticas y Sociales'),
(43, 'Facultad de Enfermería'),
(44, 'Facultad de Medicina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id_funcion` int(11) NOT NULL,
  `id_controlador` int(11) NOT NULL,
  `nombre_funcion` varchar(255) NOT NULL,
  `display` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id_funcion`, `id_controlador`, `nombre_funcion`, `display`) VALUES
(1, 2, 'crear_rol', 'Registrar'),
(2, 2, 'consultar_rol', 'Consultar'),
(3, 1, 'asignar_rol', 'Asignar rol'),
(4, 3, 'crear_cargo', 'Crear'),
(5, 3, 'consultar_cargo', 'Consultar'),
(6, 4, 'crear_centro', 'Registrar'),
(7, 4, 'consultar_centro', 'Consultar'),
(8, 5, 'crear_grupo', 'Registrar'),
(9, 5, 'consultar_grupo', 'Consultar'),
(10, 6, 'crear_linea', 'Registrar'),
(11, 6, 'consultar_linea', 'Consultar'),
(12, 7, 'crear_red', 'Registrar'),
(13, 7, 'consultar_red', 'Consultar'),
(14, 1, 'crear_usuario', 'Registrar'),
(15, 1, 'consultar_perfil', 'Ver perfil'),
(16, 1, 'modificar_perfil', 'Editar perfil'),
(17, 1, 'inhabilitar_usuario', 'Eliminar '),
(18, 8, 'crear_semillero', 'Crear'),
(19, 8, 'consultar_semillero', 'Consultar'),
(20, 8, 'validar_integrante', 'Validar'),
(21, 8, 'exportar_semillero', 'Exportar'),
(22, 9, 'crear_proyecto', 'Crear proyectos'),
(23, 9, 'consultar_proyecto', 'Consultar proyectos'),
(24, 10, 'visualizar_info', 'Generar informes'),
(25, 10, 'exportar_info', 'Exportar'),
(26, 11, 'consultar_log_aud', 'Consultar movimientos'),
(28, 1, 'consultar_usuario', 'Consultar usuarios'),
(29, 1, 'modificar_usuario', NULL),
(30, 2, 'modificar_rol', 'Modificar rol'),
(31, 3, 'modificar_cargo', 'Modificar cargo'),
(32, 4, 'modificar_centro', 'Modificar centro'),
(33, 5, 'modificar_grupo', 'Modificar grupo'),
(34, 6, 'modificar_linea', 'Modificar linea'),
(35, 7, 'modificar_red', 'Modificador red'),
(36, 8, 'modificar_semillero', 'Modificar semillero'),
(37, 9, 'modificar_proyecto', 'Modificar proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `genero`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'No binario'),
(4, 'Género fluido'),
(5, 'Género no conforme'),
(6, 'Agénero'),
(7, 'Bigénero'),
(8, 'Género queer'),
(9, 'Tercer género'),
(10, 'Dos espíritus (Two-Spirit)'),
(11, 'Intergénero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_investigacion`
--

CREATE TABLE `grupos_investigacion` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrantes`
--

CREATE TABLE `integrantes` (
  `id_integrante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_semiilero` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_investigacion`
--

CREATE TABLE `lineas_investigacion` (
  `id_linea` int(11) NOT NULL,
  `nombre_linea` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_investigacion`
--

INSERT INTO `lineas_investigacion` (`id_linea`, `nombre_linea`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'Coordinador', 1, '2024-07-23 18:59:28', '2024-07-23 18:59:28'),
(2, 'Estudios Ambientales Locales', 1, '2024-07-23 19:04:31', '2024-07-23 19:04:31'),
(3, 'Convergencia Digital y experimentación', 1, '2024-07-23 19:04:37', '2024-07-23 19:04:37'),
(4, 'Integración de Tecnologías Aplicadas en Mecatrónica', 1, '2024-07-23 19:04:43', '2024-07-23 19:04:43'),
(5, 'Movilidad Aerea', 1, '2024-07-23 19:04:57', '2024-07-23 19:04:57'),
(6, 'Coordinador', 1, '2024-07-23 20:00:58', '2024-07-23 20:00:58'),
(7, 'Movilidad Aerea', 1, '2024-07-23 20:06:54', '2024-07-23 20:06:54'),
(8, 'Estudios Ambientales Locales', 0, '2024-07-23 20:09:37', '2024-07-23 20:09:37'),
(9, 'Integración de Tecnologías Aplicadas en Mecatrónica', 0, '2024-07-23 20:14:55', '2024-07-23 20:14:55'),
(10, 'Coordinador', 1, '2024-07-23 20:15:56', '2024-07-23 20:15:56'),
(11, 'Integración de Tecnologías Aplicadas en Mecatrónica', 1, '2024-07-23 20:16:05', '2024-07-23 20:16:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrias`
--

CREATE TABLE `maestrias` (
  `id_maestria` int(11) NOT NULL,
  `nombre_maestria` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maestrias`
--

INSERT INTO `maestrias` (`id_maestria`, `nombre_maestria`) VALUES
(47, 'Licenciatura Canónica en Filosofía'),
(48, 'Maestría en Gerencia del Comercio Internacional'),
(49, 'Maestría en Administración'),
(50, 'Maestría en Cine Documental'),
(51, 'Maestría en Desarrollo'),
(52, 'Maestría en Filosofía'),
(53, 'Maestría en Literatura'),
(54, 'Maestría en Comportamiento del Consumidor'),
(55, 'Maestría en Comunicación Digital'),
(56, 'Maestría en Educación'),
(57, 'Maestría en Derecho'),
(58, 'Maestría en Estudios Latinoamericanos'),
(59, 'Maestría en Ingeniería Civil'),
(60, 'Maestría en Gestión de la Educación'),
(61, 'Maestría en Innovación en Agronegocios'),
(62, 'Maestría en Ingeniería'),
(63, 'Maestría en Dirección de Marketing'),
(64, 'Maestría en Ciencias Médicas'),
(65, 'Maestría en Enfermería Oncológica'),
(66, 'Maestría en Comunicación Organizacional'),
(67, 'Maestría en Diseño del Paisaje'),
(68, 'Maestría en Ingeniería e Innovación para el Desarrollo Agroindustrial'),
(69, 'Maestría en Estudios Políticos'),
(70, 'Maestría en Gerencia de Proyectos'),
(71, 'Maestría en Psicopedagogía'),
(72, 'Maestría en Psicoterapia'),
(73, 'Maestría en Gestión Humana para Organizaciones Saludables'),
(74, 'Maestría en Psicología Social'),
(75, 'Maestría en Sostenibilidad'),
(76, 'Maestría en Gestión Tecnológica'),
(77, 'Maestría en Teología'),
(78, 'Licenciatura Canónica en Teología'),
(79, 'Maestría en Terapia Familiar'),
(80, 'Maestría en Bioética y Bioderecho'),
(81, 'Maestría en Tecnologías de la Información y la Comunicación'),
(82, 'Maestría en Psicología y Salud Mental'),
(83, 'Maestría en Procesos de Aprendizaje y Enseñanza de Segundas Lenguas'),
(84, 'Maestría en Gestión Integral y Calidad en Salud'),
(85, 'Maestría en Gestión Estratégica de la Información y el Conocimiento'),
(86, 'Maestría en Economía de la Innovación y el Cambio Técnico'),
(87, 'Maestría en Industrias Creativas y Culturales'),
(88, 'Maestría en Innovación Social y Territorio'),
(89, 'Maestría en Ciencias Naturales y Matemática'),
(90, 'Maestría en Ingeniería de Confiabilidad y Gestión de Activos'),
(91, 'Maestría en Materiales y Tecnología Industrial'),
(92, 'Maestría en Diseño y Gestión de Procesos Industriales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(6) UNSIGNED NOT NULL,
  `municipio` varchar(255) NOT NULL DEFAULT '',
  `estado` int(1) UNSIGNED NOT NULL,
  `departamento_id` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `municipio`, `estado`, `departamento_id`) VALUES
(1, 'Abriaquí', 1, 5),
(2, 'Acacías', 1, 50),
(3, 'Acandí', 1, 27),
(4, 'Acevedo', 1, 41),
(5, 'Achí', 1, 13),
(6, 'Agrado', 1, 41),
(7, 'Agua de Dios', 1, 25),
(8, 'Aguachica', 1, 20),
(9, 'Aguada', 1, 68),
(10, 'Aguadas', 1, 17),
(11, 'Aguazul', 1, 85),
(12, 'Agustín Codazzi', 1, 20),
(13, 'Aipe', 1, 41),
(14, 'Albania', 1, 18),
(15, 'Albania', 1, 44),
(16, 'Albania', 1, 68),
(17, 'Albán', 1, 25),
(18, 'Albán (San José)', 1, 52),
(19, 'Alcalá', 1, 76),
(20, 'Alejandria', 1, 5),
(21, 'Algarrobo', 1, 47),
(22, 'Algeciras', 1, 41),
(23, 'Almaguer', 1, 19),
(24, 'Almeida', 1, 15),
(25, 'Alpujarra', 1, 73),
(26, 'Altamira', 1, 41),
(27, 'Alto Baudó (Pie de Pato)', 1, 27),
(28, 'Altos del Rosario', 1, 13),
(29, 'Alvarado', 1, 73),
(30, 'Amagá', 1, 5),
(31, 'Amalfi', 1, 5),
(32, 'Ambalema', 1, 73),
(33, 'Anapoima', 1, 25),
(34, 'Ancuya', 1, 52),
(35, 'Andalucía', 1, 76),
(36, 'Andes', 1, 5),
(37, 'Angelópolis', 1, 5),
(38, 'Angostura', 1, 5),
(39, 'Anolaima', 1, 25),
(40, 'Anorí', 1, 5),
(41, 'Anserma', 1, 17),
(42, 'Ansermanuevo', 1, 76),
(43, 'Anzoátegui', 1, 73),
(44, 'Anzá', 1, 5),
(45, 'Apartadó', 1, 5),
(46, 'Apulo', 1, 25),
(47, 'Apía', 1, 66),
(48, 'Aquitania', 1, 15),
(49, 'Aracataca', 1, 47),
(50, 'Aranzazu', 1, 17),
(51, 'Aratoca', 1, 68),
(52, 'Arauca', 1, 81),
(53, 'Arauquita', 1, 81),
(54, 'Arbeláez', 1, 25),
(55, 'Arboleda (Berruecos)', 1, 52),
(56, 'Arboledas', 1, 54),
(57, 'Arboletes', 1, 5),
(58, 'Arcabuco', 1, 15),
(59, 'Arenal', 1, 13),
(60, 'Argelia', 1, 5),
(61, 'Argelia', 1, 19),
(62, 'Argelia', 1, 76),
(63, 'Ariguaní (El Difícil)', 1, 47),
(64, 'Arjona', 1, 13),
(65, 'Armenia', 1, 5),
(66, 'Armenia', 1, 63),
(67, 'Armero (Guayabal)', 1, 73),
(68, 'Arroyohondo', 1, 13),
(69, 'Astrea', 1, 20),
(70, 'Ataco', 1, 73),
(71, 'Atrato (Yuto)', 1, 27),
(72, 'Ayapel', 1, 23),
(73, 'Bagadó', 1, 27),
(74, 'Bahía Solano (Mútis)', 1, 27),
(75, 'Bajo Baudó (Pizarro)', 1, 27),
(76, 'Balboa', 1, 19),
(77, 'Balboa', 1, 66),
(78, 'Baranoa', 1, 8),
(79, 'Baraya', 1, 41),
(80, 'Barbacoas', 1, 52),
(81, 'Barbosa', 1, 5),
(82, 'Barbosa', 1, 68),
(83, 'Barichara', 1, 68),
(84, 'Barranca de Upía', 1, 50),
(85, 'Barrancabermeja', 1, 68),
(86, 'Barrancas', 1, 44),
(87, 'Barranco de Loba', 1, 13),
(88, 'Barranquilla', 1, 8),
(89, 'Becerríl', 1, 20),
(90, 'Belalcázar', 1, 17),
(91, 'Bello', 1, 5),
(92, 'Belmira', 1, 5),
(93, 'Beltrán', 1, 25),
(94, 'Belén', 1, 15),
(95, 'Belén', 1, 52),
(96, 'Belén de Bajirá', 1, 27),
(97, 'Belén de Umbría', 1, 66),
(98, 'Belén de los Andaquíes', 1, 18),
(99, 'Berbeo', 1, 15),
(100, 'Betania', 1, 5),
(101, 'Beteitiva', 1, 15),
(102, 'Betulia', 1, 5),
(103, 'Betulia', 1, 68),
(104, 'Bituima', 1, 25),
(105, 'Boavita', 1, 15),
(106, 'Bochalema', 1, 54),
(107, 'Bogotá D.C.', 1, 11),
(108, 'Bojacá', 1, 25),
(109, 'Bojayá (Bellavista)', 1, 27),
(110, 'Bolívar', 1, 5),
(111, 'Bolívar', 1, 19),
(112, 'Bolívar', 1, 68),
(113, 'Bolívar', 1, 76),
(114, 'Bosconia', 1, 20),
(115, 'Boyacá', 1, 15),
(116, 'Briceño', 1, 5),
(117, 'Briceño', 1, 15),
(118, 'Bucaramanga', 1, 68),
(119, 'Bucarasica', 1, 54),
(120, 'Buenaventura', 1, 76),
(121, 'Buenavista', 1, 15),
(122, 'Buenavista', 1, 23),
(123, 'Buenavista', 1, 63),
(124, 'Buenavista', 1, 70),
(125, 'Buenos Aires', 1, 19),
(126, 'Buesaco', 1, 52),
(127, 'Buga', 1, 76),
(128, 'Bugalagrande', 1, 76),
(129, 'Burítica', 1, 5),
(130, 'Busbanza', 1, 15),
(131, 'Cabrera', 1, 25),
(132, 'Cabrera', 1, 68),
(133, 'Cabuyaro', 1, 50),
(134, 'Cachipay', 1, 25),
(135, 'Caicedo', 1, 5),
(136, 'Caicedonia', 1, 76),
(137, 'Caimito', 1, 70),
(138, 'Cajamarca', 1, 73),
(139, 'Cajibío', 1, 19),
(140, 'Cajicá', 1, 25),
(141, 'Calamar', 1, 13),
(142, 'Calamar', 1, 95),
(143, 'Calarcá', 1, 63),
(144, 'Caldas', 1, 5),
(145, 'Caldas', 1, 15),
(146, 'Caldono', 1, 19),
(147, 'California', 1, 68),
(148, 'Calima (Darién)', 1, 76),
(149, 'Caloto', 1, 19),
(150, 'Calí', 1, 76),
(151, 'Campamento', 1, 5),
(152, 'Campo de la Cruz', 1, 8),
(153, 'Campoalegre', 1, 41),
(154, 'Campohermoso', 1, 15),
(155, 'Canalete', 1, 23),
(156, 'Candelaria', 1, 8),
(157, 'Candelaria', 1, 76),
(158, 'Cantagallo', 1, 13),
(159, 'Cantón de San Pablo', 1, 27),
(160, 'Caparrapí', 1, 25),
(161, 'Capitanejo', 1, 68),
(162, 'Caracolí', 1, 5),
(163, 'Caramanta', 1, 5),
(164, 'Carcasí', 1, 68),
(165, 'Carepa', 1, 5),
(166, 'Carmen de Apicalá', 1, 73),
(167, 'Carmen de Carupa', 1, 25),
(168, 'Carmen de Viboral', 1, 5),
(169, 'Carmen del Darién (CURBARADÓ)', 1, 27),
(170, 'Carolina', 1, 5),
(171, 'Cartagena', 1, 13),
(172, 'Cartagena del Chairá', 1, 18),
(173, 'Cartago', 1, 76),
(174, 'Carurú', 1, 97),
(175, 'Casabianca', 1, 73),
(176, 'Castilla la Nueva', 1, 50),
(177, 'Caucasia', 1, 5),
(178, 'Cañasgordas', 1, 5),
(179, 'Cepita', 1, 68),
(180, 'Cereté', 1, 23),
(181, 'Cerinza', 1, 15),
(182, 'Cerrito', 1, 68),
(183, 'Cerro San Antonio', 1, 47),
(184, 'Chachaguí', 1, 52),
(185, 'Chaguaní', 1, 25),
(186, 'Chalán', 1, 70),
(187, 'Chaparral', 1, 73),
(188, 'Charalá', 1, 68),
(189, 'Charta', 1, 68),
(190, 'Chigorodó', 1, 5),
(191, 'Chima', 1, 68),
(192, 'Chimichagua', 1, 20),
(193, 'Chimá', 1, 23),
(194, 'Chinavita', 1, 15),
(195, 'Chinchiná', 1, 17),
(196, 'Chinácota', 1, 54),
(197, 'Chinú', 1, 23),
(198, 'Chipaque', 1, 25),
(199, 'Chipatá', 1, 68),
(200, 'Chiquinquirá', 1, 15),
(201, 'Chiriguaná', 1, 20),
(202, 'Chiscas', 1, 15),
(203, 'Chita', 1, 15),
(204, 'Chitagá', 1, 54),
(205, 'Chitaraque', 1, 15),
(206, 'Chivatá', 1, 15),
(207, 'Chivolo', 1, 47),
(208, 'Choachí', 1, 25),
(209, 'Chocontá', 1, 25),
(210, 'Chámeza', 1, 85),
(211, 'Chía', 1, 25),
(212, 'Chíquiza', 1, 15),
(213, 'Chívor', 1, 15),
(214, 'Cicuco', 1, 13),
(215, 'Cimitarra', 1, 68),
(216, 'Circasia', 1, 63),
(217, 'Cisneros', 1, 5),
(218, 'Ciénaga', 1, 15),
(219, 'Ciénaga', 1, 47),
(220, 'Ciénaga de Oro', 1, 23),
(221, 'Clemencia', 1, 13),
(222, 'Cocorná', 1, 5),
(223, 'Coello', 1, 73),
(224, 'Cogua', 1, 25),
(225, 'Colombia', 1, 41),
(226, 'Colosó (Ricaurte)', 1, 70),
(227, 'Colón', 1, 86),
(228, 'Colón (Génova)', 1, 52),
(229, 'Concepción', 1, 5),
(230, 'Concepción', 1, 68),
(231, 'Concordia', 1, 5),
(232, 'Concordia', 1, 47),
(233, 'Condoto', 1, 27),
(234, 'Confines', 1, 68),
(235, 'Consaca', 1, 52),
(236, 'Contadero', 1, 52),
(237, 'Contratación', 1, 68),
(238, 'Convención', 1, 54),
(239, 'Copacabana', 1, 5),
(240, 'Coper', 1, 15),
(241, 'Cordobá', 1, 63),
(242, 'Corinto', 1, 19),
(243, 'Coromoro', 1, 68),
(244, 'Corozal', 1, 70),
(245, 'Corrales', 1, 15),
(246, 'Cota', 1, 25),
(247, 'Cotorra', 1, 23),
(248, 'Covarachía', 1, 15),
(249, 'Coveñas', 1, 70),
(250, 'Coyaima', 1, 73),
(251, 'Cravo Norte', 1, 81),
(252, 'Cuaspud (Carlosama)', 1, 52),
(253, 'Cubarral', 1, 50),
(254, 'Cubará', 1, 15),
(255, 'Cucaita', 1, 15),
(256, 'Cucunubá', 1, 25),
(257, 'Cucutilla', 1, 54),
(258, 'Cuitiva', 1, 15),
(259, 'Cumaral', 1, 50),
(260, 'Cumaribo', 1, 99),
(261, 'Cumbal', 1, 52),
(262, 'Cumbitara', 1, 52),
(263, 'Cunday', 1, 73),
(264, 'Curillo', 1, 18),
(265, 'Curití', 1, 68),
(266, 'Curumaní', 1, 20),
(267, 'Cáceres', 1, 5),
(268, 'Cáchira', 1, 54),
(269, 'Cácota', 1, 54),
(270, 'Cáqueza', 1, 25),
(271, 'Cértegui', 1, 27),
(272, 'Cómbita', 1, 15),
(273, 'Córdoba', 1, 13),
(274, 'Córdoba', 1, 52),
(275, 'Cúcuta', 1, 54),
(276, 'Dabeiba', 1, 5),
(277, 'Dagua', 1, 76),
(278, 'Dibulla', 1, 44),
(279, 'Distracción', 1, 44),
(280, 'Dolores', 1, 73),
(281, 'Don Matías', 1, 5),
(282, 'Dos Quebradas', 1, 66),
(283, 'Duitama', 1, 15),
(284, 'Durania', 1, 54),
(285, 'Ebéjico', 1, 5),
(286, 'El Bagre', 1, 5),
(287, 'El Banco', 1, 47),
(288, 'El Cairo', 1, 76),
(289, 'El Calvario', 1, 50),
(290, 'El Carmen', 1, 54),
(291, 'El Carmen', 1, 68),
(292, 'El Carmen de Atrato', 1, 27),
(293, 'El Carmen de Bolívar', 1, 13),
(294, 'El Castillo', 1, 50),
(295, 'El Cerrito', 1, 76),
(296, 'El Charco', 1, 52),
(297, 'El Cocuy', 1, 15),
(298, 'El Colegio', 1, 25),
(299, 'El Copey', 1, 20),
(300, 'El Doncello', 1, 18),
(301, 'El Dorado', 1, 50),
(302, 'El Dovio', 1, 76),
(303, 'El Espino', 1, 15),
(304, 'El Guacamayo', 1, 68),
(305, 'El Guamo', 1, 13),
(306, 'El Molino', 1, 44),
(307, 'El Paso', 1, 20),
(308, 'El Paujil', 1, 18),
(309, 'El Peñol', 1, 52),
(310, 'El Peñon', 1, 13),
(311, 'El Peñon', 1, 68),
(312, 'El Peñón', 1, 25),
(313, 'El Piñon', 1, 47),
(314, 'El Playón', 1, 68),
(315, 'El Retorno', 1, 95),
(316, 'El Retén', 1, 47),
(317, 'El Roble', 1, 70),
(318, 'El Rosal', 1, 25),
(319, 'El Rosario', 1, 52),
(320, 'El Tablón de Gómez', 1, 52),
(321, 'El Tambo', 1, 19),
(322, 'El Tambo', 1, 52),
(323, 'El Tarra', 1, 54),
(324, 'El Zulia', 1, 54),
(325, 'El Águila', 1, 76),
(326, 'Elías', 1, 41),
(327, 'Encino', 1, 68),
(328, 'Enciso', 1, 68),
(329, 'Entrerríos', 1, 5),
(330, 'Envigado', 1, 5),
(331, 'Espinal', 1, 73),
(332, 'Facatativá', 1, 25),
(333, 'Falan', 1, 73),
(334, 'Filadelfia', 1, 17),
(335, 'Filandia', 1, 63),
(336, 'Firavitoba', 1, 15),
(337, 'Flandes', 1, 73),
(338, 'Florencia', 1, 18),
(339, 'Florencia', 1, 19),
(340, 'Floresta', 1, 15),
(341, 'Florida', 1, 76),
(342, 'Floridablanca', 1, 68),
(343, 'Florián', 1, 68),
(344, 'Fonseca', 1, 44),
(345, 'Fortúl', 1, 81),
(346, 'Fosca', 1, 25),
(347, 'Francisco Pizarro', 1, 52),
(348, 'Fredonia', 1, 5),
(349, 'Fresno', 1, 73),
(350, 'Frontino', 1, 5),
(351, 'Fuente de Oro', 1, 50),
(352, 'Fundación', 1, 47),
(353, 'Funes', 1, 52),
(354, 'Funza', 1, 25),
(355, 'Fusagasugá', 1, 25),
(356, 'Fómeque', 1, 25),
(357, 'Fúquene', 1, 25),
(358, 'Gachalá', 1, 25),
(359, 'Gachancipá', 1, 25),
(360, 'Gachantivá', 1, 15),
(361, 'Gachetá', 1, 25),
(362, 'Galapa', 1, 8),
(363, 'Galeras (Nueva Granada)', 1, 70),
(364, 'Galán', 1, 68),
(365, 'Gama', 1, 25),
(366, 'Gamarra', 1, 20),
(367, 'Garagoa', 1, 15),
(368, 'Garzón', 1, 41),
(369, 'Gigante', 1, 41),
(370, 'Ginebra', 1, 76),
(371, 'Giraldo', 1, 5),
(372, 'Girardot', 1, 25),
(373, 'Girardota', 1, 5),
(374, 'Girón', 1, 68),
(375, 'Gonzalez', 1, 20),
(376, 'Gramalote', 1, 54),
(377, 'Granada', 1, 5),
(378, 'Granada', 1, 25),
(379, 'Granada', 1, 50),
(380, 'Guaca', 1, 68),
(381, 'Guacamayas', 1, 15),
(382, 'Guacarí', 1, 76),
(383, 'Guachavés', 1, 52),
(384, 'Guachené', 1, 19),
(385, 'Guachetá', 1, 25),
(386, 'Guachucal', 1, 52),
(387, 'Guadalupe', 1, 5),
(388, 'Guadalupe', 1, 41),
(389, 'Guadalupe', 1, 68),
(390, 'Guaduas', 1, 25),
(391, 'Guaitarilla', 1, 52),
(392, 'Gualmatán', 1, 52),
(393, 'Guamal', 1, 47),
(394, 'Guamal', 1, 50),
(395, 'Guamo', 1, 73),
(396, 'Guapota', 1, 68),
(397, 'Guapí', 1, 19),
(398, 'Guaranda', 1, 70),
(399, 'Guarne', 1, 5),
(400, 'Guasca', 1, 25),
(401, 'Guatapé', 1, 5),
(402, 'Guataquí', 1, 25),
(403, 'Guatavita', 1, 25),
(404, 'Guateque', 1, 15),
(405, 'Guavatá', 1, 68),
(406, 'Guayabal de Siquima', 1, 25),
(407, 'Guayabetal', 1, 25),
(408, 'Guayatá', 1, 15),
(409, 'Guepsa', 1, 68),
(410, 'Guicán', 1, 15),
(411, 'Gutiérrez', 1, 25),
(412, 'Guática', 1, 66),
(413, 'Gámbita', 1, 68),
(414, 'Gámeza', 1, 15),
(415, 'Génova', 1, 63),
(416, 'Gómez Plata', 1, 5),
(417, 'Hacarí', 1, 54),
(418, 'Hatillo de Loba', 1, 13),
(419, 'Hato', 1, 68),
(420, 'Hato Corozal', 1, 85),
(421, 'Hatonuevo', 1, 44),
(422, 'Heliconia', 1, 5),
(423, 'Herrán', 1, 54),
(424, 'Herveo', 1, 73),
(425, 'Hispania', 1, 5),
(426, 'Hobo', 1, 41),
(427, 'Honda', 1, 73),
(428, 'Ibagué', 1, 73),
(429, 'Icononzo', 1, 73),
(430, 'Iles', 1, 52),
(431, 'Imúes', 1, 52),
(432, 'Inzá', 1, 19),
(433, 'Inírida', 1, 94),
(434, 'Ipiales', 1, 52),
(435, 'Isnos', 1, 41),
(436, 'Istmina', 1, 27),
(437, 'Itagüí', 1, 5),
(438, 'Ituango', 1, 5),
(439, 'Izá', 1, 15),
(440, 'Jambaló', 1, 19),
(441, 'Jamundí', 1, 76),
(442, 'Jardín', 1, 5),
(443, 'Jenesano', 1, 15),
(444, 'Jericó', 1, 5),
(445, 'Jericó', 1, 15),
(446, 'Jerusalén', 1, 25),
(447, 'Jesús María', 1, 68),
(448, 'Jordán', 1, 68),
(449, 'Juan de Acosta', 1, 8),
(450, 'Junín', 1, 25),
(451, 'Juradó', 1, 27),
(452, 'La Apartada y La Frontera', 1, 23),
(453, 'La Argentina', 1, 41),
(454, 'La Belleza', 1, 68),
(455, 'La Calera', 1, 25),
(456, 'La Capilla', 1, 15),
(457, 'La Ceja', 1, 5),
(458, 'La Celia', 1, 66),
(459, 'La Cruz', 1, 52),
(460, 'La Cumbre', 1, 76),
(461, 'La Dorada', 1, 17),
(462, 'La Esperanza', 1, 54),
(463, 'La Estrella', 1, 5),
(464, 'La Florida', 1, 52),
(465, 'La Gloria', 1, 20),
(466, 'La Jagua de Ibirico', 1, 20),
(467, 'La Jagua del Pilar', 1, 44),
(468, 'La Llanada', 1, 52),
(469, 'La Macarena', 1, 50),
(470, 'La Merced', 1, 17),
(471, 'La Mesa', 1, 25),
(472, 'La Montañita', 1, 18),
(473, 'La Palma', 1, 25),
(474, 'La Paz', 1, 68),
(475, 'La Paz (Robles)', 1, 20),
(476, 'La Peña', 1, 25),
(477, 'La Pintada', 1, 5),
(478, 'La Plata', 1, 41),
(479, 'La Playa', 1, 54),
(480, 'La Primavera', 1, 99),
(481, 'La Salina', 1, 85),
(482, 'La Sierra', 1, 19),
(483, 'La Tebaida', 1, 63),
(484, 'La Tola', 1, 52),
(485, 'La Unión', 1, 5),
(486, 'La Unión', 1, 52),
(487, 'La Unión', 1, 70),
(488, 'La Unión', 1, 76),
(489, 'La Uvita', 1, 15),
(490, 'La Vega', 1, 19),
(491, 'La Vega', 1, 25),
(492, 'La Victoria', 1, 15),
(493, 'La Victoria', 1, 17),
(494, 'La Victoria', 1, 76),
(495, 'La Virginia', 1, 66),
(496, 'Labateca', 1, 54),
(497, 'Labranzagrande', 1, 15),
(498, 'Landázuri', 1, 68),
(499, 'Lebrija', 1, 68),
(500, 'Leiva', 1, 52),
(501, 'Lejanías', 1, 50),
(502, 'Lenguazaque', 1, 25),
(503, 'Leticia', 1, 91),
(504, 'Liborina', 1, 5),
(505, 'Linares', 1, 52),
(506, 'Lloró', 1, 27),
(507, 'Lorica', 1, 23),
(508, 'Los Córdobas', 1, 23),
(509, 'Los Palmitos', 1, 70),
(510, 'Los Patios', 1, 54),
(511, 'Los Santos', 1, 68),
(512, 'Lourdes', 1, 54),
(513, 'Luruaco', 1, 8),
(514, 'Lérida', 1, 73),
(515, 'Líbano', 1, 73),
(516, 'López (Micay)', 1, 19),
(517, 'Macanal', 1, 15),
(518, 'Macaravita', 1, 68),
(519, 'Maceo', 1, 5),
(520, 'Machetá', 1, 25),
(521, 'Madrid', 1, 25),
(522, 'Magangué', 1, 13),
(523, 'Magüi (Payán)', 1, 52),
(524, 'Mahates', 1, 13),
(525, 'Maicao', 1, 44),
(526, 'Majagual', 1, 70),
(527, 'Malambo', 1, 8),
(528, 'Mallama (Piedrancha)', 1, 52),
(529, 'Manatí', 1, 8),
(530, 'Manaure', 1, 44),
(531, 'Manaure Balcón del Cesar', 1, 20),
(532, 'Manizales', 1, 17),
(533, 'Manta', 1, 25),
(534, 'Manzanares', 1, 17),
(535, 'Maní', 1, 85),
(536, 'Mapiripan', 1, 50),
(537, 'Margarita', 1, 13),
(538, 'Marinilla', 1, 5),
(539, 'Maripí', 1, 15),
(540, 'Mariquita', 1, 73),
(541, 'Marmato', 1, 17),
(542, 'Marquetalia', 1, 17),
(543, 'Marsella', 1, 66),
(544, 'Marulanda', 1, 17),
(545, 'María la Baja', 1, 13),
(546, 'Matanza', 1, 68),
(547, 'Medellín', 1, 5),
(548, 'Medina', 1, 25),
(549, 'Medio Atrato', 1, 27),
(550, 'Medio Baudó', 1, 27),
(551, 'Medio San Juan (ANDAGOYA)', 1, 27),
(552, 'Melgar', 1, 73),
(553, 'Mercaderes', 1, 19),
(554, 'Mesetas', 1, 50),
(555, 'Milán', 1, 18),
(556, 'Miraflores', 1, 15),
(557, 'Miraflores', 1, 95),
(558, 'Miranda', 1, 19),
(559, 'Mistrató', 1, 66),
(560, 'Mitú', 1, 97),
(561, 'Mocoa', 1, 86),
(562, 'Mogotes', 1, 68),
(563, 'Molagavita', 1, 68),
(564, 'Momil', 1, 23),
(565, 'Mompós', 1, 13),
(566, 'Mongua', 1, 15),
(567, 'Monguí', 1, 15),
(568, 'Moniquirá', 1, 15),
(569, 'Montebello', 1, 5),
(570, 'Montecristo', 1, 13),
(571, 'Montelíbano', 1, 23),
(572, 'Montenegro', 1, 63),
(573, 'Monteria', 1, 23),
(574, 'Monterrey', 1, 85),
(575, 'Morales', 1, 13),
(576, 'Morales', 1, 19),
(577, 'Morelia', 1, 18),
(578, 'Morroa', 1, 70),
(579, 'Mosquera', 1, 25),
(580, 'Mosquera', 1, 52),
(581, 'Motavita', 1, 15),
(582, 'Moñitos', 1, 23),
(583, 'Murillo', 1, 73),
(584, 'Murindó', 1, 5),
(585, 'Mutatá', 1, 5),
(586, 'Mutiscua', 1, 54),
(587, 'Muzo', 1, 15),
(588, 'Málaga', 1, 68),
(589, 'Nariño', 1, 5),
(590, 'Nariño', 1, 25),
(591, 'Nariño', 1, 52),
(592, 'Natagaima', 1, 73),
(593, 'Nechí', 1, 5),
(594, 'Necoclí', 1, 5),
(595, 'Neira', 1, 17),
(596, 'Neiva', 1, 41),
(597, 'Nemocón', 1, 25),
(598, 'Nilo', 1, 25),
(599, 'Nimaima', 1, 25),
(600, 'Nobsa', 1, 15),
(601, 'Nocaima', 1, 25),
(602, 'Norcasia', 1, 17),
(603, 'Norosí', 1, 13),
(604, 'Novita', 1, 27),
(605, 'Nueva Granada', 1, 47),
(606, 'Nuevo Colón', 1, 15),
(607, 'Nunchía', 1, 85),
(608, 'Nuquí', 1, 27),
(609, 'Nátaga', 1, 41),
(610, 'Obando', 1, 76),
(611, 'Ocamonte', 1, 68),
(612, 'Ocaña', 1, 54),
(613, 'Oiba', 1, 68),
(614, 'Oicatá', 1, 15),
(615, 'Olaya', 1, 5),
(616, 'Olaya Herrera', 1, 52),
(617, 'Onzaga', 1, 68),
(618, 'Oporapa', 1, 41),
(619, 'Orito', 1, 86),
(620, 'Orocué', 1, 85),
(621, 'Ortega', 1, 73),
(622, 'Ospina', 1, 52),
(623, 'Otanche', 1, 15),
(624, 'Ovejas', 1, 70),
(625, 'Pachavita', 1, 15),
(626, 'Pacho', 1, 25),
(627, 'Padilla', 1, 19),
(628, 'Paicol', 1, 41),
(629, 'Pailitas', 1, 20),
(630, 'Paime', 1, 25),
(631, 'Paipa', 1, 15),
(632, 'Pajarito', 1, 15),
(633, 'Palermo', 1, 41),
(634, 'Palestina', 1, 17),
(635, 'Palestina', 1, 41),
(636, 'Palmar', 1, 68),
(637, 'Palmar de Varela', 1, 8),
(638, 'Palmas del Socorro', 1, 68),
(639, 'Palmira', 1, 76),
(640, 'Palmito', 1, 70),
(641, 'Palocabildo', 1, 73),
(642, 'Pamplona', 1, 54),
(643, 'Pamplonita', 1, 54),
(644, 'Pandi', 1, 25),
(645, 'Panqueba', 1, 15),
(646, 'Paratebueno', 1, 25),
(647, 'Pasca', 1, 25),
(648, 'Patía (El Bordo)', 1, 19),
(649, 'Pauna', 1, 15),
(650, 'Paya', 1, 15),
(651, 'Paz de Ariporo', 1, 85),
(652, 'Paz de Río', 1, 15),
(653, 'Pedraza', 1, 47),
(654, 'Pelaya', 1, 20),
(655, 'Pensilvania', 1, 17),
(656, 'Peque', 1, 5),
(657, 'Pereira', 1, 66),
(658, 'Pesca', 1, 15),
(659, 'Peñol', 1, 5),
(660, 'Piamonte', 1, 19),
(661, 'Pie de Cuesta', 1, 68),
(662, 'Piedras', 1, 73),
(663, 'Piendamó', 1, 19),
(664, 'Pijao', 1, 63),
(665, 'Pijiño', 1, 47),
(666, 'Pinchote', 1, 68),
(667, 'Pinillos', 1, 13),
(668, 'Piojo', 1, 8),
(669, 'Pisva', 1, 15),
(670, 'Pital', 1, 41),
(671, 'Pitalito', 1, 41),
(672, 'Pivijay', 1, 47),
(673, 'Planadas', 1, 73),
(674, 'Planeta Rica', 1, 23),
(675, 'Plato', 1, 47),
(676, 'Policarpa', 1, 52),
(677, 'Polonuevo', 1, 8),
(678, 'Ponedera', 1, 8),
(679, 'Popayán', 1, 19),
(680, 'Pore', 1, 85),
(681, 'Potosí', 1, 52),
(682, 'Pradera', 1, 76),
(683, 'Prado', 1, 73),
(684, 'Providencia', 1, 52),
(685, 'Providencia', 1, 88),
(686, 'Pueblo Bello', 1, 20),
(687, 'Pueblo Nuevo', 1, 23),
(688, 'Pueblo Rico', 1, 66),
(689, 'Pueblorrico', 1, 5),
(690, 'Puebloviejo', 1, 47),
(691, 'Puente Nacional', 1, 68),
(692, 'Puerres', 1, 52),
(693, 'Puerto Asís', 1, 86),
(694, 'Puerto Berrío', 1, 5),
(695, 'Puerto Boyacá', 1, 15),
(696, 'Puerto Caicedo', 1, 86),
(697, 'Puerto Carreño', 1, 99),
(698, 'Puerto Colombia', 1, 8),
(699, 'Puerto Concordia', 1, 50),
(700, 'Puerto Escondido', 1, 23),
(701, 'Puerto Gaitán', 1, 50),
(702, 'Puerto Guzmán', 1, 86),
(703, 'Puerto Leguízamo', 1, 86),
(704, 'Puerto Libertador', 1, 23),
(705, 'Puerto Lleras', 1, 50),
(706, 'Puerto López', 1, 50),
(707, 'Puerto Nare', 1, 5),
(708, 'Puerto Nariño', 1, 91),
(709, 'Puerto Parra', 1, 68),
(710, 'Puerto Rico', 1, 18),
(711, 'Puerto Rico', 1, 50),
(712, 'Puerto Rondón', 1, 81),
(713, 'Puerto Salgar', 1, 25),
(714, 'Puerto Santander', 1, 54),
(715, 'Puerto Tejada', 1, 19),
(716, 'Puerto Triunfo', 1, 5),
(717, 'Puerto Wilches', 1, 68),
(718, 'Pulí', 1, 25),
(719, 'Pupiales', 1, 52),
(720, 'Puracé (Coconuco)', 1, 19),
(721, 'Purificación', 1, 73),
(722, 'Purísima', 1, 23),
(723, 'Pácora', 1, 17),
(724, 'Páez', 1, 15),
(725, 'Páez (Belalcazar)', 1, 19),
(726, 'Páramo', 1, 68),
(727, 'Quebradanegra', 1, 25),
(728, 'Quetame', 1, 25),
(729, 'Quibdó', 1, 27),
(730, 'Quimbaya', 1, 63),
(731, 'Quinchía', 1, 66),
(732, 'Quipama', 1, 15),
(733, 'Quipile', 1, 25),
(734, 'Ragonvalia', 1, 54),
(735, 'Ramiriquí', 1, 15),
(736, 'Recetor', 1, 85),
(737, 'Regidor', 1, 13),
(738, 'Remedios', 1, 5),
(739, 'Remolino', 1, 47),
(740, 'Repelón', 1, 8),
(741, 'Restrepo', 1, 50),
(742, 'Restrepo', 1, 76),
(743, 'Retiro', 1, 5),
(744, 'Ricaurte', 1, 25),
(745, 'Ricaurte', 1, 52),
(746, 'Rio Negro', 1, 68),
(747, 'Rioblanco', 1, 73),
(748, 'Riofrío', 1, 76),
(749, 'Riohacha', 1, 44),
(750, 'Risaralda', 1, 17),
(751, 'Rivera', 1, 41),
(752, 'Roberto Payán (San José)', 1, 52),
(753, 'Roldanillo', 1, 76),
(754, 'Roncesvalles', 1, 73),
(755, 'Rondón', 1, 15),
(756, 'Rosas', 1, 19),
(757, 'Rovira', 1, 73),
(758, 'Ráquira', 1, 15),
(759, 'Río Iró', 1, 27),
(760, 'Río Quito', 1, 27),
(761, 'Río Sucio', 1, 17),
(762, 'Río Viejo', 1, 13),
(763, 'Río de oro', 1, 20),
(764, 'Ríonegro', 1, 5),
(765, 'Ríosucio', 1, 27),
(766, 'Sabana de Torres', 1, 68),
(767, 'Sabanagrande', 1, 8),
(768, 'Sabanalarga', 1, 5),
(769, 'Sabanalarga', 1, 8),
(770, 'Sabanalarga', 1, 85),
(771, 'Sabanas de San Angel (SAN ANGEL)', 1, 47),
(772, 'Sabaneta', 1, 5),
(773, 'Saboyá', 1, 15),
(774, 'Sahagún', 1, 23),
(775, 'Saladoblanco', 1, 41),
(776, 'Salamina', 1, 17),
(777, 'Salamina', 1, 47),
(778, 'Salazar', 1, 54),
(779, 'Saldaña', 1, 73),
(780, 'Salento', 1, 63),
(781, 'Salgar', 1, 5),
(782, 'Samacá', 1, 15),
(783, 'Samaniego', 1, 52),
(784, 'Samaná', 1, 17),
(785, 'Sampués', 1, 70),
(786, 'San Agustín', 1, 41),
(787, 'San Alberto', 1, 20),
(788, 'San Andrés', 1, 68),
(789, 'San Andrés Sotavento', 1, 23),
(790, 'San Andrés de Cuerquía', 1, 5),
(791, 'San Antero', 1, 23),
(792, 'San Antonio', 1, 73),
(793, 'San Antonio de Tequendama', 1, 25),
(794, 'San Benito', 1, 68),
(795, 'San Benito Abad', 1, 70),
(796, 'San Bernardo', 1, 25),
(797, 'San Bernardo', 1, 52),
(798, 'San Bernardo del Viento', 1, 23),
(799, 'San Calixto', 1, 54),
(800, 'San Carlos', 1, 5),
(801, 'San Carlos', 1, 23),
(802, 'San Carlos de Guaroa', 1, 50),
(803, 'San Cayetano', 1, 25),
(804, 'San Cayetano', 1, 54),
(805, 'San Cristobal', 1, 13),
(806, 'San Diego', 1, 20),
(807, 'San Eduardo', 1, 15),
(808, 'San Estanislao', 1, 13),
(809, 'San Fernando', 1, 13),
(810, 'San Francisco', 1, 5),
(811, 'San Francisco', 1, 25),
(812, 'San Francisco', 1, 86),
(813, 'San Gíl', 1, 68),
(814, 'San Jacinto', 1, 13),
(815, 'San Jacinto del Cauca', 1, 13),
(816, 'San Jerónimo', 1, 5),
(817, 'San Joaquín', 1, 68),
(818, 'San José', 1, 17),
(819, 'San José de Miranda', 1, 68),
(820, 'San José de Montaña', 1, 5),
(821, 'San José de Pare', 1, 15),
(822, 'San José de Uré', 1, 23),
(823, 'San José del Fragua', 1, 18),
(824, 'San José del Guaviare', 1, 95),
(825, 'San José del Palmar', 1, 27),
(826, 'San Juan de Arama', 1, 50),
(827, 'San Juan de Betulia', 1, 70),
(828, 'San Juan de Nepomuceno', 1, 13),
(829, 'San Juan de Pasto', 1, 52),
(830, 'San Juan de Río Seco', 1, 25),
(831, 'San Juan de Urabá', 1, 5),
(832, 'San Juan del Cesar', 1, 44),
(833, 'San Juanito', 1, 50),
(834, 'San Lorenzo', 1, 52),
(835, 'San Luis', 1, 73),
(836, 'San Luís', 1, 5),
(837, 'San Luís de Gaceno', 1, 15),
(838, 'San Luís de Palenque', 1, 85),
(839, 'San Marcos', 1, 70),
(840, 'San Martín', 1, 20),
(841, 'San Martín', 1, 50),
(842, 'San Martín de Loba', 1, 13),
(843, 'San Mateo', 1, 15),
(844, 'San Miguel', 1, 68),
(845, 'San Miguel', 1, 86),
(846, 'San Miguel de Sema', 1, 15),
(847, 'San Onofre', 1, 70),
(848, 'San Pablo', 1, 13),
(849, 'San Pablo', 1, 52),
(850, 'San Pablo de Borbur', 1, 15),
(851, 'San Pedro', 1, 5),
(852, 'San Pedro', 1, 70),
(853, 'San Pedro', 1, 76),
(854, 'San Pedro de Cartago', 1, 52),
(855, 'San Pedro de Urabá', 1, 5),
(856, 'San Pelayo', 1, 23),
(857, 'San Rafael', 1, 5),
(858, 'San Roque', 1, 5),
(859, 'San Sebastián', 1, 19),
(860, 'San Sebastián de Buenavista', 1, 47),
(861, 'San Vicente', 1, 5),
(862, 'San Vicente del Caguán', 1, 18),
(863, 'San Vicente del Chucurí', 1, 68),
(864, 'San Zenón', 1, 47),
(865, 'Sandoná', 1, 52),
(866, 'Santa Ana', 1, 47),
(867, 'Santa Bárbara', 1, 5),
(868, 'Santa Bárbara', 1, 68),
(869, 'Santa Bárbara (Iscuandé)', 1, 52),
(870, 'Santa Bárbara de Pinto', 1, 47),
(871, 'Santa Catalina', 1, 13),
(872, 'Santa Fé de Antioquia', 1, 5),
(873, 'Santa Genoveva de Docorodó', 1, 27),
(874, 'Santa Helena del Opón', 1, 68),
(875, 'Santa Isabel', 1, 73),
(876, 'Santa Lucía', 1, 8),
(877, 'Santa Marta', 1, 47),
(878, 'Santa María', 1, 15),
(879, 'Santa María', 1, 41),
(880, 'Santa Rosa', 1, 13),
(881, 'Santa Rosa', 1, 19),
(882, 'Santa Rosa de Cabal', 1, 66),
(883, 'Santa Rosa de Osos', 1, 5),
(884, 'Santa Rosa de Viterbo', 1, 15),
(885, 'Santa Rosa del Sur', 1, 13),
(886, 'Santa Rosalía', 1, 99),
(887, 'Santa Sofía', 1, 15),
(888, 'Santana', 1, 15),
(889, 'Santander de Quilichao', 1, 19),
(890, 'Santiago', 1, 54),
(891, 'Santiago', 1, 86),
(892, 'Santo Domingo', 1, 5),
(893, 'Santo Tomás', 1, 8),
(894, 'Santuario', 1, 5),
(895, 'Santuario', 1, 66),
(896, 'Sapuyes', 1, 52),
(897, 'Saravena', 1, 81),
(898, 'Sardinata', 1, 54),
(899, 'Sasaima', 1, 25),
(900, 'Sativanorte', 1, 15),
(901, 'Sativasur', 1, 15),
(902, 'Segovia', 1, 5),
(903, 'Sesquilé', 1, 25),
(904, 'Sevilla', 1, 76),
(905, 'Siachoque', 1, 15),
(906, 'Sibaté', 1, 25),
(907, 'Sibundoy', 1, 86),
(908, 'Silos', 1, 54),
(909, 'Silvania', 1, 25),
(910, 'Silvia', 1, 19),
(911, 'Simacota', 1, 68),
(912, 'Simijaca', 1, 25),
(913, 'Simití', 1, 13),
(914, 'Sincelejo', 1, 70),
(915, 'Sincé', 1, 70),
(916, 'Sipí', 1, 27),
(917, 'Sitionuevo', 1, 47),
(918, 'Soacha', 1, 25),
(919, 'Soatá', 1, 15),
(920, 'Socha', 1, 15),
(921, 'Socorro', 1, 68),
(922, 'Socotá', 1, 15),
(923, 'Sogamoso', 1, 15),
(924, 'Solano', 1, 18),
(925, 'Soledad', 1, 8),
(926, 'Solita', 1, 18),
(927, 'Somondoco', 1, 15),
(928, 'Sonsón', 1, 5),
(929, 'Sopetrán', 1, 5),
(930, 'Soplaviento', 1, 13),
(931, 'Sopó', 1, 25),
(932, 'Sora', 1, 15),
(933, 'Soracá', 1, 15),
(934, 'Sotaquirá', 1, 15),
(935, 'Sotara (Paispamba)', 1, 19),
(936, 'Sotomayor (Los Andes)', 1, 52),
(937, 'Suaita', 1, 68),
(938, 'Suan', 1, 8),
(939, 'Suaza', 1, 41),
(940, 'Subachoque', 1, 25),
(941, 'Sucre', 1, 19),
(942, 'Sucre', 1, 68),
(943, 'Sucre', 1, 70),
(944, 'Suesca', 1, 25),
(945, 'Supatá', 1, 25),
(946, 'Supía', 1, 17),
(947, 'Suratá', 1, 68),
(948, 'Susa', 1, 25),
(949, 'Susacón', 1, 15),
(950, 'Sutamarchán', 1, 15),
(951, 'Sutatausa', 1, 25),
(952, 'Sutatenza', 1, 15),
(953, 'Suárez', 1, 19),
(954, 'Suárez', 1, 73),
(955, 'Sácama', 1, 85),
(956, 'Sáchica', 1, 15),
(957, 'Tabio', 1, 25),
(958, 'Tadó', 1, 27),
(959, 'Talaigua Nuevo', 1, 13),
(960, 'Tamalameque', 1, 20),
(961, 'Tame', 1, 81),
(962, 'Taminango', 1, 52),
(963, 'Tangua', 1, 52),
(964, 'Taraira', 1, 97),
(965, 'Tarazá', 1, 5),
(966, 'Tarqui', 1, 41),
(967, 'Tarso', 1, 5),
(968, 'Tasco', 1, 15),
(969, 'Tauramena', 1, 85),
(970, 'Tausa', 1, 25),
(971, 'Tello', 1, 41),
(972, 'Tena', 1, 25),
(973, 'Tenerife', 1, 47),
(974, 'Tenjo', 1, 25),
(975, 'Tenza', 1, 15),
(976, 'Teorama', 1, 54),
(977, 'Teruel', 1, 41),
(978, 'Tesalia', 1, 41),
(979, 'Tibacuy', 1, 25),
(980, 'Tibaná', 1, 15),
(981, 'Tibasosa', 1, 15),
(982, 'Tibirita', 1, 25),
(983, 'Tibú', 1, 54),
(984, 'Tierralta', 1, 23),
(985, 'Timaná', 1, 41),
(986, 'Timbiquí', 1, 19),
(987, 'Timbío', 1, 19),
(988, 'Tinjacá', 1, 15),
(989, 'Tipacoque', 1, 15),
(990, 'Tiquisio (Puerto Rico)', 1, 13),
(991, 'Titiribí', 1, 5),
(992, 'Toca', 1, 15),
(993, 'Tocaima', 1, 25),
(994, 'Tocancipá', 1, 25),
(995, 'Toguí', 1, 15),
(996, 'Toledo', 1, 5),
(997, 'Toledo', 1, 54),
(998, 'Tolú', 1, 70),
(999, 'Tolú Viejo', 1, 70),
(1000, 'Tona', 1, 68),
(1001, 'Topagá', 1, 15),
(1002, 'Topaipí', 1, 25),
(1003, 'Toribío', 1, 19),
(1004, 'Toro', 1, 76),
(1005, 'Tota', 1, 15),
(1006, 'Totoró', 1, 19),
(1007, 'Trinidad', 1, 85),
(1008, 'Trujillo', 1, 76),
(1009, 'Tubará', 1, 8),
(1010, 'Tuchín', 1, 23),
(1011, 'Tulúa', 1, 76),
(1012, 'Tumaco', 1, 52),
(1013, 'Tunja', 1, 15),
(1014, 'Tunungua', 1, 15),
(1015, 'Turbaco', 1, 13),
(1016, 'Turbaná', 1, 13),
(1017, 'Turbo', 1, 5),
(1018, 'Turmequé', 1, 15),
(1019, 'Tuta', 1, 15),
(1020, 'Tutasá', 1, 15),
(1021, 'Támara', 1, 85),
(1022, 'Támesis', 1, 5),
(1023, 'Túquerres', 1, 52),
(1024, 'Ubalá', 1, 25),
(1025, 'Ubaque', 1, 25),
(1026, 'Ubaté', 1, 25),
(1027, 'Ulloa', 1, 76),
(1028, 'Une', 1, 25),
(1029, 'Unguía', 1, 27),
(1030, 'Unión Panamericana (ÁNIMAS)', 1, 27),
(1031, 'Uramita', 1, 5),
(1032, 'Uribe', 1, 50),
(1033, 'Uribia', 1, 44),
(1034, 'Urrao', 1, 5),
(1035, 'Urumita', 1, 44),
(1036, 'Usiacuri', 1, 8),
(1037, 'Valdivia', 1, 5),
(1038, 'Valencia', 1, 23),
(1039, 'Valle de San José', 1, 68),
(1040, 'Valle de San Juan', 1, 73),
(1041, 'Valle del Guamuez', 1, 86),
(1042, 'Valledupar', 1, 20),
(1043, 'Valparaiso', 1, 5),
(1044, 'Valparaiso', 1, 18),
(1045, 'Vegachí', 1, 5),
(1046, 'Venadillo', 1, 73),
(1047, 'Venecia', 1, 5),
(1048, 'Venecia (Ospina Pérez)', 1, 25),
(1049, 'Ventaquemada', 1, 15),
(1050, 'Vergara', 1, 25),
(1051, 'Versalles', 1, 76),
(1052, 'Vetas', 1, 68),
(1053, 'Viani', 1, 25),
(1054, 'Vigía del Fuerte', 1, 5),
(1055, 'Vijes', 1, 76),
(1056, 'Villa Caro', 1, 54),
(1057, 'Villa Rica', 1, 19),
(1058, 'Villa de Leiva', 1, 15),
(1059, 'Villa del Rosario', 1, 54),
(1060, 'Villagarzón', 1, 86),
(1061, 'Villagómez', 1, 25),
(1062, 'Villahermosa', 1, 73),
(1063, 'Villamaría', 1, 17),
(1064, 'Villanueva', 1, 13),
(1065, 'Villanueva', 1, 44),
(1066, 'Villanueva', 1, 68),
(1067, 'Villanueva', 1, 85),
(1068, 'Villapinzón', 1, 25),
(1069, 'Villarrica', 1, 73),
(1070, 'Villavicencio', 1, 50),
(1071, 'Villavieja', 1, 41),
(1072, 'Villeta', 1, 25),
(1073, 'Viotá', 1, 25),
(1074, 'Viracachá', 1, 15),
(1075, 'Vista Hermosa', 1, 50),
(1076, 'Viterbo', 1, 17),
(1077, 'Vélez', 1, 68),
(1078, 'Yacopí', 1, 25),
(1079, 'Yacuanquer', 1, 52),
(1080, 'Yaguará', 1, 41),
(1081, 'Yalí', 1, 5),
(1082, 'Yarumal', 1, 5),
(1083, 'Yolombó', 1, 5),
(1084, 'Yondó (Casabe)', 1, 5),
(1085, 'Yopal', 1, 85),
(1086, 'Yotoco', 1, 76),
(1087, 'Yumbo', 1, 76),
(1088, 'Zambrano', 1, 13),
(1089, 'Zapatoca', 1, 68),
(1090, 'Zapayán (PUNTA DE PIEDRAS)', 1, 47),
(1091, 'Zaragoza', 1, 5),
(1092, 'Zarzal', 1, 76),
(1093, 'Zetaquirá', 1, 15),
(1094, 'Zipacón', 1, 25),
(1095, 'Zipaquirá', 1, 25),
(1096, 'Zona Bananera (PRADO - SEVILLA)', 1, 47),
(1097, 'Ábrego', 1, 54),
(1098, 'Íquira', 1, 41),
(1099, 'Úmbita', 1, 15),
(1100, 'Útica', 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_funcion` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `id_rol`, `id_funcion`, `updated_at`, `created_at`) VALUES
(1, 1, 3, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(2, 1, 14, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(3, 1, 15, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(4, 1, 16, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(5, 1, 17, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(6, 1, 28, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(7, 1, 1, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(8, 1, 2, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(9, 1, 4, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(10, 1, 5, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(11, 1, 6, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(12, 1, 7, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(13, 1, 8, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(14, 1, 9, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(15, 1, 10, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(16, 1, 11, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(17, 1, 12, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(18, 1, 13, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(19, 1, 18, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(20, 1, 19, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(21, 1, 20, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(22, 1, 21, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(23, 1, 22, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(24, 1, 23, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(25, 1, 24, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(26, 1, 25, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(27, 1, 26, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(28, 2, 15, '2024-08-08 18:43:49', '2024-08-08 18:43:49'),
(29, 2, 16, '2024-08-08 18:43:49', '2024-08-08 18:43:49'),
(30, 2, 19, '2024-08-08 18:43:49', '2024-08-08 18:43:49'),
(31, 2, 23, '2024-08-08 18:43:49', '2024-08-08 18:43:49'),
(32, 3, 15, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(33, 3, 16, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(34, 3, 19, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(35, 3, 22, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(36, 3, 23, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(37, 3, 37, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(38, 4, 15, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(39, 4, 16, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(40, 4, 19, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(41, 4, 20, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(42, 4, 21, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(43, 4, 36, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(44, 4, 23, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(45, 4, 24, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(46, 4, 25, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(47, 5, 15, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(48, 5, 16, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(49, 5, 19, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(50, 5, 22, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(51, 5, 23, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(52, 5, 37, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(53, 6, 15, '2024-08-08 18:52:29', '2024-08-08 18:52:29'),
(54, 6, 16, '2024-08-08 18:52:29', '2024-08-08 18:52:29'),
(55, 6, 19, '2024-08-08 18:52:29', '2024-08-08 18:52:29'),
(56, 6, 23, '2024-08-08 18:52:29', '2024-08-08 18:52:29'),
(57, 7, 15, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(58, 7, 16, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(59, 7, 19, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(60, 7, 21, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(61, 7, 23, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(62, 7, 24, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(63, 7, 25, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(64, 8, 15, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(65, 8, 16, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(66, 8, 19, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(67, 8, 21, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(68, 8, 23, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(69, 8, 24, '2024-08-08 18:53:47', '2024-08-08 18:53:47'),
(70, 8, 25, '2024-08-08 18:53:47', '2024-08-08 18:53:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_operativo`
--

CREATE TABLE `plan_operativo` (
  `id_plan` int(11) NOT NULL,
  `actividad` varchar(900) NOT NULL,
  `tarea` varchar(900) NOT NULL,
  `resultado` varchar(900) NOT NULL,
  `producto` varchar(150) NOT NULL,
  `frecuencia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesiones`
--

CREATE TABLE `profesiones` (
  `id_profesion` int(11) NOT NULL,
  `nombre_profesion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesiones`
--

INSERT INTO `profesiones` (`id_profesion`, `nombre_profesion`) VALUES
(1, 'Administración Comercial y de Mercadeo'),
(2, 'Administración Financiera'),
(3, 'Administración de Empresas'),
(4, 'Administración de Logística Internacionales'),
(5, 'Administración de Negocios'),
(6, 'Administración de empresas'),
(7, 'Administración de negocios'),
(8, 'Administración en Mercadeo'),
(9, 'Administración en Recursos Humanos'),
(10, 'Administración en Salud Ocupacional'),
(11, 'Administración y Finanzas'),
(12, 'Arte contemporáneo'),
(13, 'Atención prehospitalaria'),
(14, 'Bacteriología y laboratorio clínico'),
(15, 'Bioingeniería'),
(16, 'Biomedicina'),
(17, 'Ciencias políticas y relaciones internacionales'),
(18, 'Comunicación social'),
(19, 'Contaduría pública'),
(20, 'De interiores'),
(21, 'De marcas'),
(22, 'De moda'),
(23, 'Derecho'),
(24, 'Diseñador de videojuegos'),
(25, 'Diseñador gráfico'),
(26, 'Diseño'),
(27, 'Diseño de muebles'),
(28, 'Diseño digital'),
(29, 'Diseño industrial'),
(30, 'Diseño naval'),
(31, 'Diseño publicitario'),
(32, 'Diseño textiles'),
(33, 'Diseño y decoración'),
(34, 'Diseño y desarrollo web'),
(35, 'Economía'),
(36, 'Enfermería'),
(37, 'Estadística'),
(38, 'Farmacia'),
(39, 'Finanzas y comercio internacional'),
(40, 'Fisioterapia o Terapia física'),
(41, 'Genética'),
(42, 'Geología'),
(43, 'Ingeniería'),
(44, 'Ingeniería Aeronáutica'),
(45, 'Ingeniería Agroforestal'),
(46, 'Ingeniería Agropecuaria'),
(47, 'Ingeniería Ambiental o Medio Ambiental'),
(48, 'Ingeniería Biomédica'),
(49, 'Ingeniería Civil'),
(50, 'Ingeniería Electromecánica'),
(51, 'Ingeniería Electrónica'),
(52, 'Ingeniería Eléctrica'),
(53, 'Ingeniería Forestal'),
(54, 'Ingeniería Física'),
(55, 'Ingeniería Geomática'),
(56, 'Ingeniería Hidráulica'),
(57, 'Ingeniería Industrial'),
(58, 'Ingeniería Informática'),
(59, 'Ingeniería Mecánica'),
(60, 'Ingeniería Metalúrgica'),
(61, 'Ingeniería Naval'),
(62, 'Ingeniería Pesquera'),
(63, 'Ingeniería Petrolera'),
(64, 'Ingeniería Química'),
(65, 'Ingeniería Robótica y Mecatrónica'),
(66, 'Ingeniería Zootecnista'),
(67, 'Ingeniería administrativa'),
(68, 'Ingeniería de Agrimensura'),
(69, 'Ingeniería de Fabricación'),
(70, 'Ingeniería de Materiales'),
(71, 'Ingeniería de Minas'),
(72, 'Ingeniería de Producción'),
(73, 'Ingeniería de Producción por Ciclos Propedéuticos'),
(74, 'Ingeniería de Sistemas'),
(75, 'Ingeniería de Software'),
(76, 'Ingeniería de minas'),
(77, 'Ingeniería de producción'),
(78, 'Ingeniería de sistemas'),
(79, 'Ingeniería de sistemas y computación'),
(80, 'Ingeniería de telecomunicaciones'),
(81, 'Ingeniería electromecánica'),
(82, 'Ingeniería electrónica'),
(83, 'Ingeniería eléctrica'),
(84, 'Ingeniería en Ecología'),
(85, 'Ingeniería en Sonido'),
(86, 'Ingeniería en Telecomunicaciones'),
(87, 'Ingeniería industrial'),
(88, 'Ingeniería informática'),
(89, 'Ingeniería mecánica'),
(90, 'Medicina'),
(91, 'Medicina general'),
(92, 'Mercadeo y publicidad'),
(93, 'Negocios internacionales'),
(94, 'Nutrición y dietetica'),
(95, 'Odontología'),
(96, 'Oftalmología'),
(97, 'Optometría'),
(98, 'Paramédico'),
(99, 'Psicología'),
(100, 'Psiquiatría'),
(101, 'Quiropráctica'),
(102, 'Química farmacéutica'),
(103, 'Relaciones económicas internacionales'),
(104, 'Salud ocupacional'),
(105, 'Terapia respiratoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_formacion`
--

CREATE TABLE `programas_formacion` (
  `id_programa` int(11) NOT NULL,
  `numero_ficha` varchar(30) NOT NULL,
  `programa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_conocimiento`
--

CREATE TABLE `redes_conocimiento` (
  `id_Red` int(11) NOT NULL,
  `nombre_red` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'Administrador', 1, '2024-08-08 18:42:06', '2024-08-08 18:42:06'),
(2, 'Aprendiz', 1, '2024-08-08 18:43:49', '2024-08-08 18:43:49'),
(3, 'Líder de proyecto', 1, '2024-08-08 18:50:14', '2024-08-08 18:50:14'),
(4, 'Líder de semillero', 1, '2024-08-08 18:51:29', '2024-08-08 18:51:29'),
(5, 'Instructor investigador', 1, '2024-08-08 18:52:04', '2024-08-08 18:52:04'),
(6, 'Administrador', 1, '2024-08-08 18:52:29', '2024-08-08 18:52:29'),
(7, 'Coordinador', 1, '2024-08-08 18:53:17', '2024-08-08 18:53:17'),
(8, 'Dinamizador SENNOVA', 1, '2024-08-08 18:53:47', '2024-08-08 18:53:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semilleros_ has_lineas`
--

CREATE TABLE `semilleros_ has_lineas` (
  `id_semilleros_has_lineas` int(11) NOT NULL,
  `id_semillero` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semilleros_has_programas`
--

CREATE TABLE `semilleros_has_programas` (
  `id_semilleros_has_programas` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_semillero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semilleros_ has_redes`
--

CREATE TABLE `semilleros_ has_redes` (
  `id_semilleros_has_redes` int(11) NOT NULL,
  `id_semillero` int(11) NOT NULL,
  `id_red` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semilleros_investigacion`
--

CREATE TABLE `semilleros_investigacion` (
  `id_semillero` int(11) NOT NULL,
  `nombre_semillero` varchar(150) NOT NULL,
  `iniciales_semillero` varchar(150) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `mision` varchar(900) NOT NULL,
  `vision` varchar(900) NOT NULL,
  `objetivo_general` varchar(200) NOT NULL,
  `objetivos_especificos` varchar(700) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_poblaciones`
--

CREATE TABLE `tipos_poblaciones` (
  `id_tipo` int(11) NOT NULL,
  `tipo_poblacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_poblaciones`
--

INSERT INTO `tipos_poblaciones` (`id_tipo`, `tipo_poblacion`) VALUES
(41, 'ABANDONO_O_DESPOJO_FORZADO_DE_TIERRAS'),
(42, 'ACTOS_TERRORISTA/ATENTADOS/COMBATES/ENFRENTAMIENTOS/HOSTIGAMIENTOS'),
(43, 'ADOLESCENTE_DESVINCULADO_DE_GRUPOS_ARMADOS_ORGANIZADOS'),
(44, 'ADOLESCENTE_EN_CONFLICTO_CON_LA_LEY_PENAL'),
(45, 'ADOLESCENTE_TRABAJADOR'),
(46, 'AMENAZA'),
(47, 'ARTESANOS'),
(48, 'CAMPESINO'),
(49, 'DELITOS_CONTRA_LA_LIBERTAD_Y_LA_INTEGRIDAD_SEXUAL_EN_DESARROLLO_DEL_CONFLICTO_ARMADO'),
(50, 'DESAPARICIÓN_FORZADA'),
(51, 'DESPLAZADOS_DISCAPACITADOS'),
(52, 'DESPLAZADOS_POR_FENÓMENOS_NATURALES_CABEZA_DE_FAMI'),
(53, 'DESPLAZADOS_POR_LA_VIOLENCIA'),
(54, 'DESPLAZADOS_POR_LA_VIOLENCIA_CABEZA_DE_FAMILIA'),
(55, 'DISCAPACIDAD_INTELECTUAL'),
(56, 'DISCAPACIDAD_AUDITIVA'),
(57, 'DISCAPACIDAD_FÍSICA'),
(58, 'DISCAPACIDAD_VISUAL'),
(59, 'DISCAPACIDAD_PSICOSOCIAL'),
(60, 'DISCAPACIDAD_MÚLTIPLE'),
(61, 'SORDOCEGUERA'),
(62, 'EMPRENDEDORES'),
(63, 'HERIDO'),
(64, 'HOMICIDIO_/_MASACRE'),
(65, 'INPEC'),
(66, 'JOVENES_VULNERABLES'),
(67, 'MICROEMPRESAS'),
(68, 'MINAS_ANTIPERSONAL,MUNICIÓN_SIN_EXPLOTAR,_Y_ARTEFACTO«EXPLOSIVO_IMPROVISADO'),
(69, 'MUJER_CABEZA_DE_FAMILIA'),
(70, 'PERSONAS_EN_PROCESO_DE_REINTEGRACIÓN'),
(71, 'RECLUTAMIENTO_FORZADO'),
(72, 'REMITIDOS_POR_EL_CIE'),
(73, 'REMITIDOS_POR_EL_PAL'),
(74, 'SECUESTRO'),
(75, 'SOBREVIVIENTES_MINAS_ANTIPERSONALES'),
(76, 'SOLDADOS_CAMPESINOS'),
(77, 'TERCERA_EDAD'),
(78, 'TORTURA'),
(79, 'VINCULACIÓN_DE_NIÑOS,_NIÑAS_Y_ADOLESCENTES_A_ACTIVIDADES_RELACIONADAS_CON_GRUPOS_ARMADOS'),
(80, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ayzack', 'a@gmail.com', NULL, '$2y$12$mSvTX876QUTWEVkARpyaSeC.Qt9AEK/G36Gl5nS58o0HCAKQBTXcC', NULL, '2024-07-23 21:18:33', '2024-07-23 21:18:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  ADD PRIMARY KEY (`id_centro`),
  ADD UNIQUE KEY `Cu_codigo_centro` (`codigo_centro`);

--
-- Indices de la tabla `controladores`
--
ALTER TABLE `controladores`
  ADD PRIMARY KEY (`id_controlador`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `detalle_doctorado`
--
ALTER TABLE `detalle_doctorado`
  ADD PRIMARY KEY (`id_detalle_doctorado`);

--
-- Indices de la tabla `detalle_maestria`
--
ALTER TABLE `detalle_maestria`
  ADD PRIMARY KEY (`id_detalle_maestria`);

--
-- Indices de la tabla `detalle_profesion`
--
ALTER TABLE `detalle_profesion`
  ADD PRIMARY KEY (`id_detalle_profesion`);

--
-- Indices de la tabla `doctorados`
--
ALTER TABLE `doctorados`
  ADD PRIMARY KEY (`id_doctorado`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id_funcion`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `grupos_investigacion`
--
ALTER TABLE `grupos_investigacion`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  ADD PRIMARY KEY (`id_integrante`);

--
-- Indices de la tabla `lineas_investigacion`
--
ALTER TABLE `lineas_investigacion`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `maestrias`
--
ALTER TABLE `maestrias`
  ADD PRIMARY KEY (`id_maestria`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `plan_operativo`
--
ALTER TABLE `plan_operativo`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  ADD PRIMARY KEY (`id_profesion`);

--
-- Indices de la tabla `programas_formacion`
--
ALTER TABLE `programas_formacion`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `redes_conocimiento`
--
ALTER TABLE `redes_conocimiento`
  ADD PRIMARY KEY (`id_Red`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `semilleros_ has_lineas`
--
ALTER TABLE `semilleros_ has_lineas`
  ADD PRIMARY KEY (`id_semilleros_has_lineas`);

--
-- Indices de la tabla `semilleros_has_programas`
--
ALTER TABLE `semilleros_has_programas`
  ADD PRIMARY KEY (`id_semilleros_has_programas`);

--
-- Indices de la tabla `semilleros_ has_redes`
--
ALTER TABLE `semilleros_ has_redes`
  ADD PRIMARY KEY (`id_semilleros_has_redes`);

--
-- Indices de la tabla `semilleros_investigacion`
--
ALTER TABLE `semilleros_investigacion`
  ADD PRIMARY KEY (`id_semillero`);

--
-- Indices de la tabla `tipos_poblaciones`
--
ALTER TABLE `tipos_poblaciones`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  MODIFY `id_centro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `controladores`
--
ALTER TABLE `controladores`
  MODIFY `id_controlador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `detalle_doctorado`
--
ALTER TABLE `detalle_doctorado`
  MODIFY `id_detalle_doctorado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_maestria`
--
ALTER TABLE `detalle_maestria`
  MODIFY `id_detalle_maestria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_profesion`
--
ALTER TABLE `detalle_profesion`
  MODIFY `id_detalle_profesion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctorados`
--
ALTER TABLE `doctorados`
  MODIFY `id_doctorado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id_funcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `grupos_investigacion`
--
ALTER TABLE `grupos_investigacion`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  MODIFY `id_integrante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas_investigacion`
--
ALTER TABLE `lineas_investigacion`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `maestrias`
--
ALTER TABLE `maestrias`
  MODIFY `id_maestria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_operativo`
--
ALTER TABLE `plan_operativo`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `programas_formacion`
--
ALTER TABLE `programas_formacion`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redes_conocimiento`
--
ALTER TABLE `redes_conocimiento`
  MODIFY `id_Red` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `semilleros_ has_lineas`
--
ALTER TABLE `semilleros_ has_lineas`
  MODIFY `id_semilleros_has_lineas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semilleros_has_programas`
--
ALTER TABLE `semilleros_has_programas`
  MODIFY `id_semilleros_has_programas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semilleros_ has_redes`
--
ALTER TABLE `semilleros_ has_redes`
  MODIFY `id_semilleros_has_redes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semilleros_investigacion`
--
ALTER TABLE `semilleros_investigacion`
  MODIFY `id_semillero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_poblaciones`
--
ALTER TABLE `tipos_poblaciones`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
