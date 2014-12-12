<div id="menuH">
<?php $statement="SELECT id,nom FROM catalogue Group by nom";
$select=$bdd->query($statement);
while($res=$select->fetch()){
	$menu[$res['nom']]=$res['id'];
}
?>
<?php if ($id==0){?>
<a class="menuitemH_a" href="index.php">Accueil</a>
<a class="menuitemH" href="categorie/categorie.php?id=<?php echo $menu['VETEMENTS']?>">Vetements</a>
<a class="menuitemH" href="categorie/categorie.php?id=<?php echo $menu['CHAUSSURES']?>">Chaussures</a>
<a class="menuitemH" href="categorie/categorie.php?id=<?php echo $menu['ACCESSOIRES']?>">Accessoires</a>
<?php 
}
else {?>
	<a class="menuitemH_a" href="../index.php">Accueil</a>
	<a class="menuitemH" href="../categorie/categorie.php?id=<?php echo $menu['VETEMENTS']?>">Vetements</a>
	<a class="menuitemH" href="../categorie/categorie.php?id=<?php echo $menu['CHAUSSURES']?>">Chaussures</a>
	<a class="menuitemH" href="../categorie/categorie.php?id=<?php echo $menu['ACCESSOIRES']?>">Accessoires</a>
	<?php 
}
?>
<div style="height:100%;width:1px;"></div>
</div>