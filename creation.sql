-- Liste des creations des tables ainsi que leur contraintes en mysql


-- La DB
DROP DATABASE rrl_test;

CREATE DATABASE rrl_test;

USE rrl_test;

-- Les tables

CREATE TABLE menbre(
       id        INTEGER UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
       nom       VARCHAR(12),
       prenom    VARCHAR(12),
       mail      VARCHAR(32),
       telephone INTEGER(10),
       adresse   INTEGER REFERENCES id(adresse));


CREATE TABLE adresse(
       id          INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       ville       VARCHAR(12) NOT NULL,
       rue         VARCHAR(16) NOT NULL,
       code_postal INTEGER(5)  NOT NULL,
       pays        VARCHAR(12) NOT NULL);


CREATE TABLE catalogue(
       id  INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nom VARCHAR(12) NOT NULL,
       maj DATE        NOT NULL);


CREATE TABLE promo(
       id        INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       CATALOGUE INTEGER REFERENCES id(catalogue),
       reduction INTEGER); 


CREATE TABLE commande(
       id       INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nprod    INTEGER REFERENCES id(produit),
       quantite INTEGER,
       nclient  INTEGER REFERENCES id(menbre)); 


CREATE TABLE produit(
       id          INTEGER NOT NULL UNIQUE PRIMARY KEY,
       designation VARCHAR(32),
       descriptif  VARCHAR(64),
       disponible  INTEGER,
       prix        INTEGER,
       catalogue   INTEGER REFERENCES id(catalogue));
       
CREATE TABLE expidition(
       id     INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
       n_addr INTEGER REFERENCES id(adresse),
       date   DATE);


-- Les contraintes specifiques 

ALTER TABLE menbre ADD CONSTRAINT Cmail
      CHECK (mail LIKE '%@%');

ALTER TABLE adresse ADD CONSTRAINT Cpays
      CHECK (pays IN ('ALLEMAGNE', 'FRANCE', 'ITALIE', 'ESPAGNE', 'BELGIQUE')); 


ALTER TABLE promo ADD CONSTRAINT Creduction
      CHECK (reduction between 0 AND 100));
