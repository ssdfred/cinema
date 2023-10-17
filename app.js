const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const { check, validationResult } = require('express-validator');

const app = express();
const port = 3007;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));
app.set('view engine', 'ejs');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'cinema_reservation',
  port: 3307,
});

connection.connect();

// Utilisation d'une fonction pour gérer les erreurs
function handleError(res, error, message) {
  console.error(error);

  // Vérification si res est un objet avec la méthode status
  if (res && res.status) {
    res.status(500).json({ error: message });
  } else {
    // Si res n'est pas un objet avec la méthode status, affichez simplement le message d'erreur
    console.error(message);
  }
}

// Ajout de faux utilisateurs et films lors du démarrage de l'application
const fakeUser = {
  username: 'john_doe',
  password: 'password123',
  email: 'john@example.com',
};

const addUserQuery = 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)';
connection.query(addUserQuery, [fakeUser.username, fakeUser.password, fakeUser.email], (error, results) => {
  if (error) handleError(console.error, error, 'Faux utilisateur non ajouté avec succès');
  else console.log('Faux utilisateur ajouté avec succès:', results);
});

const fakeMovie = {
  title: 'Fake Movie',
  director: 'Director Name',
  release_year: 2022,
};

const addMovieQuery = 'INSERT INTO movies (title, director, release_year) VALUES (?, ?, ?)';
connection.query(addMovieQuery, [fakeMovie.title, fakeMovie.director, fakeMovie.release_year], (error, results) => {
  if (error) handleError(console.error, error, 'Faux film non ajouté avec succès');
  else console.log('Faux film ajouté avec succès:', results);
});

// Routes

// Page d'accueil - Affiche tous les films
app.get('/', (req, res) => {
  connection.query('SELECT * FROM movies', (error, results) => {
    if (error) handleError(res, error, 'Erreur lors de la récupération des films');
    else res.render('index', { movies: results });
  });
});

// Page de détails d'un film
app.get('/movie/:id', (req, res) => {
  const movieId = req.params.id;
  connection.query('SELECT * FROM movies WHERE id = ?', [movieId], (error, results) => {
    if (error) handleError(res, error, 'Erreur lors de la récupération des détails du film');
    else {
      const movie = results[0];
      res.render('movie', { movie });
    }
  });
});

// Logique de réservation
app.post('/reserve', [
  check('movieId').isNumeric(),
  check('clientId').isNumeric(),
  check('date').isISO8601(),
], (req, res) => {
  const errors = validationResult(req);

  if (!errors.isEmpty()) {
    return res.status(422).json({ errors: errors.array() });
  }

  const { movieId, clientId, date } = req.body;

  // Vérification si le film existe
  connection.query('SELECT * FROM movies WHERE id = ?', [movieId], (error, movieResults) => {
    if (error) return handleError(res, error, 'Erreur lors de la vérification du film');

    // Vérification si le client existe
    connection.query('SELECT * FROM clients WHERE id = ?', [clientId], (error, clientResults) => {
      if (error) return handleError(res, error, 'Erreur lors de la vérification du client');

      if (movieResults.length === 0 || clientResults.length === 0) {
        // Film ou client non trouvé, renvoyer avec un message d'erreur
        res.status(404).json({ error: 'Film ou client non trouvé' });
      } else {
        // Les données du film et du client sont valides, procéder à la réservation
        const reservation = {
          movie_id: movieId,
          client_id: clientId,
          reservation_date: date,
        };

        // Insérer la réservation dans la base de données
        connection.query('INSERT INTO reservations SET ?', reservation, (error) => {
          if (error) return handleError(res, error, 'Erreur lors de la réservation');
          // Réservation réussie, renvoyer avec un message de succès
          res.status(200).json({ success: 'Réservation réussie' });
        });
      }
    });
  });
});

app.listen(port, () => {
  console.log(`Server listening at http://localhost:${port}`);
});
