<?php
$b=TRUE;
if (!isset($_SESSION["login"])){
	$b=FALSE;
}
if (isset($_GET['co'])){
	if (isset($_POST["password"]) && isset($_POST["login"])){
		$statement='Select password From identifiant Where login="'.$_POST['login'].'"';
		$select=$bdd->query($statement);
		while($res=$select->fetch()){
			
			if (password_verify($_POST['password'],$res['password'])){
				$_SESSION['login']=$_POST['login'];
				$statement="Select id From membre Where mail='".$_SESSION['login']."'";
				$_SESSION['id']=$bdd->query($statement)->fetch()['id'];
				foreach ($_SESSION['pannier'] as $id=>$quantiteT){
					foreach ($quantiteT as $i=>$quantite){
						$statement="Insert Into commande (nprod,quantite,nclient,date,confirme) Values($id,$quantite,".$_SESSION['id'].',NOW(),0)';
						echo $statement;
						$bdd->exec($statement);
					}
				}
				
				$b=TRUE;
			}
		}
	}
}
