<?php require 'includes/header.php'; ?>
<body>

							<!-- Accueil -->

<div data-role="page" id="accueil" data-theme="c" data-dom-cache="true">

	<header data-role="header">
    
    		<h1>RSS</h1>
            
            <a href="index.php#form" data-role="button" data-icon="plus" data-inline="true" data-transition="pop" class="ui-btn-right">Add</a>
            <a href="index.php#del" data-role="button" data-icon="minus" data-inline="true" data-transition="pop" class="ui-btn-left">Delete</a>

    </header>
        
        <div data-role="content">
        
        	<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Chercher un site">
            	
                <?php 
					$sql='SELECT * FROM site S, categorie C WHERE S.categ = C.id ORDER BY nom ASC';

					$result = $connexion->query($sql);
					$result->execute();

					if($result != null){
						while($ligne = $result->fetch(PDO::FETCH_OBJ)){

			echo '<li>'.
                	'<a href="site.php?nomSite='.$ligne->nom.'" data-transition="flip" data-prefetch="true">' .
					'<h3>'.$ligne->nom.'</h3>' .
					'<p>'.$ligne->nom_categorie.'</p>' .
                    '</a>' .
                '</li>'; 
							}//fin while
					}// fin IF

         		?>
                          
            </ul>

    	</div> <!-- end contain -->
    
        <div data-role="footer">
        	<h1>James RSS Reader</h1>
        </div>
        
</div> 
										<!-- Fin  Accueil -->

													
                                                    
                                                    <!-- Add Site-->

<?php

								/*
									Formulaire Traitement
								*/

try{
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*
		** Vérifier que l'URL saisie retourne un flux RSS ou http://feedvalidator.org/check.cgi?url=
	*/


function IsValidFeed($sURL) {
    $sURL  = 'http://validator.w3.org/appc/check.cgi?url=' . urlencode($sURL);
    $sPage = file_get_contents($sURL);
    
    if (strstr($sPage, 'This is a valid RSS feed.')) {
        return TRUE;
    }
    
    return FALSE;
}

if( isset($_POST) && !empty($_POST)){
	$sUrl='';
	$sUrl = $_POST['url_site'];
	$url_site = $_POST['url_site'];
	$nom = $_POST['nom'];
	$categorie = $_POST['categorie'];
	
	$sql="SELECT nom, url FROM site WHERE nom ='" .$_POST['nom']."' AND url = '".$_POST['url_site']."' ";
	$result=$connexion->query($sql);
	$ligne= $result->rowCount();
	
	if($result = $ligne){	
	
		header("Location:index.php");
		
	}else{
		
		if(IsValidFeed($sUrl) == true){
			
			$sql="INSERT INTO site VALUES ('', '$nom', '$categorie', '$url_site')";
		
			$result = $connexion->prepare($sql);
			$result->execute();				
			header("Location:index.php");
		
		}//fin vérifier url
						
	}
			
}//Fin Si $_POST

}catch(PDOException $e) //message d'erreur
								{
        							echo $e->getMessage();
								}

?>

											<!-- Formulaire -->
    
    
<div id="form" data-role="page"  data-theme="b" data-add-back-btn="true" data-dom-cache="true">

	<header data-role="header">
    	<h1>Add Feed</h1>
    </header>    
        
       <div dat-role="content">     
            
            <form method="post" action="index.php" data-ajax="false">
            
            	<li data-role="fieldcontain" >
                    
        				<label for="name"> <b>NAME</b> : </label>
          				<input type="text" id="nom" name="nom" placeholder="name"  class="ui-body ui-body-e"/>
                        
      				</li >
                    
                    <li data-role="fieldcontain">
                    
        				<label  for="url"> <B>URL</B> : </label>
                        <input type="text" id="url" name="url_site"  placeholder="http://example.com/rss/xml" class="ui-body ui-body-e"/>
          				
                        
      				</li >
                    
                    <li data-role="fieldcontain">
                    
        				<label for="category"> <b>CATEGORY</b> : </label>
          				<select data-theme="e" type="text" name="categorie" data-native-menu="false">
                        <?php
						
							$sql='SELECT * FROM categorie ORDER BY nom_categorie ASC';
							$result = $connexion->query($sql);
							
							if($result != null){
								while($ligne = $result->fetch(PDO::FETCH_OBJ)){
                        			echo'<option value="'.$ligne->id.'">'.$ligne->nom_categorie.'</option>';
								}
							}
                        ?>
                        </select>
                        
      				</li>
                    
                    <div class="ui-body ui-body-b">
						<fieldset class="ui-grid-a">
							<div class="ui-block-a">
                				<button type="submit" data-theme="d" class="ui-btn-hidden" aria-disabled="false">Cancel</button>
                			</div>
                
				<div class="ui-block-b">
                				<button type="submit" data-theme="a"  class="ui-btn-hidden" aria-disabled="false">Send</button>
                            </div>
	    				</fieldset>
				</div>
            
            </form>
        
        </div>  <!-- end contain form -->
        <div data-role="footer">
        	<h1>James RSS Reader</h1>
        </div>
        
</div>         
        
        
											<!-- Delete Form -->
    
    
    
						<?php
						$site = $_GET['site'];
                        $sql="DELETE FROM site WHERE id=".$site." ";
													
						if($_GET['site'] !=""){
							
							$result = $connexion->query($sql);
							
									//DELETE FEED
							header("Location:index.php");
						}
                        ?>
    
<div id="del" data-role="page"  data-theme="b" data-add-back-btn="true" data-dom-cache="true">

	<header data-role="header">
    	<h1>Delete Feed</h1>
    </header>    
        
       <div dat-role="content">

            <form method="GET" action="index.php" data-ajax="false">

                    <li data-role="fieldcontain">
                    
        				<label for="site"> Site : </label>
          				<select data-theme="e" type="text" name="site" data-native-menu="false">
                        <?php
						
							$sql='SELECT * FROM site ORDER BY nom ASC';
							$result = $connexion->query($sql);
							
							if($result != null){
								while($ligne = $result->fetch(PDO::FETCH_OBJ)){
                        			echo'<option value="'.$ligne->id.'">'.$ligne->nom.'</option>';
								}
							}
                        ?>
                        </select>
                        
      				</li>
                    
                    <div class="ui-body ui-body-b">
						<fieldset class="ui-grid-a">

                				<button type="submit" data-theme="a"   aria-disabled="false">Send</button>

	    				</fieldset>
				</div>
            
            </form>

        </div>  <!-- end contain form -->        
                
        <div data-role="footer">
        	<h1>James RSS Reader</h1>
        </div>
        
</div> 

											  
</body>

</html>