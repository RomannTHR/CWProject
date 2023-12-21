<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar" style="background-color: #7b9dfc;">
  <div class="container">
    <a class="navbar-brand mx-auto p-2" href="#">
      <img src="../Images/Allobobo.png" alt="Bootstrap" width="300" height="98">
    </a>
    <a href="signinmed.php" class="btn btn-primary">
      Vous êtes practicien ?
    </a>
  </div>
  </nav>
    <br>
    <h1 style="text-align : center;">Inscription</h1>
    <br>
    <form id="signin" action="signin.php" method="post">
    <div class="container mx-auto p-2" style="width: 500px;">
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nom</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre nom" aria-label="Username" aria-describedby="basic-addon1" name="nom">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Prénom</span>
        <input type="text" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre prénom" aria-label="Username" aria-describedby="basic-addon1" name="prenom">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Téléphone</span>
        <input type="tel" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre téléphone" aria-label="Username" aria-describedby="basic-addon1" name="tel">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Adresse E-Mail</span>
        <input type="email" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="email">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Confirmation e-mail</span>
        <input type="email" id="formGroupExampleInput2" class="form-control" placeholder="Confirmer votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="confemail">
        <?php 
          $email = $_POST['email'];
          $confemail = $_POST['confemail'];
          if(!empty($_POST['Valid'])){
            if($email != $confemail){
              echo "<p style='color : red'>Vous n'avez pas entrer la bonne adresse e-mail</p>";
            }  
          }

 
        ?>
        </div>

        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Mot de Passe</span>
        <input type="password" id="formGroupExampleInput2" class="form-control" placeholder="Entrez votre mot de passe" aria-label="Username" aria-describedby="basic-addon1" name="mdp">

        </div>
        <div class="position-relative">
        <input class="btn btn-primary position-absolute mt-3" value = "S'inscrire" type="submit" name="Valid"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Déjà un compte ? <a href="identify.php">Se connecter</a></div>
        </div>
      </div>




    </form>
    
    <?php 
      require_once("database.php");
        
      $prenom = $_POST['prenom'];
      $nom = $_POST['nom'];
      $tel = $_POST['tel'];
      $email = $_POST['email'];
      $confemail = $_POST['confemail'];
      $mdp = $_POST['mdp'];



      if (!empty($_POST['Valid'])) {
        if (isFormValid($prenom, $nom, $tel, $email, $confemail, $mdp)) {
            if (sendDataToDB($nom, $prenom, $tel, $email, $mdp)) {
                echo "<p style='text-align : center; margin-top : 4em; color : green;'>Enregistrement réussi.</p>";
            } else {
                echo "<p style='text-align : center; margin-top : 4em; color : red;'>Vous vous êtes déjà enregistré avec cet e-mail.</p>";
            }
        }
    }
    
    
    ?>

    


  
  </body>
</html>