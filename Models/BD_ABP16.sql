--
-- Base de datos: PadelAbp
--
DROP DATABASE IF EXISTS PadelABP;
CREATE DATABASE IF NOT EXISTS PadelABP DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE PadelABP;
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO padelabpdba@localhost;
  DROP USER padelabpdba@localhost;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS padelabpdba@localhost IDENTIFIED BY 'padelpass';
GRANT USAGE ON *.* TO padelabpdba@localhost REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON PadelABP.* TO padelabpdba@localhost WITH GRANT OPTION;

CREATE TABLE IF NOT EXISTS USUARIO (
  login varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  password varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  nombre varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  apellidos varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  dni varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  fechaNacimiento datetime(6) NOT NULL,
  email varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  telefono int(15) DEFAULT NULL,
  rol enum('Deportista','Administrador','Entrenador') COLLATE latin1_spanish_ci DEFAULT NULL,
  socio enum('SI','NO') COLLATE latin1_spanish_ci DEFAULT NULL,
  foto varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  borrado enum('SI','NO') DEFAULT 'NO',

  PRIMARY KEY (login)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS pareja (
  idPareja int AUTO_INCREMENT COLLATE latin1_spanish_ci NOT NULL,
  idDeportista1 varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  idDeportista2 varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (idPareja)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  
  CREATE TABLE IF NOT EXISTS partido (
  idPartido varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  idPista varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  idPareja1 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  idPareja2 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  fecha varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  resultado varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

  PRIMARY KEY (idPartido)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS pista (
    idPista varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    nombre varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    especificaciones varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
    ubicacion varchar(128) COLLATE latin1_spanish_ci DEFAULT NULL,
    borrado enum('SI','NO') DEFAULT 'NO',
    
    PRIMARY KEY (idPista)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci; 

  CREATE TABLE IF NOT EXISTS reserva (        
    idReserva int AUTO_INCREMENT COLLATE latin1_spanish_ci NOT NULL,
    idPista varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idUsuario varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    fecha datetime(6) NOT NULL,
    precio varchar(25),

    PRIMARY KEY (idReserva,idPista),
    FOREIGN KEY (idPista) REFERENCES pista(idPista)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



  CREATE TABLE IF NOT EXISTS `campeonato` (
    `idCampeonato` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `nombreCampeonato` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `fechaInicio` date NOT NULL,
    `fechaFin` date NOT NULL,
    `numParticipantes` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `premios` varchar(125) COLLATE latin1_spanish_ci DEFAULT NULL,
    `normativa` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `borrado` enum('SI','NO') DEFAULT 'NO',
    `empezado` enum('SI','NO') DEFAULT 'NO',

    PRIMARY KEY (idCampeonato)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


  CREATE TABLE IF NOT EXISTS categoria (
  idCategoria varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  
    PRIMARY KEY (idCategoria),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS nivel (
    idNivel varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idNivel),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS partidoPromocionado (
    idPartidoPromocionado varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    nombre varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    fecha datetime(6) NOT NULL,
    idParticipante1 varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    idParticipante2 varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    idParticipante3 varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    idParticipante4 varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    numParticipantes varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

    PRIMARY KEY (idPartidoPromocionado)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  

  
  CREATE TABLE IF NOT EXISTS `grupo` (
    `numParticipantes` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGrupo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    `idGanador` varchar(25) COLLATE latin1_spanish_ci NULL,
    `idPareja` int,
    `idCampeonato` varchar(25),
    `categoria` ENUM('mixta','femenina','masculina','') NOT NULL,
    `nivel` INT NOT NULL,
      
    PRIMARY KEY (idGrupo)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



  CREATE TABLE IF NOT EXISTS calendario (
    idReserva int COLLATE latin1_spanish_ci DEFAULT NULL,
    idPartido varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    idPartidoPromocionado varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
    nombre varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    fecha datetime(6) NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,

    PRIMARY KEY (idReserva, idPartido),
    FOREIGN KEY(idReserva) REFERENCES reserva(idReserva)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE `participa` (
  `idPareja` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `idCampeonato` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `categoria` enum('mixta','masculina','femenina','') COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
   


 CREATE TABLE IF NOT EXISTS publicacion (       
  idNoticia varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  Nombre varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  Descripcion varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  idAutor varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  fecha datetime(6) NOT NULL,
  borrado BIT DEFAULT 0,

  PRIMARY KEY (idNoticia)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

 CREATE TABLE IF NOT EXISTS estadistica (
    idUsuario varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  partidosGanados varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  partidosJugados varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  puntos varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  puntosAFavor varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  victoriasConsecutivas varchar(25) COLLATE latin1_spanish_ci NULL,
  mejorRanking varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  torneosJugados varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  finalesJugadas varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idUsuario),
    FOREIGN KEY (idUsuario) REFERENCES usuario(login)
    
  )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;  


  CREATE TABLE IF NOT EXISTS enfrentamiento (
    idEnfrentamiento varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idPareja1 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idPareja2 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    fecha datetime(6) COLLATE latin1_spanish_ci NOT NULL,
    idGrupo varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    numSetsPareja1 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    numSetsPareja2 varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idPista varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idEnfrentamiento,idCampeonato),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato)
  )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  CREATE TABLE IF NOT EXISTS jugadoresCampeonato (
    idPareja varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idCampeonato),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato)
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
  
  CREATE TABLE IF NOT EXISTS jugadoresCategoria(
    idPareja varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCategoria varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idCategoria,idCampeonato),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato),
    FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria)
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

  CREATE TABLE IF NOT EXISTS jugadoresNivel(
    idPareja varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idNivel varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idNivel,idCampeonato),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato),
    FOREIGN KEY (idNivel) REFERENCES nivel(idNivel)
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

    CREATE TABLE IF NOT EXISTS jugadoresGrupo(
    idPareja varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idGrupo varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idCampeonato varchar(25) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idGrupo,idCampeonato),
    FOREIGN KEY (idCampeonato) REFERENCES campeonato(idCampeonato),
    FOREIGN KEY (idGrupo) REFERENCES grupo(idGrupo)
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


    CREATE TABLE IF NOT EXISTS claseParticular(
    idClaseParticular varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idPista varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idEntrenador varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    idUsuario varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    nivel varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    hora datetime(6) COLLATE latin1_spanish_ci NOT NULL,

    PRIMARY KEY (idClaseParticular)
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


    CREATE TABLE IF NOT EXISTS ranking(
    idPareja varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    partidosGanados varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    partidosJugados varchar(25) COLLATE latin1_spanish_ci NOT NULL,
    puntos varchar(25) COLLATE latin1_spanish_ci NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO usuario (login, password, nombre, apellidos, dni, fechaNacimiento, email, telefono, rol, socio, foto,borrado ) VALUES
('admin', 'admin', 'admin', 'el administrador', '95875625X', '2019-11-14', 'admin@padel.es', '677777777', 'ADMINISTRADOR', 'SI','../Files/man-1.png','NO'),
('entrenador', 'entrenador', 'Pepe', 'el entrenador', '59117771C', '2019-11-15', 'entrenador@padel.es', '657555555', 'ENTRENADOR', 'SI','../Files/man-2.png','NO'),
('deportista1', 'deportista', 'Ruben', 'el deportista', '74291751A', '2001-11-11', 'deportista1@padel.es', '611111111', 'DEPORTISTA', 'NO','../Files/deportista-1.png','NO'),
('deportista2', 'deportista2', 'Carlos', 'el deportista2', '33653901W', '2002-1-2', 'deportista2@padel.es', '622222222', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista3', 'deportista3', 'Lorenzo', 'el deportista3', '95119250J', '2003-1-3', 'deportista3@padel.es', '633333333', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista4', 'deportista4', 'Victor', 'el deportista4', '43339819E', '2004-1-4', 'deportista4@padel.es', '644444444', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista5', 'deportista5', 'Juan', 'el deportista5', '33484025G', '2005-1-5', 'deportista5@padel.es', '655555555', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista6', 'deportista6', 'Alvaro', 'el deportista6', '93009004V', '2006-1-6', 'deportista6@padel.es', '666666666', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista7', 'deportista7', 'Alberto', 'el deportista7', '81504224K', '2007-1-7', 'deportista7@padel.es', '677777777', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista8', 'deportista8', 'Joao', 'el deportista8', '17320774A', '2008-1-8', 'deportista8@padel.es', '688888888', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista9', 'deportista9', 'Martin', 'el deportista9', '89924446N', '2009-1-9', 'deportista9@padel.es', '699999999', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista10', 'deportista10', 'Fernando', 'el deportista10', '87394928B', '2010-1-10', 'deportista10@padel.es', '610101010', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista11', 'deportista11', 'Ivan', 'el deportista11', '84798134D', '2011-1-11', 'deportista11@padel.es', '711111111', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista12', 'deportista12', 'Santi', 'el deportista12', '46768798T', '2012-1-12', 'deportista12@padel.es', '612121212', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista13', 'deportista13', 'Carliños', 'el deportista13', '62181635P', '2013-1-13', 'deportista13@padel.es', '613131313', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO'),
('deportista14', 'deportista14', 'Adrian', 'el deportista14', '07226831R', '2014-1-14', 'deportista14@padel.es', '614141414', 'DEPORTISTA', 'SI','../Files/deportista-2.png','NO');


INSERT INTO pareja (idPareja,idDeportista1,idDeportista2) VALUES 
('1','deportista1','deportista2'),
('2','deportista3','deportista4'),
('3','deportista5','deportista6'),
('4','deportista7','deportista8'),
('5','deportista9','deportista10'),
('6','deportista11','deportista12'),
('7','deportista13','deportista14');

INSERT INTO pista (idPista,nombre,especificaciones,ubicacion,borrado) VALUES 
  ('1','Pista01','Cesped con pared de cristal.','allí','NO'),
  ('2','Pista02','Cemento con pared de cristal.','allí','NO'),
  ('3','Pista03','Cemento con pared de Cemento.','allí','NO'),
  ('4','Pista04','Cemento con pared de cristal.','allí','NO'),
  ('5','Pista05','Parquet con pared de cristal.','allí','NO'),
  ('6','Pista06','Parquet con pared de cristal.','allí','NO'),
  ('7','Pista07','Parquet con pared de cristal.','allí','NO');

INSERT INTO reserva (idReserva,idPista,idUsuario,fecha,precio) VALUES 
  ('1','1','deportista1','2019-11-17','10'),
  ('2','2','deportista1','2019-11-17','10'),
  ('3','1','deportista1','2019-11-18','10'),
  ('4','1','deportista1','2019-11-18','10');

INSERT INTO campeonato (idCampeonato,nombreCampeonato,fechaInicio,fechaFin,numParticipantes,premios,normativa,borrado) VALUES 
  ('1','uno','2019-10-10','2019-10-20','50','300000','../Files/normativa.pdf','NO'),
  ('2','dos','2019-10-1','2019-10-8','10','200','../Files/normativa.pdf','NO'),
  ('3','tres','2019-10-10','2019-10-20','50','300000','../Files/normativa.pdf','SI');

INSERT INTO enfrentamiento (idEnfrentamiento,idCampeonato,idPareja1,idPareja2,fecha,idGrupo,numSetsPareja1,numSetsPareja2,idPista) VALUES
  ('1','1','1','2','2019-12-12 18:00:00','1','3','1','1'),
  ('2','1','3','4','2019-12-12 18:00:00','1','3','2','2'),
  ('3','1','5','6','2019-12-12 18:00:00','1','2','3','3');

INSERT INTO partido(idPartido,idPista,idPareja1,idPareja2,fecha,resultado) VALUES
  ('1','1','1','2','2018-12-12 18:00:00','3-0'),
  ('2','1','1','2','2018-12-13 18:00:00','2-3'),
  ('3','1','1','2','2018-12-14 18:00:00','3-1');

INSERT INTO grupo(idGrupo,idGanador,idPareja,idCampeonato,categoria,nivel) VALUES
('1','1','1','1','1','1');

INSERT INTO categoria(idCategoria,idCampeonato) VALUES
  ('1','1');

INSERT INTO nivel(idNivel,idCampeonato) VALUES 
('1','1');

INSERT INTO `participa` (`categoria`,`grupo`,`idCampeonato`,`idPareja`,`nivel`) VALUES 
('mixta','0','1','78','1'),
('mixta','0','1','79','1'),
('mixta','0','1','80','1'),
('mixta','0','1','81','1'),
('mixta','0','1','82','1'),
('mixta','0','1','83','1'),
('mixta','0','1','84','1'),
('mixta','0','1','85','1'),
('mixta','0','1','86','1'),
('mixta','0','1','87','1'),
('mixta','0','1','88','1'),
('mixta','0','1','89','1'),
('mixta','0','1','90','1'),
('mixta','0','1','91','1'),
('mixta','0','1','92','1'),
('mixta','0','1','93','1'),
('mixta','0','1','94','1'),
('mixta','0','1','95','1'),
('mixta','0','1','96','1');
/*INSERT INTO `grupo` VALUES
  ('8','1','','pareja1','pareja2','pareja3','pareja4','pareja5','pareja6','pareja7','pareja8');*/

INSERT INTO partidoPromocionado (idPartidoPromocionado,nombre,fecha,idParticipante1,idParticipante2,idParticipante3,idParticipante4,numParticipantes) VALUES
  ('1','Promocion1','2019-9-9','deportista1','deportista2','deportista3','','3'),
  ('2','Promocion2','2019-9-10','deportista5','deportista6','deportista7','deportista8','4');

