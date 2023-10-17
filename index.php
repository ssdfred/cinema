<?php
// Informations de connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'cinema_reservation1';
$port = 3307; // Le port MySQL que vous utilisez

try {
    // Connexion à la base de données
    $connection = new PDO("mysql:host=$host;dbname=$database;port=$port", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué: " . $e->getMessage());
}

// index.php

$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri === '/movie') {
    include 'views/movie.php';
} elseif ($request_uri === '/createUser') {
    include 'views/createUser.php';
} else {
    // Par défaut, inclure la vue de la page d'accueil
    include 'views/index.php';
}
?>
