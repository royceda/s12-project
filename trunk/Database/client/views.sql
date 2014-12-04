

-- VUES

-- Classement des stars


CREATE VIEW statPVendu (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, p.id as nprod, designation 
FROM commande right outer join produit p
ON p.id = commande.nprod	        
GROUP BY nprod 
ORDER BY ventes DESC;

SELECT *
FROM plus_moins;


-- Classement des flops


CREATE VIEW statMVendu (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, p.id AS nprod, designation
FROM commande RIGHT OUTER JOIN produit p 
ON p.id = commande.nprod
GROUP BY nprod 
ORDER BY ventes;



-- classement par prix

CREATE VIEW cheap_to_expensive (id, designation, prix) AS
SELECT id, designation, prix
FROM produit
ORDER BY prix desc;



-- Liste des meilleurs clients


CREATE VIEW StatClient (ncl, nom, prenom, nb_achats) AS
       SELECT cl.id as ncl, cl.nom as nom, cl.prenom as prenom, count(nclient) as nb_achats 
       FROM membre cl, commande c
       WHERE cl.id = c.nclient
       GROUP BY cl.id
       ORDER BY nb_achats desc;


-- chiffre d'affaire

-- par client

CREATE VIEW statPVClient (nom, prenom, plus_values) AS
       SELECT cl.nom as nom, cl.prenom as prenom, sum(p.prix) as plus_values
       FROM membre cl, commande c, produit p
       WHERE c.nprod = p.id
       AND c.nclient = cl.id
       GROUP BY cl.nom
       ORDER BY plus_values desc;
