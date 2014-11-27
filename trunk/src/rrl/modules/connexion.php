<?php
$b=TRUE;
if (!isset($_SESSION["login"])){
	$b=FALSE;
}
if (isset($_GET['co'])){
	if (isset($_POST["password"]) && isset($_POST["login"])){
		$statement='Select password From identification Where login="'.$_POST['login'].'"';
		$select=$bdd->query(statement);
		while($res=$select->fetch()){
			if ($res["password"]==password_hash($_POST['password'],PASSWORD_DEFAULT)){
				$_SESSION['login']=$_POST['login'];
				$statement="Select id From membre Where mail=".$_SESSION['login'];
				$_SESSION['id']=$bdd->query($statement)->fetch()['id'];
				$b=TRUE;
			}
		}
	}
}