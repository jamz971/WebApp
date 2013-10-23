<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html> 
<html> 
<head> 

	<title>Plats</title> 
    
	<meta  name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="apple-touch-icon" href="images/launch_icon_57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/launch_icon_72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/launch_icon_114.png" />
    
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />
	<link rel="stylesheet" href="css/custom.css" />
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body> 
<div id="choisir_plat" data-role="page" data-add-back-btn="true" data-dom-cache="true">

    <div data-role="navbar">
        <ul>
        <li><a href="ville.php">Villes</a></li>
        <li><a href="plat.php">Plats</a></li>
        <li><a href="restau.php">Restaurant</a></li>     
        </ul>
    </div>    
    <a href="index.php" data-pretch="true">
        <div data-role="header">    
             <h1> Selecteur de Restauration</h1>
        </div>
    </a> 

	<div data-role="content">

	
	<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Filtrer les plats...">

	<?php
	/*
	$sql = "SELECT id_v, nom_v, cp_v, COUNT(s_restau)nbrRst FROM ville, trouver, plats,situer WHERE plats.id_p = trouver.t_plat AND ville.id_v = trouver.t_ville AND situer.s_ville= ville.id_v AND t_plat =:plat GROUP BY nom_v";
	
	//Compter nombre de restaurant ou on trouve le plat
	//SELECT COUNT(id_s) nbrtVille FROM situer, ville WHERE ville.id_v = situer.s_ville AND s_ville =id_v
	//$sql2 ="SELECT COUNT(c_restau) nbrstPlat FROM cuisine, restaurants WHERE restaurants.id_r = cuisine.c_restau AND c_plat =:plat";
*/

	$sql="SELECT * FROM plats, trouver, ville WHERE plats.id_p = trouver.t_plat AND ville.id_v = trouver.t_ville AND t_ville =:ville";
	$sql2="SELECT * FROM plats";

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->prepare($sql); //traitement de la requête
								if( isset($_GET['ville'])){ 
										$result->bindParam("ville", $_GET['ville']);
									}else{
								
									$result = $connexion->prepare($sql2);
										} //traitement de la requête		
								$result->execute();

								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){
												
										echo "<li>" .
												"<a href='restau.php?plat=$ligne->id_p' data-transition='slide' data-pretch='true'>" .
												"<img src='img/plat/$ligne->image_p'/>" .
												"<h3>$ligne->nom_p</h3>" .
												"</a>" .
											"</li>";		
									}
								}
												

								
							}catch(PDOException $e) //message d'erreur
								{
        							echo $e->getMessage();
								}
	
	?>  

	</ul>
	
	</div>
	<footer data-role="footer" data-position="fixed">
    	<!-- PUB -->
    </footer>

</div><!-- /page -->
</body>
</html>