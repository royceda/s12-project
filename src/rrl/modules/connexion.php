<?php
$b=TRUE;
if (!isset($_SESSION['login'])){
	$b=FALSE;
}
if (isset($_GET['co'])){
	if (isset($_POST['password']) && isset($_POST['login'])){
		$statement='SELECT password FROM identifiant WHERE login=\''.$_POST['login'].'\'';
		$select=$bdd->query($statement);
		while ($res=$select->fetch()){
			//$pass = password_hash('passi', PASSWORD_DEFAULT);
			if (password_verify($_POST['password'], $res['password'])) { // Cette ligne ne marche pas!
				echo 'Look here';
				$_SESSION['login']=$_POST['login'];
				$statement="SELECT id FROM membre WHERE mail=".'\''.$_SESSION['login'].'\'';
				$_SESSION['id']=$bdd->query($statement)->fetch()['id'];
				$b=TRUE;
			}
		}
	}
}
?>