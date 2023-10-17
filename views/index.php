<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Reservation</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
  <h1>Liste des films</h1>
  <ul>
    <?php
    // Connexion à la base de données (à compléter avec vos informations de connexion)
    $conn = new mysqli("localhost", "root", "root", "cinema_reservation");

    // Vérification de la connexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Récupération des films depuis la base de données
    $result = $conn->query("SELECT * FROM film");

    // Affichage des films
    while ($row = $result->fetch_assoc()) {
      echo "<li><a href=\"/movie.php?id={$row['ID_Film']}\">{$row['titre']}</a></li>";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>
  </ul>
</body>
</html>
