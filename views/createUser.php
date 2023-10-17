<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Reservation</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
  <h1>Créer un Utilisateur</h1>
  <form action="/createUser.php" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Créer Utilisateur</button>
  </form>

  <?php
  // Traitement du formulaire d'ajout d'utilisateur (à compléter)
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Connexion à la base de données (à compléter avec vos informations de connexion)
    $conn = new mysqli("localhost", "root", "root", "cinema_reservation");

    // Vérification de la connexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Insertion de l'utilisateur dans la base de données
    $insertUserQuery = "INSERT INTO Utilisateur (NomUtilisateur, MotDePasse, Email) VALUES ('$username', '$password', '$email')";
    $conn->query($insertUserQuery);

    // Fermeture de la connexion à la base de données
    $conn->close();

    echo "<p>Utilisateur ajouté avec succès.</p>";
  }
  ?>
</body>
</html>
