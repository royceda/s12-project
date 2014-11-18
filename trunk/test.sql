SHOW DATABASES;
USE rrl_test;

-- adresse

INSERT INTO adresse (id, ville, rue, code_postal, pays) 
       VALUES (1,'LH', '12 rue du beau', 76000, 'FRANCE'); 

INSERT INTO adresse (id, ville, rue, code_postal, pays) 
       values(2, 'PARIS', '12 rue Rivoli', 1000, 'FRANCE'); 

INSERT INTO adresse (id, ville, rue, code_postal, pays) 
       values(3, 'BERLIN', '12 Munich', 9890, 'ALLEMAGNE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'ROME', '12 Vatican', 1231, 'ITALIE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'BORDEAUX', '12 rue Ste Catherine', 33000, 'FRANCE'); 


SELECT *
FROM adresse;


DELETE FROM adresse 
WHERE id>1;

-- client

INSERT INTO menbre (id, nom, prenom, telephone, adresse)
       VALUES (1, 'brown', 'charlie',0676753452, 1);


INSERT INTO menbre (nom, prenom, telephone)
       VALUES ('VAN PEE', 'LINUS',0676753452);


INSERT INTO menbre (nom, prenom, telephone)
       VALUES ('shakur', 'tupac',0676753452);


SELECT *
FROM menbre;
 

-- produit

INSERT INTO produit (id, designation, descriptif, disponible, prix)
       VALUES (1, 'NIKE LEBRON X', 'basket taille 45', 24, 180);


INSERT INTO produit (id, designation, descriptif, disponible, prix)
       VALUES (2, 'AIR JORDAN XXI PE', 'basket taille 42', 24, 240);


INSERT INTO produit (id, designation, descriptif, disponible, prix)
       VALUES (3, 'NIKE KD VII', 'basket taille 40', 24, 110);

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
