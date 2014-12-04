<?php
$b=TRUE;
if (!isset($_SESSION["login"])){
	$b=FALSE;
}
if (isset($_GET['co'])){
	if (isset($_POST["password"]) && isset($_POST["login"])){
		$statement='Select password From identifiant Where login="'.$_POST['login'].'"';
		$select=$bdd->query($statement);
		while($res=$select->fetch()){
			if (password_verify($_POST['password'],$res['password'])){
				$_SESSION['login']=$_POST['login'];
				$statement="Select id From membre Where mail=".$_SESSION['login'];
				$_SESSION['id']=$bdd->query($statement)->fetch()['id'];
				$b=TRUE;
			}
		}
	}
}