DROP DATABASE IF EXISTS socialize;
CREATE DATABASE socialize;
USE socialize;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `utente` (
     `nome`   VARCHAR(20) DEFAULT NULL,
     `cognome` VARCHAR(40) DEFAULT NULL,
     `giorno` VARCHAR(2) DEFAULT NULL,
     `mese` VARCHAR(20) DEFAULT NULL,
     `anno` VARCHAR(4) DEFAULT NULL,
     `sesso` CHAR(1) DEFAULT NULL,
     `pwd` VARCHAR(20) NOT NULL,
     `citta` VARCHAR(20) DEFAULT NULL,
     `email` VARCHAR(80) NOT NULL,
     `codice` varchar(20) DEFAULT NULL,
     `attivazione` INT DEFAULT NULL,
     PRIMARY KEY(`email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;