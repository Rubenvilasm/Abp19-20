--
-- Base de datos: `PadelAbp`
--
CREATE DATABASE IF NOT EXISTS `PadelABP` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `PadelABP`;


CREATE TABLE IF NOT EXISTS `USUARIO` (
  `login` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `dni` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `rol` enum('Deportista','Administrador','Entrenador') COLLATE latin1_spanish_ci DEFAULT NULL,
  `socio` enum('Activo','Inactivo') COLLATE latin1_spanish_ci DEFAULT NULL,
  `foto` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `borrado` BIT DEFAULT 0,

  PRIMARY KEY (login)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `pareja` (
  `idPareja` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `idDeportista1` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `idDeportista2` varchar(128) COLLATE latin1_spanish_ci NOT NULL,

  PRIMARY KEY (idPareja)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS `pista` (
    `idPista` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `nombre` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `especificaciones` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    
    PRIMARY KEY (idPista)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci; 

  CREATE TABLE IF NOT EXISTS `reserva` (	      
    `idReserva` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idPista` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idUsuario` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fecha` date NOT NULL,

    PRIMARY KEY (idReserva,idPista),
    FOREIGN KEY (idPista) REFERENCES pista(idPista)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



  CREATE TABLE IF NOT EXISTS `campeonato` (
    `idCampeonato` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fechaInicio` date NOT NULL,
    `fechaFin` date NOT NULL,
    `numParticipantes` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `premios` varchar(125) COLLATE latin1_spanish_ci DEFAULT NULL,
    `normativa` varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idCampeonato)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS `categoria` (
    `idCategoria` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `nivel` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  
    PRIMARY KEY (idCategoria)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS `partidoPromocionado` (
    `idPartidoPromocionado` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fecha` date NOT NULL,
    `idParticipante1` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idParticipante2` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idParticipante3` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idParticipante4` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `numParticipantes` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

    PRIMARY KEY (idPartidoPromocionado)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  
  CREATE TABLE IF NOT EXISTS `partido` (
    `idPartido` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idPareja1` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idPareja2` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fecha` date NOT NULL,
    `resultado` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idPista` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

    PRIMARY KEY (idPartido,idPareja1,idPareja2),
    FOREIGN KEY (idPista) REFERENCES pista (idPista)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS `calendario` (
    `idReserva` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idPartido` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `idPartidoPromocionado` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    `nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fecha` date NOT NULL,
    `idCampeonato` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

    PRIMARY KEY (idReserva, idPartido),
    FOREIGN KEY (idReserva) REFERENCES reserva (idReserva),
    FOREIGN KEY (idPartido) REFERENCES partido (idPartido)

  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  

  
  CREATE TABLE IF NOT EXISTS `grupo` (
    `numParticipantes` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGrupo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGanador` varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idGrupo)

  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci; 
  

  
  CREATE TABLE IF NOT EXISTS `playOff` (
    `idPlayOff` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGrupo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `eliminado` BIT DEFAULT 0,
    `idPareja` varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idPlayOff),
    FOREIGN KEY (idPareja) REFERENCES pareja(idPareja),
    FOREIGN KEY (idGrupo) REFERENCES grupo (idGrupo)
  )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

   


 CREATE TABLE IF NOT EXISTS `publicacion` (	      
  `idNoticia` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Descripcion` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `idAutor` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,

  PRIMARY KEY (idNoticia)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

 CREATE TABLE IF NOT EXISTS `estadistica` (
    `idUsuario` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `partidosGanados` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `puntosPorPartido` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `partidosPerdidos` varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idUsuario),
    FOREIGN KEY (idUsuario) REFERENCES usuario (login)
    
  )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  
  CREATE TABLE IF NOT EXISTS `ligaRegular` (
    `idLiga` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGrupo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `IdPartido` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `puntuacion` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fechaInicio` date NOT NULL,
    `fechaFin` date NOT NULL,

    PRIMARY KEY (idLiga,idGrupo),
    FOREIGN KEY (idGrupo) REFERENCES GRUPO(idGrupo),
    FOREIGN KEY (idPartido) REFERENCES partido(idPartido)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  

