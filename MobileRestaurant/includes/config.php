<?php  
$DB_HOST = "mysql4.000webhost.com"; //serveur auquel on doit se connecter pour acceder à la DB

$DB_USER = "a4596834_jamz"; //nom de ou des l'utilisateur(s) ayant acces à la DB 

$DB_PASSWORD = "electro971";  //MDP pour se connecter à  la DB

$DB_NAME = "a4596834_restau"; // nom de la DB 

$connexion = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);      
?>
