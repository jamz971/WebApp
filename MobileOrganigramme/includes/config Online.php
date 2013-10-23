<?php
$dbhost = "mysql4.000webhost.com"; //serveur auquel on doit se connecter pour acceder à la DB

$dbuser = "a4596834_jessy"; //nom de ou des l'utilisateur(s) ayant acces à la DB 

$dbpass = "electro971";  //MDP pour se connecter Ã  la DB

$dbname = "a4596834_chart"; // nom de la DB 

$connexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
?>
