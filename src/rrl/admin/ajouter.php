<?php
include '../modules/bdd.php';
$b=True;
if (!isset($_GET['f'])){
	$b=FALSE;
}
if ($b) include_once 'modules/insert.php';
$id=101;
?>
<!DOCTYPE html>
<html class="">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>RRL Admin-Ajouter</title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include "head.php";

if ($b==FALSE){
?>
<h1>Ajouter</h1>
<form class="select" style="text-align:center;">
Ajouter un 
	<select name="ajout" >
		<option value="none" selected>Cliquez sur l'un des options</option>
		<option value="produit">Produit</option>
		<option value="catalogue">Catalogue</option>
		<option value="promo">Promotion</option>
		<option value="client">Client</option>
	</select>
</form>
<div id="body">
<div id="client">
	
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
<div id="promo">
	
	<form id="promoform" method="post" action="?f=4">
		<label for="catalogue">Catalogue :</label><input type="text" name="catalogue" id="catalogue"/><br/>
		<label for="reduction">Reduction :</label><input type="text" name="reduction" id="reduction"/><br/>
		<label for="startline">startline :</label><input type="text" name="startline" id="startline"/><br/>
		<label for="deadline">endline :</label><input type="text" name="deadline" id="deadline"/><br/>
		<input type="submit" value="ENREGISTRER"/>
	</form>
</div>

</div>
<?php }
else if (isset($erreur)){?>
	<h1>Erreur</h1>
	<?php
	echo "<div class=\"erreur\">$erreur</div>"; 	
}
else{
	echo "<h1>Message</h1>";
	echo "<div class=\"message\">".$message."</div>";
}
include_once "../bottom.php";?>
<script type="text/javascript" src="ajouter.js"></script>
<script type="text/javascript" src="../js/height-min.js"></script>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
	$( "#startline" ).datepicker({
		 dateFormat: "yy-mm-dd"
	});
	$( "#endline" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
});
</script>	
</body>