<?php
session_start();
$adresse_actuelle="../panier/verifier.php";
include "../modules/bdd.php";
include "../modules/connexion.php";
if (!isset($_GET['id'])){
	$id=1;
	$index=FALSE;
}
else $id=$_GET['id'];

?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Pannier</title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="../index.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
<link href="../css/pannier.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include_once "../head.php"?>
<?php include_once "../menu.php"?>
<?php 
if ($b==TRUE){
$statement="Select Count(*) As nb From commande Where confirme=0 And nclient=".$_SESSION['id'];
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
<a class="voir_pannier" href="../panier/verifier.php">Cart:<span class="nb_items"><?php echo $nb_commande?></span> item </a>
</div>

<h1><span>Pannier</span></h1>
<?php 
if ($nb_commande==0){
	?>
	<div class="center">
	<span class="panniervide"> Votre pannier est vide.
		<?php if ($b==FALSE) echo "Aviez-vous déjà des articles dans votre panier ?<br/> Connectez-vous pour les retrouver";
				else echo 'Retourner à <a href="../index.php" style="text-decoration:underline;color:black"> l\'accueil</a>'?>
	</span>
	</div>
<?php 
}
else{?>
	
<table>
<tr>
	<th class="croix"></th>
	<th class="photo"></th>
	<th class="description"></th>
	<th class="size">taille</th>
	<th class="quantity">quantity</th>
	<th class="price">price</th>
</tr>
<?php
	$total=0;
	if ($b==TRUE){
		$statement="Select co.nprod as id, p.photo as photo, co.quantite as quantite, c.nom as catalogue, p.prix as prix, co.taille as taille, p.designation as designation".
		" From commande co,catalogue c,produit p".
		" Where co.confirme=0 And co.nclient=".$_SESSION['id'].' And p.id=co.nprod And p.catalogue=c.id';
		$select=$bdd->query($statement);
		while ($res=$select->fetch()){
			?>
			<tr>
				<td  class="croix"><a href="../panier/delete.php?id=<?php echo $res['id']?>&amp;taille=<?php echo $res['taille']?>"><img src="../images/cross.png"/></a></td>
				<td><img src="../images/<?php echo $res['photo']?>" alt="photo"/></td>
				<td><?php echo $res['designation']?></td>
				<td class="size"><?php echo $res['taille']?></td>
				<td class="quantity">x <form action="../panier/modifier.php?id=<?php echo $res['id']?>" method="post" ><input value="<?php echo $res['quantite']?>" name="<?php echo $res['id']?>"/></form></td>
				<td class="price"><?php echo $res['quantite']*$res['prix']?>&euro;</td>
				</tr>
			
			<?php 
			$total+=$res['quantite']*$res['prix'];
		}
		
	}
	else{
		print_r($_SESSION);
		foreach ($_SESSION['pannier'] as $id_prod=>$commande){
			$statement="SELECT p.designation as designation, p.descriptif as descriptif, p.photo as photo, p.prix as prix FROM produit p Where id=".$id_prod;
			foreach ($commande as $taille=>$quantite){
				$res=$bdd->query($statement)->fetch();?>
			<tr>
				<td  class="croix"><a href="../panier/delete.php?id=<?php echo $id_prod?>&amp;taille=<?php echo $taille?>"><img src="../images/cross.png"/></a></td>
				<td><img src="../images/<?php echo $res['photo']?>.jpeg" alt="photo"/></td>
				<td><?php echo $res['designation']?><br/><?php echo $res['descriptif']?></td>
				<td class="size"><?php echo $taille?> </td>
				<?php //echo $_SESSION['pannier'][$id_prod][$taille]?>
				<td class="quantity">x <form action="../panier/modifier.php?id=<?php echo $id_prod?>&amp;taille=<?php echo $taille?>" method="post" ><input value="<?php echo $_SESSION['pannier'][$id_prod][$taille]?>" name="<?php echo $id_prod?>"/></form></td>
				<td class="price"><?php echo $_SESSION['pannier'][$id_prod][$taille]*$res['prix']?>&euro;</td>
				</tr>
		<?php
				$total+=$_SESSION['pannier'][$id_prod][$taille]*$res['prix'];
			}	
		}
	}
	?>
	<tr>
	<td class="croix"></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="quantity">Total items</td>
	<td class="price"><?php echo $total?>&euro;</td>
	</tr>
	
	<tr>
	<td class="croix"></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="quantity"><strong>Frais de port</strong></td>
	<td class="price">5&euro;</td>
	</tr>
	<tr>
	<td class="croix"></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="quantity"><strong>total</strong></td>
	<td class="price"><?php echo $total+5?>&euro;</td>
	</tr>
	
	</table>	
<div class="center">
<div class="confirmer"><a href="../panier/confirmer.php">CONFIRMER</a></div>
</div>
			<?php 
}
include_once '../bottom.php';
?>