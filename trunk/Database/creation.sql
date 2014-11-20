-- Liste des creations des tables ainsi que leur contraintes en mysql

-- La DB
DROP DATABASE rrl_test;

CREATE DATABASE rrl_test;

USE rrl_test;

-- Les tables

-- 1
CREATE TABLE adresse(
       id           INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       ville        VARCHAR(12) NOT NULL,
       rue          VARCHAR(16) NOT NULL,
       code_postale INTEGER(5)  NOT NULL,
       pays         VARCHAR(12) NOT NULL) CHARSET = UTF8;

-- 2
CREATE TABLE membre(
       id        INTEGER     UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
       nom       VARCHAR(12),
       prenom    VARCHAR(12),
       mail      VARCHAR(32) UNIQUE,
       telephone INTEGER(10),
       adresse   INTEGER,
       FOREIGN KEY (adresse) REFERENCES adresse(id) ON UPDATE CASCADE)
       CHARSET = UTF8;

-- 3
CREATE TABLE catalogue(
       id  INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nom VARCHAR(12) NOT NULL,
       maj DATE        NOT NULL)
       CHARSET = UTF8;

-- 4
CREATE TABLE promo(
       id        INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       catalogue INTEGER,
       reduction INTEGER,
       CONSTRAINT Cred CHECK (reduction BETWEEN 0 AND 100),
       FOREIGN KEY (catalogue) REFERENCES catalogue(id) ON UPDATE CASCADE)
       CHARSET = UTF8;

-- 5

CREATE TABLE produit(
       id          INTEGER NOT NULL UNIQUE PRIMARY KEY,
       designation VARCHAR(32),
       descriptif  VARCHAR(64),
       disponible  INTEGER,
       prix        INTEGER,
       catalogue   INTEGER,
       date_add    DATE, 
       FOREIGN KEY (catalogue) REFERENCES catalogue(id) ON UPDATE CASCADE)
       CHARSET = UTF8;
    
-- 6

CREATE TABLE commande(
       id       INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nprod    INTEGER,
       quantite INTEGER,
       nclient  INTEGER,
       FOREIGN KEY (nprod)   REFERENCES produit(id) ON UPDATE CASCADE,
       FOREIGN KEY (nclient) REFERENCES membre(id)  ON UPDATE CASCADE)
       CHARSET = UTF8; 

-- 7   
CREATE TABLE expedition(
       id     INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
       addr   INTEGER NOT NULL, 
       dexp   DATE,
       FOREIGN KEY (addr) REFERENCES adresse(id)  ON UPDATE CASCADE);

-- 8 
CREATE TABLE code_promo(
       ncl         INTEGER NOT NULL,
       pourcentage INTEGER NOT NULL,
       ncmd        INTEGER,    
       FOREIGN KEY (ncl)  REFERENCES membre(id)   ON UPDATE CASCADE,
       FOREIGN KEY (ncmd) REFERENCES commande(id) ON UPDATE CASCADE)
       CHARSET = UTF8;
       
-- 9
CREATE TABLE identifiant(
       login    VARCHAR(32),
       password VARCHAR(16),
       FOREIGN KEY (login) REFERENCES membre(mail) ON UPDATE CASCADE)
       CHARSET = UTF8;



-- Les contraintes specifiques 

-- 10
ALTER TABLE membre ADD CONSTRAINT Cmail
      CHECK (mail LIKE '%@%');

-- 11
ALTER TABLE adresse ADD CONSTRAINT Cpays
      CHECK (pays IN ('ALLEMAGNE', 'FRANCE', 'ITALIE', 'ESPAGNE', 'BELGIQUE')); 

-- 12




