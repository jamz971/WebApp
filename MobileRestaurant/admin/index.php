<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION["login_admin"]) && $_SESSION["login_admin"] =""){
	header ("location: login.php");
	exit();	
}


	$login_adminID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);//filtre pour empecher de saisir autre chose que des chiffre et des lettres
	$login_admin = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["login_admin"]);
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);
	//lancer la requete pour être sur que cette personne soit un admin

	$sql ="SELECT * FROM admin WHERE login = ? AND password = ? LIMIT 1";	
	//-----Personn exist dans la DB ------
	
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $connexion->prepare($sql);
		$result->bindParam(1,$login_admin);
		$result->bindParam(2,$password);
		$result->execute();
	
	
	if ($result->rowCount() == 0){
		echo "votre login n'est pas répertorié";
		
	}
?>

<?php	
	if(isset($_GET['logout']) ){
		unset($_SESSION["login_admin"]);
		$_SESSION["login_admin"] == "";
		header('location:login.php');
		
		exit();
		}
?>

<!DOCTYPE html> 
<html> 
<head> 

	<title>Admin</title> 
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile.structure-1.1.0.css" />
	<link rel="apple-touch-icon" href="../images/launch_icon_57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="../images/launch_icon_72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="../images/launch_icon_114.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.css" />
	<link rel="stylesheet" href="../css/custom.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head> 
<body> 
<div id="home" data-role="page" data-add-back-btn="true" data-dom-cache="true">
	
	<div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
         <a href="index.php?logout" data-min="true" data-pretch="true">logout</a>
          
	</div> 

	<div data-role="content" >
	<ul data-role="listeview" data-inset="true">
    	<li><h3><a href="#ajout_plat" data-role="button">Ajout Plats</a></h3></li>
        <li><h3><a href="#ajout_restau" data-role="button">Ajout Restaurants</a></h3></li>
        <li><h3><a href="#ajout_villes" data-role="button">Ajout Villes</a></h3></li>
        <li><h3><a href="#sup_plat" data-role="button"> Supprimer Plat</a></h3></li>
    </ul>
    
	
</div><!-- /content -->

</div><!-- /page home-->


							<!--SUPPRIMER PLATS -->
                            
                            
 <div id="sup_plat" data-role="page" data-add-back-btn="true" data-dom-cache="true">
 
	<div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
          <a href="index.php?logout" class="ui-btn-right" data-role="button">logout</a>
	</div> 
 
 	<div data-role="content">
    
    	<h1>Supprimer Plat</h1>
        
        <ul data-role="listview">
        
        <?php 
					//Supprimer Plats
					
					$sql="SELECT * FROM plats";
		
try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){ 
									
									echo "<li>" .
												"<a href='sup.php?id=$ligne->id_p' data-transition='slidedown' data-pretch='true'>" .
												"<img src='../img/plat/$ligne->image_p'/>" .
												"<h3>$ligne->nom_p</h3>" .
												"</a>" .
												"</li>";	
 
									}
									
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
    
    <footer data-add-back-btn="true" data-role="navbar" data-position="fixed" data-theme="a">
	<ul>
		<li><a href="index.php" data-pretch="true" data-icon="home">Home</a></li>
		<li><a href="index.php#ajout_plat" data-pretch="true" data-icon="star">Plats</a></li>
        <li><a href="index.php#ajout_restau" data-pretch="true" data-icon="row">Restau</a></li>
		<li><a href="index.php#ajout_ville" data-pretch="true" data-icon="gear">Ville</a></li>				
	</ul> 
</footer>
    
 
 </div> <!-- Fin Page sup plat -->


						
                        <!-- PAGE 2 Ajout_Plat-->
                        
<div id="ajout_plat" data-role="page" data-add-back-btn="true" data-dom-cache="true">

<?php
$error="";
if(isset($_POST['plat']) && !empty($_POST['plat']) && isset($_POST['image']) && !empty($_POST['image']) ){
	
	$plat=$_POST['plat'];
	$image=$_POST['image'];
	$image= $plat.".jpg";

		$sql="INSERT INTO plats VALUES('', '$plat', '$image')" or die (mysql_error('insert plat'));

	$result = $connexion->prepare($sql);
	$result->bindParam(1,$_POST['plat']);
	$result->bindParam(2,$_POST['image']);
	$result->execute();
			
	move_uploaded_file($_FILES['image']['tmp_name'],"../img/plat/$image");
	header("location:index.php#ajout_plat");			
}else{
	$error="Veuillez completer le formulaire correctement <br />";
	}
	
?>

	
	<div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
          <a href="index.php?logout" class="ui-btn-right" data-role="button">logout</a>
	</div> 

	<div data-role="content">
    <h2>Ajouter un Plat</h2>
    
	<ul data-role="listview" data-inset="true">
    <?php echo $error;?>

		<form method="post" action="index.php#ajout_plat" data-ajax="false" enctype="multipart/form-data">
            
            	<li data-role="fieldcontain">
					<label for="plat"> Nom du Plat : </label>
          			<input autocomplete="on" type="text" id="plat" name="plat" placeholder="nom du plat"/>
                        
      			</li >
                 
                <li data-role="fieldcontain">
					<label for="image"> Image : </label>
          			<input type="file" id="image" accept="image/jpeg" name="image" />        
      			</li>
                    
                 <li class="ui-body ui-body-b">
                	<button class="ui-body ui-body-b" type="submit" data-theme="b" data-mini="true" >Submit</button>
				</li>
            
            </form>
		
	</ul> 
   <hr style="margin-top:25px;"> 
    <h2 style="margin-top:40px;">Liste de Plat</h2>
    
    <ul data-role="listview" data-inset="true">
    
    
    
    	 <?php
	$sql = "SELECT * FROM plats  ORDER BY id_p DESC";

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){ //recupération du résultat sous forme d'objet
									
									echo "<li>" .
												"<img src='../img/plat/$ligne->image_p'/>" .
												"<h3>$ligne->nom_p</h3>" .
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
    
	
</div><!-- /content -->

<footer data-add-back-btn="true" data-role="navbar" data-position="fixed" data-theme="a">
	<ul>
		<li><a href="index.php" data-pretch="true" data-icon="home">Home</a></li>
		<li><a href="index.php#ajout_plat" data-pretch="true" data-icon="star">Plats</a></li>
        <li><a href="index.php#ajout_restau" data-pretch="true" data-icon="row">Restau</a></li>
		<li><a href="index.php#ajout_ville" data-pretch="true" data-icon="gear">Ville</a></li>				
	</ul> 
</footer>

</div><!-- Ajou plat-->



					<!-- PAGE 3 Ajout_Restau-->
                        
<div id="ajout_restau" data-role="page" data-add-back-btn="true" data-dom-cache="true">

<?php
$error="";
if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['adress']) && !empty($_POST['adress']) ){
	
	$nom=$_POST['nom'];
	$type=$_POST['type'];
	$tel=$_POST['tel'];
	$adress=$_POST['adress'];
	$ville_r=$_POST['ville_r'];
	$cp=$_POST['cp'];
	$note=$_POST['note'];
	$image=$_FILES['image'];
	$image= $nom_r.".jpg";

		$sql="INSERT INTO restaurants VALUES('', '$nom_r', '$type', '$tel', '$adress', '$ville_r', '$cp', '$image', '$note')" or die (mysql_error('insert plat'));

	$result = $connexion->prepare($sql);

	$result->execute();
			
	move_uploaded_file($_FILES['image']['tmp_name'],"../img/restau/$image");
	
	header("location:index.php#ajout_restau"); 			
}else{
	$error="Veuillez completer le formulaire<br />";
	}
	
?>

	
	<div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
          <a href="index.php?logout" class="ui-btn-right" data-role="button">logout</a>
	</div> 

	<div data-role="content">
    <h2>Ajouter un Restaurant</h2>
    
	<ul data-role="listview" data-inset="true">
    <?php echo $error;?>

		<form method="post" action="index.php#ajout_plat" data-ajax="false" enctype="multipart/form-data">
            
            	<li data-role="fieldcontain">
					<label for="nom_r"> Nom du Restaurant : </label>
          			<input autocomplete="on" type="text" id="nom_r" name="nom_r" placeholder="nom du restau"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="type"> Type de Restaurant : </label>
          			<input autocomplete="on" type="text" id="type" name="type" placeholder="type"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="tel"> Tel : </label>
          			<input autocomplete="on" type="text" maxlength="10" id="tel" name="tel" placeholder="0590457863"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="adresse"> Adresse : </label>
          			<input autocomplete="on" type="text" id="adresse" name="adresse" placeholder="Rue Maurice Marie-Claire"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="adresse"> Ville : </label>
          			<input autocomplete="on" type="text" id="adresse" name="ville_r" placeholder="Basse-Terre"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="cp"> Code Postal: </label>
          			<input autocomplete="on" type="text" maxlength="5" id="cp" name="cp" placeholder="97100"/>
                        
      			</li >
                 
                 <li data-role="fieldcontain">
					<label for="note"> Note : </label>
          			<input autocomplete="on" type="text" maxlength="6" id="note" name="note" placeholder="un, deux, trois, quatre"/>
                        
      			</li >
                
                <li data-role="fieldcontain">
					<label for="image"> Image : </label>
          			<input type="file" id="image" accept="image/jpeg" name="image" />        
      			</li>
   
                 <li class="ui-body ui-body-b">
                	<button class="ui-body ui-body-b" type="submit" data-theme="b" data-mini="true" >Submit</button>
				</li>
            
            </form>
		
	</ul> 
   <hr style="margin-top:25px;"> 
    <h2 style="margin-top:40px;">Liste de Restaurants</h2>
    
    <ul data-role="listview" data-inset="true">
    
    
    
    	 <?php
	$sql = "SELECT * FROM restaurants  ORDER BY id_r DESC";

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){ //recupération du résultat sous forme d'objet
									
									echo "<li>" .
												"<img src='../img/restau/$ligne->image_r'/>" .
												"<h3>$ligne->nom_r</h3>" .
												"<p style='margin-top:3px'>$ligne->type_r</p>" .
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
    
	
</div><!-- /content -->

<footer data-add-back-btn="true" data-role="navbar" data-position="fixed" data-theme="a">
<ul>
					<li><a href="index.php" data-pretch="true" data-icon="home">Home</a></li>
					<li><a href="index.php#ajout_plat" data-pretch="true" data-icon="star">Plats</a></li>
                    <li><a href="index.php#ajout_restau" data-pretch="true" data-icon="star">Restau</a></li>
					<li><a href="index.php#ajout_ville" data-pretch="true" data-icon="gear">Ville</a></li>
				</ul> </footer>

</div><!-- /restaurant plat-->



							<!-- PAGE 4 Ajout_Ville-->
                        
<div id="ajout_ville" data-role="page" data-add-back-btn="true" data-dom-cache="true">

<?php
$error="";
if(isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['cp']) && !empty($_POST['cp']) ){
		
		$ville=$_POST['ville'];
		$cp=$_POST['cp'];

		$sql="INSERT INTO ville VALUES('', '$ville', '$cp')" or die (mysql_error('insert ville'));

	$result = $connexion->prepare($sql);
	$result->bindParam(1,$_POST['ville']);
	$result->bindParam(2,$_POST['cp']);
	$result->execute();
	header("location:index.php#ajout_ville");				
}else{
	$error="Veuillez completer le formulaire correctement <br />";
	}
	
?>

	
	<div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
          <a href="index.php?logout" class="ui-btn-right" data-role="button">logout</a>
	</div> 

	<div data-role="content">
    <h2>Ajouter une Ville</h2>
    
	<ul data-role="listview" data-inset="true">
    <?php echo $error;?>

		<form method="post" action="index.php#ajout_plat" data-ajax="false" enctype="multipart/form-data">
            
            	<li data-role="fieldcontain">
					<label for="ville"> Nom de ville: </label>
          			<input autocomplete="on" type="text" id="ville" name="ville" placeholder="nom ville"/>
                        
      			</li >
                 
                <li data-role="fieldcontain">
					<label for="cp"> Code Postal : </label>
          			<input type="text" id="cp" maxlength="5" name="cp" placeholder="97100" />        
      			</li>
                    
                 <li class="ui-body ui-body-b">
                	<button class="ui-body ui-body-b" type="submit" data-theme="b" data-mini="true" >Envoye</button>
				</li>
            
            </form>
		
	</ul> 
   <hr style="margin-top:25px;"> 
   
    <h2 style="margin-top:40px;">Liste de Ville</h2>
    
    <ul data-role="listview" data-inset="true">
    
    
    
    	 <?php
	$sql = "SELECT * FROM ville  ORDER BY id_v DESC";

try {
								$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
								$result = $connexion->query($sql); //traitement de la requête
								
								if($result > null){
									while($ligne = $result->fetch(PDO::FETCH_OBJ) ){ //recupération du résultat sous forme d'objet
									
									echo "<li>" .
												"<h3>$ligne->nom_v</h3>" .
												"<p style='margin-top:3px'>$ligne->cp_v</p>" .
												"</li>";	
 
									}
									
								}else{
										echo" le résultat de la requête est égal à 0 ou null";
									}

								
							}catch(PDOException $e) //message d'erreur
								{
        							echo $e->getMessage();
								}
	
	?>
    
    </ul>
    
	
</div><!-- /content -->

<footer data-role="navbar" data-position="fixed" data-theme="a">
<ul>
					<li><a href="index.php" data-pretch="true" data-icon="home">Home</a></li>
					<li><a href="index.php#ajout_plat" data-pretch="true" data-icon="star">Plats</a></li>
                    <li><a href="index.php#ajout_restau" data-pretch="true" data-icon="star">Restau</a></li>
					<li><a href="index.php#ajout_ville" data-pretch="true" data-icon="gear">Ville</a></li>
				</ul> </footer>

</div><!-- ville-->

</body>
</html>