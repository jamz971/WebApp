<?php
require_once'includes/config.php';

	$sql = "SELECT * FROM restaurants WHERE id_r=:restau";
	$query="SELECT nom_p FROM plats P, cuisine C, restaurants R WHERE P.id_p = C.c_plat AND C.c_restau = R.id_r AND id_r=:restau";

try {
			$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			$result = $connexion->prepare($sql); //traitement de la requête
			$result->bindParam("restau", $_GET['restau']);
			$result->execute();

			$ligne = $result->fetch(PDO::FETCH_OBJ);	
			
			 //echo "<li> $row->nom_p;</li>";
			 
			 $rest = $connexion->prepare($query); //traitement de la requête
			$rest->bindParam("restau", $_GET['restau']);
			$rest->execute();

	?>

<!DOCTYPE html> 
<html> 
<head> 

	<title>Restaurant</title> 
    
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
<div id="restau" data-role="page" data-add-back-btn="true" data-dom-cache="true">
	<a href="index.php" data-pretch="true">
        <div data-role="header"> 
            <h1> Selecteur de Restauration</h1>
        </div>
    </a>
	
	<div data-role="content">
	<div class="ui-grid-a" id="restau_infos">	
		<div class="ui-block-a">
		<h1> <?php echo utf8_encode($ligne->nom_r);?></h1>
		<p><strong> <?php echo utf8_encode($ligne->type_r);?></strong></p>
		<p> Plats disponibles: </p>
			<ul> 
				 <?php 
				 if($rest > null){
				while($row = $rest->fetch(PDO::FETCH_OBJ)){
					echo '<li><i>'.utf8_encode($row->nom_p).'</i></li>';
					}
				
				}else{
					
					echo"<li> aucun plat</li>";
					}	?>
			</ul>			
		</div>		
		<div class="ui-block-b">
		<p><img src="img/restau/<?php echo utf8_encode($ligne->image_r);?>" alt="<?php echo utf8_encode($ligne->nom_r);?>"/></p>
		<p><a href="http://www.google.fr" rel="external" data-role="button" data-pretch="true"> voir leur site</a></p>
		</div>
	</div><!-- /grid-a -->
	<hr/>
	
	<div class="ui-grid-a" id="contact_infos">	
		<div class="ui-block-a">
		<h2> Contacter</h2>
		<p><?php echo utf8_encode($ligne->adresse_r);?></p>
		<p> <?php echo $ligne->cp_r,"<br/>",  $ligne->ville_r;?></p>	
	
		</div>		
		<div class="ui-block-b">
			<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo urlencode(utf8_encode($ligne->adresse_r) .' '. $ligne->ville_r);?>&zoom=15&size=300x300&markers=size:mid%7Ccolor:red%7C&sensor=false" alt="<?php echo utf8_encode($ligne->nom_r);?>"/>
		</div>
	</div><!-- /grid-a -->
	<div id="contact_buttons">	
		<a href="http://maps.google.fr/maps?q=<?php echo urlencode(utf8_encode($ligne->nom_r) .' '. utf8_encode($ligne->adresse_r) .' '. utf8_encode($ligne->ville_r));?>" data-role="button" data-icon="maps"> Voir sur Google Maps </a> 
		
		 <a href="tel:<?php echo preg_replace('#[^A-Za-z0-9]#i', '',utf8_encode($ligne->tel_r));?>" data-role="button" data-icon="tel"> Appel </a>

	</div>	
	<hr/>
	
	<div id="notation">	
	<form>
	<label for="select-choice-0" class="select"></label><h2> Noter </h2></label>
		<select name="note_utilisateur" id="note_utilisateur" data-native-menu="false" data-theme="c" >
		   <option value="un" class="un">Pas bon</option>
		   <option value="deux" class="deux">Moyen</option>
		   <option value="trois" class="trois">Tres bon</option>
		   <option value="quatre" class="quatre">Excellent</option>
		</select>	
	</form>
	</div>

<?php 
}catch(PDOException $e) //message d'erreur
	{
        echo $e->getMessage();
	}

?>

	<script type="text/javascript">

	$( '#infos' ).live( 'pageinit',function(event){
		var SelectedOptionClass = $('option:selected').attr('class');
		$('div.ui-select').addClass(SelectedOptionClass);
		
		$('#note_utilisateur').live('change', function(){	 
			$('div.ui-select').removeClass(SelectedOptionClass);
			
			SelectedOptionClass = $('option:selected').attr('class');
			$('div.ui-select').addClass(SelectedOptionClass);		
			
		 });
		
	  
	});

	</script>
    

	

	</div>


</div><!-- /page -->
</body>
</html>