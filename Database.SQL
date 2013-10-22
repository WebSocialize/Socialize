DROP DATABASE IF EXISTS socialize;
CREATE DATABASE socialize;
USE socialize;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE utenti (
     nome   VARCHAR(20) NOT NULL,
     cognome VARCHAR(40) NOT NULL,
     password VARCHAR(20) NOT NULL,
     email VARCHAR(80) NOT NULL,
     citta VARCHAR(20) NOT NULL,
     sesso CHAR(1) NOT NULL,
     datanascita DATE NOT NULL,
     stato VARCHAR(10) NOT NULL,
     PRIMARY KEY(email)
);