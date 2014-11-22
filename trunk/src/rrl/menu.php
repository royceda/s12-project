<div id="menuH">
<?php if ($id==0){?>
<a class="menuitemH_a" href="index.php">Accueil</a>
<a class="menuitemH" href="categorie/categorie.php?C=1">Catalogue 1</a>
<a class="menuitemH" href="categorie/categorie.php?C=2">Catalogue 2</a>
<a class="menuitemH" href="categorie/categorie.php?C=3">Catalogue 3</a>
<a class="menuitemH" href="categorie/categorie.php?C=4">Autres Catalogues</a>
<?php 
}
else {?>
	<a class="menuitemH_a" href="../index.php">Accueil</a>
	<a class="menuitemH" href="../categorie/categorie.php?C=1">Catalogue 1</a>
	<a class="menuitemH" href="../categorie/categorie.php?C=2">Catalogue 2</a>
	<a class="menuitemH" href="../categorie/categorie.php?C=3">Catalogue 3</a>
	<a class="menuitemH" href="../categorie/categorie.php?C=4">Autres Catalogues</a>
	<?php 
}
?>
<div style="height:100%;width:1px;"></div>
</div>