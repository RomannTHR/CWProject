--- Table Client---

CREATE TABLE Client(
        email     Varchar (50) NOT NULL ,
        nom       Varchar (5) NOT NULL ,
        prenom    Varchar (50) NOT NULL ,
        telephone Int NOT NULL ,
        mdp       Varchar (50) NOT NULL
	,CONSTRAINT Client_PK PRIMARY KEY (email)
);


--- Tabke Medecin ---

CREATE TABLE Medecin(
        email_med       Varchar (50) NOT NULL ,
        nom_med         Varchar (50) NOT NULL ,
        prenom_med      Varchar (50) NOT NULL ,
        num_tel_med     Int NOT NULL ,
        specialite      Varchar (50) NOT NULL ,
        code_postal_med Int NOT NULL ,
        mdp_med         Varchar (5) NOT NULL
	,CONSTRAINT Medecin_PK PRIMARY KEY (email_med)
);


--- Table rendez-vous ---

CREATE TABLE rendezvous(
        id_rdv    Int NOT NULL ,
        heure_rdv Datetime NOT NULL ,
        email     Varchar (50) NOT NULL ,
        email_med Varchar (50) NOT NULL
	,CONSTRAINT rendezvous_PK PRIMARY KEY (id_rdv)

	,CONSTRAINT rendezvous_Client_FK FOREIGN KEY (email) REFERENCES Client(email)
	,CONSTRAINT rendezvous_Medecin0_FK FOREIGN KEY (email_med) REFERENCES Medecin(email_med)
);


--- Table Soigner ---

CREATE TABLE soigner(
        email     Varchar (50) NOT NULL ,
        email_med Varchar (50) NOT NULL
	,CONSTRAINT soigner_PK PRIMARY KEY (email,email_med)

	,CONSTRAINT soigner_Client_FK FOREIGN KEY (email) REFERENCES Client(email)
	,CONSTRAINT soigner_Medecin0_FK FOREIGN KEY (email_med) REFERENCES Medecin(email_med)
);
