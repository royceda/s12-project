-- Liste des creations des tables ainsi que leur contraintes en mysql

-- La DB
DROP DATABASE rrl_test;

CREATE DATABASE rrl_test;

USE rrl_test;

-- Les tables

-- 1
CREATE TABLE adresse(
       id          INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       ville       VARCHAR(12) NOT NULL,
       rue         VARCHAR(16) NOT NULL,
       code_postal INTEGER(5)  NOT NULL,
       pays        VARCHAR(12) NOT NULL);

-- 2
CREATE TABLE menbre(
       id        INTEGER UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
       nom       VARCHAR(12),
       prenom    VARCHAR(12),
       mail      VARCHAR(32),
       telephone INTEGER(10),
       adresse   INTEGER,
       FOREIGN KEY (adresse) REFERENCES adresse(id) ON DELETE CASCADE);

-- 3
CREATE TABLE catalogue(
       id  INTEGER     NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nom VARCHAR(12) NOT NULL,
       maj DATE        NOT NULL);

-- 4
CREATE TABLE promo(
       id        INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       catalogue INTEGER,
       reduction INTEGER,
       CONSTRAINT Cred CHECK (reduction BETWEEN 0 AND 100),
       FOREIGN KEY (catalogue) REFERENCES catalogue(id) ON DELETE CASCADE);

-- 5

CREATE TABLE produit(
       id          INTEGER NOT NULL UNIQUE PRIMARY KEY,
       designation VARCHAR(32),
       descriptif  VARCHAR(64),
       disponible  INTEGER,
       prix        INTEGER,
       catalogue   INTEGER, 
       FOREIGN KEY (catalogue) REFERENCES catalogue(id) ON DELETE CASCADE);
    
-- 6

CREATE TABLE commande(
       id       INTEGER NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
       nprod    INTEGER,
       quantite INTEGER,
       nclient  INTEGER,
       FOREIGN KEY (nprod)   REFERENCES produit(id) ON DELETE CASCADE,
       FOREIGN KEY (nclient) REFERENCES menbre(id) ON UPDATE CASCADE); 

-- 7   
CREATE TABLE expedition(
       id     INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
       addr   INTEGER NOT NULL, 
       dexp   DATE,
       FOREIGN KEY (addr) REFERENCES adresse(id)  ON DELETE CASCADE);

-- 8 
CREATE TABLE code_promo(
       ncl         INTEGER NOT NULL,
       pourcentage INTEGER NOT NULL,
       ncmd        INTEGER,    
       FOREIGN KEY (ncl)  REFERENCES menbre(id)   ON DELETE CASCADE,
       FOREIGN KEY (ncmd) REFERENCES commande(id) ON DELETE CASCADE);
       

-- Les contraintes specifiques 

-- 9
ALTER TABLE menbre ADD CONSTRAINT Cmail
      CHECK (mail LIKE '%@%');

-- 10
ALTER TABLE adresse ADD CONSTRAINT Cpays
      CHECK (pays IN ('ALLEMAGNE', 'FRANCE', 'ITALIE', 'ESPAGNE', 'BELGIQUE')); 

-- 11




