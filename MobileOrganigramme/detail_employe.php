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
<title>Organigramme- Detail Employé</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="apple-touch-icon" sizes="57x57" href="img/logo72.png" />
<link rel="apple-touch-icon" href="img/logo72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="img/logo72.png" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
?>

</head>
<body>

	<div data-role="page" id="detail_employe" data-add-back-btn="false" data-dom-cache="true">
    
		<header data-role="header">
    
    		<h2>Details Employé</h2>
            
            <div data-role="navbar" data-theme="a">
        
				<ul>
					<li><a href="index.php" data-pretch="true" data-icon="home">Employé</a></li>
					<li><a href="liste_superieur.php" data-pretch="true" data-icon="star">Supérieurs</a></li>
					<li><a href="ajout_employe.php" data-pretch="true" data-icon="gear">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    
    	</header> <!-- FIN header -->
        
        
    
		<div data-role="content">
        
        	
            
            <?php
						include 'includes/config.php';
								//////////////////////////
								/// INFOS DES SALARIES ///
								//////////////////////////
								
						$sql = "SELECT e.employe_id, e.employe_prenom, e.employe_nom, e.employe_chef, f.nom_fonction, e.employe_departement, e.employe_ville, e.employe_tel_bureau, e.employe_port, " .
								"e.employe_mail, e.employe_image, m.employe_prenom superieurPrenom , m.employe_nom superieurNom, count(r.employe_id) employeDirect " . 
								"FROM fonction f, employe e LEFT JOIN employe r on r.employe_chef = e.employe_id LEFT JOIN employe m on e.employe_chef = m.employe_id " .
								"WHERE e.employe_id=:id " .
								"AND e.employe_poste = f.id_fonction " .
								"GROUP BY e.employe_nom ORDER BY e.employe_nom, e.employe_prenom";	
								
						  try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->prepare($sql); //traitement de la requête
								$result->bindParam("id", $_GET['id']);
								$result->execute();
								$employe = $result->fetchObject();
								$connexion = null;
	
			?>
            
            <img src="pics/<?php echo $employe->employe_image?>" class="employe-pic"/>
            <div data-role="detailemploye">
       								<h3> <?php echo "$employe->employe_prenom $employe->employe_nom" ?></h3>
       								<p><?php echo $employe->nom_fonction  ?></p>
                                    <p><u><?php echo $employe->employe_departement ?></u></p>
       								<p><?php echo $employe->employe_ville ?></p>
            </div> <!--Fin detailemploye -->
        
        	<ul data-role="listview" data-theme="a" data-inset="true" class="action-list">
            
            	<?php
	    		if ($employe->employe_chef > 0)
	    		{	
					echo "<li><a href='detail_employe.php?id=$employe->employe_chef' data-pretch='true' data-transition='pop'><h3>Supérieur</h3><p>$employe->superieurPrenom $employe->superieurNom</p></a></li>";
				}
	    		if ($employe->employeDirect > 0)
	    		{	
					echo "<li><a href='employe_direct.php?subordoneID=$employe->employe_id' data-pretch='true' data-transition='pop'><h3>Subordonné(s) Direct</h3><p>$employe->employeDirect</p></a></li>";
				}
		    	if (!is_null($employe->employe_tel_bureau))
		    	{
					echo "<li><img alt='phone' src='img/phone.png' class='action-icon'/><a href='tel:$employe->employe_port'><h3>Bureau</h3><p>$employe->employe_tel_bureau</p></a></li>";
				}
		    	if (!is_null($employe->employe_port))
		    	{
					echo "<li><img alt='phone' src='img/phone.png' class='action-icon'/><a href='tel:$employe->employe_port'><h3>Appel</h3><p>$employe->employe_port</p></a></li>";

					echo "<li><img alt='sms' src='img/sms.png' class='action-icon'/><a href='sms:$employe->employe_port'><h3>SMS</h3><p>$employe->employe_port</p></a></li>";
				}
		    	if (!is_null($employe->employe_mail))
		    	{
					echo "<li><img alt='mail' src='img/mail.png' class='action-icon'/><a href='mailto:$employe->employe_mail'><h3>Email</h3><p>$employe->employe_mail</p></a></li>";
				}
		    	?>
            
            </ul>
            
            <?php 
				} catch(PDOException $e){
				echo $e->getMessage();
				}
			?>

    	</div><!-- Fin content -->
	
    </div> <!-- Fin Page -->

</body>

</html>