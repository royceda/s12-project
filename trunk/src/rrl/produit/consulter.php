<?php
$id=999;
ini_set('xdebug.collect_vars', 'on');
ini_set('xdebug.collect_params', '4');
ini_set('xdebug.dump_globals', 'on');
ini_set('xdebug.dump.SERVER', 'REQUEST_URI');
ini_set('xdebug.show_local_vars', 'on');


session_start();

if (!isset($_GET['id'])){
	header("Location: ../index.php");
	
}
else{
	include_once '../modules/bdd.php';
	$statement="SELECT nom,type FROM catalogue Where id=".$id;
	$res=$bdd->query($statement)->fetch();
	$typeName=$res['type'];    $catalogueName=$res['nom'];
	$statement="Select catalogue From produit Where id=".$_GET['id'];
	$_GET['c']=$bdd->query($statement)->fetch()['catalogue'];
	$adresse_actuelle="../categorie/index.php";
	$statement='Select name FROM photo Where id='.$_GET['c'];
	$res=$bdd->query($statement)->fetch();
	$state="Select designation From produit Where id=".$_GET['id'];
	$designation=$bdd->query($state)->fetch()['designation'];
	include "../modules/connexion.php";?>
	<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $designation?></title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="../css/categorie.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
<link href="../css/produit.css" rel="stylesheet" type="text/css">
<script src="../js/menu.js" type="text/javascript"></script>

</head>
<body>
<?php include "../head.php";
		include "../menu.php";
		include_once '../modules/pannier.php';
?>
	<div class="photo_categorie"><img src="images/photos/categories/<?php echo $res['name']?>.jpg"></div>
	<?php include_once '../modules/menuV.php'?>
	
<?php 
	$statement="SELECT p.id as id, p.designation as designation, p.descriptif as descriptif, p.prix as prix,".
		 " p.catalogue as catalogue, p.date_add as date,c.nom,p.photo as photo FROM produit p,catalogue c where p.id=".$_GET['id']." And c.id=".$_GET['c'] ;
$select=$bdd->query($statement);
while($res=$select->fetch()){	
?>
<div id="body">
<div class="bloc_produit">
<div class="titre">
<?php echo $res['designation'];?>
</div>
<div class="photo_produit"><img alt="<?php echo $res['designation']?>" src="../images/<?php echo $res['photo']?>"></div>
<div class="description">
<?php echo $res['descriptif']?>
</div>
	<table>
	<tr>
		<th></th>
		<th></th>
	</tr>
	<tr>
	<form action="../panier/ajouter.php?c=1&amp;t=1&amp;id=<?php echo $_GET['id']?>" method="post">
		<td>Taille:</td>
		<td>
			
			<?php
			$statement="SELECT DISTINCT d.taille FROM disponibilite d, produit p where d.nprod=".$_GET['id']." And d.quantite<>0 ORDER BY d.taille" ;
			$s=$bdd->query($statement); 
			?>
			<select name="taille" id="selection">
				<option value="none" style="display:block;"selected>Selectionez votre taille</option>
				<?php
				while($r=$s->fetch()){ 
				?>
				<option style="display:block;" value="<?php echo $r['taille']?>"><?php echo $r['taille']?></option>
				<?php }?>
			</select>
			
		</td>
	</tr>
	<tr>
		<td>Prix:</td>
	<td><?php echo $res['prix']?>€</td>
	</tr>
	</table>
	<br><input type="submit" value="AJOUTER"/>
	</form>
	
</div>
</div>
	<?php 
}
include_once '../bottom.php';?>
<!--  type="text/javascript" src="consulter.js"> </script>-->
</body>
</html>
<?php }?>