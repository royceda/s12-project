<!-- 
	 Ce fichier php contient le menu Vertical utilisé dans la page categorie/categorie.php et panier/consulter.php.
	 Son utilisation necessite de trouver $catalogueName avant: voir l'un des deux fichiers cité avant pour des clarifications.
-->
<?php 
$statement="Select id,nom from catalogue Group By nom";
$select=$bdd->query($statement);
while($res=$select->fetch()){
	$catalogues[$res['nom']]=$res['id'];
}
?>
<div id="menuV">
<ul>
	<li>
		<a href="../categorie/categorie.php?id=<?php echo $catalogues['VETEMENTS']?>">VETEMENTS</a>
		<?php if ($catalogueName=='VETEMENTS'){?>
		<ul>
		<?php 
			$statement="SELECT  c.type as type,c.id as id FROM catalogue c,produit p, disponibilite d".
			" WHERE nom=\"".$catalogueName.'" And p.catalogue=c.id  And d.nprod=p.id And d.quantite<>0 Group By type,nom';
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id='.$res['id'].'&amp;type=1">'.ucfirst(strtolower($res['type'])).'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
	<li>
		<a href="../categorie/categorie.php?id=<?php echo $catalogues['CHAUSSURES']?>">CHAUSSURES</a>
		<?php if ($catalogueName=='CHAUSSURES'){?>
		<ul>
		<?php 
			$statement="SELECT  c.type as type,c.id as id FROM catalogue c,produit p, disponibilite d".
			" WHERE nom=\"".$catalogueName.'" And p.catalogue=c.id And d.quantite<>0 And d.nprod=p.id And d.nprod=p.id Group By c.type,c.nom';
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id='.$res['id'].'&amp;type=1">'.ucfirst(strtolower($res['type'])).'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
	<li>
		<a href="../categorie/categorie.php?id=<?php echo $catalogues['ACCESSOIRES']?>">ACCESSOIRES</a>
		<?php if ($catalogueName=='ACCESSOIRES'){?>
		<ul>
		<?php
			$statement="SELECT  c.type as type,c.id as id FROM catalogue c,produit p, disponibilite d".
			" WHERE nom=\"".$catalogueName.'" And p.catalogue=c.id And d.quantite<>0 And d.nprod=p.id  And d.nprod=p.id Group By c.type,c.nom';
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id='.$res['id'].'&amp;type=1">'.ucfirst(strtolower($res['type'])).'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
</ul>
</div>
