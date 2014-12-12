<?php
$id=100;
$b=TRUE;
if (!isset($_GET['v'])){
	$b=FALSE;
}
if ($b)
	include_once  "stat.php";
?>
<!DOCTYPE html>
<html class=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>RRL Admin-Stats</title>
<link href="../menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="../head.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
<link href="../css/bottom.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include "head.php";
?>
<h1>Statistiques</h1>
<form class="select" method="post" action="../admin/index.php?v=1">
<input type="radio" name="selection" value="1" checked/>
	<select name="CAF">
		<option value="client">Chiffre d'affaire par client</option>
		<option value="catalogue">Chiffre d'affaire par catalogue</option>
		<option value="type">Chiffre d'affaire par sous-Catalogue</option>
		<option value="produit">Chiffre d'affaire par produit</option>
	</select>
	<br/>
<input type="radio" name="selection" value="2"/>
	<select name="LP">
		<option value="plusvendus">Produits les plus vendus</option>
		<option value="moinsvendus">Produits les moins vendus</option>
	</select>
	<br/>
<input type="radio" name="selection" value="3"/>
	<label>Nombre de commande passé entre </label> <input id="begin" name="begin"/><br/> 
	<label>Et le </label> <input id="end" name="end"/>	
	<br>
	<input type="submit" value="ANALYSER"/>
</form>
<?php
	if ($b){?>
	<div style="width:100%;border-top:1px solid black;margin-bottom:2%;"></div>
	<h3>Resultat: <?php echo $resultatName?></h3>	
	<table class="resultat">
	<tr>
		<th><?php echo $col1?></th>
		<th><?php echo $col2?></th>
		<th><?php echo $col3?></th>
	</tr>
	<?php 
		for ($i=1;$i<=sizeof($res);$i++){
	?>	<tr>
	
		<td><?php echo $res[$i][1]?></td>
		<td><?php echo $res[$i][2]?></td>
		<td><?php echo $res[$i][3]?></td>
		</tr>
		<?php }
	?>
	</table>
<?php		
	} 
?>
<?php include_once "../bottom.php"?>
<script type="text/javascript" src="../js/height-min.js"></script>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
	$( "#begin" ).datepicker({
		 dateFormat: "yy-mm-dd"
	});
	$( "#end" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	
});
</script>
</body>