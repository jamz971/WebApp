<?php require_once '../includes/config.php';?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>

<?php 
try{

	$id = $_GET['id'];

	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql ="DELETE FROM plats WHERE id_p = ".$id." ";
	
	if($_GET['id'] != ""){
		
		$result = $connexion->query($sql);

	}else{
		header('Location:index.php#sup_plat');
	}
	
	if($result = TRUE){
		
			header("Location:index.php");
		}
	
}catch(PDOEXCEPTION $e){
		echo $e ->getMessage();
	}
?>


</body>
</html>