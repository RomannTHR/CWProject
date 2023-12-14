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




    function sendDataToDB($nom,$prenom,$telephone,$email,$mdp){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();

            $stmt = $conn->prepare('INSERT INTO Client(email,nom,prenom,telephone,mdp) VALUES (:email,:nom,:prenom,:telephone,:mdp)');

            // On va vérifier que l'email n'est pas déjà dans la base de données.
            $email_client = $conn->query('SELECT email FROM client');
            $result = $email_client->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $mail){
                if($mail == $email){
                    return false;
                }
            }




            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':telephone',$telephone);
            $stmt->bindParam(':mdp',password_hash($mdp, PASSWORD_DEFAULT));
            $stmt->execute(); 
            $conn->commit();
            } catch (PDOException $e) {
                $conn->rollBack();
                echo 'Connexion échouée : ' . $e->getMessage();
                return false;
            }
    }

    function dbGetMed($conn, $specialiste,$lieu){
        try{
        $request = 'SELECT nom_med,prenom_med,specialite,email_med FROM medecin WHERE medecin.nom_med=:specialite and code_postal_med=:lieu';
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
    function addRDV($email_client,$email_med,$jour,$heure,$idrdv){
        try {
            $conn = dbConnect();
            $conn->beginTransaction();

            $stmt = $conn->prepare('INSERT INTO rendezvous(id_rdv,heure_rdv,email,email_med,jour) VALUES (:idrdv,:heure_rdv,:email,:email_med,:jour)');
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


?>