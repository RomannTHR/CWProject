<?php
    include 'database.php';
    $conn=dbconnect();
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