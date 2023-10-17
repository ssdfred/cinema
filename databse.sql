-- Création des tables supplémentaires
CREATE TABLE Utilisateur (
  ID_Utilisateur INT PRIMARY KEY,
  NomUtilisateur VARCHAR(255),
  MotDePasse VARCHAR(255), 
  Email VARCHAR(255),
 
);

CREATE TABLE Commentaire (
  ID_Commentaire INT PRIMARY KEY,
  ID_Utilisateur INT,
  ID_Film INT,
  Texte TEXT,
  Note INT,
  
  FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
  FOREIGN KEY (ID_Film) REFERENCES Film(ID_Film)
);

-- Insertion de données factices pour les nouvelles tables
INSERT INTO Utilisateur VALUES (1, 'user1', 'motdepassehashé', 'user1@email.com');
INSERT INTO Commentaire VALUES (1, 1, 1, 'Très bon film!', 5);
-- ... ajoutez d'autres données

-- Mise à jour de la table Réservation pour inclure l'ID_Utilisateur
ALTER TABLE Reservation ADD COLUMN ID_Utilisateur INT;
ALTER TABLE Reservation ADD FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur);
-- ... mettez à jour les données existantes avec des valeurs ID_Utilisateur

-- Sauvegarde de la base de données mise à jour
-- Exemple : pg_dump -U username -d database_name > backup_updated.sql
