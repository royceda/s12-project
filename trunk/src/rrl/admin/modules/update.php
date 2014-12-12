<?php
	switch($_GET['f']){
		case 1: 
			$statement="Select id From adresse".
					" Where ville='".$_POST['ville']."' And pays='".$_POST['pays']."' And rue='".$_POST['rue']."' And code_postale=".$_POST['codepostal'];
			echo $statement;
			$select=$bdd->query($statement);
			while($res=$select->fetch()){
				$idResultat=$res['id'];
			}
			if (!isset($idResultat)){
				$statement="INSERT INTO adresse ( ville, rue, code_postale, pays) values( '".$_POST['ville']."', '".$_POST['rue']."', ".$_POST['codepostal'].", '".$_POST['pays']."')";
				$insert=$bdd->prepare($statement);
				$insert->execute();
				$idResultat=$bdd->lastInsertId();
			}
			$statement="UPDATE membre m, identifiant i SET m.nom='".$_POST['nom']."', m.prenom='".$_POST['prenom']."', m.mail='".$_POST['mail']."', m.telephone='".$_POST['telephone']."', m.adresse=".$idResultat;
			if (isset($_POST['passwordf'],$_POST['checkpassword'])){				
				if ($_POST['passwordf']!=$_POST['checkpassword']){
					$erreur="Les deux mots de passe saisits sont différents";
					break;
				}
				$statement.=", i.password='".password_hash($_POST['passwordf'], PASSWORD_DEFAULT)."'";
			}
			$statement.=" WHERE m.id=".$_GET['id']." And i.login='".$_POST['mail']."'";	
			echo '<br/>'.$statement;
			$insert=$bdd->exec($statement);
			break;
		case 2:
			$statement="UPDATE produit SET designation='".$_POST['designation']."', descriptif='".$_POST['descriptif']."', prix='".$_POST['prix']."', photo='".$_POST['photo']."'";
			$statement.=" Where id=".$_GET['id'];
			$insert=$bdd->exec($statement);
			break;
		case 3:
			$statement="SELECT nom from catalogue where id=".$_GET['id'];
			$select=$bdd->query($statement);
			while($res=$select->fetch())
				$nomCatalogue=$res['nom'];
			echo $_POST['nom']." ".$nomCatalogue;
			$statement="UPDATE catalogue SET nom='".$_POST['nom']."',maj=NOW()";
			$statement.=" Where nom='".$nomCatalogue."'";
			$insert=$bdd->exec($statement);
			break;
		case 4:
			$statement="UPDATE catalogue SET nom='".$_POST['nom']."', type='".$_POST['type']."'";
			$statement.=" Where id=".$_GET['id'];
			$insert=$bdd->exec($statement);
			break;
		case 5:
			$statement="UPDATE promo SET catalogue='".$_POST['catalogue']."', reduction='".$_POST['reduction']."', deadline='".$_POST['deadline']."',startline='".$_POST['startline']."'";
			$statement.=" Where id=".$_GET['id'];
			$insert=$bdd->exec($statement);
			break;	
}
?>