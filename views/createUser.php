<?php



// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Valider les données (ajoutez votre propre logique de validation ici)

  // Hash du mot de passe
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Préparer et exécuter la requête SQL
  $query = $connection->prepare('INSERT INTO utilisateur (NomUtilisateur, MotDePasse, Email) VALUES (?, ?, ?)');
  $query->execute([$username, $hashedPassword, $email]);

  // Rediriger vers la page d'accueil après l'ajout de l'utilisateur
  header('Location: /');
  exit;
}
?>
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
  <form action="/createUser" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Créer Utilisateur</button>
  </form>
</body>

</html>