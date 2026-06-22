use gestTeach;

    CREATE TABLE Enseignant(
        id INT AUTO_INCREMENT PRIMARY KEY,
        matricule VARCHAR(25) NOT NULL UNIQUE,
        nom VARCHAR(150) NOT NULL,
        prenom VARCHAR(150),
        tauxHoraire DECIMAL(10,2),
        nombreHeure INT
    );

    CREATE TABLE Utilisateur(
        userId INT AUTO_INCREMENT PRIMARY KEY,
        userName VARCHAR(150),
        userPassword VARCHAR(255)
    );

