<!DOCTYPE html> 
<html> 
<head> 
	
	<title>Selecteur de Restauration</title>
    
	<meta  name="viewport" content="width=device-width, initial-scale=1" charset="utf-8"> 
	
	<link rel="apple-touch-icon" href="images/launch_icon_57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/launch_icon_72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/launch_icon_114.png" />
    
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />
	<link rel="stylesheet" href="css/custom.css" />
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script></head> 
<body> 
<div id="choisir_restau" data-role="page" data-add-back-btn="true"  data-dom-cache="true">
	
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
	
	<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Filtrer les restaurants..." >
    
    <?php
require_once'includes/config.php';

	$sql = "SELECT * FROM restaurants R, plats P, cuisine C WHERE R.id_r = C.c_restau AND P.id_p = C.c_plat AND id_p=:plat";
	$sql2 = "SELECT * FROM restaurants";
	

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->prepare($sql); //traitement de la requête
								if(isset($_GET['plat'])){
									$result->bindParam("plat", $_GET['plat']);
								} 
								else{
									$result = $connexion->prepare($sql2);
									}
								$result->execute();

							if($result > null){
								while($ligne = $result->fetch(PDO::FETCH_OBJ)){

									echo "<li>" .
												"<a href='infos.php?restau=$ligne->id_r' data-transition='slideup' data-pretch='true'>" .
												"<img src='img/restau/$ligne->image_r' alt='$ligne->image_r'/>" .
												"<h2>".utf8_encode($ligne->nom_r)."</h2>" .
												"<p class='classement $ligne->note'> $ligne->note etoile </p>" .
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