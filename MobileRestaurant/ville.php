<?php
require_once 'includes/config.php';

?>

<!DOCTYPE html> 
<html> 
<head>
    <meta charset="utf-8">
	
	<title>Ville</title> 
	
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
<div data-role="page" id="ville" data-theme="e" data-add-back-btn="true" data-dom-cache="true">

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

	
	<ul data-role="listview" data-theme="c" data-inset="true" data-filter="true" data-filter-placeholder="Filtrer les villes...">
    
    <?php
	$sql = "SELECT * FROM ville  ORDER BY nom_v ASC";
	//$sql2 ="SELECT COUNT(s_restau)AS NbrR, id_v, nom_v FROM situer S, ville V, restaurants R WHERE R.id_r = S.s_restau AND V.id_v = S.s_ville AND id_v = id_v";

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result> null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ)){ //recupération du résultat sous forme d'objet
									
									echo "<li>" .
												"<a href='plat.php?ville=$ligne->id_v' data-transition='slide' data-pretch='true'>" .												
												"$ligne->nom_v" .
												"<p style='margin-top:3px'>$ligne->cp_v</p>" .
												"</a>" .
												"</li>";	
 
									}
									$result->closeCursor();//fermeture de la boucle
								}else{
										echo" le résultat de la requête est égal à 0 ou null";
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
