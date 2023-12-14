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

  <br>

  
  <form action="RDV.php" method="post">
  <h1 style="text-align: center;">Prendre RDV</h1>
  <div class="container mx-auto p-2 text-center" style="max-width: 500px;">
    <div class="d-flex">
      <div class="flex-fill mr-2">
        <label for="formGroupExampleInput" class="form-label">Lieu RDV</label>
        <input type="text" class="form-control" name='lieu' id="formGroupExampleInput" placeholder="Entrez un lieu de RDV">
      </div>
      <div class="flex-fill mr-2">
        <label for="formGroupExampleInput2" class="form-label">Nom spécialiste</label>
        <input type="text" class="form-control" name='specialiste' id="formGroupExampleInput2" placeholder="Entrez le nom du spécialiste ou de spécialité">
      </div>
      <div style="padding-top : 30px;width : 175px;"class="ml-auto">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </div>
  </div>
</form>

</form>

  </body>
</html>
<?php
    include 'database.php';
    $lieu=$_POST['lieu'];
    $specialiste=$_POST['specialiste'];
   


    //fonction pour avoir les rdv dispo

    $db = dbConnect();
    $result = dbGetMed($db, $specialiste,$lieu);
    $day= dbGetRDVByDay($db,$specialiste);
    //email patient 
   $email_client=$_SESSION["email"];

    //affiche les heures
    foreach($day as $med){
      $jour=$med['jour'];
      $hour_dispo=dbGetRDVByHour($db,$specialiste,$jour);
      
    }

    //afficher les cards pour chaque jour et chaque medecin
    foreach ($result as $med) {
      echo"<div class='card-group'>
        <div class='card'>
          <form action='RDV.php' value = 'S'inscrire' type='submit' name='Valid'>
            <div class='card-body'>
              <ul>
                <li>
                <div class='mb-3'>
                <label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>
                <select class='form-select' id='choixHoraire' name='horaire'>";
                    foreach ($hour_dispo as $hour) {
                        echo "<option value='medecin1'>" . $hour['heure'] . "</option>";
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
              <p class='card-text'><small class='text-body-secondary'></small></p>
            </li>
            <li style='display: inline-block;margin-left :50px'>
              <div class='col-12' style='float right'>
              <button class='btn btn-primary' name='Valid' type='submit'>Prendre RDV</button>
              </div>
            </li>
          </div>
          </ul>
        </form>
      </div>
    </div>";
    if(!isset($_POST['horaire'])){
      echo $_POST['horaire'];
    }
    $email_med=$med['email_med'];
    //if(!empty($_POST['Valid'])){
      //addRDV($email_client,$email_med,$jour,$heure,$idrdv);
    //}
    }
    print_r($r);
?>



