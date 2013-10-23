<?php
include_once'includes/config.php';

$nomSite = $_GET['nomSite'];
$shortLink = $_GET['shortLink'];

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
	
	$yql = "http://query.yahooapis.com/v1/public/yql?q=";
	$yql .= urlencode("SELECT * FROM feed WHERE url ='$url' AND guid ='$shortLink'"); //traitement sur min lien
	$yql .= "&format=json";  //conversion format json
	
	//creation du flux à partir du fichier retourné
	
	if($yql != null){
		$flux = json_decode(file_get_contents($yql));
	}else{
			$yql = "http://query.yahooapis.com/v1/public/yql?q=";
			$yql .= urlencode("SELECT * FROM feed WHERE url ='$url' AND origLink ='$shortLink'"); //traitement sur lien total
			$yql .= "&format=json";
			
			$flux = json_decode(file_get_contents($yql));
		}
}
}catch(PDOException $e){echo $e->getMessage();} //message d'erreur

include 'vues/article.tmp.php';
?>

