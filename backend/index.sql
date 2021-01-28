CREATE DATABASE IF NOT EXISTS annuaire;

CREATE USER IF NOT EXISTS 'nico'@'localhost' IDENTIFIED BY 'sdfghjkl';
GRANT ALL ON annuaire.* TO 'nico'@'localhost';

use annuaire;
ALTER DATABASE annuaire charset=utf8;

CREATE TABLE adherents(
    adherent_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    prenom VARCHAR(255),
    nom VARCHAR(255),
    pseudo VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    numero VARCHAR(255) UNIQUE,
    adresse1 VARCHAR(255),
    code_postal VARCHAR(255),
    ville VARCHAR(255),
    date_adhesion DATETIME,
    mot_de_passe VARCHAR(255)
    
);

CREATE TABLE interets(
    interet_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom VARCHAR(255)
    
);

CREATE TABLE interet_adherent(
    adherent_id INT,
    centre_interet_id INT,
    PRIMARY KEY (adherent_id, centre_interet_id),
    CONSTRAINT fk_adherent_id_interet_adherent FOREIGN KEY (adherent_id)
        REFERENCES adherents (adherent_id),
    CONSTRAINT fk_interet_id FOREIGN KEY (centre_interet_id)
        REFERENCES interets (interet_id)
);


CREATE TABLE profils(
    profil_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    titre VARCHAR(255),
    photo VARCHAR(255),
    description TEXT,
    adherent_id INT UNIQUE,
    CONSTRAINT fk_adherent_id_profil FOREIGN KEY (adherent_id)
        REFERENCES adherents (adherent_id)
);

INSERT INTO interets (nom) VALUES 
    ("Sport"), ("Musique"), ("Jeux vidéos"), ("Lecture"), ("Informatique"),
    ("Sorties"), ("Cuisine"), ("Aviation"), ("Mécanique"), ("Licornes"),
    ("Joaillerie"), ("Agriculture"), ("Cinéma"), ("Politique"), ("Couture"),
    ("Animaux"), ("Sciences"), ("Histoire"), ("SVT"), ("Physique-Chimie"),
    ("Taxidermie"), ("Philatélie");