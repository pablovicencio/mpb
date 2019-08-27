-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-08-2019 a las 20:19:15
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_mpb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `act_producto`
--

DROP TABLE IF EXISTS `act_producto`;
CREATE TABLE IF NOT EXISTS `act_producto` (
  `id_act` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_act` int(11) NOT NULL,
  `nom_prod_act` varchar(150) NOT NULL,
  `uni_prod_act` int(11) DEFAULT NULL,
  `envase_prod_act` int(11) DEFAULT NULL,
  `cat_prod_act` int(11) NOT NULL,
  `marca_prod_act` varchar(100) NOT NULL,
  `precio_envase_prod_act` int(11) NOT NULL,
  `precio_uni_prod_act` int(11) NOT NULL,
  `tienda_prod_act` int(11) DEFAULT NULL,
  `fec_reg_act` datetime DEFAULT NULL,
  `ope_prod_act` int(11) DEFAULT NULL,
  `vig_prod_act` int(11) NOT NULL,
  PRIMARY KEY (`id_act`),
  KEY `fk_prod_act_idx` (`id_prod_act`),
  KEY `fk_ope_act_idx` (`ope_prod_act`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(150) DEFAULT NULL,
  `fec_cre_cat` datetime NOT NULL,
  `ope_cre_cat` int(11) DEFAULT NULL,
  `vig_cat` int(11) NOT NULL,
  PRIMARY KEY (`id_cat`),
  KEY `fk_ope_cat_idx` (`ope_cre_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nom_cat`, `fec_cre_cat`, `ope_cre_cat`, `vig_cat`) VALUES
(1, 'test', '2019-07-13 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

DROP TABLE IF EXISTS `comuna`;
CREATE TABLE IF NOT EXISTS `comuna` (
  `COMUNA_ID` int(5) NOT NULL DEFAULT '0',
  `COMUNA_NOMBRE` varchar(20) DEFAULT NULL,
  `COMUNA_PROVINCIA_ID` int(3) DEFAULT NULL,
  PRIMARY KEY (`COMUNA_ID`),
  KEY `COMUNA_PROVINCIA_ID` (`COMUNA_PROVINCIA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`COMUNA_ID`, `COMUNA_NOMBRE`, `COMUNA_PROVINCIA_ID`) VALUES
(1101, 'Iquique', 11),
(1107, 'Alto Hospicio', 11),
(1401, 'Pozo Almonte', 14),
(1402, 'Camiña', 14),
(1403, 'Colchane', 14),
(1404, 'Huara', 14),
(1405, 'Pica', 14),
(2101, 'Antofagasta', 21),
(2102, 'Mejillones', 21),
(2103, 'Sierra Gorda', 21),
(2104, 'Taltal', 21),
(2201, 'Calama', 22),
(2202, 'Ollagüe', 22),
(2203, 'San Pedro de Atacama', 22),
(2301, 'Tocopilla', 23),
(2302, 'María Elena', 23),
(3101, 'Copiapó', 31),
(3102, 'Caldera', 31),
(3103, 'Tierra Amarilla', 31),
(3201, 'Chañaral', 32),
(3202, 'Diego de Almagro', 32),
(3301, 'Vallenar', 33),
(3302, 'Alto del Carmen', 33),
(3303, 'Freirina', 33),
(3304, 'Huasco', 33),
(4101, 'La Serena', 41),
(4102, 'Coquimbo', 41),
(4103, 'Andacollo', 41),
(4104, 'La Higuera', 41),
(4105, 'Paihuano', 41),
(4106, 'Vicuña', 41),
(4201, 'Illapel', 42),
(4202, 'Canela', 42),
(4203, 'Los Vilos', 42),
(4204, 'Salamanca', 42),
(4301, 'Ovalle', 43),
(4302, 'Combarbalá', 43),
(4303, 'Monte Patria', 43),
(4304, 'Punitaqui', 43),
(4305, 'Río Hurtado', 43),
(5101, 'Valparaíso', 51),
(5102, 'Casablanca', 51),
(5103, 'Concón', 51),
(5104, 'Juan Fernández', 51),
(5105, 'Puchuncaví', 51),
(5107, 'Quintero', 51),
(5109, 'Viña del Mar', 51),
(5201, 'Isla de Pascua', 52),
(5301, 'Los Andes', 53),
(5302, 'Calle Larga', 53),
(5303, 'Rinconada', 53),
(5304, 'San Esteban', 53),
(5401, 'La Ligua', 54),
(5402, 'Cabildo', 54),
(5403, 'Papudo', 54),
(5404, 'Petorca', 54),
(5405, 'Zapallar', 54),
(5501, 'Quillota', 55),
(5502, 'La Calera', 55),
(5503, 'Hijuelas', 55),
(5504, 'La Cruz', 55),
(5506, 'Nogales', 55),
(5601, 'San Antonio', 56),
(5602, 'Algarrobo', 56),
(5603, 'Cartagena', 56),
(5604, 'El Quisco', 56),
(5605, 'El Tabo', 56),
(5606, 'Santo Domingo', 56),
(5701, 'San Felipe', 57),
(5702, 'Catemu', 57),
(5703, 'Llay Llay', 57),
(5704, 'Panquehue', 57),
(5705, 'Putaendo', 57),
(5706, 'Santa María', 57),
(5801, 'Quilpué', 58),
(5802, 'Limache', 58),
(5803, 'Olmué', 58),
(5804, 'Villa Alemana', 58),
(6101, 'Rancagua', 61),
(6102, 'Codegua', 61),
(6103, 'Coinco', 61),
(6104, 'Coltauco', 61),
(6105, 'Doñihue', 61),
(6106, 'Graneros', 61),
(6107, 'Las Cabras', 61),
(6108, 'Machalí', 61),
(6109, 'Malloa', 61),
(6110, 'Mostazal', 61),
(6111, 'Olivar', 61),
(6112, 'Peumo', 61),
(6113, 'Pichidegua', 61),
(6114, 'Quinta de Tilcoco', 61),
(6115, 'Rengo', 61),
(6116, 'Requínoa', 61),
(6117, 'San Vicente', 61),
(6201, 'Pichilemu', 62),
(6202, 'La Estrella', 62),
(6203, 'Litueche', 62),
(6204, 'Marchihue', 62),
(6205, 'Navidad', 62),
(6206, 'Paredones', 62),
(6301, 'San Fernando', 63),
(6302, 'Chépica', 63),
(6303, 'Chimbarongo', 63),
(6304, 'Lolol', 63),
(6305, 'Nancagua', 63),
(6306, 'Palmilla', 63),
(6307, 'Peralillo', 63),
(6308, 'Placilla', 63),
(6309, 'Pumanque', 63),
(6310, 'Santa Cruz', 63),
(7101, 'Talca', 71),
(7102, 'Constitución', 71),
(7103, 'Curepto', 71),
(7104, 'Empedrado', 71),
(7105, 'Maule', 71),
(7106, 'Pelarco', 71),
(7107, 'Pencahue', 71),
(7108, 'Río Claro', 71),
(7109, 'San Clemente', 71),
(7110, 'San Rafael', 71),
(7201, 'Cauquenes', 72),
(7202, 'Chanco', 72),
(7203, 'Pelluhue', 72),
(7301, 'Curicó', 73),
(7302, 'Hualañé', 73),
(7303, 'Licantén', 73),
(7304, 'Molina', 73),
(7305, 'Rauco', 73),
(7306, 'Romeral', 73),
(7307, 'Sagrada Familia', 73),
(7308, 'Teno', 73),
(7309, 'Vichuquén', 73),
(7401, 'Linares', 74),
(7402, 'Colbún', 74),
(7403, 'Longaví', 74),
(7404, 'Parral', 74),
(7405, 'Retiro', 74),
(7406, 'San Javier', 74),
(7407, 'Villa Alegre', 74),
(7408, 'Yerbas Buenas', 74),
(8101, 'Concepción', 81),
(8102, 'Coronel', 81),
(8103, 'Chiguayante', 81),
(8104, 'Florida', 81),
(8105, 'Hualqui', 81),
(8106, 'Lota', 81),
(8107, 'Penco', 81),
(8108, 'San Pedro de la Paz', 81),
(8109, 'Santa Juana', 81),
(8110, 'Talcahuano', 81),
(8111, 'Tomé', 81),
(8112, 'Hualpén', 81),
(8201, 'Lebu', 82),
(8202, 'Arauco', 82),
(8203, 'Cañete', 82),
(8204, 'Contulmo', 82),
(8205, 'Curanilahue', 82),
(8206, 'Los Álamos', 82),
(8207, 'Tirúa', 82),
(8301, 'Los Ángeles', 83),
(8302, 'Antuco', 83),
(8303, 'Cabrero', 83),
(8304, 'Laja', 83),
(8305, 'Mulchén', 83),
(8306, 'Nacimiento', 83),
(8307, 'Negrete', 83),
(8308, 'Quilaco', 83),
(8309, 'Quilleco', 83),
(8310, 'San Rosendo', 83),
(8311, 'Santa Bárbara', 83),
(8312, 'Tucapel', 83),
(8313, 'Yumbel', 83),
(8314, 'Alto Biobío', 83),
(8401, 'Chillán', 163),
(8402, 'Bulnes', 163),
(8403, 'Cobquecura', 162),
(8404, 'Coelemu', 162),
(8405, 'Coihueco', 161),
(8406, 'Chillán Viejo', 163),
(8407, 'El Carmen', 163),
(8408, 'Ninhue', 162),
(8409, 'Ñiquén', 161),
(8410, 'Pemuco', 163),
(8411, 'Pinto', 163),
(8412, 'Portezuelo', 162),
(8413, 'Quillón', 163),
(8414, 'Quirihue', 162),
(8415, 'Ránquil', 162),
(8416, 'San Carlos', 161),
(8417, 'San Fabián', 161),
(8418, 'San Ignacio', 163),
(8419, 'San Nicolás', 161),
(8420, 'Treguaco', 162),
(8421, 'Yungay', 163),
(9101, 'Temuco', 91),
(9102, 'Carahue', 91),
(9103, 'Cunco', 91),
(9104, 'Curarrehue', 91),
(9105, 'Freire', 91),
(9106, 'Galvarino', 91),
(9107, 'Gorbea', 91),
(9108, 'Lautaro', 91),
(9109, 'Loncoche', 91),
(9110, 'Melipeuco', 91),
(9111, 'Nueva Imperial', 91),
(9112, 'Padre las Casas', 91),
(9113, 'Perquenco', 91),
(9114, 'Pitrufquén', 91),
(9115, 'Pucón', 91),
(9116, 'Saavedra', 91),
(9117, 'Teodoro Schmidt', 91),
(9118, 'Toltén', 91),
(9119, 'Vilcún', 91),
(9120, 'Villarrica', 91),
(9121, 'Cholchol', 91),
(9201, 'Angol', 92),
(9202, 'Collipulli', 92),
(9203, 'Curacautín', 92),
(9204, 'Ercilla', 92),
(9205, 'Lonquimay', 92),
(9206, 'Los Sauces', 92),
(9207, 'Lumaco', 92),
(9208, 'Purén', 92),
(9209, 'Renaico', 92),
(9210, 'Traiguén', 92),
(9211, 'Victoria', 92),
(10101, 'Puerto Montt', 101),
(10102, 'Calbuco', 101),
(10103, 'Cochamó', 101),
(10104, 'Fresia', 101),
(10105, 'Frutillar', 101),
(10106, 'Los Muermos', 101),
(10107, 'Llanquihue', 101),
(10108, 'Maullín', 101),
(10109, 'Puerto Varas', 101),
(10201, 'Castro', 102),
(10202, 'Ancud', 102),
(10203, 'Chonchi', 102),
(10204, 'Curaco de Vélez', 102),
(10205, 'Dalcahue', 102),
(10206, 'Puqueldón', 102),
(10207, 'Queilén', 102),
(10208, 'Quellón', 102),
(10209, 'Quemchi', 102),
(10210, 'Quinchao', 102),
(10301, 'Osorno', 103),
(10302, 'Puerto Octay', 103),
(10303, 'Purranque', 103),
(10304, 'Puyehue', 103),
(10305, 'Río Negro', 103),
(10306, 'San Juan de la Costa', 103),
(10307, 'San Pablo', 103),
(10401, 'Chaitén', 104),
(10402, 'Futaleufú', 104),
(10403, 'Hualaihué', 104),
(10404, 'Palena', 104),
(11101, 'Coyhaique', 111),
(11102, 'Lago Verde', 111),
(11201, 'Aysén', 112),
(11202, 'Cisnes', 112),
(11203, 'Guaitecas', 112),
(11301, 'Cochrane', 113),
(11302, 'O\'Higgins', 113),
(11303, 'Tortel', 113),
(11401, 'Chile Chico', 114),
(11402, 'Río Ibáñez', 114),
(12101, 'Punta Arenas', 121),
(12102, 'Laguna Blanca', 121),
(12103, 'Río Verde', 121),
(12104, 'San Gregorio', 121),
(12201, 'Cabo de Hornos', 122),
(12202, 'Antártica', 122),
(12301, 'Porvenir', 123),
(12302, 'Primavera', 123),
(12303, 'Timaukel', 123),
(12401, 'Natales', 124),
(12402, 'Torres del Paine', 124),
(13101, 'Santiago', 131),
(13102, 'Cerrillos', 131),
(13103, 'Cerro Navia', 131),
(13104, 'Conchalí', 131),
(13105, 'El Bosque', 131),
(13106, 'Estación Central', 131),
(13107, 'Huechuraba', 131),
(13108, 'Independencia', 131),
(13109, 'La Cisterna', 131),
(13110, 'La Florida', 131),
(13111, 'La Granja', 131),
(13112, 'La Pintana', 131),
(13113, 'La Reina', 131),
(13114, 'Las Condes', 131),
(13115, 'Lo Barnechea', 131),
(13116, 'Lo Espejo', 131),
(13117, 'Lo Prado', 131),
(13118, 'Macul', 131),
(13119, 'Maipú', 131),
(13120, 'Ñuñoa', 131),
(13121, 'Pedro Aguirre Cerda', 131),
(13122, 'Peñalolén', 131),
(13123, 'Providencia', 131),
(13124, 'Pudahuel', 131),
(13125, 'Quilicura', 131),
(13126, 'Quinta Normal', 131),
(13127, 'Recoleta', 131),
(13128, 'Renca', 131),
(13129, 'San Joaquín', 131),
(13130, 'San Miguel', 131),
(13131, 'San Ramón', 131),
(13132, 'Vitacura', 131),
(13201, 'Puente Alto', 132),
(13202, 'Pirque', 132),
(13203, 'San José de Maipo', 132),
(13301, 'Colina', 133),
(13302, 'Lampa', 133),
(13303, 'Tiltil', 133),
(13401, 'San Bernardo', 134),
(13402, 'Buin', 134),
(13403, 'Calera de Tango', 134),
(13404, 'Paine', 134),
(13501, 'Melipilla', 135),
(13502, 'Alhué', 135),
(13503, 'Curacaví', 135),
(13504, 'María Pinto', 135),
(13505, 'San Pedro', 135),
(13601, 'Talagante', 136),
(13602, 'El Monte', 136),
(13603, 'Isla de Maipo', 136),
(13604, 'Padre Hurtado', 136),
(13605, 'Peñaflor', 136),
(14101, 'Valdivia', 141),
(14102, 'Corral', 141),
(14103, 'Lanco', 141),
(14104, 'Los Lagos', 141),
(14105, 'Máfil', 141),
(14106, 'Mariquina', 141),
(14107, 'Paillaco', 141),
(14108, 'Panguipulli', 141),
(14201, 'La Unión', 142),
(14202, 'Futrono', 142),
(14203, 'Lago Ranco', 142),
(14204, 'Río Bueno', 142),
(15101, 'Arica', 151),
(15102, 'Camarones', 151),
(15201, 'Putre', 152),
(15202, 'General Lagos', 152);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

DROP TABLE IF EXISTS `descuento`;
CREATE TABLE IF NOT EXISTS `descuento` (
  `id_desc` int(11) NOT NULL AUTO_INCREMENT,
  `info_desc` varchar(100) DEFAULT NULL,
  `dia_desc` int(11) DEFAULT NULL,
  `tienda_desc` int(11) DEFAULT NULL,
  `monto_desc` int(11) DEFAULT NULL,
  `cat_desc` int(11) DEFAULT NULL,
  `ope_desc` int(11) DEFAULT NULL,
  `prod_desc` int(11) DEFAULT NULL,
  `fec_cre_desc` datetime DEFAULT NULL,
  `vig_desc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_desc`),
  KEY `fk_ope_desc_idx` (`ope_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_lista`
--

DROP TABLE IF EXISTS `det_lista`;
CREATE TABLE IF NOT EXISTS `det_lista` (
  `id_det` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod_det` int(11) DEFAULT NULL,
  `vig_det` int(11) DEFAULT NULL,
  `lista_det` int(11) DEFAULT NULL,
  `cant_prod` int(11) NOT NULL,
  PRIMARY KEY (`id_det`),
  KEY `fk_prod_det_idx` (`id_prod_det`),
  KEY `fk_lista_det_idx` (`lista_det`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `det_lista`
--

INSERT INTO `det_lista` (`id_det`, `id_prod_det`, `vig_det`, `lista_det`, `cant_prod`) VALUES
(1, 1, 1, 2, 3),
(2, 2, 1, 2, 2),
(3, 1, 1, 3, 10),
(4, 2, 1, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `desde_horario` time NOT NULL,
  `hasta_horario` time NOT NULL,
  `dia_horario` int(11) NOT NULL,
  `tienda_horario` int(11) NOT NULL,
  `vig_horario` int(11) NOT NULL,
  `ope_cre_horario` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `fk_tienda_horario_idx` (`tienda_horario`),
  KEY `fk_ope_horario_idx` (`ope_cre_horario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_compra`
--

DROP TABLE IF EXISTS `lista_compra`;
CREATE TABLE IF NOT EXISTS `lista_compra` (
  `id_lista` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lista` varchar(150) NOT NULL,
  `fec_cre_lista` datetime DEFAULT NULL,
  `usu_cre_lista` int(11) DEFAULT NULL,
  `vig_lista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lista`),
  KEY `fk_usu_lista_idx` (`usu_cre_lista`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista_compra`
--

INSERT INTO `lista_compra` (`id_lista`, `nom_lista`, `fec_cre_lista`, `usu_cre_lista`, `vig_lista`) VALUES
(1, 'test', '2019-08-23 04:57:36', 1, 1),
(2, 'lista', '2019-08-23 04:59:55', 1, 1),
(3, 'lista 1', '2019-08-23 05:01:49', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operador`
--

DROP TABLE IF EXISTS `operador`;
CREATE TABLE IF NOT EXISTS `operador` (
  `id_ope` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ope` varchar(150) NOT NULL,
  `mail_ope` varchar(100) NOT NULL,
  `fec_cre_ope` datetime NOT NULL,
  `vig_ope` int(11) NOT NULL,
  PRIMARY KEY (`id_ope`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operador`
--

INSERT INTO `operador` (`id_ope`, `nom_ope`, `mail_ope`, `fec_cre_ope`, `vig_ope`) VALUES
(1, 'Pablo', 'pvicencioc@hotmail.cl', '2019-07-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prod` varchar(150) NOT NULL,
  `uni_prod` float DEFAULT NULL,
  `envase_prod` int(11) DEFAULT NULL,
  `cat_prod` int(11) NOT NULL,
  `marca_prod` varchar(100) NOT NULL,
  `precio_envase_prod` int(11) NOT NULL,
  `precio_uni_prod` int(11) NOT NULL,
  `tienda_prod` int(11) DEFAULT NULL,
  `fec_ult_reg` datetime DEFAULT NULL,
  `ope_cre_prod` int(11) DEFAULT NULL,
  `vig_prod` int(11) NOT NULL,
  `img_prod` varchar(250) NOT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `fk_tienda_prod_idx` (`tienda_prod`),
  KEY `fk_ope_prod_idx` (`ope_cre_prod`),
  KEY `fk_cat_prod_idx` (`cat_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `nom_prod`, `uni_prod`, `envase_prod`, `cat_prod`, `marca_prod`, `precio_envase_prod`, `precio_uni_prod`, `tienda_prod`, `fec_ult_reg`, `ope_cre_prod`, `vig_prod`, `img_prod`) VALUES
(1, 'test', 1, 1, 1, 'test marca', 200, 250, 1, '2019-07-13 00:00:00', 1, 1, ''),
(2, 'Te Ceylan', 1, 1, 1, 'Té Supremo', 300, 300, 2, '2019-07-22 00:00:00', 1, 1, ''),
(3, 'Omo 6 Kg', 6, 1, 1, 'Omo', 2582, 15490, 3, '2019-08-27 00:00:00', 1, 1, ''),
(4, 'Omo 0.4 Kg', 0.4, 1, 1, 'Omo', 1873, 749, 4, '2019-08-27 00:00:00', 1, 1, ''),
(7, 'Omo 3.5 Kg', 3.5, 1, 1, 'Omo', 2569, 8990, 5, '2019-08-27 00:00:00', 1, 1, ''),
(8, 'Omo 14 Kg', 14, 1, 1, 'Omo', 1642, 22990, 6, '2019-08-27 00:00:00', 1, 1, ''),
(9, 'Omo 3 Kg', 3, 1, 1, 'Omo', 2637, 7910, 7, '2019-08-27 00:00:00', 1, 1, ''),
(10, 'Omo 2.7 Kg', 2.7, 1, 1, 'Omo', 3996, 10970, 8, '2019-08-27 00:00:00', 1, 1, ''),
(11, 'Leche Colun 3 Lt', 2, 3, 1, 'Colun', 667, 2000, 3, '2019-08-27 00:00:00', 1, 1, ''),
(12, 'Leche Surlat 1 Lt', 1, 2, 1, 'Surlat', 599, 599, 4, '2019-08-27 00:00:00', 1, 1, ''),
(13, 'Leche Lider 1 Lt', 1, 2, 1, 'Lider', 640, 640, 5, '2019-08-27 00:00:00', 1, 1, ''),
(14, 'Leche Tottus 1 Lt', 1, 2, 1, 'Tottus', 599, 599, 6, '2019-08-27 00:00:00', 1, 1, ''),
(15, 'Leche Surlat 6 Lt', 6, 2, 1, 'Surlat', 641, 3845, 7, '2019-08-27 00:00:00', 1, 1, ''),
(16, 'Leche Lider 1 Lt', 1, 2, 1, 'Surlat', 670, 670, 8, '2019-08-27 00:00:00', 1, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `PROVINCIA_ID` int(3) NOT NULL DEFAULT '0',
  `PROVINCIA_NOMBRE` varchar(23) DEFAULT NULL,
  `PROVINCIA_REGION_ID` int(2) DEFAULT NULL,
  PRIMARY KEY (`PROVINCIA_ID`),
  KEY `PROVINCIA_REGION_ID` (`PROVINCIA_REGION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`PROVINCIA_ID`, `PROVINCIA_NOMBRE`, `PROVINCIA_REGION_ID`) VALUES
(11, 'Iquique', 1),
(14, 'Tamarugal', 1),
(21, 'Antofagasta', 2),
(22, 'El Loa', 2),
(23, 'Tocopilla', 2),
(31, 'Copiapó', 3),
(32, 'Chañaral', 3),
(33, 'Huasco', 3),
(41, 'Elqui', 4),
(42, 'Choapa', 4),
(43, 'Limarí', 4),
(51, 'Valparaíso', 5),
(52, 'Isla de Pascua', 5),
(53, 'Los Andes', 5),
(54, 'Petorca', 5),
(55, 'Quillota', 5),
(56, 'San Antonio', 5),
(57, 'San Felipe de Aconcagua', 5),
(58, 'Marga Marga', 5),
(61, 'Cachapoal', 6),
(62, 'Cardenal Caro', 6),
(63, 'Colchagua', 6),
(71, 'Talca', 7),
(72, 'Cauquenes', 7),
(73, 'Curicó', 7),
(74, 'Linares', 7),
(81, 'Concepción', 8),
(82, 'Arauco', 8),
(83, 'Biobío', 8),
(91, 'Cautín', 9),
(92, 'Malleco', 9),
(101, 'Llanquihue', 10),
(102, 'Chiloé', 10),
(103, 'Osorno', 10),
(104, 'Palena', 10),
(111, 'Coihaique', 11),
(112, 'Aisén', 11),
(113, 'Capitán Prat', 11),
(114, 'General Carrera', 11),
(121, 'Magallanes', 12),
(122, 'Antártica Chilena', 12),
(123, 'Tierra del Fuego', 12),
(124, 'Última Esperanza', 12),
(131, 'Santiago', 13),
(132, 'Cordillera', 13),
(133, 'Chacabuco', 13),
(134, 'Maipo', 13),
(135, 'Melipilla', 13),
(136, 'Talagante', 13),
(141, 'Valdivia', 14),
(142, 'Ranco', 14),
(151, 'Arica', 15),
(152, 'Parinacota', 15),
(161, 'Punilla', 16),
(162, 'Itata', 16),
(163, 'Diguillín', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

DROP TABLE IF EXISTS `puntaje`;
CREATE TABLE IF NOT EXISTS `puntaje` (
  `id_puntaje` int(11) NOT NULL AUTO_INCREMENT,
  `nota_puntaje` int(11) DEFAULT NULL,
  `vig_puntaje` int(11) DEFAULT NULL,
  `fk_prod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_puntaje`),
  KEY `fk_prod_puntaje_idx` (`fk_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `REGION_ID` int(2) NOT NULL DEFAULT '0',
  `REGION_NOMBRE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`REGION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`REGION_ID`, `REGION_NOMBRE`) VALUES
(1, 'Tarapacá'),
(2, 'Antofagasta'),
(3, 'Atacama'),
(4, 'Coquimbo'),
(5, 'Valparaíso'),
(6, 'Región del Libertador Gral. Bernardo O\'Higgins'),
(7, 'Región del Maule'),
(8, 'Región del Biobío'),
(9, 'Región de la Araucanía'),
(10, 'Región de Los Lagos'),
(11, 'Región Aisén del Gral. Carlos Ibáñez del Campo'),
(12, 'Región de Magallanes y de la Antártica Chilena'),
(13, 'Región Metropolitana de Santiago'),
(14, 'Región de Los Ríos'),
(15, 'Arica y Parinacota'),
(16, 'Región de Ñuble');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_param`
--

DROP TABLE IF EXISTS `tab_param`;
CREATE TABLE IF NOT EXISTS `tab_param` (
  `id_param` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_grupo` varchar(45) DEFAULT NULL,
  `cod_item` varchar(45) DEFAULT NULL,
  `desc_item` varchar(100) DEFAULT NULL,
  `vig_item` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_param`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_param`
--

INSERT INTO `tab_param` (`id_param`, `cod_grupo`, `cod_item`, `desc_item`, `vig_item`) VALUES
(1, '1', '1', 'Kg', '1'),
(2, '1', '2', 'Lt', '1'),
(3, '1', '3', 'Gr', '1'),
(4, '1', '4', 'Mts', '1'),
(5, '1', '5', 'Uni', '1'),
(6, '1', '6', 'Cc', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

DROP TABLE IF EXISTS `tienda`;
CREATE TABLE IF NOT EXISTS `tienda` (
  `id_tienda` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tienda` varchar(150) NOT NULL,
  `razon_social_tienda` varchar(200) DEFAULT NULL,
  `dir_tienda` varchar(150) NOT NULL,
  `comuna_tienda` int(11) NOT NULL,
  `latitud_tienda` varchar(15) NOT NULL,
  `longitud_tienda` varchar(15) NOT NULL,
  `desc_gral_tienda` varchar(250) DEFAULT NULL,
  `ope_cre_tienda` int(11) DEFAULT NULL,
  `vig_tienda` int(11) NOT NULL,
  `fec_cre_tienda` datetime NOT NULL,
  `logo_tienda` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tienda`),
  KEY `fk_ope_tienda_idx` (`ope_cre_tienda`),
  KEY `fk_comuna_tienda_idx` (`comuna_tienda`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nom_tienda`, `razon_social_tienda`, `dir_tienda`, `comuna_tienda`, `latitud_tienda`, `longitud_tienda`, `desc_gral_tienda`, `ope_cre_tienda`, `vig_tienda`, `fec_cre_tienda`, `logo_tienda`) VALUES
(1, 'test tienda', 'test tienda', 'calle la union 474', 5304, '-70.568621', '-32.805751', 'supermercado los lagos', 1, 1, '2019-07-13 00:00:00', ''),
(2, 'Erbi', 'Erbi', 'El Parque 65', 5304, '-70.578496', '-32.797668', 'Supermercado', 1, 1, '2019-07-23 00:00:00', ''),
(3, 'Jumbo', 'Jumbo', 'Av Miraflores 2238', 5701, '-70.707572', '-32.750195', 'Supermercado', 1, 1, '2019-08-27 14:38:11', NULL),
(4, 'Mayorista 10', 'Mayorista 10', 'Sto Domingo 111', 5701, '-70.722807', '-32.749142', 'Supermercado', 1, 1, '2019-08-27 14:39:29', NULL),
(5, 'Lider Express', 'Lider Express', 'Tocornal 2450', 5701, '-70.708428', '-32.753625', 'Supermercado', 1, 1, '2019-08-27 14:40:38', NULL),
(6, 'Tottus', 'Tottus', 'Bernardo Ohiggins 1150', 5701, '-70.722706', '-32.756039', 'Supermercado', 1, 1, '2019-08-27 14:42:07', NULL),
(7, 'Sta. Isabel', 'Sta. Isabel', 'Merced 25', 5701, '-70.721571', '-32.751829', 'Supermercado', 1, 1, '2019-08-27 14:44:13', NULL),
(8, 'Acuenta', 'Acuenta', 'Maipú 1121', 5701, '-70.729869', '-32.749189', 'Supermercado', 1, 1, '2019-08-27 14:45:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usu` varchar(150) NOT NULL,
  `mail_usu` varchar(100) NOT NULL,
  `pass_usu` varchar(32) NOT NULL,
  `fec_cre_usu` datetime DEFAULT NULL,
  `vig_usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nom_usu`, `mail_usu`, `pass_usu`, `fec_cre_usu`, `vig_usu`) VALUES
(1, 'pablue', 'pvicencioc@hotmail.cl', 'e10adc3949ba59abbe56e057f20f883e', '2019-08-22 04:08:58', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `act_producto`
--
ALTER TABLE `act_producto`
  ADD CONSTRAINT `fk_ope_act` FOREIGN KEY (`ope_prod_act`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prod_act` FOREIGN KEY (`id_prod_act`) REFERENCES `producto` (`id_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_ope_cat` FOREIGN KEY (`ope_cre_cat`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_COMUNA_PROVINCIA_ID_fkey` FOREIGN KEY (`COMUNA_PROVINCIA_ID`) REFERENCES `provincia` (`PROVINCIA_ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD CONSTRAINT `fk_ope_desc` FOREIGN KEY (`ope_desc`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `det_lista`
--
ALTER TABLE `det_lista`
  ADD CONSTRAINT `fk_lista_det` FOREIGN KEY (`lista_det`) REFERENCES `lista_compra` (`id_lista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prod_det` FOREIGN KEY (`id_prod_det`) REFERENCES `producto` (`id_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_ope_horario` FOREIGN KEY (`ope_cre_horario`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tienda_horario` FOREIGN KEY (`tienda_horario`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD CONSTRAINT `fk_usu_lista` FOREIGN KEY (`usu_cre_lista`) REFERENCES `usuario` (`id_usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_cat_prod` FOREIGN KEY (`cat_prod`) REFERENCES `categoria` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ope_prod` FOREIGN KEY (`ope_cre_prod`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tienda_prod` FOREIGN KEY (`tienda_prod`) REFERENCES `tienda` (`id_tienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_PROVINCIA_REGION_ID_fkey` FOREIGN KEY (`PROVINCIA_REGION_ID`) REFERENCES `region` (`REGION_ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `fk_prod_puntaje` FOREIGN KEY (`fk_prod`) REFERENCES `producto` (`id_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD CONSTRAINT `fk_comuna_tienda` FOREIGN KEY (`comuna_tienda`) REFERENCES `comuna` (`COMUNA_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ope_tienda` FOREIGN KEY (`ope_cre_tienda`) REFERENCES `operador` (`id_ope`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
