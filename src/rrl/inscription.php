<?php
session_start();
$id=0;
$adresse_actuelle="inscription.php";
include_once 'modules/bdd.php';
include 'modules/connexion.php';
?>
<!Doctype html> 
<html class="">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link href="menu.css" rel="stylesheet" type="text/css">
    	<link href="head.css" rel="stylesheet" type="text/css">
    	<link href="css/inscription.css" rel="stylesheet" type="text/css">
 		<link href="css/bottom.css" rel="stylesheet" type="text/css">
	    <title> Incription </title>
    </head>

    <body>
	  	<?php include 'head.php'; ?>
	  	<?php include 'menu.php'; ?>

	    <h1 style="text-align:center"> Formulaire d'insciption </h1>

	    <div align="center">
	    	<?php
	    	if (isset($_GET['i'])){
	    		if (!empty($_POST['mail'])) {
					$pass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
	    			
					if(password_verify($_POST['pass2'], $pass)) {
						if (!isset($_POST['nom'],$_POST['prenom'],$_POST['tel'],$_POST['mail'],$_POST['pass1'],$_POST['pass2'],$_POST['pays'],$_POST['rue'],$_POST['ville'],$_POST['cpost']))
							$erreur="Les cases ne sont pas toutes remplises";
						if (isset($erreur))
							break;
						$statement2 = 'SELECT id FROM adresse WHERE rue = \''.$_POST['rue'].'\' and ville = \''.$_POST['ville'].'\';';
						$id_adresse = $bdd->query($statement2)->fetch()['id'];
						
						if (empty($id_adresse)) {
							$statement1 = 'INSERT INTO adresse(rue, ville, code_postale, pays) 
								VALUES(\''.$_POST['rue'].'\''.', '.'\''.$_POST['ville'].'\''.', '.'\''.$_POST['cpost'].'\''.', '.'\''.$_POST['pays'].'\''.');';
							$insert1=$bdd->query($statement1);
							$id_adresse = $bdd->query($statement2)->fetch()['id'];							
						}
												
						$statement3 = 'INSERT INTO membre(nom, prenom, mail, telephone, adresse)
 							VALUES(\''.$_POST['nom'].'\''.', '.'\''.$_POST['prenom'].'\''.', '.'\''.$_POST['mail'].'\''.', '.'\''.$_POST['tel'].'\''.', '.'\''.$id_adresse.'\''.');';
						try{
							$insert2=$bdd->query($statement3);
						}
						catch(Exception $e){
							if ($bdd->errorCode()==23000)
								$erreur="L'email saisit est déjà utilisé par un autre utilisateur";
							else 
								$erreur="Un problème technique a été survenu. Veuillez ressayer";
						}
						if (!isset($erreur)){
						$statement4 = 'INSERT INTO identifiant(login, password)
 							VALUES(\''.$_POST['mail'].'\''.', '.'\''.$pass.'\');';
						$insert3=$bdd->query($statement4);
						
						$message="Votre inscription a bien été validé";
						}
		
					} else {
						$erreur='Les deux mots de passe que vous avez rentré ne correspondent pas…';
					}
	    		} else {
	    			$erreur="Veuillez renseigner tous les champs";
	    		}
	}
	    		if (!isset($erreur) && !isset($message)){
	    	?>
	    </div>

	    <form id="inscription" method="post" action="?i=1">
		    <table >
		        <tr>
					<td> Nom</td>
					<td><input type="text" size="x" maxlength="m" name="nom" > </td>
		        </tr>

		        <tr>
					<td> Prenom </td>
					<td> <input type="text" size="x" maxlength="m" name="prenom" > </td>
		        </tr>

		        <tr>
					<td> Mail </td> 
					<td> <input type="text" size="x" maxlength="m" name="mail" > </td>
			    </tr>

			    <tr>
					<td> Telephone </td> 
					<td> <input type="text" size="x" maxlength="m" name="tel" > </td>
			    </tr>

			    <tr>
					<td> Mot de Passe </td>
					<td> <input type="password" size="x" maxlength="m" name="pass1" > </td>
			    </tr>

			    <tr>
					<td> Confirmer Mot de Passe </td>
					<td> <input type="password" size="x" maxlength="m" name="pass2" > </td>
			    </tr>

			    <tr>
					<td> <p>Adresse:</p> </td> 
			    </tr>
			    
			    <tr>
					<td> Rue </td> 
					<td> <input type="text" size="x" maxlength="m" name="rue" > </td>
				</tr>

			    <tr>
					<td> Ville </td> 
					<td> <input type="text" size="x" maxlength="m" name="ville" > </td>
			    </tr>

			    <tr>
					<td> Code Postale </td> 
					<td> <input type="text" size="x" maxlength="m" name="cpost" > </td>
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

	    <?php 
	    		}
	    		else if (isset($erreur)){
	    			echo '<div class="erreur">'.$erreur.'</div>';
	    			echo '<div class="ressayer"><a href="inscription.php">Ressayer</a></div>';
	    		}else if (isset($message)){
	    			echo '<div class="message">'.$message.'</div>';
	    		}
	    include 'bottom.php'; ?>	   
    </body>
</html>