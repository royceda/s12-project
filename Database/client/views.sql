
--
-- Structure de la vue `statCatalogue`
--
DROP TABLE IF EXISTS `statCatalogue`;

CREATE VIEW `statCatalogue` AS 
select `ca`.`nom` AS `catalogue`,sum((`c`.`quantite` * `p`.`prix`)) AS `prix` 
from ((`commande` `c` join `produit` `p`) join `catalogue` `ca`) 
where ((`c`.`nprod` = `p`.`id`) and (`p`.`catalogue` = `ca`.`id`)) 
group by `ca`.`nom`
Order by `prix` desc;

--
-- Structure de la vue statClient
--
DROP TABLE IF EXISTS `statClient`;

CREATE  VIEW `statClient` AS 
select `c`.`nclient` AS `client`,sum((`c`.`quantite` * `p`.`prix`)) AS `prix` 
from (`commande` `c` join `produit` `p`) 
where (`c`.`nprod` = `p`.`id`) 
group by `c`.`nclient` 
order by `prix` desc;

--
-- Structure de la vue statMoinsVendu
--
DROP TABLE IF EXISTS `statMoinsVendu`;

CREATE  VIEW `statMoinsVendu` AS 
select `p`.`id` AS `produit`,(count(0) * sum(`c`.`quantite`)) AS `achats`
 from (`commande` `c` join `produit` `p`) 
where (`c`.`nprod` = `p`.`id`) 
group by `p`.`id` 
order by `achats`;

--
-- Structure de la vue statPlusVendu
--
DROP TABLE IF EXISTS `statPlusVendu`;

CREATE  VIEW `statPlusVendu` AS 
Select `p`.`id` AS `produit`,(count(0) * sum(`c`.`quantite`)) AS `achats` 
From (`commande` `c` join `produit` `p`)
Where (`c`.`nprod` = `p`.`id`) 
Group by `p`.`id` 
order by `achats` desc;

--
-- Structure de la vue statProduit
--
DROP TABLE IF EXISTS `statProduit`;

CREATE  VIEW `statProduit` AS 
Select `p`.`designation` AS `produit`,sum((`c`.`quantite` * `p`.`prix`)) AS `prix` 
From (`commande` `c` join `produit` `p`) 
Where (`c`.`nprod` = `p`.`id`) 
Group by `p`.`designation` 
Order by `prix` desc;

--
-- Structure de la vue statType
--
DROP TABLE IF EXISTS `statType`;

CREATE  VIEW `statType` AS 
Select `ca`.`type` AS `type`,sum((`c`.`quantite` * `p`.`prix`)) AS `prix` 
From ((`commande` `c` join `produit` `p`) join `catalogue` `ca`) 
Where ((`c`.`nprod` = `p`.`id`) and (`p`.`catalogue` = `ca`.`id`) and (`ca`.`id` = `p`.`catalogue`)) 
Group by `ca`.`type` 
Order by `prix` desc;
