<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vos Rendez-vous</title>
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

  <br>
      <?php
        $dateHeureActuelle=date('Y-m-d H:i:s');

        include 'database.php';
        $db = dbConnect();
        $email_client=$_SESSION['email'];
        $rdvPassed=getRDVclient($db,$email_client);
        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
        echo "<h2 class='text-center'>Vos rendez-vous à venir :</h2>";
        foreach ($rdvPassed as $rdv) {
          $date = new DateTime($rdv['heure_rdv']);
          $formattedDate = strftime('%A %e %B %Y', $date->getTimestamp());
            if ($rdv['heure_rdv'] > $dateHeureActuelle) {
                echo "<div class='card-group'>
                    <div class='card'>
                        <div class='card-body'>
                            <ul>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h3 class='card-title'>Dr " . $rdv['nom_med'] . " " . $rdv['prenom_med'] . "</h3>
                                </li>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h4 class='card-text'>" . $rdv['specialite'] . "</h4>
                                </li>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h4 class='card-text'>" .$formattedDate. "</h4>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>";
            }
        }

        echo "<h2 class='text-center'>Vos rendez-vous précédents :</h2>";

        foreach ($rdvPassed as $rdv) {
            $date = new DateTime($rdv['heure_rdv']);
            $formattedDate = strftime('%A %e %B %Y', $date->getTimestamp());
            if ($rdv['heure_rdv'] <= $dateHeureActuelle) {
                echo "
            <form action='viewRDV.php' method='post'>
                <div class='card-group'>
                    <div class='card'>
                        <div class='card-body'>
                            <ul>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h3 class='card-title'>Dr " . $rdv['nom_med'] . " " . $rdv['prenom_med'] . "</h3>
                                </li>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h4 class='card-text'>" . $rdv['specialite'] . "</h4>
                                </li>
                                <li style='display: inline-block;margin-left :50px'>
                                    <h4 class='card-text'>" .$formattedDate. "</h4>
                                </li>
                                <li style='display: inline-block;margin-left :50px'>
                                    <div class='col-12' style='float right'>
                                        <input type='hidden' name='selected_rdv' value='" . $rdv['id_rdv'] . "'> 
                                        <input class='btn btn-primary position-absolute mt-3' type='submit' value='Reprendre rendez-vous' onclick='showDisponibilites(" . $rdv['id_rdv'] . ") name='valid'>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>";
                $specialiste=$rdv['nom_med'];
                if(isset($_POST['valid']) && isset($_POST['selected_rdv'])){
                $day= dbGetRDVByDay($db,$specialiste);
                foreach($day as $med){
                    $jour=$med['jour'];
                    $hour_dispo=dbGetRDVByHour($db,$specialiste,$jour);
                    setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
                    $date = new DateTime($jour);
                    $formattedDate = strftime('%A %e %B %Y', $date->getTimestamp());
                    echo"<div class='card-group'>
                        <div class='card border-info border-4 mx-4 rounded-0' style='background-color: #f8f9fa;'>
                        <h4 class='card-text'>".$formattedDate."</h4>
                        <form action='viewRDV.php' method='post'>
                            <div class='card-body'>
                            <ul>
                                <li>
                                <div class='mb-3'>
                                <label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>
                                <select class='form-select' id='choixHoraire' name='horaire'>";
                                    foreach ($hour_dispo as $hour) {
                                        echo "<option value=".$hour['jour'].">" . $hour['heure'] ." </option>";
                                        
                                    }
                        echo "</select>
                            </div>            
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
                  //définis les variables pour la fonction addRDV
                    $jour=$_POST['horaire'];
                    $heure=$_POST['horaire'];
                    $idrdv=rand(1,32767);
                    $email_med=$_POST['email_med'];
            }
        
            }"</form>";
            
        } 

      ?>
  </body>
</html>
