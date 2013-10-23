<?php //Caching des données
Header("Cache-Control: must-revalidate");
$offset = 3660; //1 minute de caching
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Organigramme - Acceuil</title>
<link rel="stylesheet" href="css/style.css"/>
	<link rel="apple-touch-icon" sizes="57x57" href="img/logo72.png" />
	<link rel="apple-touch-icon" href="img/logo72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/logo72.png" />

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>



	<div data-role="page" id="acceuil" data-theme="a" data-add-back-btn="true" data-dom-cache="true">
    
		<header data-role="header">
    
    		<h2>Organigramme</h2>
            
            <div data-role="navbar" data-theme="a">
        
				<ul>
					<li><a href="index.php" data-pretch="true" data-icon="home">Employé</a></li>
					<li><a href="liste_superieur.php" data-pretch="true" data-icon="star">Supérieurs</a></li>
					<li><a href="ajout_employe.php" data-pretch="true" data-icon="gear">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    
    	</header> <!-- FIN header -->

		<div data-role="content">

        	<ul data-role="listview" data-filter="true" data-inset="true" class="action-list">

                    <?php
					include 'includes/config.php';
					
								//Affichage de la liste des employes et du nombre d'employé direct de chq chef de service et du PDG<br>
								//FAIRE ATTENTION AU ESPACE APRES ET AVANT  " DANS LA REQUETE PAR LIGNE POUR CHQ CLAUSE
							$sql = "SELECT e.employe_id, e.employe_nom, e.employe_prenom, f.nom_fonction, e.employe_image, COUNT(r.employe_id) nbEmployeDirect " .
								   "FROM fonction f, employe e LEFT JOIN employe r ON r.employe_chef = e.employe_id " .
								   "WHERE e.employe_poste = f.id_fonction " .
								   "GROUP BY e.employe_id " .
								   "ORDER BY e.employe_id";
	   
							try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){ //recupération du résultat sous forme d'objet
									echo"<li>". 
											"<a href='detail_employe.php?id=$ligne->employe_id' data-pretch='true' data-transition='pop'><img src='pics/$ligne->employe_image' alt='$ligne->employe_image' />" .
							   				"<h4>$ligne->employe_prenom $ligne->employe_nom</h4>" .
							   				"<p>$ligne->nom_fonction</p>" .
							   				"<span class='ui-li-count'> $ligne->nbEmployeDirect </span>" .
							   				"</a>" .
						  				"</li>";
										
									}
									$result->closeCursor();//fermeture de la boucle
								}else{
										echo" le résultat de la requête est égal à 0 ou null";
									}

								$connexion = null;
							}catch(PDOException $e) //message d'erreur
								{
        							echo $e->getMessage();
								}
					?>        
            </ul>
    
    	</div><!-- Fin content -->

	
    </div> <!-- Fin Page -->

</body>

</html>