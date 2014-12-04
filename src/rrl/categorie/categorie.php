<?php
session_start();
include_once '../modules/bdd.php';
$adresse_actuelle="../categorie/index.php";
if (!isset($_GET['id'])){
	$id=1;
}
else $id=$_GET['id'];
if (!isset($_GET['ty'])){
	$type=1;
}
else $type=$_GET['ty'];
if (!isset($_GET['sort'])){
	$sort="dated";
}
else $sort=$_GET['sort'];

if (!isset($_GET['p'])){
	$page=0;
}
else $page=$_GET['p'];


$NBPAGE=18;
include "../modules/connexion.php";
?>

<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title></title>
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
$statement='Select name FROM photo Where id='.$id;
$res=$bdd->query($statement)->fetch();?>
<div class="photo_categorie"><img src="images/photos/categories/<?php echo $res['name']?>.jpg"></div>
<div id="menuV">
<div id="menu">
<?php 
	$statement="Select id,nom From catalogue";
	$select=$bdd->query($statement);
	while($res=$select->fetch()){
		$catalogues[$res['id']]=$res['nom'];
	}
	for ($i=1;$i<6;$i++){
		echo '<div class="menu" id="menu'.$i.'" onclick="event.preventDefault();afficheMenu(this);">';
		echo '<a href="#">'.$catalogues[$i].'</a>';
		echo '</div>';
		$statement='Select type from produit Where catalogue='.$i.' Order By type';
		$select=$bdd->query($statement);
		$a=1;
		if ($id==$i)
			echo '<div id="sousmenu'.$id.'" style="display:initial">';
		else 
			echo '<div id="sousmenu'.$id.'" style="display:none">';
		while($res=$select->fetch()){
			echo '<div class="sousmenu">';
			if ($i==$id && $type==$a){
				echo '<a href="../categorie/index.php?id='.$i.'&amp;ty='.$a.'" class="act">'.$res['type'].'</a>';
				$typeName=$res['type'];
			}
			else 
				echo '<a href="../categorie/index.php?id='.$i.'&amp;ty='.$a.'">'.$res['type'].'</a>';
			echo '</div>';	
			$a++;
		}
		echo "</div>";
	}
?>	
</div>
</div>
<div id="body">

	<div id="trie">
		<form action="categorie.php?c=1&amp;&t=1">
			Taille:
			<select name="pointure">
				<option value="all">all</option>
				<?php 
				$statement="Select d.taille as taille From disponibilite d, produit p".
				" Where p.id=d.nprod And type='".$typeName."' And d.quantite<>0";
				$select=$bdd->query($statement);
				while($res=$select->fetch()){
					if ($typeName==$res['taille'])
						echo '<option value="'.$res['taille'].'" selected>date croissant</option>';
					echo '<option value="'.$res['taille'].'" >date croissant</option>';
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
$statement="Select p.date_add as date_add, p.id as id, p.type as type, p.designation as designation, p.prix as prix, c.nom as catalogue".
		" From produit p, disponibilite d, catalogue c". 
		" Where p.id=d.nprod And type='".$typeName."' And d.quantite<>0 And p.catalogue=c.id"." Order By  ";
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
				$statement="prix Desc";
				break;
			case "meilleurv":
				$statement.="";
				break;
			case "coeur":
				$statement.="";
				break;
		}
$statement.=" Limit ".$page*$NBPAGE.",".($page+1)*$NBPAGE;
echo $statement;
$select=$bdd->query($statement);
$pages=$select->rowCount();
while($res=$select->fetch()){
	echo '<div class="item">';
	echo '<div class="photo_item_c">';
	echo '<img class="photo_item" src="../images/photos/'.$res['catalogue'].'/'.$res['id'].'.jpg">';
	echo '<a href="../produits/consulter.php?id='.$res['id'].'">Details</a>';
	echo '</div>';
	echo '<span class="info">'.substr($res['description'],120).'... '.' <span class="prix">'.$res['prix'].'€</span></span>';
	echo '</div>';
}?>
</div>			
<?php include_once '../modules/pages.php';
?>

<?php 
include_once '../bottom.php';
?>

</body>
</html>