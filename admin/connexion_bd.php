<?php
$host="sql212.infinityfree.com";
$user="if0_36837483";
$pwd="pSGKjB6XWjnZjd";
$bd="if0_36837483_artisan_pct";
    try {
        $cnx = new PDO('mysql:host='.$host.';dbname='.$bd.';charset=utf8', $user, $pwd); 
    
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    