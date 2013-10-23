<?php
include'config.php';

								/*
									Formulaire Traitement
								*/
try{
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


									/*
										** Vérifier que l'URL saisie retourne un flux RSS
									*/


function validerRSS($url){

			$validateur = 'http://feedvalidator.org/check.cgi?url='; //adress du validateur de flux
			
				$reponse = file_get_contents($validateur . urlencode($url));
					
					if( strstr( $reponse , 'This is a valid RSS feed.' )){
						return true;
									
					}else{	
					
						return false;						
					}
			
			}//fin fonction

if( isset($_POST) && !empty($_POST)){
	
	$url = $_POST['url'];
	$nom = $_POST['nom'];
	$categorie = $_POST['categorie'];
	
	$sql="SELECT nom, url FROM site WHERE nom =".$_POST['nom']." AND url = ".$_POST['url']." ";
	$result=$connexion->query($sql);

	if($result == true){		
		header("Location:../index.php#form");
	}else{
		
		if(validerRSS($url) == true){
			
			$sql="INSERT INTO site VALUES ('', '$nom', '$categorie', '$url')";
		
			$result = $connexion->prepare($sql);
			$result->execute();				
			header("Location:../index.php");
		
		}//fin vérifier url
						
	}
			
}else{header("location:../index.php");}//Fin Si $_POST

}catch(PDOException $e) //message d'erreur
								{
        							echo $e->getMessage();
								}


?>