<?php 
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prendre Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar" style="background-color: #7b9dfc;">
  <div class="container">
    <a class="navbar-brand mx-auto p-2" href="#">
      <img src="../Images/Allobobo.png" alt="Bootstrap" width="300" height="98">
    </a>
    <a href="identify.php">
      <img src="../Images/deco.png" alt="Bootstrap" width="100" height="98">
    </a>
    
  </div>
  </nav>
  <div class="p-3 mb-2 bg-primary-subtle text-emphasis-primary">
  <br>
  <form action="RDV.php" method="post">
  <h1 style="text-align: center;">Prendre rendez-vous</h1>
  <div class="container mx-auto p-2 text-center" style="max-width: 500px;">
    <div class="d-flex">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">🔎</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Nom , spécialité"  aria-describedby="basic-addon1" name="specialiste">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">🏥</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Lieu"  aria-describedby="basic-addon1" name="lieu">
      </div>
      <div style="width: 150px;"class="input-group-text">
        <button name='research' class="btn btn-primary" type="submit">Rechercher</button>
      </div>
    </div>
  </div>
</form>

</div>

  </body>
</html>

<?php



  $specialite = $_POST['specialiste'];
  $lieu = $_POST['lieu'];
  
  require_once("database.php");

  $conn = dbConnect();
  $medecins = dbGetMed($conn, $specialite,$lieu);

  foreach($medecins as $medecin){
    $jours = dbGetRDVByDay($conn,$medecin['email_med']);

    foreach($jours as $jour){

      $heures = dbGetRDVByHour($conn,$medecin['email_med'],$jour['date_dispo']);
      if($heures != NULL){
        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
        $date = new DateTime($jour['date_dispo']);
        $formattedDate = strftime('%A %e %B %Y', $date->getTimestamp());
  
        echo"<div class='card-group'>
            <div class='card border-info border-4 mx-4 rounded-0' style='background-color: #f8f9fa;'>
            <h4 class='card-text'>".$formattedDate."</h4>
              <form action='RDV.php' method='post'>
                <div class='card-body'>
                  <ul>
                    <li>
                    <div class='mb-3'>
                    <label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>
                    <input type='hidden' name='horaire' value='".$jour['date_dispo']."'>
                    <select class='form-select' id='choixHoraire' name='heure'>";
                        foreach ($heures as $heure) {
                            echo "<option value=".$heure['heure'].">" . $heure['heure'] ." </option>";
                        }
            echo "</select>
                </div>            
                    </li>
                <li style='display: inline-block;margin-left :50px'>
                  <h3 class='card-title'>Dr ".$medecin['nom_med']." ".$medecin['prenom_med']."</h3>
                </li>
                <li style='display: inline-block;margin-left :50px'>
                  <h4 class='card-text'>".$medecin['specialite']."</h4>
                </li>
                <li style='display: inline-block;margin-left :50px'>
                  <input type='hidden' name='email_med' value='".$medecin['email_med']."'>
                  <h4 class='card-text'>".$medecin['email_med']."</h4>
                </li>
                <li style='display: inline-block;margin-left :50px'>
                  <h4 class='card-text'>".$medecin['code_postal_med']."</h4>
                </li>
                <li style='display: inline-block;margin-left :50px'>
                  <p class='card-text'><small class='text-body-secondary'></small></p>
                </li>
                <li style='display: inline-block;margin-left :50px'>
                  <div class='col-12' style='float right'>
                  <input class='btn btn-primary position-absolute mt-3' type='submit' value='Prendre rendez-vous' name='valid'>
                  </div>
                </li>
              </div>
              </ul>
            </form>
          </div>
        </div>
        <br>";
  
      }
      }






  }

  
  if(isset($_POST['valid'])){
    $idrdv=rand(1,32767);
    $newDate = date("Y-m-d", strtotime($_POST['horaire'])); 
    $med = $_POST['email_med'];


    echo $newDate;
    echo $_POST['heure'];
    echo $_SESSION["email"];
    addRDV($conn,$_SESSION["email"],$med,$newDate,$_POST['heure'],$idrdv);

    supprMedRdvDispo($conn,$med,$newDate,$_POST['heure']);
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    Vous avez bien pris votre rendez-vous! Merci.
  </div>";
  }











    /*include 'database.php';
    $lieu=$_POST['lieu'];
    $specialiste=$_POST['specialiste'];
    


    //fonction pour avoir les rdv dispo

    $db = dbConnect();
    $result = dbGetMed($db, $specialiste,$lieu);
    $day= dbGetRDVByDay($db,$specialiste);
    //email patient en fonciton de la session
    $email_client=$_SESSION["email"];

    //affiche le nombre de résultat obtenus
    if(isset($_POST['research'])){
      $NumberOfResult = getNumberOfResult($db, $specialiste, $lieu);
      if ($NumberOfResult && !empty($NumberOfResult)) {
        $Résultats = $NumberOfResult[0]['counts'];
        if($Résultats==0){
          echo "Aucun résultat trouvé.";
        }
        else if($Résultats==1){
          echo $Résultats." résultat trouvé";
        }
        else {
          echo $Résultats." résultats trouvés";
      }
    }
  }
    
    //affiche les heures
    foreach($day as $med){
      $jour=$med['date_dispo'];
    }
    
    //définis les variables pour la fonction addRDV
    $jour= $_POST['horaire'];
    $heure= $_POST['horaire'];
    $idrdv=rand(1,32767);
    $email_med=$_POST['email_med'];*/
   
    
    //afficher les cards pour chaque jour et chaque medecin
    /*if (!empty($specialite) || !empty($lieu)) {
    foreach ($result as $med) {
      setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
      $jour=$med['date_dispo'];
      $date = new DateTime($jour);
      $formattedDate = strftime('%A %e %B %Y', $date->getTimestamp());
      $hour_dispo= dbGetRDVByHour($db,$specialiste,$med['date_dispo']);
      echo"<div class='card-group'>
        <div class='card border-info border-4 mx-4 rounded-0' style='background-color: #f8f9fa;'>
        <h4 class='card-text'>".$formattedDate."</h4>
          <form action='RDV.php' method='post'>
            <div class='card-body'>
              <ul>
                <li>
                <div class='mb-3'>
                <label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>
                <select class='form-select' id='choixHoraire' name='horaire'>";
                    foreach ($hour_dispo as $hour) {
                        echo "<option value=".$hour['date_dispo'].">" . $hour['heure'] ." </option>";
                        
                    }
        echo "</select>
            </div>            
                </li>
            <li style='display: inline-block;margin-left :50px'>
              <h3 class='card-title'>Dr ".$med['nom_med']." ".$med['prenom_med']."</h3>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <h4 class='card-text'>".$med['specialite']."</h4>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <input type='hidden' name='email_med' value='".$med['email_med']."'>
              <h4 class='card-text'>".$med['email_med']."</h4>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <h4 class='card-text'>".$med['code_postal_med']."</h4>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <p class='card-text'><small class='text-body-secondary'></small></p>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <div class='col-12' style='float right'>
              <input class='btn btn-primary position-absolute mt-3' type='submit' value='Prendre rendez-vous' name='valid'>
              </div>
            </li>
          </div>
          </ul>
        </form>
      </div>
    </div>
    <br>";
    }

  }
  if(isset($_POST['valid'])){
    addRDV($db,$email_client,$email_med,$jour,$heure,$idrdv);
    supprMedRdvDispo($db,$email_med,$jour);
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    Vous avez bien pris votre rendez-vous! Merci.
  </div>";
  }
   
  print_r($r);*/
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="display-4 text-primary">Allobobo c'est ...</h4>
            <p class="d-inline-block mx-3 h5 text-primary">70 millions d'utilisateurs quotidiens <i class="material-icons">&#xe7ef;</i></p>
            <p class="d-inline-block mx-3 h5 text-primary">500 000 praticiens <i class="material-icons">&#xf109;</i></p>
            <p class="d-inline-block mx-3 h5 text-primary">40 pays partenaires <i class="material-icons">&#xe2db;</i></p>
        </div>
        <div class="col-md-12 text-center mt-4">
            <p class="d-inline-block mx-3 h5 text-primary">#1 des plateformes de prises de rendez-vous en ligne <i class="material-icons">&#xea3f;</i></p>
            <p class="d-inline-block mx-3 h5 text-primary">98 % de satisfaction <i class="material-icons">&#xe7f2;</i></p>
        </div>
    </div>
</div>