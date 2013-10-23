<?php
$dbhost = "mysql2.000webhost.com"; //serveur auquel on doit se connecter pour acceder à la DB
$dbuser = "a3553998_jamz"; //nom de ou des l'utilisateur(s) ayant acces à la DB 
$dbpass = "funboard123456";  //MDP pour se connecter à la DB
$dbname = "a3553998_rss"; // nom de la DB 
$connexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
?>