<?php
    include("database.php");
    session_start();

    ini_set('display_errors',1);
    error_reporting(E_ALL);

    $conn=dbConnect();


    $method_request = $_SERVER['REQUEST_METHOD'];

    $request = substr($_SERVER['PATH_INFO'], 1); 
    $request = explode('/', $request); 
    $requestRessource = array_shift($request);

    if(isset($_SESSION['page']) == false){
        $_SESSION['page'] = "identifyClient";
    }



    if($requestRessource=='setPage'){  


        if($_SERVER['REQUEST_METHOD']=='GET'){


        }
            
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

            parse_str(file_get_contents('php://input'), $_PUT);

            if(isset($_PUT['page'])){
                $_SESSION['page'] = $_PUT['page'];

                echo json_encode($_PUT['page']);


            }
            else{
                echo json_encode(false);
            }
        }
        if($method_request=='DELETE'){

        }  
    }

    if($requestRessource=='getPage'){  


        if($_SERVER['REQUEST_METHOD']=='GET'){

            if(isset($_SESSION['page'])){
                echo json_encode($_SESSION['page']);
            }
            else{
                echo json_encode(false);
            }


        }
            
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }


    if($requestRessource=='identify'){  
        //checkLogin
        if($method_request=='GET'){
            
        }
        if($method_request=='POST'){

            $email_login = $_POST['email_login'];
            $mdp_login = $_POST['mdp_login'];

            if(checkLogin($email_login, $mdp_login)){
                $_SESSION["email"] = $email_login;
                $_SESSION["mdp"] = password_hash($mdp_login,PASSWORD_DEFAULT);

                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }


        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }
    if($requestRessource=='identifymed'){  
        //checkLoginMed
        if($method_request=='GET'){
            


        }
        if($method_request=='POST'){

            $email_login = $_POST['email_login'];
            $mdp_login = $_POST['mdp_login'];

            if(checkLoginMed($email_login, $mdp_login)){
                $_SESSION["email"] = $email_login;
                $_SESSION["mdp"] = password_hash($mdp_login,PASSWORD_DEFAULT);

                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }


        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }
    if($requestRessource=='RDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($method_request=='GET'){
            $medecins = dbGetMed($conn, $_GET['specialite'],$_GET['lieu']); 
            echo json_encode($medecins);
        }
            
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }

    if($requestRessource=='getDayRDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($method_request=='GET'){
            
            $jours = dbGetRDVByDay($conn,$_GET['medecin']); 

            echo json_encode($jours);
        }
            
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }

    if($requestRessource=='getHourRDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($method_request=='GET'){
        
            $heures = dbGetRDVByHour($conn,$_GET['medecin'],$_GET['jour']);
            $infoMed = getInfosMed($_GET['medecin']);
            $result = [$_GET['medecin'],$_GET['jour'],$heures,$infoMed];
            echo json_encode($result);
        }
            
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }
    if($requestRessource=='addRDV'){  
        if($method_request=='GET'){

        }
            
        if($method_request=='POST'){
            $email_med = $_POST['medecin'];
            $heure = $_POST['heure'];
            $email_client = $_SESSION["email"];
            $idrdv=rand(1,32767);
            
            $newDate = date("Y-m-d", strtotime($_POST['date'])); 

            $result = addRDV($conn,$email_client,$email_med,$newDate,$heure,$idrdv);

            echo json_encode($result);
        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

            $email_med = $_GET['medecin'];
            $heure = $_GET['heure'];
            $email_client = $_SESSION["email"];
            $idrdv=rand(1,32767);
            
            $newDate = date("Y-m-d", strtotime($_GET['date'])); 

            $result = supprMedRdvDispo($conn,$email_med,$newDate,$heure);

            echo json_encode($result);


        }  
    }


    


    if($requestRessource=='medButton'){  

        //sendDataToDB
        if($method_request=='GET'){

            
        }
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }



    if($requestRessource=='signin'){  

        //sendDataToDB
        if($method_request=='GET'){

        }
        if($method_request=='POST'){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numtel = $_POST['numtel'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];


            if(sendDataToDB($nom,$prenom,$numtel,$email,$mdp) == true){
                $result = true;
            }
            else{
                $result = false;
            }

            echo json_encode($result);
        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }


    if($requestRessource=='signinmed'){
        //sendMedToDB
        if($method_request=='GET'){


        }
        if($method_request=='POST'){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $codePos = $_POST['codePos'];
            $numtel = $_POST['numtel'];
            $email = $_POST['email'];
            $spe = $_POST['spe'];
            $mdp = $_POST['mdp'];


            if(sendMedToDB($nom,$prenom,$codePos,$numtel,$email,$spe,$mdp) == true){
                $result = true;
            }
            else{
                $result = false;
            }

            echo json_encode($result);


        }
        if($method_request=='PUT'){






        }
        if($method_request=='DELETE'){

        }  
    }
    if($requestRessource=='viewRDV'){ 
        //getRDVClient 
        //getNumberOfResult
        //getNextRDVByMed
        if($method_request=='GET'){

        }
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }
    if($requestRessource=='viewRDVMed'){  
        //supprMedRDvDispo
        //addRDVInCalendar
        //insertDispoByDay
        if($method_request=='GET'){

        }
        if($method_request=='POST'){

        }
        if($method_request=='PUT'){

        }
        if($method_request=='DELETE'){

        }  
    }

?>