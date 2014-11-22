<?php
start_session();
$id=0;
include_once 'bdd.php';
$b=TRUE;
$NBPAGE=18;
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
				$b=TRUE;
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
<?php if ($b==FALSE){	
	?>
<form action="membres/seco.php" id="connexion">
<div><label for="login">Login</label><input id="login" name="login" type="text"></div>
<div><label for="password">Pass</label><input id="password" name="password" type="password"></div>
<div class="connexion">
	<a href="inscription.php">register</a> 
	<a href="index.php?c=1">log in</a>
</div>
</form>
<?php 
	}
	else {
		if (!isset($_SESSION['nom'])){
			$statement='Select nom,prenom From membre Where mail="'.$_SESSION['login'].'"';
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				$_SESSION['nom']=$res['nom'];
				$_SESSION['prenom']=$res['prenom'];
			}
		}
		?>
		<div id="connexion">
		<div class="nom"><?php echo "Bonjour ".$_SESSION['nom']." ".$_SESSION['prenom']." "?></div>
		<div class="espace_client">Votre espace client</div>
		</div>
		<?php 
	}
include_once 'menu.php';
$statement='Select name FROM photo Where id=0';
$res=$bdd->query($statement)->fetch();
?>
<div class="photo_j"><img src="images/photo_j/<?php echo $res['name']?>.jpg"></div>
<div class="bloc">
<?php 
	$statement='Select Count(*) as nb From produit';
	$pages=$bdd->query($statement)->fetch()['nb'];
	if (!isset($_GET['p'])){
		$page=0;
	}
	$satement="Select p.id as id, p.type as type,p.designation as designation ,p.prix as prix, c.nom as catalogue".
				"From produit p,catalogue c".
				"Where p.catalogue=c.id And p.disponible<>0 ".
				"Order By date_add Desc ". 
				"Limit ".$page*$NBPAGE.",".$page*($NBPAGE+1);
	$select=$bdd->query($statement);
	while($res=$select->fetch()){
		?>		 
		<div class="item">
		<div class="photo_item_c">
		<img class="photo_item" src="images/photos/<?php echo $res['catalogue']?>/<?php echo $res['id']?>.jpeg">
		<a href="produits/consulter.php?id=<?php echo $res['id']?>">Details</a>
		</div>
		<span class="info"><?php echo $res['designation']?> <span class="prix"><?php echo $res['prix']?></span></span>
		</div>
		<?php 
	}
?>
</div>

<span class="navigation_p">Page:
<?php 
if ($page>2){
	$start=0;
	$end=5;
}
else{
	$start=$page-2;
	$end=$page+3;
}
for ($i=$start;$i<$end;$i++){
	if ($i==$page){?>
		<span class="actuel"><?php echo $page?></span>
	
	<?php
	} 
	else {?>
		<a href="?p=<?php echo $i?>"><?php echo $i?></a> 		 
<?php 	}
}
	?>
 <a href="?p=<?php echo $page+2?>">...</a>
 <a href="?p=<?php echo $page+1?>">&gt;</a>
</span>
<?php 
	include_once 'bottom.php';
?>


</body>
