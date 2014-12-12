<?php
include_once '../modules/bdd.php';
switch($_POST['selection']){
	case "1":
		$col1="Classement";
		$col3="Valeur";
		switch($_POST['CAF']){
			case "client":
				$resultatName="Chiffre d'affaire par client";
				$col2="Client";
				$statement="Select client,prix From statClient";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['client'];
					$res[$i][3]=$resultat['prix'];
					$i++;
				}
				break;
			case "catalogue":
				$resultatName="Chiffre d'affaire par catalogue";
				$col2="Catalogue";
				$statement="select catalogue,prix from statCatalogue";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['catalogue'];
					$res[$i][3]=$resultat['prix'];
					$i++;
				}
				break;
			case "produit":
				$resultatName="Chiffre d'affaire par produit";
				$col2="Produit";
				$statement="Select produit, prix From statProduit";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['produit'];
					$res[$i][3]=$resultat['prix'];
					$i++;
				}
				break;
			case "type":
				$resultatName="Chiffre d'affaire par Sous-catalogue";
				$col2="Sous-Catalogue";
				$statement="Select type, prix From statType";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['type'];
					$res[$i][3]=$resultat['prix'];
					$i++;
				}
				break;
				
		}
		break;
	
	case "2":
		$col1="Classement";
		$col2="Produit";
		$col3="Nombre";
		switch($_POST['LP']){
			case "plusvendus":
				$resultatName="Produits les plus vendus";
				$statement="Select produit, achats From statPlusVendu";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['produit'];
					$res[$i][3]=$resultat['achats'];
					$i++;
				}
				break;
			case "moinsvendus":
				$resultatName="Produits les moins vendus";
				$statement="Select produit, achats From statMoinsVendu";
				$select=$bdd->query($statement);
				$i=1;
				while($resultat=$select->fetch()){
					$res[$i][1]=$i;
					$res[$i][2]=$resultat['produit'];
					$res[$i][3]=$resultat['achats'];
					$i++;
				}				
				break;
		}
		break;
	case "3":
		$col1="Date";
		$col2="Client";
		$col3="Total";
		$resultatName="Commandes passés entre le ".$_POST['begin']." et le ".$_POST['end'] ;
		$statement="Select c.date, Count(*)*(SUM(c.quantite)) as total, m.nom as nom, m.prenom as prenom "
					."From commande c, membre m "
  					."Where c.nclient=m.id And c.date Between '".$_POST['begin']."' ANd '".$_POST['end']."' "
					." Group By c.nclient,c.date "
					."Order By date desc";
		$select=$bdd->query($statement);
		$i=1;
		$total=0;
		while($resultat=$select->fetch()){
				$res[$i][1]=$resultat['date'];
				$res[$i][2]=$resultat['nom']." ".$resultat["prenom"];
				$res[$i][3]=$resultat['total'];
				$total+=$resultat['total'];
				$i++;
		}		
		$res[$i][1]="";
		$res[$i][2]="TOTAL";
		$res[$i][3]=$total;
		break;
}