<?php
session_start();
$adresse_actuelle="index.php";
$id=0;
include_once 'modules/bdd.php';
$NBPAGE=18;
include "modules/connexion.php"
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
<?php include_once 'head.php';
include_once 'menu.php';
if ($b==TRUE){
$statement="Select Count(*) As nb From commande Where confirme=0 And nclient=".$_SESSION['id'].'"';
$nb_commande=$bdd->query($statement)->fetch()['nb'];
}
else {
	if (isset($_SESSION['pannier'])){
		$nb_commande=count($_SESSION['pannier']);
	}
	else 
		$nb_commande=0;
}
?>
<div style="display:inline-block;width:100%;">
<a class="voir_pannier" href="http://localhost/rrl/panier/verifier.php">Cart:<span class="nb_items"><?php echo $nb_commande?></span> item </a>
</div>
<?php 
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
	if ($pages<5)
		$end=$pages;
	else 
		$end=5;
}
else{
	if ($pages<5){
		$start=0;
		$end=$pages;
    }
	else{
		$start=$page-2;
		$end=$page+3;
	}
}
if ($pages>5 && $page>3){
	?> <a href="?p=<?php echo $start-1?>">&lt;</a>
<?php }
for ($i=$start;$i<$end;$i++){
	if ($i==$page){?>
		<span class="actuel"><?php echo $page?></span>
	
	<?php
	} 
	else {?>
		<a href="?p=<?php echo $i?>"><?php echo $i?></a> 		 
<?php 	}
}
if ($pages<$end+2)	
 echo '<a href="?p=<?php echo $end+2?>">...</a>';
if ($pages!=$page) 
	echo '<a href="?p=<?php echo $page+1?>">&gt;</a>';
?>
</span>
<?php 
	include_once 'bottom.php';
?>


</body>
