<?php
session_start();
include_once '../modules/bdd.php';
$adresse_actuelle="../categorie/index.php";
if (!isset($_GET['id'])){
	$id=$bdd->query("SELECT id From catalogue Where nom='VETEMENTS'")->fetch()['id'];
	$index=FALSE;
}
else $id=$_GET['id'];
if (!isset($_GET['p'])){
	$page=0;
	unset($_SESSION['pointure']);
	unset($_SESSION['trie']);
}
else $page=$_GET['p'];
$statement="SELECT nom,type FROM catalogue Where id=".$id;
$res=$bdd->query($statement)->fetch();
$typeName=$res['type'];    $catalogueName=$res['nom'];
if (!isset($_SESSION['trie'])){
	if (!isset($_POST['trie'])){
		$sort="dated";
	}
	else $sort=$_POST['trie'];
	$_SESSION['trie']=$sort;
}
else
	$sort=$_SESSION['trie']; 

if(!isset($_SESSION['pointure'])){
	if (isset($_POST['pointure'])){
		$pointure=$_POST['pointure'];
		$_SESSION['pointure']=$pointure;
	}else{
		$pointure="all";
	}
}
else 
	$pointure=$_SESSION['pointure'];
if (!isset($_GET['type']))
	$typeDef=FALSE;
else $typeDef=TRUE;
$NBPAGE=18;
include "../modules/connexion.php";
/////////////////////////////////////////////Récuperation d'un des ids de chaque catalogues/////////////////////
/*$statement="Select id,nom from catalogue Group By nom";
$select=$bdd->query($statement);
while($res=$select->fetch()){
	$catalogues[$res['nom']]=$res['id'];
}*/
?>

<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>RRL-<?php echo $catalogueName?></title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="../css/categorie.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
<script src="../js/menu.js" type="text/javascript"></script>

</head>
<body>

<?php include_once '../head.php';
include_once '../menu.php';
include_once '../modules/pannier.php';
$statement='Select name FROM photo Where type=\''.$typeName."'";
$res=$bdd->query($statement)->fetch();?>
<div class="photo_categorie"><img src="../images/photos/categories/<?php echo $res['name']?>.jpg"></div>

<?php include_once '../modules/menuV.php'?>



<div id="body">

	<div id="trie">
		<form method="post" action="categorie.php?c=1&amp;t=1&amp;id=<?php 
		echo $id;
		if($typeDef)
			echo "&amp;type=1";
		?>
		">
			Taille:
			<select name="pointure">
				<option value="all">all</option>
				<?php 
				$statement="Select DISTINCT d.taille as taille From disponibilite d, catalogue c, produit p".
				" Where p.id=d.nprod  And d.quantite<>0 And c.id=p.catalogue And c.nom='".$catalogueName."'";
				if ($typeDef)
					$statement.=" And c.type='".$typeName."'";
				 $statement.=' ORDER BY taille';
				$select=$bdd->query($statement);
				while($res=$select->fetch()){
					if ($pointure==$res['taille'])
						echo '<option value="'.$res['taille'].'" selected>'.$res['taille'].'</option>';
					echo '<option value="'.$res['taille'].'" >'.$res['taille'].'</option>';
				}
				?>
				
			</select>
			Trié par: 		
			<select name="trie" style="margin-right:0;">
				<option value="datec" <?php if($sort=="datec") echo "selected"?>>date croissant</option>
				<option value="dated" <?php if($sort=="dated") echo "selected"?>>date decroissant</option>
				<option value="prixc" <?php if($sort=="prixc") echo "selected"?>>prix croissant</option>
				<option value="prixd" <?php if($sort=="prixd") echo "selected"?>>prix decroissant</option>
				<option value="meilleurv" <?php if($sort=="meilleurv") echo "selected"?>>meilleur vente</option>
			</select>
		</form>
	</div>
<?php 
$statement="Select COUNT(*) as nb".
		" From produit p, disponibilite d, catalogue c".
		" Where p.id=d.nprod  And d.quantite<>0 And  c.id=p.catalogue And c.nom='".$catalogueName."' "; 
		if ($pointure!="all")
			$statement.=" And d.taille=".$pointure;
		if ($typeDef)
			$statement.=" And c.type='".$typeName."'";			
$pages=ceil(($bdd->query($statement)->fetch()['nb'])/$NBPAGE);
if ($pages!=0){
$statement="Select p.date_add as date_add, p.id as id, c.type as type, p.designation as designation, p.prix as prix, p.photo as photo".
		" From produit p, disponibilite d, catalogue c". 
		" Where p.id=d.nprod  And d.quantite<>0 And  c.id=p.catalogue And c.nom='".$catalogueName."' "; 
		if ($pointure!="all")
			$statement.=" And d.taille=".$pointure;
		if ($typeDef)
			$statement.=" And c.type='".$typeName."'";			
		$statement.=" Order By ";
		switch ($sort){
			case "datec":
				$statement.="p.date_add";
				break;
			case "dated":
				$statement.="p.date_add Desc";
				break;
			case "prixc":
				$statement.="p.prix";
				break;
			case "prixd":
				$statement.="p.prix Desc";
				break;
			case "meilleurv":
				$statement=" Select p.date_add as date_add, p.id as id, ca.type as type, p.designation as designation, p.prix as prix, p.photo as photo ". 
							" From ((`commande` `c` join `produit` `p`) join `catalogue` `ca`)  ".
							 " Where (`c`.`nprod` = `p`.`id`) And ca.id=p.catalogue And ca.nom='".$catalogueName."'"; 
				if ($pointure!="all")	
					$statement.=" And d.taille=".$pointure;
				if ($typeDef)
					$statement.=" And c.type='".$typeName."'";				
				$statement.=" Group by `p`.`id` ";
				break;
		}
$statement.=" Limit ".$page*$NBPAGE.",".($page+1)*$NBPAGE;
$select=$bdd->query($statement);
while($res=$select->fetch()){
	echo '<div class="item">';
	echo '<div class="photo_item_c">';
	echo '<img class="photo_item" src="../images/'.$res['photo'].'">';
	echo '<a href="../produit/consulter.php?id='.$res['id'].'">Details</a>';
	echo '</div>';
	echo '<div class="info">'.$res['designation'].' <br/><span class="prix">'.$res['prix'].'€</span></div>';
	echo '</div>';
}?>
</div>			
<?php 
$c=true;
include_once '../modules/pages.php';
}
else{
	?><div class="center" style="margin-bottom: 300px;"><div class="panniervide">Nous somme désolé mais aucun produit n'est disponible dans cette section.</div></div><br>
<?php }
?>

<?php 
include_once '../bottom.php';
?>
<script type="text/javascript" src="categorie.js"></script>

</body>
</html>