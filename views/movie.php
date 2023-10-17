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
  <?php
  // Récupération des détails du film depuis la base de données
  $query = $connection->query('SELECT * FROM film');
  $films = $query->fetchAll(PDO::FETCH_ASSOC);
 
  foreach ($films as $film) : 
    // Affichage des détails du film
    echo "<h1>{$film['titre']}</h1>";
    echo "<p>Réalisateur: {$film['realisateur']}</p>";
    echo "<p>Année de sortie: {$film['anneeSortie']}</p>";
  endforeach;

  ?>
</body>
</html>
