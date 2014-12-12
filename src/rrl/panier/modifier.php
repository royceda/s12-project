<?php
session_start();
if (!isset($_GET['id']) || !isset($_POST[$_GET['id']]) || !isset($_GET['taille'])){
	header("Location: ../panier/verifier.php");
}
else{
	include_once "../modules/bdd.php";
	include_once "../modules/connexion.php";
	if ($b==TRUE){
		$statement="UPDATE commande SET quantite=".$_POST[$_GET['id']]." WHERE nprod=".$_GET['id']." AND nclient=".$_SESSION['id']." And taille=".$_SESSION['taille']." AND confirme=0";
		$bdd->exec($statement);
	}
	else {
		$_SESSION['pannier'][$_GET['id']][$_SESSION['taille']]=$_POST[$_GET['id']];
	}
	header("Location: ../panier/verifier.php");
}