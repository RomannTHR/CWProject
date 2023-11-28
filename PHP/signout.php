<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Out</title>
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
    <h1 style="text-align : center;">Inscription</h1>
    <br>
    <div class="container mx-auto p-2" style="width: 500px;">
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nom</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre nom" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Prénom</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre prénom" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Téléphone</span>
        <input type="tel" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre téléphone" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Adresse E-Mail</span>
        <input type="email" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Confirmation e-mail</span>
        <input type="email" id="formGroupExampleInput2" class="form-control" placeholder="Confirmer votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Mot de Passe</span>
        <input type="password" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre mot de passe" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="position-relative">
        <button class="btn btn-primary position-absolute mt-3" type="submit">S'inscrire</button><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Déjà un compte ? <a href="identify.php">Se connecter</a></div>
        </div>
    </div>


    </div>
  
  </body>
</html>