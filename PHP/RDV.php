
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
  <form action="RDV.php" method="post">
  <h1 style="text-align : center;">Prendre RDV</h1>
  <div class="container mx-auto p-2" style="width: 500px;">
    <div class="mb-3" style="float: left;">
      <label for="formGroupExampleInput" class="form-label">Lieu RDV</label>
      <input type="text" class="form-control" name="lieu" id="formGroupExampleInput" placeholder="Entrez un lieu de RDV">
    </div>
    <div class="mb-3" style="float: right">
      <label for="formGroupExampleInput2" class="form-label" >Nom spécialiste</label>
      <input type="text" class="form-control" name="specialiste" id="formGroupExampleInput2" placeholder="Entrez le nom du spécialiste ou de spécialité">
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
    // echo $specialiste;
    

  //fonction pour avoir les rdv dispo

$db = dbConnect();
$result = dbGetMed($db, $specialiste);
foreach ($result as $med) {
  echo $med['nom_med'] .'<br>';
  echo $med['prenom_med'] .'<br>';
  echo $med['specialite'] .'<br>';
  echo $med['heure_rdv'] .'<br>';
}
print_r($r);
?>