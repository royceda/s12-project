<?php
session_start();
include_once '../modules/bdd.php';
include_once '../modules/connexion.php';
if (isset($_GET['id']) && isset($_GET['taille'])){
	if ($b==TRUE){
		$statement="DELETE FROM commande WHERE nclient=".$_SESSION['id']." And nprod=".$_GET['id']." And taille='".$_GET['taille']."'";
		$bdd->exec($statement);
	}
	else {
		unset($_SESSION['pannier'][$_GET['id']][$_GET['taille']]);
		if (count($_SESSION['pannier'][$_GET['id']])==0)
			unset($_SESSION['pannier'][$_GET['id']]);
	}
}
header("LOCATION: ../panier/verifier.php");