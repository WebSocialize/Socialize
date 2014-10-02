DROP DATABASE IF EXISTS socialize;
CREATE DATABASE socialize;
USE socialize;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `utente` (
     `nome`   VARCHAR(20) DEFAULT NULL,
     `cognome` VARCHAR(40) DEFAULT NULL,
     `email` VARCHAR(80) NOT NULL,
     `pwd` VARCHAR(20) DEFAULT NULL,
     `data` VARCHAR(10) DEFAULT NULL,
     `sesso` CHAR(1) DEFAULT NULL,
     `citta` VARCHAR(20) DEFAULT NULL,
     `codice` varchar(20) DEFAULT NULL,
     `attivazione` INT DEFAULT NULL,
     `immprofilo` VARCHAR(80) DEFAULT NULL,
     `status`   VARCHAR(150) DEFAULT NULL,
     PRIMARY KEY(`email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `amministratore` (
   `email` VARCHAR(80) NOT NULL,
   `pwd` VARCHAR(20) DEFAULT NULL,
   PRIMARY KEY(`email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `evento` (
      `nome` VARCHAR(40) NOT NULL,
      `data` VARCHAR(10) DEFAULT NULL,
      `citta` VARCHAR(30) DEFAULT NULL,
      `luogo` VARCHAR(40) DEFAULT NULL,
      `descrizione` VARCHAR(150) DEFAULT NULL,
      `categoria` VARCHAR(20) DEFAULT NULL,
      `organizzatore` VARCHAR(80) NOT NULL,
	    `numVisite` INT DEFAULT NULL,
      `idimg` VARCHAR(80) DEFAULT NULL,
      PRIMARY KEY (`nome`),
      FOREIGN KEY(`organizzatore`) REFERENCES `utente`(`email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `commento` (
       `commentante` VARCHAR(80) NOT NULL,
       `commento` VARCHAR(500) DEFAULT NULL,
       `id` INT NOT NULL AUTO_INCREMENT,
       `nome_evento` VARCHAR(40) NOT NULL,
       PRIMARY KEY (`id`),
       FOREIGN KEY(`commentante`) REFERENCES `utente`(`email`),
       FOREIGN KEY(`nome_evento`) REFERENCES `evento`(`nome`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `partecipanti` (
       `nome_evento` VARCHAR(40) NOT NULL,
       `email_utente` VARCHAR(80) NOT NULL,
       PRIMARY KEY(`nome_evento`, `email_utente`),
       FOREIGN KEY(`email_utente`) REFERENCES `utente`(`email`),
       FOREIGN KEY(`nome_evento`) REFERENCES `evento`(`nome`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `interesse` (
      `nome_interesse` VARCHAR(40) NOT NULL,
      `email_utente` VARCHAR(80) NOT NULL,
      PRIMARY KEY(`nome_interesse`,`email_utente`),
      FOREIGN KEY(`email_utente`) REFERENCES `utente`(`email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `amministratore` VALUES ('cichedda@gmail.com','password');

INSERT INTO `utente` VALUES ('Davide','Cichella','davide-cichella@hotmail.it','11111111','29-11-1991','M','Teramo','9480348320','1','utentedefaultimg.jpg','Questo è lo stato di Davide.');
INSERT INTO `utente` VALUES ('Andrea','Minetti','andreaminetti91@gmail.com','12345678','09-07-1991','M','Pescara','8480348320','1','utentedefaultimg.jpg','Questo è lo stato di Andrea.');
INSERT INTO `utente` VALUES ('Alessandro','Scopigno','ales_nsb@hotmail.it','password','20-06-1991','M','Rieti','7480348320','1','utentedefaultimg.jpg','Questo è lo stato di Alessandro.');

INSERT INTO `interesse` VALUES ('Sport','davide-cichella@hotmail.it');
INSERT INTO `interesse` VALUES ('Cinema','andreaminetti91@gmail.com');
INSERT INTO `interesse` VALUES ('Arte','ales_nsb@hotmail.it');

INSERT INTO `evento` VALUES ('Karaoke anni 70','20-12-2013','Pescara','Shaman Irish Pub','Cantiamoooooo','Karaoke','davide-cichella@hotmail.it','1','eventodefaultimg.jpg');

INSERT INTO `partecipanti` VALUES ('Karaoke anni 70','davide-cichella@hotmail.it');