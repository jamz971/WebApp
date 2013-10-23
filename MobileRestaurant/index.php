<?php
require_once 'includes/config.php';

?>

<!DOCTYPE html> 
<html> 
<head>
    <meta charset="utf-8">
	
	<title>Home</title> 
	
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
<div data-role="page" id="home" data-theme="c" data-add-back-btn="true" data-dom-cache="true">

    <div id="branding">
       <h1>Selecteur de Restauration </h1>
    </div>    
    <div data-role="navbar">
        <ul data-role="list-divider">
        <li><a href="ville.php">Villes</a></li>
        <li><a href="plat.php">Plats</a></li>
        <li><a href="restau.php">Restaurant</a></li>     
        </ul>
    </div>
        
	<div data-role="content">
    

    	
        <!-- Inserer Code + bouton qui récupérera la position géographique lat long -->
		
    

    	<!-- PUB -->
   
	</div>
    
    <footer data-position="fixed">
    </footer>       

</div><!-- /page -->
</body>
</html>
