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
?>