<a href="http://localhost/rrl/accueil.html" id="contener_logo"><img src="index_files/logo.png" class="logo"></a>
<?php if ($b==FALSE){
	?>
<form action="<?php echo $adresse_actuelle?>?co=1" id="connexion">
<div><label for="login">Login</label><input id="login" name="login" type="text"></div>
<div><label for="password">Pass</label><input id="password" name="password" type="password"></div>
<div class="connexion">
	<a href="inscription.php">register</a> 
	<input type="submit" value="Log in" class="login"/>
</div>
</form>
<?php 
	}
	else {
		if (!isset($_SESSION['nom'])){
			$statement='Select nom,prenom From membre Where mail="'.$_SESSION['login'].'"';
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				$_SESSION['nom']=$res['nom'];
				$_SESSION['prenom']=$res['prenom'];
			}
		}
		?>
		<div id="connexion">
		<div class="nom"><?php echo "Bonjour ".$_SESSION['nom']." ".$_SESSION['prenom']." "?></div>
		<div class="espace_client">Votre espace client</div>
		</div>
		<?php 
	}
	?>