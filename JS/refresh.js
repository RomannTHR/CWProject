window.onload = function(){
    ajaxRequest('GET', '../PHP/request.php/getPage/', setPage);
};


function setPage(infos){
    if(infos == "identifyClient"){
        ajaxRequest('PUT','../PHP/request.php/setPage/', () => console.log("La page est maintenant : " + infos),'page='+infos);
        var contenuHTML = `        <h1 style="text-align : center; margin-top : 5vw;">Connexion</h1>
        <form id="login" method="post">
        <div class="container mx-auto p-2" style="width: 500px;">
          <label for="formGroupExampleInput2" class="form-label">E-mail</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" id="email_login" class="form-control" placeholder="Entrez un E-Mail valide" aria-label="Username" aria-describedby="basic-addon1" name="email_login">
          </div>
      
          <label for="mdp_login" class="form-label">Mot de passe</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">🔑</span>
            <input type="password" id="mdp_login" class="form-control" placeholder="Entrez un Mot de Passe valide" aria-label="Username" aria-describedby="basic-addon1" name="mdp_login">
          </div>
          <div class="position-relative">
          <input class="btn btn-primary position-absolute mt-3" type="submit" value="Se connecter" name="connect"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Pas de compte ? <input type="button" id="createAccount" class="btn btn-primary" value="Créer un compte"></div>
          </div>
        </div>
        </form>`;
        $('#container').html(contenuHTML);
        $('.medButton').val("Vous êtes practicien ?");
        $('#clickDeco').css('display', 'none');
        $('#changerPage').css('display', 'block');

    }
    if(infos == "identifyMed"){
        ajaxRequest('PUT','../PHP/request.php/setPage/', () => console.log("La page est maintenant : " + infos),'page='+infos);
        var contenuHTML = `  <h1 style="text-align : center; margin-top : 5vw;">Connexion</h1>
        <form id="login" method="post">
        <div class="container mx-auto p-2" style="width: 500px;">
          <label for="formGroupExampleInput1" class="form-label">E-mail</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" id="email_login" class="form-control" placeholder="Entrez un E-Mail valide" aria-label="Username" aria-describedby="basic-addon1" name="email_login">
          </div>
      
          <label for="formGroupExampleInput2" class="form-label">Mot de passe</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">🔑</span>
            <input type="password" id="mdp_login" class="form-control" placeholder="Entrez un Mot de Passe valide" aria-label="Username" aria-describedby="basic-addon1" name="mdp_login">
          </div>
          <div class="position-relative">
          <input class="btn btn-primary position-absolute mt-3" type="submit" value="Se connecter" name="connect"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Pas de compte ? <input type="button" id="createAccount" class="btn btn-primary" value="Créer un compte"></div></div>
          </div>
        </div>`;
        $('#container').html(contenuHTML);
        // Changez le texte du bouton
        $('.medButton').val("Vous êtes patient ?");
        $('#clickDeco').css('display', 'none');
        $('#changerPage').css('display', 'block');


    }
    if(infos == "signinClient"){
        ajaxRequest('PUT','../PHP/request.php/setPage/', () => console.log("La page est maintenant : " + infos),'page='+infos);

        var contenuHTML = `
        <br>
        <h1 style="text-align : center;">Inscription</h1>
        <br>
        <form id="signin" method="post">
        <div class="container mx-auto p-2" style="width: 500px;">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom</span>
            <input type="text" id="nom" class="form-control" placeholder="Entrez votre nom" aria-label="Username" aria-describedby="basic-addon1" name="nom">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Prénom</span>
            <input type="text" id="prenom" class="form-control" placeholder="Entrez votre prénom" aria-label="Username" aria-describedby="basic-addon1" name="prenom">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Téléphone</span>
            <input type="tel" id="tel" class="form-control" placeholder="Entrez votre téléphone" aria-label="Username" aria-describedby="basic-addon1" name="tel">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Adresse E-Mail</span>
            <input type="email" id="email" class="form-control" placeholder="Entrez votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="email">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Confirmation e-mail</span>
            <input type="email" id="confemail" class="form-control" placeholder="Confirmer votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="confemail">
            </div>
    
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mot de Passe</span>
            <input type="password" id="mdp" class="form-control" placeholder="Entrez votre mot de passe" aria-label="Username" aria-describedby="basic-addon1" name="mdp">
    
            </div>
            <div class="position-relative">
            <input class="btn btn-primary position-absolute mt-3" id="insertInBD" value = "S'inscrire" type="submit" name="Valid"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Déjà un compte ? <input type="button" class="btn btn-primary" id="connectAccount" value="Se connecter"></div>
            </div>
          </div>
    
        `;
        $('#container').html(contenuHTML);
        $('#clickDeco').css('display', 'none');
        $('#changerPage').css('display', 'block');

    }
    if(infos == "signinMed"){
        ajaxRequest('PUT','../PHP/request.php/setPage/', () => console.log("La page est maintenant : " + infos),'page='+infos);
        var contenuHTML = `
        <br>
        <h1 style="text-align : center;">Inscription Medecin</h1>
        <br>
        <form id="signin" method="post">
        <div class="container mx-auto p-2" style="width: 500px;">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom</span>
            <input type="text" id="nom_med" class="form-control" placeholder="Entrez votre nom" aria-label="Username" aria-describedby="basic-addon1" name="nom_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Prénom</span>
            <input type="text" id="prenom_med" class="form-control" placeholder="Entrez votre prénom" aria-label="Username" aria-describedby="basic-addon1" name="prenom_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Code Postal</span>
            <input type="text" id="codepos_med" class="form-control" placeholder="Entrez votre code postal" aria-label="Username" aria-describedby="basic-addon1" name="codepos_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Téléphone</span>
            <input type="tel" id="tel_med" class="form-control" placeholder="Entrez votre téléphone" aria-label="Username" aria-describedby="basic-addon1" name="tel_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Adresse E-Mail</span>
            <input type="email" id="email_med" class="form-control" placeholder="Entrez votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="email_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Confirmation e-mail</span>
            <input type="email" id="confemail_med" class="form-control" placeholder="Confirmer votre adresse e-mail" aria-label="Username" aria-describedby="basic-addon1" name="confemail_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Spécialité</span>
            <input type="text" id="specialite_med" class="form-control" placeholder="Entrez votre spécialité" aria-label="Username" aria-describedby="basic-addon1" name="specialite_med">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mot de Passe</span>
            <input type="password" id="mdp_med" class="form-control" placeholder="Entrez votre mot de passe" aria-label="Username" aria-describedby="basic-addon1" name="mdp_med">
    
            </div>
            <div class="position-relative">
            <input class="btn btn-primary position-absolute mt-3" id="insertInBD" value = "S'inscrire" type="submit" name="Valid_med"><div id="no_acc" class ="position-absolute start-50 top-50 mt-4">Déjà un compte ? <input type="button" class="btn btn-primary" id="connectAccount" value="Se connecter"></div>
            </div>
          </div>
        `;
        $('#container').html(contenuHTML);
        $('#clickDeco').css('display', 'none');
        $('#changerPage').css('display', 'block');

    }
    if(infos == "RDV"){

      ajaxRequest('PUT','../PHP/request.php/setPage/', () => console.log("La page est maintenant : " + infos),'page='+infos);
      

      var contenuHTML = `
      <form id="searchForm" method="post">
      <h1 style="text-align: center;">Prendre rendez-vous</h1>
      <div class="container mx-auto p-2 text-center" style="max-width: 500px;">
        <div class="d-flex">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">🔎</span>
            <input type="text" id="inputNomSpe" class="form-control" placeholder="Nom , spécialité"  aria-describedby="basic-addon1" name="specialiste">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">🏥</span>
            <input type="text" id="inputLieu" class="form-control" placeholder="Lieu"  aria-describedby="basic-addon1" name="lieu" ">
          </div>
          <div style="width: 150px;"class="input-group-text">
            <button name='research' class="btn btn-primary" type="submit">Rechercher</button>
          </div>
        </div>
      </div>
    </form>


    <div id="card-body" class='d-flex justify-content-center ' style="flex-wrap : wrap;">
      
      
      `;
      $('#container').html(contenuHTML);

      $('#clickDeco').css('display', 'block');
      $('#changerPage').css('display', 'none');


       




    }
}



$(document).on('click', '#clickDeco', function () {

  setPage("identifyClient");

});