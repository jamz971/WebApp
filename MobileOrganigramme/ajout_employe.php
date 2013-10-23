<?php //Caching des données
Header("Cache-Control: must-revalidate");
$offset = 60; //1 minute de caching
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, target-densitydpi=device-dpi, user-scalable=no, initial-scale=1.0"/>
<title>Organigramme - Ajouter </title>
<link rel="stylesheet" href="css/style.css" />
<link rel="apple-touch-icon" sizes="57x57" href="img/logo72.png" />
<link rel="apple-touch-icon" href="img/logo72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="img/logo72.png" />
<?php 

				///////////////////////////////////////////
				///VERIFIER SI IL Y A CONNEXION INTERNET///
				///POUR UTILISER LES FICHIER EN LOCAL OU///
				///				SUR LE SERVEUR          ///
				///////////////////////////////////////////

if (!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){
	
echo '<link rel="stylesheet" href="js/jquery.mobile-1.1.0-rc.2.min.css" />'.
		'<script src="js/jquery-1.7.2.min.js"></script>'.
    	 '<script src="js/jquery.mobile-1.1.0-rc.2.min.js"></script>';
}
else{ 
	echo '<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.css" />'.
		 '<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>'.
    	 '<script src="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.js"></script>';
}
?>

</head>
<body>

	<div data-role="page" id="ajout_employe" data-add-back-btn="true" data-dom-cache="true">
    
		<header data-role="header">
    
    		<h2>Ajouter un Employé</h2>
            
            <div data-role="navbar" data-theme="a" >
        
				<ul>
					<li><a href="index.php" data-pretch="true" data-transition="pop" data-icon="home">Employé</a></li>
					<li><a href="liste_superieur.php" data-pretch="true" data-transition="pop" data-icon="star">Supérieurs</a></li>
					<li><a href="ajout_employe.php" data-pretch="true" data-transition="pop" data-icon="gear">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    
    	</header> <!-- FIN header -->

		<div data-role="content">

      
            <?php
			
						include 'includes/config.php';

						
						$query ="SELECT DISTINCT employe_departement FROM employe";
						$service=null;
						
						$query2="SELECT id_fonction, nom_fonction FROM fonction";
						
						$fonction=null;
						
			
						$sql="SELECT employe_nom, employe_prenom, employe_id, employe_departement FROM employe where employe_id IN (SELECT DISTINCT employe_chef FROM employe)";
						$superieur=null;
						
						  try {
							
							$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
								////////////////////////////////
								////Afficher les Services des 
								///         employés     //////////
								/// ////////////////////////////////
								


							$result=$connexion->prepare($query);
								$result->execute();
								if ($result > null){
									$ligne=$result->rowCount();
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){
										
										$service.= "<option value='$ligne->employe_departement'>$ligne->employe_departement</option>";
									}
									
						  		}else {
										echo 'aucun resultat';
									}
									
									
								////////////////////////////////////
								////Afficher le nom des supérieur///
								////////////////////////////////////
									
									
									$result=$connexion->prepare($query2);
								$result->execute();
								if ($result > null){
									$ligne=$result->rowCount();
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){
															
										$fonction.= "<option value='$ligne->id_fonction'>$ligne->nom_fonction</option>";

									}
									
						  		}else {
										echo 'aucun resultat';
									}
									
									
								////////////////////////////////////
								////Afficher le nom des supérieur///
								////////////////////////////////////
								
								$result=$connexion->prepare($sql);
								$result->execute();
								if ($result > null){
									$ligne=$result->rowCount();
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){
										
										$superieur.= "<option value='$ligne->employe_id'>$ligne->employe_nom $ligne->employe_prenom - $ligne->employe_departement</option>";
									}
									
						  		}else {
										echo 'aucun superieur';
									}
								
								/////////////////
								///FORMULAIRE///
								////////////////

							$connexion = null;
							} catch(PDOException $e){
								echo $e->getMessage();
							}
	
			?>
        
        	<ul data-role="listview" data-theme="a" data-inset="true" class="action-list">
            
				<form action="succes_ajout.php" id="ajout_employe" data-ajax="false" method="post" enctype="multipart/form-data">
                
                	<li data-role="fieldcontain">
                    
        				<label for="nom"><em>* </em> Nom : </label>
          				<input type="text" id="nom" name="nom" placeholder="nom" data-min="true" class="required" />
                        
      				</li>
            
      				<li data-role="fieldcontain">
      
            			<label for="prenom"><em>* </em>Prénom : </label>
          				<input type="text" id="prenom" name="prenom" placeholder="prenom" data-min="true" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
                    
        				<label for="superieur"><em>* </em> Supérieur : </label>
          				<select id="superieur" name="superieur" class="required" data-native-menu="false" data-min="true" tabindex="-1" >
                        	<?php echo $superieur; ?>
                        </select>
                        
      				</li>
            
      				<li data-role="fieldcontain">
      
            			<label for="fonction"><em>* </em>Fonction : </label>
          				<select data-native-menu="false" data-min="true" id="fonction" name="fonction" class="required">
                        	<?php echo $fonction; ?>
                        </select>
            
      				</li>
                    
                    <li data-role="fieldcontain">
                    
        				<label for="service"><em>* </em> Service : </label>
          				<select id="service" name="service" class="required" data-native-menu="false" data-min="true" tabindex="-1">
                        	<?php echo $service; ?>
                        </select>
                        
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="tel"><em>* </em>Tèl Bureau : </label>
          				<input type="text" id="tel" data-min="true" name="tel" placeholder="0590878787" maxlength="10" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="port"><em>* </em>Portable : </label>
          				<input type="text" id="port" data-min="true" name="port" placeholder="0690818181" maxlength="10" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="mail"><em>* </em>Mail : </label>
          				<input type="text" id="mail" data-min="true" name="mail" placeholder="mail" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="ville"><em>* </em>Ville : </label>
          				<input type="text" id="ville" data-min="true" name="ville" placeholder="ville" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="image"><em>* </em>image : </label>
          				<input type="file" id="image" name="image" accept="image/jpeg" class="required" />
            
      				</li>
            
      				<li class="ui-body ui-body-b">
      
        				<button class="btnLogin" type="submit" data-theme="a">Enregistrer</button>

      				</li>
    			</form>
                
            </ul>
            

    	</div><!-- Fin content -->
	
    </div> <!-- Fin Page -->

</body>

</html>