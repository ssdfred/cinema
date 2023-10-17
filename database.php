<?php
// Informations de connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'cinema_reservation1';
$port = 3307; // Le port MySQL que vous utilisez
$connection = null;

try {
    // Connexion à la base de données
    $connection = new PDO("mysql:host=$host;dbname=$database;port=$port", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué: " . $e->getMessage());
}
