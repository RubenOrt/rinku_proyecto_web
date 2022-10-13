-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2022 a las 10:26:46
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rinku`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalcularBonos`()
    NO SQL
UPDATE `movimientos` 
SET
	`Bono_Total_Entrega` = case when `Rol` = 'Chofer' then (10*192)
    							when `Rol` = 'Cargador' then (5*192)
                            end
where `Rol` not in ('Auxiliar')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculaRetenciones_ISRBase`()
    NO SQL
UPDATE `movimientos` SET `ISR_Base` = (`Sueldo_Bruto` * 0.09) + (`Bono_Total_Entrega` * 0.09) + (`Pago_Total_Entregas` * 0.09)
where `Sueldo_Bruto` is not null
and `Bono_Total_Entrega` is not null
and `Pago_Total_Entregas` is not null$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CalcularPagoEntregas`()
    NO SQL
update `movimientos`
set
	`Pago_Total_Entregas` = (`Cant_Entregas` * 5)
where `Cant_Entregas` is not null
and `Rol` in ('Chofer')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Calcular_Retenciones_ISR_Adicional`()
    NO SQL
UPDATE `movimientos` SET `ISR_Adicional` = ((`Sueldo_Bruto` + `Bono_Total_Entrega` + `Pago_Total_Entregas`) * 0.03)
where (`Sueldo_Bruto` + `Bono_Total_Entrega` + `Pago_Total_Entregas`) > 10000$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Calcular_Vales`()
    NO SQL
UPDATE `movimientos` SET `Vales_Despensa` = (`Sueldo_Bruto`* 0.04)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculoSueldoNeto`()
UPDATE `movimientos` SET `Sueldo_Bruto`= (30*192)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `Numero` int(11) NOT NULL,
  `Nombre_Completo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `IdRol` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Numero`, `Nombre_Completo`, `IdRol`) VALUES
(5007966, 'Ruben Ortiz Marrero', 'Aux'),
(123456, 'Omar Perez', 'CH'),
(2147483647, 'Perengano Mendez', 'CA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `IdMovimiento` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `Numero_Emp` int(11) NOT NULL,
  `ISR_Base` float NOT NULL,
  `ISR_Adicional` float NOT NULL,
  `Vales_Despensa` float NOT NULL,
  `Cant_Entregas` float NOT NULL,
  `Mes` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Sueldo_Bruto` float NOT NULL,
  `Fecha_mov` datetime DEFAULT NULL,
  `Bono_Total_Entrega` float NOT NULL,
  `Horas_Trabajadas_Mensuales` float NOT NULL,
  `Pago_Total_Entregas` float NOT NULL,
  `Rol` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`IdMovimiento`, `Numero_Emp`, `ISR_Base`, `ISR_Adicional`, `Vales_Despensa`, `Cant_Entregas`, `Mes`, `Sueldo_Bruto`, `Fecha_mov`, `Bono_Total_Entrega`, `Horas_Trabajadas_Mensuales`, `Pago_Total_Entregas`, `Rol`) VALUES
('5007966Auxiliar20221013', 5007966, 518.4, 0, 230.4, 85, '202210', 5760, '2022-10-13 02:37:50', 0, 192, 0, 'Auxiliar'),
('123456Chofer20221013', 123456, 746.55, 0, 230.4, 123, '202210', 5760, '2022-10-13 03:02:30', 1920, 192, 615, 'Chofer'),
('2147483647Cargador20221013', 2147483647, 604.8, 0, 230.4, 50, '202210', 5760, '2022-10-13 03:03:21', 960, 192, 0, 'Cargador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `IdRol` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `NombreRol` varchar(150) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `NombreRol`) VALUES
('CH', 'Chofer'),
('CA', 'Cargador'),
('Aux', 'Auxiliar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
