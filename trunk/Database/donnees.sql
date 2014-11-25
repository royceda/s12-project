SHOW DATABASES;
USE rrl_test;


-- adresse

INSERT INTO adresse (id, ville, rue, code_postale, pays) 
       VALUES (1,'LH', '12 rue du beau', 76000, 'FRANCE'); 

INSERT INTO adresse (id, ville, rue, code_postale, pays) 
       values(2, 'PARIS', '12 rue Rivoli', 1000, 'FRANCE'); 

INSERT INTO adresse (id, ville, rue, code_postale, pays) 
       values(3, 'BERLIN', '12 Munich', 9890, 'ALLEMAGNE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'ROME', '12 Vatican', 1231, 'ITALIE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'LIEGE', '12 rue Ste Catherine', 33000, 'BELGIQUE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'SEVILLE', '12 rue Ste Catherine', 33000, 'ESPAGNE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'MUNICH', '12 rue Ste Catherine', 33000, 'ALLEMAGNE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'ZURICH', '12 rue Ste Catherine', 33000, 'SUISSE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'GENOA', '12 rue Ste Catherine', 33000, 'ITALIE'); 

INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( 'NICE', '12 Place Massenat', 06000, 'FRANCE'); 


SELECT *
FROM adresse;


-- client

INSERT INTO membre (id, nom, prenom, telephone, mail, adresse)
       VALUES (1, 'Brown', 'Charlie', 0676753452, 'allo@gmail.ch', 1);

INSERT INTO membre (id,nom, prenom, telephone,mail, adresse)
       VALUES (2,'VAN PEE', 'LINUS', 0676753452, 'aaaaaa@bb.fr', 3);

INSERT INTO membre (nom, prenom, telephone, mail, adresse)
       VALUES ('Shakur', 'Tupac', 0676753452, 'B.panther@licos.com', 2);

INSERT INTO membre (nom, prenom, telephone, mail, adresse)
       VALUES ('Combs', 'Sean', 0676753452, 'DIDDY@licos.com', 7);

INSERT INTO membre (nom, prenom, telephone, mail, adresse)
       VALUES ('Machiavel', 'Nicolas', 0676753452, 'N.Machiavel@licos.com', 9);

INSERT INTO membre (nom, prenom, telephone, mail, adresse)
       VALUES ('Presley', 'Elvis', 0676753452, 'E.Presley@licos.com', 10);

INSERT INTO membre (nom, prenom, telephone, mail, adresse)
       VALUES ('Endrix', 'Jimmy', 0676753452, 'J.Endrix@licos.com', 4);


SELECT *
FROM membre;
 
-- identifiant

INSERT INTO identifiant (login, password)
       VALUES ('allo@gmail.ch', 'blahblah');

select * 
from identifiant;

-- catalogue

INSERT INTO catalogue(id, nom, maj)
       VALUES (23, 'SPORT', '2014-04-20');

INSERT INTO catalogue(id, nom, maj)
       VALUES (25, 'VILLE', NOW());

INSERT INTO catalogue(id, nom, maj)
       VALUES (24, 'CLASSE', NOW());

select *
from catalogue;


-- produit

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (1, 'NIKE LEBRON X', 'basket taille 45', 3, 180, 23, '2014-11-22');

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (2,'AIR JORDAN XXI PE', 'basket taille 42', 6, 240, 24, '2014-04-20');

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (3, 'NIKE KD VII', 'basket taille 40', 2, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (4, 'AIR JORDAN III', 'basket taille 40', 2, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (5, 'AIR JORDAN VII', 'basket taille 42', 2, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (6, 'AIR JORDAN X', 'basket taille 40', RAND(), 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (7, 'NIKE HYPPERFUSE 2014', 'basket taille 43', 12, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (8, 'NIKE AIR ZOOM HYPERDUNK', 'basket taille 44', 25, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (9,'NIKE LUNAR FLYNIT RED', 'basket taille 46', 8, 110, 24, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (10, 'NIKE AIR FORCE ONE WHITE', 'basket taille 38', 9, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (11, 'ADIDAS D-ROSE 4', 'basket taille 43', 11, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (12, 'ADIDAS HOWARD II', 'basket taille 48', 12, 110,23, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (13, 'LOUBOUTIN RED/WHITE', 'basket taille 44', 9, 985,23, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN BLACK/WHITE', 'basket taille 43', 6, 1010, 24, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN BLACK', 'basket taille 46', 5, 823, 24, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN ALL WHITE', 'basket taille 47', 12, 823, 24, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('G.ZANOTI GOLD/WHITE', 'basket taille 43', 4, 800, 24, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('G.ZANOTI GOLD/BLACK', 'basket taille 42', 7, 800, 24, NOW());



select *
from produit;


-- commande

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10),3, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 7, 1);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 2, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 3, 3);
 
INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*10), 3, 1);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (10, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (13, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (13, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (10, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (16, 1, 3);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (14, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND(16)*154/10), 1, 1);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (floor(RAND()*17),1 ,floor(RAND()*7));



SELECT *
FROM commande;

SELECT COUNT(*)
FROM commande
WHERE nclient=2;

-- DELETE FROM commande
-- WHERE id>0;

DELETE FROM adresse 
WHERE id>10;
