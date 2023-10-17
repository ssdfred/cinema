const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');

const app = express();
exports.app = app;
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
exports.connection = connection;

connection.connect();

function handleError(res, error, message) {
  console.error(error);
  if (res && res.status) {
    res.status(500).json({ error: message });
  } else {
    console.error(message);
  }
}
exports.handleError = handleError;

app.get('/', (req, res) => {
  connection.query('SELECT * FROM film', (error, results) => {
    if (error) handleError(res, error, 'Erreur lors de la récupération des films');
    else res.render('index', { movies: results });
  });
});
const { check, validationResult } = require('express-validator');
const { app, connection, handleError } = require('./app');


app.listen(port, () => {
  console.log(`Server listening at http://localhost:${port}`);
});
