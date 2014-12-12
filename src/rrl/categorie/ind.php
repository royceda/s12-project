<?php
session_start();
include_once '../modules/bdd.php';
$adresse_actuelle="../categorie/index.php";
if (!isset($_GET['id'])){
	$id=1;
	$index=FALSE;
}
else $id=$_GET['id'];
$statement="SELECT nom,type FROM catalogue Where id=".$id;
$res=$bdd->query($statement)->fetch();
$typeName=$res['type'];    $catalogueName=$res['nom'];
if (!isset($_GET['trie'])){
	$sort="dated";
}
else $sort=$_GET['trie'];

if (!isset($_GET['p'])){
	$page=0;
}
else $page=$_GET['p'];

if (isset($_GET['pointure'])){
	$pointure=$_GET['pointure'];
}else{
	$pointure="all";
}
if (!isset($_GET['type']))
	$typeDef=FALSE;
else $typeDef=TRUE;
$NBPAGE=18;
include "../modules/connexion.php";
/////////////////////////////////////////////Récuperation d'un des ids de chaque catalogues/////////////////////
$statement="Select id,nom from catalogue Group By nom";
$select=$bdd->query($statement);
while($res=$select->fetch()){
	$catalogues[$res['nom']]=$res['id'];
}

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
<div class="menuV">
<ul>
	<li>
		<a href="../categorie/categorie.php?id=".<?php $catalogues['VETEMENTS']?>>Vetements</a>
		<?php if ($catalogueName=='VETEMENTS'){?>
		<ul>
		<?php 
			$statement="SELECT DISTINCT type,id FROM catalogue WHERE name=".$catalogueName;
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id'.$res['id'].'&amp;type=1">'.$res['type'].'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
	<li>
		<a href="../categorie/categorie.php?id=".<?php $catalogues['CHAUSSURES']?>>Chaussures</a>
		<?php if ($catalogueName=='CHAUSSURES'){?>
		<ul>
		<?php 
			$statement="SELECT DISTINCT type,id FROM catalogue WHERE nom='".$catalogueName."'";
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id'.$res['id'].'&amp;type=1">'.$res['type'].'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
	<li>
		<a href="../categorie/categorie.php?id=".<?php $catalogues['ACCESSOIRES']?>>Accesoires</a>
		<?php if ($catalogueName=='ACCESSOIRES'){?>
		<ul>
		<?php 
			$statement="SELECT DISTINCT type,id FROM catalogue WHERE name=".$catalogueName;
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				echo '<li><a href="../categorie/categorie.php?id'.$res['id'].'&amp;type=1">'.$res['type'].'</a></li>';
			}
		?>
		</ul>
		<?php }?>
	</li>
</ul>
</div>


<div id="body">

	<div id="trie">
		<form action="categorie.php?c=1&amp;&t=1">
			Taille:
			<select name="pointure">
				<option value="all">all</option>
				<?php 
				$statement="Select DISTINCT d.taille as taille From disponibilite d, catalogue c, produit p".
				" Where p.id=d.nprod  And d.quantite<>0 And c.id=p.catalogue";
				if ($typeDef)
					$statement.="And c.type='".$typeName."'";
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
				<option value="coeur" <?php if($sort=="coeur") echo "selected"?>>coup de coeur</option>				
			</select>
		</form>
	</div>
<?php 
$statement="Select COUNT(*) as nb".
		" From produit p, disponibilite d, catalogue c".
		" Where p.id=d.nprod And c.type='".$typeName."' And d.quantite<>0 and p.catalogue=".$id." GROUP BY p.id";
if ($pointure!='all')
	$statement.=" AND d.taille=".$pointure;
$pages=ceil(($bdd->query($statement)->fetch()['nb'])/$NBPAGE);
$statement="Select p.date_add as date_add, p.id as id, c.type as type, p.designation as designation, p.prix as prix, p.photo as photo".
		" From produit p, disponibilite d, catalogue c". 
		" Where p.id=d.nprod And p.catalogue=c.id And d.quantite<>0 And c.nom='".$catalogueName."' "; 
		if ($pointure!="all")
			$statement.=" And d.taille=".$pointure;
		if ($typeDef)
			$statement.="And c.type='".$typeName."'";			
		$statement.=" Order By ";
		switch ($sort){
			case "datec":
				$statement.="date_add";
				break;
			case "dated":
				$statement.="date_add Desc";
				break;
			case "prixc":
				$statement.="prix";
				break;
			case "prixd":
				$statement.="prix Desc";
				break;
			case "meilleurv":
				$statement.="";
				break;
		}
$statement.=" Limit ".$page*$NBPAGE.",".($page+1)*$NBPAGE;
//echo $statement;
$select=$bdd->query($statement);
while($res=$select->fetch()){
	echo '<div class="item">';
	echo '<div class="photo_item_c">';
	echo '<img class="photo_item" src="../images/'.$res['photo'].'jpg">';
	echo '<a href="../produit/consulter.php?id='.$res['id'].'">Details</a>';
	echo '</div>';
	echo '<div class="info">'.$res['designation'].' <br/><span class="prix">'.$res['prix'].'€</span></div>';
	echo '</div>';
}?>
</div>			
<?php 
$c=true;
if ($pages!=0){
include_once '../modules/pages.php';
}
else{
	?><div class="center"><div class="panniervide">Nous somme désolé mais aucun produit n'est disponible dans cette section.</div></div>
<?php }
?>

<?php 
include_once '../bottom.php';
?>
<script type="text/javascript" src="categorie.js"></script>

</body>
</html>