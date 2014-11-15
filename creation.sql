-- Liste des creations des tables ainsi que leur contraintes en mysql


-- La DB

CREATE DATABASE rrl;


-- Les tables

CREATE TABLE menbre(
       id        INTEGER UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
       nom       VARCHAR(12),
       prenom    VARCHAR(12),
       mail      VARCHAR(32),
       telephone INTEGER(10),
       adresse   INTEGER REFERENCES id(adresse));


CREATE TABLE adresse(
       id          INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO-INCREMENT,
       ville       VARCHAR(12) NOT NULL,
       rue         VARCHAR(16) NOT NULL,
       code_postal INTEGER(5)  NOT NULL,
       pays        VARCHAR(12) NOT NULL);


-- Les contraintes specifiques

CREATE INTEGRITY on menbre IS telephone 

ALTER TABLE menbre ADD CONSTRAINT Cmail
      CHECK (mail LIKE '%@%');

ALTER TABLE adresse ADD CONSTRAINT Cpays
      CHECK (pays IN ('FRANCE', 'ITALIE', 'ESPAGNE', 'BELGIQUE')); 
