..:: BD ::..
CREATE DATABASE dbAnidoption;


..:: DROPs ::..
DROP TABLE compteChat_caractere;
DROP TABLE compteChien_entrainement;
DROP TABLE entrainementChien;
DROP TABLE caractereChat;
DROP TABLE compteChat;
DROP TABLE compteChien;
DROP TABLE utilisateurs;
DROP TABLE animaux;
DROP TABLE ficheChat;
DROP TABLE ficheChien;
DROP TABLE ficheChat_caractere;
DROP TABLE ficheChien_entrainement;
DROP TABLE favoris;



..:: TABLES ::..

CREATE TABLE utilisateurs( 
    id INT NOT NULL AUTO_INCREMENT,
    visibility INT,
    prenom VARCHAR(32),
    nom VARCHAR(32),
    espece INT,
    adresseCourriel VARCHAR(255) NOT NULL UNIQUE, 
    motDePasse VARCHAR(255) NOT NULL, 
    
    INDEX idx_utilisateurs_adresseCourriel(adresseCourriel),
    CONSTRAINT pk_utilisateurs PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE compteChat( 
    id_user INT NOT NULL,
    sexe INT NOT NULL,
    griffes INT NOT NULL,
    toilettage INT NOT NULL,
    famille INT
)ENGINE=InnoDB;

CREATE TABLE compteChien( 
    id_user INT NOT NULL,
    sexe INT NOT NULL,
    taille INT NOT NULL,
    enfant INT NOT NULL,
    ado INT NOT NULL,
    futursParents INT NOT NULL,
    chien INT NOT NULL,
    chat INT NOT NULL,
    balade INT NOT NULL,
    maison INT NOT NULL,
    habitat INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE entrainementChien( 
    id_training INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(32) NOT NULL UNIQUE,

    CONSTRAINT pk_entrainementChien PRIMARY KEY (id_training)
)ENGINE=InnoDB;

CREATE TABLE caractereChat( 
    id_caractere INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(32) NOT NULL UNIQUE,

    CONSTRAINT pk_caractereChat PRIMARY KEY (id_caractere)
)ENGINE=InnoDB;

CREATE TABLE compteChat_caractere(
    id_user INT NOT NULL,
    id_compteChatCaractere INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE compteChien_entrainement(
    id_user INT NOT NULL,
    id_compteChienEntrainement INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE animaux( 
    id INT NOT NULL AUTO_INCREMENT,
    espece INT,
    nom VARCHAR(32) NOT NULL,
    age INT NOT NULL,
    sexe INT NOT NULL,
    img VARCHAR(255) NOT NULL,
    
    CONSTRAINT pk_animaux PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE ficheChat( 
    id_animaux INT NOT NULL,
    griffes INT NOT NULL,
    toilettage INT NOT NULL,
    famille INT
)ENGINE=InnoDB;

CREATE TABLE ficheChien( 
    id_animaux INT NOT NULL,
    taille INT NOT NULL,
    enfant INT NOT NULL,
    ado INT NOT NULL,
    chien INT NOT NULL,
    chat INT NOT NULL,
    exerciceRequis INT NOT NULL,
    solitude INT NOT NULL,
    habitat INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE ficheChat_caractere(
    id_animaux INT NOT NULL,
    id_caractere INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE ficheChien_entrainement(
    id_animaux INT NOT NULL,
    id_training INT NOT NULL
)ENGINE=InnoDB;

CREATE TABLE favoris( 
    id_user INT NOT NULL,
    id_animaux INT NOT NULL
)ENGINE=InnoDB;



..:: FKs ::..

ALTER TABLE compteChat
    ADD FOREIGN KEY (id_user) REFERENCES utilisateurs(id);

ALTER TABLE compteChien
    ADD FOREIGN KEY (id_user) REFERENCES utilisateurs(id);

ALTER TABLE compteChat_caractere
    ADD FOREIGN KEY (id_user) REFERENCES compteChat(id_user);

ALTER TABLE compteChat_caractere
    ADD FOREIGN KEY (id_compteChatCaractere) REFERENCES caractereChat(id_caractere);

ALTER TABLE compteChien_entrainement
    ADD FOREIGN KEY (id_user) REFERENCES compteChien(id_user);

ALTER TABLE compteChien_entrainement
    ADD FOREIGN KEY (id_compteChienEntrainement) REFERENCES entrainementChien(id_training);

ALTER TABLE ficheChat
    ADD FOREIGN KEY (id_animaux) REFERENCES animaux(id);

ALTER TABLE ficheChien
    ADD FOREIGN KEY (id_animaux) REFERENCES animaux(id);

ALTER TABLE ficheChat_caractere
    ADD FOREIGN KEY (id_animaux) REFERENCES ficheChat(id_animaux);

ALTER TABLE ficheChat_caractere
    ADD FOREIGN KEY (id_caractere) REFERENCES caractereChat(id_caractere);

ALTER TABLE ficheChien_entrainement
    ADD FOREIGN KEY (id_animaux) REFERENCES ficheChien(id_animaux);

ALTER TABLE ficheChien_entrainement
    ADD FOREIGN KEY (id_training) REFERENCES entrainementChien(id_training);

ALTER TABLE favoris
    ADD FOREIGN KEY (id_user) REFERENCES utilisateurs(id);

ALTER TABLE favoris
    ADD FOREIGN KEY (id_animaux) REFERENCES animaux(id);