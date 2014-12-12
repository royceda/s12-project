<?php
include '../modules/bdd.php';
$b=TRUE;$m=TRUE;
if (!isset($_GET['f'])){
	$b=FALSE;
}
else {
	switch($_GET['f']){
		case 1:
			$formname="client";
			break;	
		case 2:
			$formname="produit";
			break;
		case 3:
			$formname="catalogue";
			break;
	}	
}
if (!isset($_GET['m']))
	$m=FALSE;

$id=101;
?>
<!DOCTYPE html>
<html class="">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>RRL Admin-Ajouter</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="../menu.css" rel="stylesheet" type="text/css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include "head.php";?>

<h1>Modifier</h1>

<?php if ($b==FALSE){
	?>
<form class="select" style="text-align:center;">
Modifier un 
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
else if (!$m){ ?>
<div id="body">
	<form id="form" method="post" action="?f=<?php echo $_GET['f']?>&amp;m=1&amp;id=<?php echo $_POST['id']?>">

<?php 
switch($_GET['f']){
		case 1:
			echo  "Modifier le client qui a comme id:".  $_POST['id']."</br></br></br>";
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
			if (isset($ville)){
			?>
			<label for="nom">Nom :</label><input type="text" name="nom" id="nom" value="<?php echo $nom?>"/><br/>
			<label for="prenom">Prenom :</label><input type="text" name="prenom" id="prenom" value="<?php echo $prenom?>"/><br/>
			<label for="mail">Mail :</label><input type="text" name="mail" id="mail" value="<?php echo $mail?>"/><br/><br/>
			<label for="ville">ADRESSE :</label><br/>
			<label for="ville">Ville :</label><input type="text" name="ville" id="ville" value="<?php echo $ville?>"/><br/>
			<label for="rue">Rue :</label><textarea name="rue" id="rue"><?php echo $rue?></textarea><br/>
			<label for="codepostal">Code Postal :</label><input type="text" name="codepostal" id="codepostal" value="<?php echo $codepostale?>"/><br/>
			<label for="pays">Pays :</label><input type="text" name="pays" id="pays" value="<?php echo $pays?>"/><br/>
			<label for="telephone">Telephone :</label><input type="text" name="telephone" id="telephone" value="<?php echo $telephone?>"/><br/>
			<label for="passwordf">Password :</label><input type="password" name="passwordf" id="passwordf" /><br/>
			<label for="checkpassword">Type The Password Again:</label><input type="password" name="checkpassword" id="checkpassword"/>	
			<?php }
			 else{
			 	echo "<div class=\"erreure\">Client  non trouvé</div>";
			 	$error=TRUE;
			 }
			break;
		case 2:
			echo  "Modifier le produit qui a comme id:".  $_POST['id']."</br></br>";
			$statement="Select p.designation, p.descriptif, p.prix, p.photo ";
			$statement.=" From produit p Where p.id=".$_POST['id'];
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
			$designation=$res['designation'];
			$descriptif=$res['descriptif'];
			$prix=$res['prix'];
			$photo=$res['photo'];
			}
			if (isset($prix)){ ?>
			<label for="designation">Designation :</label><input type="text" name="designation" id="designation" value="<?php echo $designation?>"/><br/>
			<label for="descriptif">Descriptif :</label><textarea  name="descriptif" id="descriptif" ><?php echo $descriptif?></textarea><br/>
			<label for="prix">Prix :</label><input type="text" name="prix" id="prix" value="<?php echo $prix?>"/><br/>
			<label for="photo">Photo :</label><input type="text" name="photo" id="photo" value="<?php echo $photo?>"/><br/>
	<?php 
			}
			else{
				echo "<div class=\"erreure\">Produit  non trouvé</div>";
				$error=TRUE;
			}
			break;
		case 4 :
			echo  "Modifier le type qui a comme id:".  $_POST['id']."</br></br>";
			$statement="Select nom, type From catalogue where id=".$_POST['id'];
			$select=$bdd->query($statement);
			if ($res=$select->fetch()){
			$nom=$res['nom'];
			$type=$res['type'];
			}
			if (isset($nom)){?>
			<label for="nom">Nom :</label><input type="text" name="nom" id="nom" value="<?php echo $nom?>"/>
			<label for="type">Type :</label><input type="text" name="type" id="type" value="<?php echo $type?>"/>
	<?php 	
			}
			else{
				echo "<div class=\"erreure\">Type  non trouvé</div>";
				$error=TRUE;
			}
			break;
		case 3:
			echo  "Modifier le catalogue qui a comme id:".  $_POST['id']."</br></br>";
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
				echo '<div class="erreur">Id  non trouvé</div>';
				$error=TRUE;
			}
			break;
		case 5:	
			echo  "Modifier le promo qui a comme id:".  $_POST['id']."</br></br>";
			$statement="Select catalogue,reduction,deadline,startline From promo where id=".$_POST['id'];
			$select=$bdd->query($statement);
			if ($res=$select->fetch()){
				$catalogue=$res['catalogue'];
				$reduction=$res['reduction'];
				$deadline=$res['deadline'];
				$startline=$res['startline'];
			}
						if (isset($catalogue)){?>
						<label for="catalogue">ID du catalogue :</label><input type="text" name="catalogue" id="catalogue" value="<?php echo $catalogue?>"/><br>
						<label for="catalogue">Reduction :</label><input type="text" name="reduction" id="reduction" value="<?php echo $reduction?>"/><br>
						<label for="catalogue">deadline :</label><input type="text" name="deadline" id="deadline" value="<?php echo $deadline?>"/><br>
						<label for="catalogue">startline :</label><input type="text" name="startline" id="startline" value="<?php echo $startline?>"/><br>
				<?php 				
						}
						else{
							echo '<div class="erreur">Id  non trouvé</div>';
							$error=TRUE;
						}
						break;
			
}
if (!isset($error)){
	?>	
	<input type="submit" value="MODIFIER"/>
	</form>
<?php }?>
	</div><?php
}
else{
	include 'modules/update.php';
	if (isset($erreur))
		echo '<div class="erreur">'.$erreur.'</div>';
	else 	
		echo '<div class="message">La modification a bien été faite</div>';
}
	











/*?>
<form id="clientform" method="post" action="?f=1">
		<label for="nom">Nom :</label><input type="text" name="nom" id="nom"/><br/>
		<label for="prenom">Prenom :</label><input type="text" name="prenom" id="prenom"/><br/>
		<label for="mail">Mail :</label><input type="text" name="mail" id="mail"/><br/><br/>
		<label for="ville">ADRESSE :</label><br/>
		<label for="ville">Ville :</label><input type="text" name="ville" id="ville"/><br/>
		<label for="rue">Rue :</label><textarea name="rue" id="rue"></textarea><br/>
		<label for="codepostal">Code Postal :</label><input type="text" name="codepostal" id="codepostal"/><br/>
		<label for="pays">Pays :</label><input type="text" name="pays" id="pays"/><br/>
		<label for="telephone">Telephone :</label><input type="text" name="telephone" id="telephone"/><br/>
		<label for="passwordf">Password :</label><input type="password" name="passwordf" id="passwordf"/><br/>
		<label for="checkpassword">Type The Password Again:</label><input type="password" name="checkpassword" id="checkpassword"/>
		<input type="submit" value="ENREGISTRER"/>
	</form>
</div>
<div id="produit">
	
	<form id="produitform" method="post" action="?f=2" enctype="multipart/form-data">
		<label for="designation">Designation :</label><input type="text" name="designation" id="designation"/><br/>
		<label for="descriptif">Descriptif :</label><textarea  name="descriptif" id="descriptif"></textarea><br/>
		<label for="prix">Prix :</label><input type="text" name="prix" id="prix"/><br/>
		<label for="catalogue">ID du catalogue :</label><input type="text" name="catalogue" id="catalogue"/><br/>
		<label for="photo">Photo :</label><input type="file" name="photo" id="photo"/><br/>
		<label for="taille">Taille:</label><input type="text" name="taille" id="taille"/><br/>
		<label for="Quantite">Quantité:</label><input type="text" name="quantite" id="quantite"/><br/>
		<input type="submit" value="ENREGISTRER"/>
	</form>
</div>
<div id="catalogue">
	
	<form id="catalogueform" method="post" action="?f=3">
		<label for="nom">Nom :</label><input type="text" name="nom" id="nom"/>
		<label for="type">Type :</label><input type="text" name="type" id="type"/>
		<input type="submit" value="ENREGISTRER"/>
	</form>
</div>
</div>
<?php 
else if (isset($erreur)){?>
	<h1>Erreur</h1>
	<?php
	echo "<div class=\"erreur\">$erreur</div>"; 	
}
else{
	echo "<h1>Message</h1>";
	echo "<div class=\"message\">".$message."</div>";
}
*/
//print_r($_POST);
include_once "../bottom.php";
if (!(isset($_GET['f']))){
	?>
	<script type="text/javascript" src="ajouter.js"></script> 
<?php }?>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
	$( "#deadline" ).datepicker({
		 dateFormat: "yy-mm-dd heure::sec"
	});
	$( "#startline" ).datepicker({
		dateFormat: "yy-mm-dd heure::sec"
	});
	
});
</script>
</body>