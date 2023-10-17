-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cinema_reservation;

-- Utilisation de la base de données
USE cinema_reservation;

-- Création de la table Film
CREATE TABLE IF NOT EXISTS Film (
    ID_Film INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    realisateur VARCHAR(255),
    anneeSortie INT
);

-- Création de la table Utilisateur
CREATE TABLE IF NOT EXISTS Utilisateur (
    ID_Utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    NomUtilisateur VARCHAR(255) NOT NULL,
    MotDePasse VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL
);

-- Création de la table Commentaire
CREATE TABLE IF NOT EXISTS Commentaire (
    ID_Commentaire INT AUTO_INCREMENT PRIMARY KEY,
    ID_Utilisateur INT,
    ID_Film INT,
    Texte TEXT,
    Note INT,
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Film) REFERENCES Film(ID_Film)
);

-- Création de la table Reservation
CREATE TABLE IF NOT EXISTS Reservation (
    ID_Reservation INT AUTO_INCREMENT PRIMARY KEY,
    ID_Utilisateur INT,
    ID_Film INT,
    DateReservation DATE,
    FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
    FOREIGN KEY (ID_Film) REFERENCES Film(ID_Film)
);