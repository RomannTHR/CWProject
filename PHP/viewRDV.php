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
        echo $email_client;
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
            <form action='RDV.php' method='post'>
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
                                        <input type='hidden' name='lieu' value='".strtoupper($rdv['code_postal_med'])."'>
                                        <input type='hidden' name='nom' value='".strtoupper($rdv['nom'])."'>
                                        <button type='submit' class='btn btn-custom text-white'>Reprendre rendez-vous</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>";
        
            }"</form>";
            
        } 

      ?>
  </body>
</html>
