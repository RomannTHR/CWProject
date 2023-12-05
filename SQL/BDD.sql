--- Table Client ---

CREATE TABLE Client (
    email     VARCHAR(50) NOT NULL ,
    nom       VARCHAR(50) NOT NULL,
    prenom    VARCHAR(50) NOT NULL,
    telephone INTEGER,
    mdp       VARCHAR(100) NOT NULL,
    CONSTRAINT Client_PK PRIMARY KEY (email)
);


--- Table Medecin ---

CREATE TABLE Medecin (
    email_med       VARCHAR(50) NOT NULL,
    nom_med         VARCHAR(50) NOT NULL,
    prenom_med      VARCHAR(50) NOT NULL,
    num_tel_med     INT NOT NULL,
    specialite      VARCHAR(50) NOT NULL,
    code_postal_med INT NOT NULL,
    mdp_med         VARCHAR(50) NOT NULL,
    CONSTRAINT Medecin_PK PRIMARY KEY (email_med)
);


--- Table rendez-vous ---

CREATE TABLE rendezvous (
    id_rdv    SERIAL PRIMARY KEY,
    heure_rdv TIMESTAMP NOT NULL,
    email     VARCHAR(50) NOT NULL,
    email_med VARCHAR(50) NOT NULL,
    CONSTRAINT rendezvous_Client_FK FOREIGN KEY (email) REFERENCES Client(email),
    CONSTRAINT rendezvous_Medecin0_FK FOREIGN KEY (email_med) REFERENCES Medecin(email_med)
);


--- Table Soigner ---

CREATE TABLE soigner (
    email     VARCHAR(50) NOT NULL,
    email_med VARCHAR(50) NOT NULL,
    CONSTRAINT soigner_PK PRIMARY KEY (email, email_med),
    CONSTRAINT soigner_Client_FK FOREIGN KEY (email) REFERENCES Client(email),
    CONSTRAINT soigner_Medecin0_FK FOREIGN KEY (email_med) REFERENCES Medecin(email_med)
);