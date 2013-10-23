<?php
$dbhost = "localhost"; //serveur auquel on doit se connecter pour acceder à la DB
$dbuser = "jessy"; //nom de ou des l'utilisateur(s) ayant acces à la DB 
$dbpass = "electro971";  //MDP pour se connecter à la DB
$dbname = "OGANIGRAMME_FMN"; // nom de la DB 
$connexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
?>
