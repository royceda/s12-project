<!Doctype html> 
<html class="">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link href="css/menu.css" rel="stylesheet" type="text/css">
    	<link href="css/head.css" rel="stylesheet" type="text/css">
 		<link href="css/bottom.css" rel="stylesheet" type="text/css">
	    <title>
	      Incription
	    </title>
    </head>

    <body>
	  	<?php include 'head.php'; ?>
	  	<?php include 'menu.php'; ?>

	    <h1 style="text-align:center"> Formulaire d'insciption </h1>

	    <div align="center">
	    	<?php
	    		if (!empty($_POST['mail'])) {
					include_once 'modules/bdd.php';
	    			$pass1 = mysql_real_escape_string(htmlspecialchars($_POST['pass1']));
					$pass2 = mysql_real_escape_string(htmlspecialchars($_POST['pass2']));

					if($pass1 == $pass2) {
						echo $pass1;
						// Faire la requete pour la base de donnée!
					} else {
						echo 'Les deux mots de passe que vous avez rentré ne correspondent pas…';
					}
	    		} else {
	    			echo "Veuillez renseigner tous les champs";
	    		}
	    	?>
	    </div>
	    <form id="inscription" method="post">
		    <table align="center">
		        <tr>
					<td> Nom</td>
					<td><input type="text" size="x" maxlength="m" name="nom" value"texte"> </td>
		        </tr>

		        <tr>
					<td> Prenom </td>
					<td> <input type="text" size="x" maxlength="m" name="prenom" value"texte"> </td>
		        </tr>

		        <tr>
					<td> Mail </td> 
					<td> <input type="text" size="x" maxlength="m" name="mail" value"texte"> </td>
			    </tr>

			    <tr>
					<td> Telephone </td> 
					<td> <input type="text" size="x" maxlength="m" name="tel" value"texte"> </td>
			    </tr>

			    <tr>
					<td> Mot de Passe </td>
					<td> <input type="password" size="x" maxlength="m" name="pass1" value"texte"> </td>
			    </tr>

			    <tr>
					<td> Confirmer Mot de Passe </td>
					<td> <input type="password" size="x" maxlength="m" name="pass2" value"texte"> </td>
			    </tr>

			    <tr>
					<td> <p>Adresse:</p> </td> 
			    </tr>
			    
			    <tr>
					<td> Rue </td> 
					<td> <input type="text" size="x" maxlength="m" name="rue" value"texte"> </td>
				</tr>

			    <tr>
					<td> Ville </td> 
					<td> <input type="text" size="x" maxlength="m" name="ville" value"texte"> </td>
			    </tr>

			    <tr>
					<td> Code Postale </td> 
					<td> <input type="text" size="x" maxlength="m" name="cpost" value"texte"> </td>
			    </tr>

			    <tr>
					<td> Pays </td> 
					<td> 
						<select name="pays">
						    <option value="france">France</option>
						    <option value="allemagne">Allemagne</option>
						    <option value="italie">Italie</option>
						    <option value="Royaume-Uni">Royaume-Uni</option>
					    </select>
					</td>
			    </tr>

			    <tr>
					<td> <input type="button" value="Annuler" onclick="self.location.href='index.php'"> </td> 
					<td> <input type="submit" value="Confirmer"> </td>
			    </tr>
		    </table>
		</form>

	    <?php include 'bottom.php'; ?>
    </body>
</html>