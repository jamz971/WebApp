<?php //Caching des données
Header("Cache-Control: must-revalidate");
$offset = 3600; //1 minute de caching
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Organigramme - Subordonnés</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>

	<div data-role="page" id="employe_direct" data-add-back-btn="true" data-dom-cache="true">
    
		<header data-role="header">
    
    		<h2>Subordonnés Direct</h2>
            
            <div data-role="navbar" data-theme="a">
        
				<ul>
					<li><a href="index.php" data-pretch="true" data-icon="home">Employé</a></li>
					<li><a href="liste_superieur.php" data-pretch="true" data-icon="star">Supérieurs</a></li>
					<li><a href="ajout_employe.php" data-pretch="true" data-icon="gear">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    	</header> <!-- FIN header -->
    
		<div data-role="content">
        
        	<ul data-role="listview" data-filter="true" data-inset="true">
            
            	<?php
					include 'includes/config.php';
					
					$sql = "SELECT e.employe_id, e.employe_prenom, e.employe_nom, f.nom_fonction, e.employe_image, count(r.employe_id) reportCount " . 
							"FROM fonction f, employe e LEFT JOIN employe r ON r.employe_chef = e.employe_id " .
							"WHERE e.employe_chef = :subordoneID " .
							"AND e.employe_poste = f.id_fonction " .
							"GROUP BY e.employe_id ORDER BY e.employe_nom, e.employe_prenom ";
					
					try { 
						$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$result = $connexion->prepare($sql);
						$result->bindParam("subordoneID", $_GET['subordoneID']);
						$result->execute();
						while($employe = $result->fetch(PDO::FETCH_OBJ)){ 
								
								echo "<li><a href='detail_employe.php?id=$employe->employe_id' data-transition='pop' data-pretch='true'>" .
										"<img src='pics/$employe->employe_image'/>" .
										"<h4>$employe->employe_prenom $employe->employe_nom</h4>" .
										"<p>$employe->nom_fonction</p>" .
									"<span class='ui-li-count'>$employe->reportCount</span></a></li>";
							
							}
						$connexion = null;
					} catch(PDOException $e) //message d'erreur
						{
        					echo $e->getMessage();
						}
				?>
            
            </ul>
    
    	</div><!-- Fin content -->

	
</div> <!-- Fin Page -->

</body>

</html>