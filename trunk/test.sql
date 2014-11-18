SHOW DATABASES;
USE rrl_test;


--adresse

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'LH', '12 rue du beau', 76000, 'FRANCE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'PARIS', '12 rue Rivoli', 1000, 'FRANCE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'BERLIN', '12 Munich', 9890, 'ALLEMAGNE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'ROME', '12 Vatican', 1231, 'ITALIE'); 

INSERT INTO adresse ( ville, rue, code_postal, pays) 
       values( 'BORDEAUX', '12 rue Ste Catherine', 33000, 'FRANCE'); 


SELECT *
FROM adresse;


DELETE FROM adresse 
WHERE id>1;

 
-- commande

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (13, 1, 7);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (23, 7, 1209);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (65, 2, 232);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (1212, 3, 9898);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (67, 1, 7897);

INSERT INTO commande (nprod,quantite,nclient)
       VALUES (111, 1, 7);


SELECT *
FROM commande;

SELECT COUNT(*)
FROM commande
WHERE nclient=7;

DELETE FROM commande
WHERE id>0;
