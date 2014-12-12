<?php
switch($_GET['f']){
	case 1:
		$statement="Select mail From membre where id=".$_GET['id'];
		$select=$bdd->query($statement);
		$mail=$select->fetch()['mail'];
		$select->closeCursor();
		$statement="DELETE FROM commande WHERE nclient=".$_GET['id'];
		$bdd->exec($statement);
		$statement="DELETE FROM membre WHERE id=".$_GET['id'];
		$bdd->exec($statement);
		$statement="DELETE FROM identifiant WHERE login=".$mail;
		break;
	case 2:
		$statement="DELETE FROM disponibilite WHERE nprod=".$_GET['id'];
		$bdd->exec($statement);
		$statement="DELETE FROM produit WHERE id=".$_GET['id'];
		$bdd->exec($statement);
		break;
	case 3:
		$statement="SELECT nom FROM catalogue where id=".$_GET['id'];
		$select=$bdd->query($statement);
		$nom=$select->fetch()['nom'];
		$statement="DELETE FROM disponibilite WHERE nprod in (SELECT p.id as id From produit p, catalogue c where c.id=p.catalogue and c.nom='".$nom."')";
		$bdd->exec($statement);
		$statement="DELETE FROM produit Where id in (SELECT p.id as id From produit p, catalogue c where c.id=p.catalogue and c.nom='".$nom."')";
		$bdd->exec($statement);
		$statement="DELETE FROM catalogue Where nom='".$nom."'";
		$bdd->exec($statement);
		break;
	case 4:
	/*	$statement="DELETE FROM disponibilite WHERE nprod in (SELECT p.id as id From produit p, catalogue c where c.id=p.catalogue and c.id='".$_GET['id']."')";
		$bdd->exec($statement);
		$statement="DELETE FROM produit Where id in (SELECT p.id as id From produit p, catalogue c where c.id=p.catalogue and c.id=".$_GET['id'].")";
		echo $statement;
		$bdd->exec($statement);
		$statement="DELETE FROM catalogue where id=".$_GET['id'];
		$bdd->exec($statement);
		*/
		break;
	case 5:
		$statement="DELETE FROM promo WHERE id=".$_GET['id'];
		$bdd->exec($statement);
		break;
}
$message="La suppression a bien été faite.";