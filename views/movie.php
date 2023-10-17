<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Reservation</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
  <?php
  // Connexion à la base de données (à compléter avec vos informations de connexion)
  $conn = new mysqli("localhost", "root", "root", "cinema_reservation");

  // Vérification de la connexion
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Récupération des détails du film depuis la base de données
  $movieId = $_GET['id'];
  $result = $conn->query("SELECT * FROM film WHERE ID_Film = $movieId");
  $row = $result->fetch_assoc();

  // Affichage des détails du film
  echo "<h1>{$row['titre']}</h1>";
  echo "<p>Réalisateur: {$row['realisateur']}</p>";
  echo "<p>Année de sortie: {$row['anneeSortie']}</p>";

  // Fermeture de la connexion à la base de données
  $conn->close();
  ?>
</body>
</html>
