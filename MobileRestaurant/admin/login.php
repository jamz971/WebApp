<?php
session_start();
require_once '../includes/config.php';

if (isset($_SESSION["login_admin"])){
	header("location: index.php");
	exit();	
}

$login_admin="";
		$password="";
if(isset($_POST) && $_POST !="" ){
		//VARS
		
		$login_admin = $_POST['login'] ;
		$password = sha1($_POST['password']) ;
		
		$sql="SELECT id FROM admin WHERE login = ? AND password = ? LIMIT 1";
		
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $connexion->prepare($sql);
		$result->bindParam(1,$login_admin);
		$result->bindParam(2,$password);
		$result->execute();
		
		/*compte le nbr de résultat
			et creation de la session
		*/
		if($result->rowCount()==1 ){
			
			$_SESSION['id'] = $id;
			$_SESSION["login_admin"] = $login_admin;
			$_SESSION["password"] = $password;
			
			header('Location:index.php');
			}
	}else{
		echo 'ACCES NON AUTHORISE <a href="login.php">Click ici </a>';
			exit();
		}

?>

<!DOCTYPE html> 
<html> 
<head> 

	<meta name="viewport" content="width=device-width, initial-scale=1" /> 
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
<div id="login" data-role="page" data-add-back-btn="false" data-dom-cache="true" data-theme="b">
	
    <div data-role="header"> 
    
		 <h1> <a href="../index.php" data-pretch="true">Site</a></h1>
       
	</div>
    
	<div data-role="content">
	    
	<ul data-role="listview" data-inset="true" style="margin-top:100px;">

		<form method="post" action="login.php" data-ajax="false">
            
            	<li data-role="fieldcontain">
					<label for="login"> Login : </label>
          			<input autocomplete="on" type="text" id="login" name="login" placeholder="Login"/>
                        
      			</li >
                 
                <li data-role="fieldcontain">
					<label for="password"> Password : </label>
          			<input autocomplete="on" type="password" id="password" name="password"placeholder="Mot de passe" />        
      			</li>
                    
                 <li class="ui-body ui-body-b">
                	<button class="ui-body ui-body-b" type="submit" data-theme="a" data-mini="true" >Connexion</button>
				</li>
            
            </form>
		
	</ul> 
	
	</div>
<footer data-add-back-btn="true" data-role="footer" data-position="fixed">  		
    <h3><a href="../index.php" data-pretch="true">Site</a></h3>
</footer>

</div><!-- /page -->
</body>
</html>