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

    //Récupérer les utilisateurs 
    $query = "SELECT * FROM utilisateur";
    $stmt = $connection->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Afficher les utilisateurs
    foreach($users as $user){
        echo "ID : " . $user['idUser'] . "<br>";
        echo "Nom : " . $user['name'] . "<br>";
        echo "Prenom : " . $user['surname'] . "<br>";
        echo "email : " . $user['email'] . "<br>";
        echo "<br>";
    }
}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>