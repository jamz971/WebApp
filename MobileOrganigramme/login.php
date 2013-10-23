<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Organigramme - Ajouter </title>
<link rel="stylesheet" href="css/style.css" />
<link rel="shortcut icon" href="img/favicon.ico" /> 
<link rel="icon" href="img/favicon.ico" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>

	<div data-role="page" id="ajout_employe" data-add-back-btn="false">
    
		<header data-role="header">
    
    		<h2>Ajouter un Employé</h2>
            
            <div data-role="navbar" data-theme="a" >
        
				<ul>
					<li><a href="index.php">Employé</a></li>
					<li><a href="liste_superieur.php">Supérieurs</a></li>
					<li><a href="ajout_employe.php">Ajouter</a></li>
				</ul>
        
			</div><!-- /navbar -->
    
    	</header> <!-- FIN header -->

		<div data-role="content">

      
            <?php
			
						include 'includes/config.php';
						
						
						/*
						
								if($_POST['nom']&&$_POST['prenom'] != null){
							
							$verif = "SELECT employe_nom, employe_prenom WHERE employe_nom = '".$_POST['nom']."' AND employe_prenom = '".$_POST['prenom']."' ";
							$resultverif = $connexion->query($verif);
							if($resultverif -> null){
									echo'Cet employé est déjà dans la base de donnée';
							
							}else{
									$sql = "INSERT INTO employe".
									"VALUES('','$nom','$prenom','$superieur','$fonction','$service','$bureau','$port','$mail','$ville','$image')";
								}
						} 
						*/
						
						$query ="SELECT DISTINCT employe_departement, nom_fonction FROM fonction, employe WHERE employe.employe_poste = fonction.id_fonction";
						$fonction=null;
						$service=null;
			
						$sql="SELECT employe_nom, employe_prenom, employe_id FROM employe where employe_id IN (SELECT DISTINCT employe_chef FROM employe)";
						$superieur=null;
						
						  try {
							
							$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
								////////////////////////////////////
								////Afficher les Fonctions    //////
								///et les Services des employés ////
								////////////////////////////////////
								
							$result=$connexion->prepare($query);
								$result->execute();
								if ($result > null){
									$ligne=$result->rowCount();
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){
										
										$fonction.= "<option value='$ligne->nom_fonction'>$ligne->nom_fonction</option>";
										$service.= "<option value='$ligne->employe_departement'>$ligne->employe_departement</option>";
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
										
										$superieur.= "<option value='$ligne->employe_id'>$ligne->employe_nom $ligne->employe_prenom</option>";
									}
									
						  		}else {
										echo 'aucun superieur';
									}
								
								/////////////////
								///FORMULAIRE///
								////////////////
								if(isset($_POST['submit'])){
										
										extract($_POST);
										
										$sql = "INSERT INTO employe".
									"VALUES('', employe_nom =:$nom, employe_prenom =:$prenom, employe_chef =:$superieur, employe_poste =:$fonction, employe_departement =:$service, employe_tel_bureau =:$bureau, employe_port =:$port, employe_mail =:$mail, employe_ville =:$ville, employe_image =:$image)";
									 
									 $result=$connexion->prepare($sql);
									 $result->execute();										
									 $result->fetch(PDO::FETCH_OBJ);
									 header('location:index.php');
									 echo'Inscription effectuée';	
								}
							$connexion = null;
							} catch(PDOException $e){
								echo $e->getMessage();
							}
	
			?>
        
        	<ul data-role="listview" data-theme="a" data-inset="true" class="action-list">
            
				<form id="ajout_employe" action="ajout_employe.php" data-ajax="false" method="POST">
                
                	<li data-role="fieldcontain">
                    
        				<label for="nom"><em>* </em> Nom : </label>
          				<input type="text" id="nom" name="nom" placeholder="nom" class="required" />
                        
      				</li>
            
      				<li data-role="fieldcontain">
      
            			<label for="prenom"><em>* </em>Prénom : </label>
          				<input type="text" id="prenom" name="prenom" placeholder="prenom" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
                    
        				<label for="superieur"><em>* </em> Supérieur : </label>
          				<select id="superieur" name="superieur" class="required" >
                        	<?php echo $superieur; ?>
                        </select>
                        
      				</li>
            
      				<li data-role="fieldcontain">
      
            			<label for="fonction"><em>* </em>Fonction : </label>
          				<select id="fonction" name="fonction" class="required">
                        	<?php echo $fonction; ?>
                        </select>
            
      				</li>
                    
                    <li data-role="fieldcontain">
                    
        				<label for="service"><em>* </em> Service : </label>
          				<select id="service" name="service" class="required">
                        	<?php echo $service; ?>
                        </select>
                        
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="tel"><em>* </em>Tèl Bureau : </label>
          				<input type="text" id="tel" name="tel" placeholder="0590878787" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="port"><em>* </em>Portable : </label>
          				<input type="text" id="port" name="port" placeholder="0690818181" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="mail"><em>* </em>Mail : </label>
          				<input type="text" id="mail" name="mail" placeholder="mail" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="ville"><em>* </em>Ville : </label>
          				<input type="text" id="ville" name="ville" placeholder="ville" class="required" />
            
      				</li>
                    
                    <li data-role="fieldcontain">
      
            			<label for="image"><em>* </em>image : </label>
          				<input type="text" id="image" name="image" class="required" />
            
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