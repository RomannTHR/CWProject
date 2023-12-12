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
    
  </div>
  </nav>

  <br>
  
  </div>
  
</form>



  </body>
</html>
<?php
    include 'database.php';
    $lieu=$_POST['lieu'];
    $specialiste=$_POST['specialiste'];
    

  //fonction pour avoir les rdv dispo

$db = dbConnect();
$result = dbGetRDV($db, $_SESSION['nom']);
//faire fonction qui récupère toute les heures dispo
foreach ($result as $med) {
  echo"<div class='card-group'>
  <div class='card'>
  <div class='card-body'>
    <ul>
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
          <button class='btn btn-primary' type='submit'>Prendre RDV</button>
        </div>
      </li>
    </div>
    </ul>
  </div>
</div>";
//afficher les rdv dans la liste déroulante.
  echo $med['nom_med'] .'<br>';
  echo $med['prenom_med'] .'<br>';
  echo $med['specialite'] .'<br>';
  echo $med['heure_rdv'] .'<br>';
  echo"<div class='col-12' style='float right'><button class='btn btn-primary' type='submit'>Prendre RDV</button></div>";
  echo$_SESSION['nom'];
}
print_r($r);
?>