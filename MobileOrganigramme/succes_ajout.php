<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Organigramme - Ajouter </title>
<link rel="stylesheet" href="css/style.css" />
<link rel="apple-touch-icon" sizes="57x57" href="img/logo72.png" />
<link rel="apple-touch-icon" href="img/logo72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="img/logo72.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
<?php


												///////////////////////////
												///TRAITEMENT formulaire///
												///////////////////////////
												
include 'includes/config.php';

$resultat ='';
	
if(isset($_POST) && !empty($_POST)){
					
	extract($_POST, EXTR_OVERWRITE);
	
					
	$connect = (mysql_connect($dbhost, $dbuser, $dbpass) && mysql_select_db($dbname)) or die (mysql_error('connexion'));
					
	//Fonction php pour déplacé un fichier téléversé

					
	mysql_query("INSERT INTO employe VALUES('', '$nom', '$prenom', '$superieur', '$fonction', '$service', '$tel', '$port', '$mail', '$ville', '$image')") or die (mysql_error(''));
						
	$resultat = "L'employe a été enregistré ! <br /> Si vous n'êtes pas redirigé<a href='index.php'> cliquez ici</a>";
	
	echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=index.php">' ;	
							
}else{
	
		$resultat ="Veuillez completer le formulaire correctement <br />".
					"<a href='ajout_employe.php'>Retour vers Formulaire</a>";				
							 
	}
	
$image= $prenom.'_'.$nom.".jpg";

	move_uploaded_file($_FILES['image']['tmp_name'],"pics/$image"); 	
	
		mysql_query("UPDATE employe SET employe_image = '".$image."' WHERE employe_nom LIKE'".$nom."' AND employe_mail LIKE'".$mail."' ");		
			
 ?>
 
<?php
 
?>

</head>
<body>

	<div data-role="page" data-add-back-btn="false">
    
		<header data-role="header">
    
    		<h2>Ajout</h2>
            
            <div data-role="navbar" data-theme="a" >
        
				<ul>
					<li><a href="index.php" data-pretch="true" data-transition="pop" data-icon="home">Employé</a></li>
					<li><a href="liste_superieur.php" data-transition="pop" data-pretch="true" data-icon="star">Supérieurs</a></li>
					<li><a href="ajout_employe.php" data-transition="pop" data-pretch="true" data-icon="gear">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    
    	</header> <!-- FIN header -->
    
		<div data-role="content">
        
        	<?php

			echo $resultat;
				
			?>
        
        	
         
    	</div><!-- Fin content -->
	
    </div> <!-- Fin Page -->

</body>

</html>