<?php
include __DIR__ . '/database.php';
// index.php

$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri === '/movie') {
    include 'views/movie.php';
} elseif ($request_uri === '/createUser') {
    include 'views/createUser.php';
} else {
    // Par défaut, inclure la vue de la page d'accueil
    include 'views/index.php';
}
?>
