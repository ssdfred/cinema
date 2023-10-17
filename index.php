<?php
// Informations de connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'cinema_reservation1';
$port = 3307; // Le port MySQL que vous utilisez

// Connexion à la base de données
$connection = new mysqli($host, $user, $password, $database, $port);

// Vérifier la connexion
if ($connection->connect_error) {
    die("La connexion à la base de données a échoué : " . $connection->connect_error);
}

// index.php

if ($_SERVER['REQUEST_URI'] === '/movie') {
    include 'views/movie.php';
} elseif ($_SERVER['REQUEST_URI'] === '/createUser') {
    include 'views/createUser.php';
} else {
    // Par défaut, inclure la vue de la page d'accueil
    include 'views/index.php';
}
?>
