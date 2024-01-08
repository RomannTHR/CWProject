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

<div class='container'>
          <div class='d-flex justify-content-center ' style="flex-wrap : wrap;">";
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
  
        
        echo "<div class='card mx-auto' style='width: 18rem; margin-top : 3vw;'>
                <img src='../Images/Allobobo.png' class='card-img-top' alt='...'>
                <form action='RDV.php' method='post'>
                  <div class='card-body'>
                    <h5 class='card-title'>$formattedDate</h5>
                    <div class='mb-3'>
                      <label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>
                      <input type='hidden' name='horaire' value='".$jour['date_dispo']."'>
                      <select class='form-select' id='choixHoraire' name='heure'>";
                      foreach ($heures as $heure) {
                        echo "<option value=".$heure['heure'].">" . $heure['heure'] ." </option>";
                      }
                echo "</select>
                    </div>  
                  </div>
                  <ul class='list-group list-group-flush'>
                    <li class='list-group-item'><b>Docteur : </b>".$medecin['nom_med']." ".$medecin['prenom_med']."</li>
                    <li class='list-group-item'><b>Specialité : </b>".$medecin['specialite']."</li>
                    <input type='hidden' name='email_med' value='".$medecin['email_med']."'>
                    <li class='list-group-item'> <b>E-mail : </b>".$medecin['email_med']."</li>
                    <li class='list-group-item'> <b>Lieu : </b>".$medecin['code_postal_med']."</li>
                  </ul>
                  <div class='card-body'>
                    <input class='btn btn-primary' type='submit' value='Prendre rendez-vous' name='valid'>
                  </div>
                </form>
              </div>";
  
      }
    }
    echo "</div>
        </div>
      </body>
      </html>";

  }

  
  if(isset($_POST['valid'])){
    $idrdv=rand(1,32767);
    $newDate = date("Y-m-d", strtotime($_POST['horaire'])); 
    $med = $_POST['email_med'];

    addRDV($conn,$_SESSION["email"],$med,$newDate,$_POST['heure'],$idrdv);

    supprMedRdvDispo($conn,$med,$newDate,$_POST['heure']);
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    Vous avez bien pris votre rendez-vous! Merci.
  </div>";
  }


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