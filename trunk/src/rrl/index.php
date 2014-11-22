<?php
start_session();
$id=0;
include_once 'bdd.php';
$b=1;
if (!isset($_SESSION["login"])){
	$b=0;
}
if (isset($_GET['co'])){
	if (isset($_POST["password"]) && isset($_POST["login"])){
		$statement='Select password From identification Where login="'.$_POST['login'].'"';
		$select=$bdd->query(statement);
		while($res=$select->fetch()){
			if ($res["password"]==password_hash($_POST['password'],PASSWORD_DEFAULT)){
				$_SESSION['login']=$_POST['login'];
				$b=1;
			}
		}
	}
}
?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Index</title>
<link href="menu.css" rel="stylesheet" type="text/css">
<link href="head.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
</head>
<body>
<a href="http://localhost/rrl/accueil.html" id="contener_logo"><img src="index_files/logo.png" class="logo"></a>
<form action="membres/seco.php" id="connexion">
<div><label for="login">Login</label><input id="login" name="login" type="text"></div>
<div><label for="password">Pass</label><input id="password" name="password" type="password"></div>
<div class="connexion">
	<a href="inscription.php">register</a> 
	<a href="index.php?c=1">log in</a>
</div>
</form>
<?php 
include_once 'menu.php';
?>
