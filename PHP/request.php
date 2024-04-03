<?php
    include 'database.php';

    session_start();

    $conn=dbConnect();
    $request_type=$_SERVER['REQUEST_METHOD'];
    $request = substr($_SERVER['PATH_INFO'], 1);
    $request = explode('/', $request);
    $requestRessource = array_shift($request);
    if($requestRessource=='identify'){  
        //checkLogin
        if($request_type=='GET'){
            
        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource=='identifymed'){  
        //checkLoginMed
        if($request_type=='GET'){

        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource=='RDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($request_type=='GET'){
            $medecins = dbGetMed($conn, $_GET['specialite'],$_GET['lieu']); 
            echo json_encode($medecins);
        }
            
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }

    if($requestRessource=='getDayRDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($request_type=='GET'){
            
            $jours = dbGetRDVByDay($conn,$_GET['medecin']); 

            echo json_encode($jours);
        }
            
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }

    if($requestRessource=='getHourRDV'){  
        //dbGetMed
        //dbGetRDVByHour
        //dbGetRDVByDay
        //addRDV
        if($request_type=='GET'){
        
            $heures = dbGetRDVByHour($conn,$_GET['medecin'],$_GET['jour']);
            $infoMed = getInfosMed($_GET['medecin']);
            $result = [$_GET['medecin'],$_GET['jour'],$heures,$infoMed];
            echo json_encode($result);
        }
            
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource='addRDV'){  
        if($request_type=='GET'){

        }
            
        if($request_type=='POST'){
            $email_med = $_POST['medecin'];
            $heure = $_POST['heure'];
            $email_client = $_SESSION["email"];
            $idrdv=rand(1,32767);
            
            $newDate = date("Y-m-d", strtotime($_POST['date'])); 

            $result = addRDV($conn,$email_client,$email_med,$newDate,$heure,$idrdv);

            echo json_encode($result);
        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

            $email_med = $_GET['medecin'];
            $heure = $_GET['heure'];
            $email_client = $_SESSION["email"];
            $idrdv=rand(1,32767);
            
            $newDate = date("Y-m-d", strtotime($_GET['date'])); 

            $result = supprMedRdvDispo($conn,$email_med,$newDate,$heure);

            echo json_encode($result);


        }  
    }


    if($requestRessource=='signin'){  

        //sendDataToDB
        if($request_type=='GET'){

        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource=='signinmed'){
        //sendMedToDB
        if($request_type=='GET'){

        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource=='viewRDV'){ 
        //getRDVClient 
        //getNumberOfResult
        //getNextRDVByMed
        if($request_type=='GET'){

        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource=='viewRDVMed'){  
        //supprMedRDvDispo
        //addRDVInCalendar
        //insertDispoByDay
        if($request_type=='GET'){

        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }  
    }
    if($requestRessource='getRDVpassed'){
        if($request_type=='GET'){
            $email_client = $_SESSION["email"];
            $RDVPassed=getRDVClient($conn,$email_client);
            echo json_encode($RDVPassed);
        }
        if($request_type=='POST'){

        }
        if($request_type=='PUT'){

        }
        if($request_type=='DELETE'){

        }
    }
?>