-- Produit star


-- Classement des stars
drop view plus_moins;

CREATE VIEW plus_moins (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, p.id as nprod, designation 
FROM commande right outer join produit p
ON p.id = commande.nprod	        
GROUP BY nprod 
ORDER BY ventes DESC;

SELECT *
FROM plus_moins;


-- Classement des flops
drop view moins_plus;

CREATE VIEW moins_plus (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, p.id AS nprod, designation
FROM commande RIGHT OUTER JOIN produit p 
ON p.id = commande.nprod
GROUP BY nprod 
ORDER BY ventes;

SELECT *
FROM moins_plus;

