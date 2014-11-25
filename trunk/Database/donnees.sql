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


-- client

INSERT INTO menbre (id, nom, prenom, telephone, mail, adresse)
       VALUES (1, 'Brown', 'Charlie', 0676753452, 'allo@gmail.ch', 1);

INSERT INTO menbre (id,nom, prenom, telephone,mail, adresse)
       VALUES (2,'VAN PEE', 'LINUS', 0676753452, 'aaaaaa@bb.fr', 3);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Shakur', 'Tupac', 0676753452, 'B.panther@licos.com', 2);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Combs', 'Sean', 0676753452, 'DIDDY@licos.com', 7);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Machiavel', 'Nicolas', 0676753452, 'N.Machiavel@licos.com', 9);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Presley', 'Elvis', 0676753452, 'E.Presley@licos.com', 10);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Endrix', 'Jimmy', 0676753452, 'J.Endrix@licos.com', 8);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Kant', 'Emmanuel', 0676753452, 'E.Kant@licos.com', 6);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Bryant', 'Kobe', 0676753452, 'K.Bryant@aol.com', 8);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Wiggings', 'Andrew', 0676753452, 'A.Wiggings@licos.com', 4);

INSERT INTO menbre (nom, prenom, telephone, mail, adresse)
       VALUES ('Benzema', 'Karim', 0676753452, 'K.benzema@aol.com', 5);

 
-- identifiant

INSERT INTO identifiant (login, password)
       VALUES ('allo@gmail.ch', 'blahblah');

INSERT INTO identifiant (login, password)
       VALUES ('aaaaaa@bb.fr', 'blablabla');

INSERT INTO identifiant (login, password)
       VALUES ('B.panther@licos.com', 'blahblah');

INSERT INTO identifiant (login, password)
       VALUES ('DIDDY@licos.com', 'blahblah');

INSERT INTO identifiant (login, password)
       VALUES ('N.Machiavel@licos.com', 'blahblah');

INSERT INTO identifiant (login, password)
       VALUES ('E.Presley@licos.com', 'blahblah');

INSERT INTO identifiant (login, password)
       VALUES ('J.Endrix@licos.com', 'kakakakaka');

INSERT INTO identifiant (login, password)
       VALUES ('E.Kant@licos.com', 'kakakakaka');

INSERT INTO identifiant (login, password)
       VALUES ('K.Bryant@aol.com', 'kakakakaka');

INSERT INTO identifiant (login, password)
       VALUES ('A.Wiggings@licos.com', 'kakakakaka');

INSERT INTO identifiant (login, password)
       VALUES ('K.benzema@aol.com', 'kakakakaka');



-- catalogue

INSERT INTO catalogue(id, nom, maj)
       VALUES (1, 'CHAUSSURE', '2014-04-20');

INSERT INTO catalogue(id, nom, maj)
       VALUES (2, 'VILLE', NOW());

INSERT INTO catalogue(id, nom, maj)
       VALUES (3, 'CLASSE', NOW());

INSERT INTO catalogue(id, nom, maj)
       VALUES (4, 'COSTUME', NOW());

INSERT INTO catalogue( nom, maj)
       VALUES ('CHEMISE', NOW());

INSERT INTO catalogue(id, nom, maj)
       VALUES ('PANTALON', NOW());

INSERT INTO catalogue(id, nom, maj)
       VALUES ('ACCESSOIRE', NOW());



-- produit

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (1, 'NIKE LEBRON X', 'basket taille 45', 3, 180, 1, '2014-11-22');

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (2,'AIR JORDAN XXI PE', 'basket taille 42', 6, 240, 1, '2014-04-20');

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (3, 'NIKE KD VII', 'basket taille 40', 2, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (4, 'AIR JORDAN III', 'basket taille 40', 2, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (5, 'AIR JORDAN VII', 'basket taille 42', 2, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (6, 'AIR JORDAN X', 'basket taille 40', RAND(), 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (7, 'NIKE HYPPERFUSE 2014', 'basket taille 43', 12, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (8, 'NIKE AIR ZOOM HYPERDUNK', 'basket taille 44', 25, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (9,'NIKE LUNAR FLYNIT RED', 'basket taille 46', 8, 120, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (10, 'NIKE AIR FORCE ONE WHITE', 'basket taille 38', 9, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (11, 'ADIDAS D-ROSE 4', 'basket taille 43', 11, 90, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (12, 'ADIDAS HOWARD II', 'basket taille 48', 12, 110, 1, NOW());

INSERT INTO produit (id, designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES (13, 'LOUBOUTIN RED/WHITE', 'basket taille 44', 9, 985, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN BLACK/WHITE', 'basket taille 43', 6, 1010, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN BLACK', 'basket taille 46', 5, 823, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('LOUBOUTIN ALL WHITE', 'basket taille 47', 12, 823, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('G.ZANOTI GOLD/WHITE', 'basket taille 43', 4, 800, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('G.ZANOTI GOLD/BLACK', 'basket taille 42', 7, 800, 1, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('PAUL SMITH', 'costume taille 42', 7, 1200, 4, NOW());

INSERT INTO produit (designation, descriptif, disponible, prix, catalogue, date_add)
       VALUES ('BURBERRY', 'costume taille 44', 7, 1200, 4, NOW());




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

-- promo catalogue

INSERT INTO promo (id, catalogue, reduction, deadline)
       VALUES (1, floor(RAND()*5), floor(RAND()*100), '2014-12-25');



