<?php
session_start();
if (!isset($_GET['id']) || !isset($_POST['taille'])){
	header("Location: ../categorie/categorie.php");
	}
else{
	$id_produit=$_GET['id'];
	include_once "../modules/bdd.php";
	include_once "../modules/connexion.php";
	if ($b==TRUE){
		$statement="Select id,quantite,taille from commande where nprod=".$id_produit." And confirme=0 And nclient=".$_SESSION['id'];
		$select=$bdd->query($statement);
		$a=FALSE;
		while($res=$select->fetch()){
			$quantite=$res['quantite'];
			$a=TRUE;
		}
		if ($a){
			$statement="UPDATE commande SET quantite=".($quantite+1).", taille='".$_GET['taille']."' WHERE nprod=".$_GET['id']." AND nclient=".$_SESSION['id']." AND confirme=0";
			$bdd->exec($statement);
		}
		else{
			echo 'la<br/>';
			$statement="INSERT INTO commande(nprod,quantite,nclient,date,confirme,taille) VALUES(".$_GET['id'].",1,".$_SESSION['id'].",NOW(),0,'".$_POST['taille']."')";
			$bdd->exec($statement);			
		}
	}
	else {
		if (array_key_exists($_GET['id'], $_SESSION['pannier']))
			$_SESSION['pannier'][$_GET['id']][$_POST['taille']]++;
		else{
			$_SESSION['pannier'][$_GET['id']][$_POST['taille']]=1;
		}
	}
	
	header("Location: ../produit/consulter.php?id=".$id_produit);	
}