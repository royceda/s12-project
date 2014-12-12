<?php
switch($_GET['f']){
	case 1:
		$message="Le client a bien été ajouté";
		if (!isset($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['rue'],$_POST['ville'],$_POST['codepostal'],$_POST['pays'],$_POST['telephone'],$_POST['passwordf'],$_POST['checkpassword'])){
			$erreur="Vous n'avez pas remplit toutes les cases";
			break;
		}
		if ($_POST['passwordf']!=$_POST['checkpassword']){
			$erreur="Les deux mot de passe saisit ne sont pas les mêmes.";
			break;
		}
		if (!preg_match("#.*@.*\..*#", $_POST['mail'])){
			$erreur="L'adresse email saisit n'est pas valide";
			break;
		}
		$statement="Select id From adresse".
		" Where ville='".$_POST['ville']."' And pays='".$_POST['pays']."' And rue='".$_POST['rue']."' And code_postale=".$_POST['codepostal']; 
       echo $statement;
		$select=$bdd->query($statement);
       while($res=$select->fetch()){
       	$idResultat=$res['id'];
       }
       if (!isset($idResultat)){
       	$statement="INSERT INTO adresse ( ville, rue, code_postale, pays) 
       values( '".$_POST['ville']."', '".$_POST['rue']."', ".$_POST['codepostal'].", '".$_POST['pays']."')";
       	$insert=$bdd->prepare($statement);
       	$insert->execute();
       	$idResultat=$bdd->lastInsertId(); 
       }
       $statement=" INSERT INTO membre ( nom, prenom, telephone, mail, adresse)".
       " VALUES ( '".$_POST['nom']."', '".$_POST['nom']."',".$_POST['telephone'].", '".$_POST['mail']."','".$idResultat."')";
		$bdd->exec($statement);
		$statement="INSERT INTO identifiant (login, password)
       VALUES ('".$_POST['mail']."', '".password_hash($_POST['passwordf'],PASSWORD_DEFAULT)."');";
		$bdd->exec($statement);
		
       break;
	case 2:
		$message="Le produit a bien été ajouté";
		if (!isset($_POST['designation'],$_POST['descriptif'],$_POST['prix'],$_POST['catalogue'],$_POST['taille'],$_POST['quantite'])){
			$erreur="Vous n'avez pas remplit toutes les cases";
			break;
		}		
		$statement="Select nom From catalogue Where id=".$_POST['catalogue'];
		$select=$bdd->query($statement);
		while($res=$select->fetch()){
			$idResultat=$_POST['catalogue'];
			$catalogueName=$res['nom'];
		}
		if (!isset($idResultat)){
			$erreur="Le id du catalogue saisit n'existe pas.";
			break;
		}
		$statement="Select id  From produit ".
				"  Where designation=\"".$_POST['designation']."\" And descriptif=\"".$_POST['descriptif']."\" And prix=".$_POST['prix']." And catalogue=".$_POST['catalogue'];
		//echo $statement;
		$select=$bdd->query($statement);
		while($res=$select->fetch()){
			$r=$res['id'];
		}
		if (isset($r)){
			$statement="Select d.nprod as nprod From disponibilite d, produit p".
					"  WHERE d.nprod='".$r."' And d.taille='".$_POST['taille']."' And d.quantite=".$_POST['quantite'];
			echo $statement;
			$select=$bdd->query($statement);			
			while($res=$select->fetch()){
				$id2=True;
			}
			$select->closeCursor();
			if (isset($id2)){
				$statement="UPDATE disponibilite SET quantite=".$_POST['quantite']." Where nprod=".$r." And taille='".$_POST['taille']."'";
				echo $statement;
				$update=$bdd->exec($statement);
				$update->closeCursor();
			}
			else{
				$statement="INSERT INTO disponibilite(nprod,taille,quantite) VALUES(".$r.",".$_POST['taille'].",".$_POST['quantite'].")";
				$insert=$bdd->exec($statement);
				$insert->closeCursor();
			}	
		}
		else{
			if (!isset($_FILES['photo'])){
				$erreur="La photo n'a pas été spécifiée";
				break;		
			}
			if ($_FILES['photo']['error'] > 0){
				switch ($_FILES['photo']['error']){
					case UPLOAD_ERR_NO_FILE :
						$erreur=" Erreur de chargement du fichier: fichier manquant.";
						break;
					case UPLOAD_ERR_PARTIAL : 
						$erreur=" Erreur de chargement du fichier: fichier transféré partiellement.";
						break;
				}
				if(!isset($erreur)) $erreur="Erreur de chargement du fichier";
				break;
			}
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			$extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );	
			if ( !in_array($extension_upload,$extensions_valides) ) echo "Extension Fausse";
			$statement="Insert Into produit(designation,descriptif,prix,date_add,catalogue) VALUES('".$_POST['designation']."','".$_POST['descriptif']."','".$_POST['prix']."',NOW(),'".$_POST['catalogue']."');".
					'  UPDATE produit SET photo=CONCAT("../images/photos/'.$catalogueName.'/",LAST_INSERT_ID(),".jpg") Where id=LAST_INSERT_ID();';
			echo $statement;
			$insert=$bdd->prepare($statement);
			$insert->execute();
			$idInserted=$bdd->lastInsertId();
			$insert->closeCursor();
			$dest=$_SERVER['DOCUMENT_ROOT'].$_SERVER["REQUEST_URI"].'/../../images/photos/'.$catalogueName."/".$idInserted.".jpg";
			echo $_FILES['photo']['tmp_name'];
			$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$dest);
			$statement="INSERT INTO disponibilite(nprod,taille,quantite) VALUES(".$idInserted.",".$_POST['taille'].",".$_POST['quantite'].")";
			$bdd->exec($statement);			
			}
		break;
	case 3:
		$message="Le catalogue a bien été ajouté";
		$statement="Insert INTO catalogue(nom,type,maj) VALUES(\"".$_POST['nom'].'","'.$_POST['type'].'",NOW())';
		$insert=$bdd->exec($statement);
		break;
	case 4:
		$statement="Insert into promo(catalogue,reduction,startline,deadline) VALUES('".$_POST['catalogue']."','".$_POST['reduction']."','".$_POST['startline']."','".$_POST['deadline']."')";
		$insert=$bdd->exec($statement);
		$message="La promo a bien été ajouté";
}