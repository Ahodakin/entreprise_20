<?php
    try {
        $cnx = new PDO('mysql:host=localhost;dbname=artisan_pct;charset=utf8', 'root', ''); 
    
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    