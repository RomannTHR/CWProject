<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
  <h1 style="text-align : center; margin-top : 5vw;">Connexion</h1>
  <div class="container mx-auto p-2" style="width: 500px;">
    <label for="formGroupExampleInput2" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">@</span>
      <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez un E-Mail valide" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <label for="formGroupExampleInput2" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">🔑</span>
      <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez un Mot de Passe valide" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="position-relative">
    <button class="btn btn-primary position-absolute mt-3" type="submit">Se connecter</button><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Pas de compte ? <a href="signin.php">Créer un compte</a></div>
    </div>
  </div>

  </body>
</html>

