<?php 
    
    const DB_USER = "postgres";
    const DB_PASSWORD = "Isen44N";
    const DB_NAME = "allobobo";
    const DB_SERVER = "127.0.0.1";
    const DB_PORT = "5432";

    $IS_CONNECTED = false;


    function dbConnect(){
        $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
        try {
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            return $conn;
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    function isFormValid($nom,$prenom,$telephone,$email,$confemail,$mdp){
        if($nom == "" || $prenom == "" || $telephone == "" || $email == "" || $confemail == "" || $mdp == ""){
            return false;
        }
        else{
            return true;
        }
    }

    function isFormValidMed($nom,$prenom,$telephone,$email,$confemail,$codepos,$specialite,$mdp){
        if($nom == "" || $prenom == "" || $telephone == "" || $email == "" || $confemail == "" || $mdp == "" || $codepos = "" || $specialite = ""){
            return false;
        }
        else{
            return true;
        }
    }

    function checkLogin($mail,$mdp){
        try
        {
        $isCorrect = false;
        $conn = dbConnect();
        $emails = $conn->query('SELECT email,mdp FROM Client');
        $result = $emails->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $email){
            if($email['email'] == $mail && password_verify($mdp,$email['mdp'])){
                return true;
            }
        }
        return false;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    function checkLoginMed($mail,$mdp){
        try
        {
        $isCorrect = false;
        $conn = dbConnect();
        $emails = $conn->query('SELECT email_med,mdp_med FROM medecin;');
        $result = $emails->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $email){
            if($email['email_med'] == $mail && password_verify($mdp,$email['mdp_med'])){
                return true;
            }
        }
        return false;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }




    function sendDataToDB($nom,$prenom,$telephone,$email,$mdp){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();


            // On va vérifier que l'email n'est pas déjà dans la base de données.
            $email_client = $conn->prepare('SELECT email FROM client WHERE email = :email');
            $email_client->bindParam(':email', $email);
            $email_client->execute();
            $existingEmail = $email_client->fetch(PDO::FETCH_ASSOC);
    
            if ($existingEmail) {
                return false; // L'email existe déjà, retourne false
            }


            $stmt = $conn->prepare('INSERT INTO Client(email,nom,prenom,telephone,mdp) VALUES (:email,:nom,:prenom,:telephone,:mdp)');

            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':telephone',$telephone);
            $stmt->bindParam(':mdp',password_hash($mdp, PASSWORD_DEFAULT));
            $stmt->execute(); 
            $conn->commit();
            return true; // Enregistrement réussi
            } catch (PDOException $e) {
                $conn->rollBack();
                echo 'Connexion échouée : ' . $e->getMessage();
                return false;
            }
    }

    function sendMedToDB($nom,$prenom,$codepos,$telephone,$email,$spe,$mdp){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();

            // On va vérifier que l'email n'est pas déjà dans la base de données.
            
            $email_client = $conn->prepare  ('SELECT email_med FROM medecin WHERE email_med = :email');
            $email_client->bindParam(':email', $email);
            $email_client->execute();
            $existingEmail = $email_client->fetch(PDO::FETCH_ASSOC);
    
            if ($existingEmail) {
                return false; // L'email existe déjà, retourne false
            }

            $stmt = $conn->prepare('INSERT INTO Medecin(email_med,nom_med,prenom_med,num_tel_med,specialite,code_postal_med,mdp_med) VALUES (:email,:nom,:prenom,:telephone,:specialite,:codepos,:mdp)');


            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':telephone',$telephone);
            $stmt->bindParam(':specialite',$spe);
            $stmt->bindParam(':codepos',$codepos);
            $stmt->bindParam(':mdp',password_hash($mdp, PASSWORD_DEFAULT));
            $stmt->execute(); 
            $conn->commit();

            return true;

            } catch (PDOException $e) {
                $conn->rollBack();
                echo 'Connexion échouée : ' . $e->getMessage();
                return false;
            }
    }

    function dbGetMed($conn, $specialiste,$lieu){
        try{
        $specialiste='%'.$specialiste.'%';
        $lieu='%'.$lieu.'%';
        $request = 'SELECT nom_med,prenom_med,specialite,medecin.email_med,code_postal_med,date_dispo FROM medecin JOIN jour ON medecin.email_med=jour.email_med WHERE medecin.nom_med LIKE :specialite OR medecin.specialite LIKE :specialite AND code_postal_med LIKE :lieu';
        $statement = $conn->prepare($request);
        $statement->bindParam(':specialite', $specialiste,PDO::PARAM_STR);
        $statement->bindParam(':lieu', $lieu,PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }
      catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
      }
    }
    function dbGetRDVByDay($conn,$specialiste){
        try{
            $specialiste='%'.$specialiste.'%';
            $request = 'SELECT DISTINCT date_dispo FROM heure_dispo join medecin ON medecin.email_med=heure_dispo.email_med WHERE medecin.nom_med LIKE :specialite OR medecin.specialite LIKE :specialite' ;
            $statement = $conn->prepare($request);
            $statement->bindParam(':specialite', $specialiste);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }
    function dbGetRDVByHour($conn,$specialiste,$jour){
        try{
            $specialiste='%'.$specialiste.'%';
            $request = 'SELECT DISTINCT heure,date_dispo FROM heure_dispo JOIN medecin ON medecin.email_med=heure_dispo.email_med WHERE medecin.nom_med LIKE :specialite OR medecin.specialite LIKE :specialite AND date_dispo=:jour';
            $statement = $conn->prepare($request);
            $statement->bindParam(':specialite', $specialiste);
            $statement->bindParam(':jour',$jour);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }

    function addRDVInCalendar($email_med){
        try{
            $conn = dbConnect();

            $request = 'SELECT rendezvous.heure_rdv,client.nom,client.prenom,medecin.specialite FROM rendezvous JOIN client ON rendezvous.email = client.email JOIN medecin ON rendezvous.email_med = medecin.email_med WHERE medecin.email_med = :emailmed';
            $statement = $conn->prepare($request);
            $statement->bindParam(':emailmed', $email_med);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $rdv) {
                $new_date = str_replace(" ","T",$rdv['heure_rdv']);
                $new_date_time = new DateTime($new_date);
                $datemodif = $new_date_time->modify('+1 hour');
                $end_date = $datemodif->format('Y-m-d\TH:i:s');
            }

            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }
    function addRDV($conn,$email_client,$email_med,$jour,$heure,$idrdv){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();
            $stmt = $conn->prepare('INSERT INTO rendezvous(id_rdv,heure_rdv,email,email_med,date_dispo) VALUES (:idrdv,:heure_rdv,:email,:email_med,:jour)');
            $stmt->bindParam(':idrdv',$idrdv);
            $stmt->bindParam(':heure_rdv',$heure);
            $stmt->bindParam(':email',$email_client);
            $stmt->bindParam(':email_med',$email_med);
            $stmt->bindParam(':jour',$jour);
            $stmt->execute(); 
            $conn->commit();
        } catch (PDOException $e) {
                $conn->rollBack();
                echo 'Connexion échouée : ' . $e->getMessage();
                return false;
            }
    }

    function supprMedRdvDispo($conn,$email_med,$jour){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();
            $stmt = $conn->prepare('DELETE FROM heure_dispo WHERE date_dispo=:jour AND email_med=:email_med');
            $stmt->bindParam(':email_med',$email_med);
            $stmt->bindParam(':jour',$jour);
            $stmt->execute(); 
            $conn->commit();
        } catch (PDOException $e) {
                $conn->rollBack();
                echo 'Connexion échouée : ' . $e->getMessage();
                return false;
            }
    }

    
    function getRDVclient($conn,$email_client){
        try{
            $request = 'SELECT heure_rdv,nom_med,prenom_med,specialite,code_postal_med,id_rdv from rendezvous join medecin on medecin.email_med=rendezvous.email_med where email=:email;';
            $statement = $conn->prepare($request);
            $statement->bindParam(':email', $email_client);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }
    function getNumberOfResult($conn, $specialiste,$lieu){
        try{
            $specialiste='%'.$specialiste.'%';
            $lieu='%'.$lieu.'%';
            $request = 'SELECT count(*) AS counts FROM medecin WHERE medecin.nom_med LIKE :specialite OR medecin.specialite LIKE :specialite AND code_postal_med LIKE :lieu';
            $statement = $conn->prepare($request);
            $statement->bindParam(':specialite', $specialiste,PDO::PARAM_STR);
            $statement->bindParam(':lieu', $lieu,PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }


    function insertDispoByDay($email_med,$day,$hours){
        try{
            $conn = dbConnect();

            $date = str_replace('/', '-', $day);
            
            $date_org = DateTime::createFromFormat('d-m-Y', $date);

            $date_final = $date_org->format('Y-m-d');


            // On va vérifier que la date n'est pas déjà dans la base de données.
            
            $date_rdv = $conn->prepare  ('SELECT date_dispo FROM jour WHERE date_dispo = :date_dispo');
            $date_rdv->bindParam(':date_dispo', $date_final);
            $date_rdv->execute();
            $existingDate = $date_rdv->fetch(PDO::FETCH_ASSOC);
    
            if (!$existingDate) {
                $request = 'INSERT INTO jour(date_dispo,email_med) VALUES (:date_dispo,:email)';
                $statement = $conn->prepare($request);
                $statement->bindParam(':date_dispo', $date_final);
                $statement->bindParam(':email', $email_med);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }

        

            foreach($hours as $hour){
                $heure_rdv = $conn->prepare ('SELECT heure FROM heure_dispo WHERE heure = :heure');
                $heure_rdv->bindParam(':heure', $hour);
                $heure_rdv->execute();
                $existingHour = $heure_rdv->fetch(PDO::FETCH_ASSOC);

                
                if(!$existingHour){
                    $request = 'INSERT INTO heure_dispo(heure,date_dispo,email_med) VALUES (:heure,:date_dispo,:email)';
                    $statement = $conn->prepare($request);
                    $statement->bindParam(':heure', $hour);
                    $statement->bindParam(':date_dispo', $date_final);
                    $statement->bindParam(':email', $email_med);
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                }

            }
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }

    function getNextRDVByMed($email_med){
        try{
            $conn = dbConnect();

            $request = 'SELECT *,client.nom,client.prenom,client.telephone FROM rendezvous JOIN client ON client.email = rendezvous.email WHERE heure_rdv > CURRENT_DATE AND email_med = :emailmed LIMIT 10';
            $statement = $conn->prepare($request);
            $statement->bindParam(':emailmed', $email_med);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
          }
          catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
          }
    }

?>