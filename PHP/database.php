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
            if($email['email'] == $mail && $email['mdp'] = password_hash($mdp,PASSWORD_DEFAULT)){
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
            if($email['email_med'] == $mail && $email['mdp_med'] = password_hash($mdp,PASSWORD_DEFAULT)){
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
        $request = 'SELECT nom_med,prenom_med,specialite FROM medecin WHERE medecin.nom_med=:specialite and code_postal_med=:lieu';
        $statement = $conn->prepare($request);
        $statement->bindParam(':specialite', $specialiste);
        $statement->bindParam(':lieu', $lieu);
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
            $request = 'SELECT DISTINCT jour FROM heure_dispo join medecin ON medecin.email_med=heure_dispo.email_med where medecin.nom_med=:specialite';
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
            $request = 'SELECT DISTINCT heure FROM heure_dispo join medecin ON medecin.email_med=heure_dispo.email_med where medecin.nom_med=:specialite and jour=:jour';
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

?>