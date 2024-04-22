<?php 
  session_start();
?>
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
    <a href="signin.php" class="btn btn-primary">
      Vous êtes un patient ?
    </a>
  </div>
  </nav>

  <br>

  <h1 style="text-align : center; margin-top : 5vw;">Connexion</h1>
  <form id="login" action="" method="post">
  <div class="container mx-auto p-2" style="width: 500px;">
    <label for="formGroupExampleInput1" class="form-label">E-mail</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">@</span>
      <input type="text" id="formGroupExampleInput1" class="form-control" placeholder="Entrez un E-Mail valide" aria-label="Username" aria-describedby="basic-addon1" name="email_login">
    </div>

    <label for="formGroupExampleInput2" class="form-label">Mot de passe</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">🔑</span>
      <input type="password" id="formGroupExampleInput2" class="form-control" placeholder="Entrez un Mot de Passe valide" aria-label="Username" aria-describedby="basic-addon1" name="mdp_login">
    </div>
    <div class="position-relative">
    <input class="btn btn-primary position-absolute mt-3" type="submit" value="Se connecter" name="connect"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Pas de compte ? <a href="signinmed.php">Créer un compte Medecin</a></div>
    </div>
  </div>
  </form>
  <?php
    require_once("database.php");

    $email_login = $_POST['email_login'];
    $mdp_login = $_POST['mdp_login'];
    


    if(!empty($_POST['connect'])){
      if(checkLoginMed($email_login, $mdp_login)){
          $_SESSION["email"] = $email_login;
          $_SESSION["mdp"] = password_hash($mdp_login,PASSWORD_DEFAULT);
          header("Location: ../HTML/index.html?formSubmitted=true");
          exit();
      } else {
          echo "<p style='text-align : center; margin-top : 4em;'>Identifiants incorrects. Veuillez réessayer.</p>";
      }
  }
  ?>




  </body>
</html>

