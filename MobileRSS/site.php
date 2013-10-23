<?php
include_once'includes/config.php';

$nomSite = $_GET['nomSite'];

try {
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT url FROM site WHERE nom='$nomSite' ";


$result=$connexion->prepare($sql);
//$result->bindParam("nomSite", $_GET['nomSite']) ;
$result->execute();

if($result != null){
	$ligne = $result->fetch(PDO::FETCH_OBJ);
	$url = $ligne->url;

	//recupération et traitement des données pour les formatter format json
	
	$yql ="http://query.yahooapis.com/v1/public/yql?q=";
	$yql .=urlencode("SELECT * FROM feed WHERE url ='$url'"); //encodage de la requête format url
	$yql .="&format=json";  //conversion format json
	
	//creation du flux à partir du fichier retourné
	
	$flux = file_get_contents($yql);
	
	//decodage
	$flux = json_decode($flux);
	
	/*else{
		$yql ="http://query.yahooapis.com/v1/public/yql?q=";
		$yql .=urlencode("SELECT * FROM feed WHERE url ='http://feeds.feedburner.com/".$nomSite."'"); //encodage de la requête format url
		$yql .="&format=json";
	
		$flux = file_get_contents($yql, true);
		$flux = json_decode($flux);
		
		}*/

}
}catch(PDOException $e){echo $e->getMessage();}
include 'vues/site.tmp.php';		
?>
