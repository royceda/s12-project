-- Produit star


-- Classement des stars
drop view plus_moins;

CREATE VIEW plus_moins (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, nprod, designation 
FROM commande, produit
WHERE produit.id = commande.nprod	        
GROUP BY nprod 
ORDER BY ventes DESC;

SELECT *
FROM plus_moins;


-- Classement des flops
drop view moins_plus;

CREATE VIEW moins_plus (ventes, nprod, designation) AS
SELECT count(nprod) AS ventes, nprod, designation
FROM commande, produit 
WHERE produit.id = commande.nprod
GROUP BY nprod 
ORDER BY ventes;

SELECT *
FROM moins_plus;

