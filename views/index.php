<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Reservation</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'; ?>
  <h1>Liste des films</h1>
  <ul>

    <?php


    // Récupérer les données des films depuis la base de données
    $query = $connection->query('SELECT * FROM film');
    $films = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($films as $film) : ?>
      <li>
      <a href="/movie"></a>
        <?= $film['titre'] ?>

      </li>
    <?php endforeach; ?>
  </ul>
</body>