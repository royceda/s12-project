<?php
$adresse_actuelle="../admin/supprimer.php";
include '../modules/bdd.php';
$b=True;
if (!isset($_GET['f'])){
	$b=FALSE;
}

if (isset($_GET['s']))
	$s=TRUE;
else $s=FALSE;
$id=102;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>RRL Admin-Supprimer</title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php 
include_once 'head.php';

?>
<h1>Supprimer</h1>

<?php if ($b==FALSE){
	?>
<form class="select" style="text-align:center;">
Supprimer un 
	<select name="ajout" >
		<option value="none" selected>Cliquez sur l'un des options</option>
		<option value="client">Client</option>
		<option value="produit">Produit</option>
		<option value="type">Type</option>
		<option value="catalogue">Catalogue</option>
		<option value="promotion">Promotion</option>
	</select>
</form>
<div id="body">
<div id="client">
	
	<form id="clientform" method="post" action="?f=1">
	<label for="designation">ID de client:</label><input type="text" name="id" id="id"/><br/>
		<input type="submit" value="SELECTIONER"/>
	</form>
</div>
<div id="produit">
	
	<form id="produitform" method="post" action="?f=2" enctype="multipart/form-data">
		<label for="designation">ID de produit:</label><input type="text" name="id" id="id"/><br/>
		<input type="submit" value="SELECTIONER"/>
	</form>
</div>
<div id="type">
	
	<form id="produitform" method="post" action="?f=4" enctype="multipart/form-data">
		<label for="designation">ID du type:</label><input type="text" name="id" id="id"/><br/>
		<input type="submit" value="SELECTIONER"/>
	</form>
</div>

<div id="catalogue">
	
	<form id="catalogueform" method="post" action="?f=3">
		<label for="designation">ID d'un des types du catalogues:</label><input type="text" name="id" id="id"/><br/>
		<input type="submit" value="SELECTIONER"/>
	</form>
</div>
<div id="promotion">
	
	<form id="promotionform" method="post" action="?f=5">
	<label for="designation">ID de la promotion:</label><input type="text" name="id" id="id"/><br/>
		<input type="submit" value="SELECTIONER"/>
	</form>
</div>
</div>
<?php }
else if (!$s){ 
	switch($_GET['f']){
		case 1:
			$statement="Select cl.nom, cl.prenom, cl.mail, cl.telephone, a.ville, a.pays, a.code_postale, a.rue";
			$statement.=" From membre cl, adresse a ";
			$statement.=" Where cl.id=".$_POST['id']." And cl.adresse=a.id";
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				$nom=$res['nom'];
				$prenom=$res['prenom'];
				$mail=$res['mail'];
				$telephone=$res['telephone'];
				$ville=$res['ville'];
				$pays=$res['pays'];
				$codepostale=$res['code_postale'];
				$rue=$res['rue'];
			}
			if (isset($ville)){?>
			<h4>Voulez vous supprimer le client avec ces identifiants:</h4>
			<label for="nom">Nom :</label><?php echo $nom;?>
			<label for="prenom">Prenom :</label><?php echo $prenom;?>
			<label for="mail">Mail :</label><?php echo $mail?>
			<label for="ville">ADRESSE :</label><br/>
			<label for="ville">Ville :</label><?php echo $ville ?>
			<label for="rue">Rue :</label><?php echo $rue ?>
			<label for="codepostal">Code Postal :</label><?php echo $codepostale ?>
			<label for="pays">Pays :</label><?php echo $pays ?>
			<label for="telephone">Telephone :</label><?php echo $telephone ?>
<?php 				
			}
			else 
				$erreur="Client avec l'id".$_GET['id']."non trouvé";
			break;
	case 2:
		$statement="Select p.designation as designation, p.descriptif as descriptif, p.prix as prix, p.photo as photo";
		$statement.=" From produit p Where p.id=".$_POST['id'];
		$select=$bdd->query($statement);
		while($res=$select->fetch()){
			$designation=$res['designation'];
			$descriptif=$res['descriptif'];
			$prix=$res['prix'];
			$photo=$res['photo'];
		}
		if (isset($prix)){ ?>
					<label for="designation">Designation :</label><?php echo $designation?>
					<label for="descriptif">Descriptif :</label><?php echo $descriptif?>
					<label for="prix">Prix :</label><?php echo $prix?>
					<label for="photo">Photo :</label><?php echo $photo?>
					
			<?php 
		}
		else{
			$erreur="Produit".$_GET['id']." non trouvé";
		}
		break;
	case 4:
		$statement="Select nom, type From catalogue where id=".$_POST['id'];
		$select=$bdd->query($statement);
		if ($res=$select->fetch()){
			$nom=$res['nom'];
			$type=$res['type'];
		}
		if (isset($nom)){?>
					<label for="nom">Nom :</label><?php echo $nom?>
					<label for="type">Type :</label><?php echo $type?>
					
		<?php 	
		}
		else 
			$erreur="type avec l'id ".$_POST['id']."non trouvé";
		break;
	case 3:		
		$statement="Select nom From catalogue where id=".$_POST['id'];
		$select=$bdd->query($statement);
		if ($res=$select->fetch()){
			$nom=$res['nom'];
		}
					if (isset($nom)){?>
					<label for="nom">Nom :</label><input type="text" name="nom" id="nom" value="<?php echo $nom?>"/>
					
			<?php 				
					}
			else{
						$erreur="Id du catalogue ".$_POST['id']." non trouvé";
					}
		break;
	case 5:
		$statement="Select catalogue,reduction,deadline,startline From promo where id=".$_POST['id'];
		$select=$bdd->query($statement);
		if ($res=$select->fetch()){
			$catalogue=$res['catalogue'];
			$reduction=$res['reduction'];
			$deadline=$res['deadline'];
			$startline=$res['startline'];
		}
		if (isset($catalogue)){?>
								<label for="catalogue">ID du catalogue :</label><?php echo $_POST['id']?>
								<label for="catalogue">Reduction :</label><?php echo $reduction?>
								<label for="catalogue">deadline :</label><?php echo $deadline?>
								<label for="catalogue">startline :</label><?php echo $startline?>
						<?php 				
								}
		else{
			$erreur="Id du promo".$_POST['id']."non trouvé non trouvé";
		}
		break;					
	}
	if (!isset($error)){
		?>
		<div class="confirmer"><a href="?f=<?php echo $_GET['f']?>&amp;id=<?php echo $_POST['id']?>&amp;s=1">SUPPRIMER</a></div>
		<?php }
	else {
		echo '<div class="erreur">'.$erreur."</div>";
	}


}
else{
	include "modules/delete.php";
	echo '<div class="message">'.$message.'</div>';
}
include_once '../bottom.php';
?>
<script type="text/javascript" src="ajouter.js"></script> 
</body>
</html>