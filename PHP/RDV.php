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
    <a href="identify.php" onclick=<?php session_destroy()?>>
      <img src="../Images/deco.png" alt="Bootstrap" width="100" height="98">
    </a>
    
  </div>
  </nav>

  <br>
  <form action="RDV.php" method="post">
  <h1 style="text-align : center;">Prendre RDV</h1>
  <div class="container mx-auto p-2" style="width: 500px;">
    <div class="mb-3" style="float: left;">
      <label for="formGroupExampleInput" class="form-label">Lieu RDV</label>
      <input type="text" class="form-control" name='lieu' id="formGroupExampleInput" placeholder="Entrez un lieu de RDV">
    </div>
    <div class="mb-3" style="float: right">
      <label for="formGroupExampleInput2" class="form-label" >Nom spécialiste</label>
      <input type="text" class="form-control" name='specialiste' id="formGroupExampleInput2" placeholder="Entrez le nom du spécialiste ou de spécialité">
    </div>
    <div class="col-12" style="float right">
      <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
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
    $result = dbGetMed($db, $specialiste,$lieu);
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
    }
    print_r($r);
?>



