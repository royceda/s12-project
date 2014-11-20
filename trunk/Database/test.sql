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
       values( 'BORDEAUX', '12 rue Ste Catherine', 33000, 'FRANCE'); 


SELECT *
FROM adresse;


-- client

INSERT INTO membre (id, nom, prenom, telephone, mail, adresse)
       VALUES (1, 'brown', 'charlie',0676753452,'allo@gmail.ch', 1);


INSERT INTO membre (id,nom, prenom, telephone,mail, adresse)
       VALUES (3,'VAN PEE', 'LINUS',0676753452,'aaaaaa@bb.fr', 3);


INSERT INTO membre (id, nom, prenom, telephone, mail, adresse)
       VALUES (2,'shakur', 'tupac',0676753452,'bbbbb@licos.com', 2);

SELECT *
FROM membre;
 
-- identifiant

INSERT INTO identifiant (login, password)
       VALUES ('allo@gmail.ch', 'blahblah');


select * 
from identifiant;

-- catalogue

INSERT INTO catalogue(id, nom, maj)
       VALUES (23, 'SPORT', NOW());

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
       VALUES (2, 'AIR JORDAN XXI PE', 'basket taille 42', 6, 240, 24, '2014-04-20');


INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (3, 'NIKE KD VII', 'basket taille 40', 2, 110,23, NOW());

select *
from produit;


-- commande

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (3, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (2, 7, 1);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (3, 2, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (2, 3, 3);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (3, 1, 2);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (1, 1, 2);


SELECT *
FROM commande;

SELECT COUNT(*)
FROM commande
WHERE nclient=2;

DELETE FROM commande
WHERE id>0;

DELETE FROM adresse 
WHERE id>10;
