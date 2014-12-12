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
$typeName=$res['type'];$catalogueName=$res['nom'];
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
$statement='Select name FROM photo Where type='.$typeName;
$res=$bdd->query($statement)->fetch();?>
<div class="photo_categorie"><img src="images/photos/categories/<?php echo $res['name']?>.jpg"></div>
<div id="menuV">
<div id="menu">
<?php 
	$statement="Select Distinct nom From catalogue";
	$select=$bdd->query($statement);
	/*
	while($res=$select->fetch()){
		$catalogues[$res['id']]=$res['nom'];
	}
	*/
	//for ($i=1;$i<6;$i++){
	$i=0;
	while($res=$select->fetch()){
		echo '<div class="menu" id="menu'.$i.'" onclick="event.preventDefault();afficheMenu(this);">';
		echo '<a href="#">'.$res['nom'].'</a>';
		echo '</div>';
		$statement='Select type,id from catalogue Where nom='.$res['nom'].' Order By type';
		$select=$bdd->query($statement);
		$types[0]="";
		//$a=1;
		if ($res['nom']==$catalogueName)
			echo '<div id="sousmenu'.$i.'" style="display:initial">';
		else 
			echo '<div id="sousmenu'.$i.'" style="display:none">';
		while($r=$select->fetch()){
			if (in_array($res['type'],$types))
			echo '<div class="sousmenu">';
			if ($res['name']==$catalogeName && $type==$r['type']){
				echo '<a href="../categorie/categorie.php?id='.$i.'" class="act">'.$res['type'].'</a>';
				$typeName=$res['type'];
			}
			else 
				echo '<a href="../categorie/categorie.php?id='.$i.'&amp;ty='.$res['type'].'">'.$res['type'].'</a>';
			echo '</div>';	
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
				$statement="Select DISTINCT d.taille as taille From disponibilite d, produit p".
				" Where p.id=d.nprod And type='".$type."' And d.quantite<>0 ORDER BY taille";
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
		" From produit p, disponibilite d".
		" Where p.id=d.nprod And type='".$type."' And d.quantite<>0 and p.catalogue=".$id." GROUP BY p.id";
if ($pointure!='all')
	$statement.=" AND d.taille=".$pointure;
$pages=ceil(($bdd->query($statement)->fetch()['nb'])/$NBPAGE);
$statement="Select p.date_add as date_add, p.id as id, p.type as type, p.designation as designation, p.prix as prix, p.photo as photo".
		" From produit p, disponibilite d". 
		" Where p.id=d.nprod And type='".$type."' And d.quantite<>0 And p.catalogue=".$id." "; 
		if ($pointure!="all")
			$statement.=" And d.taille=".$pointure;
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