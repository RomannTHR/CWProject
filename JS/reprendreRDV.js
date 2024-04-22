$(document).on('submit', '.form-card-reprendreRDV', function(event) {
    event.preventDefault();
    document.getElementById("card_show_rdv").innerHTML="";
    //récupère médecin sur la cards
    var medecin = $(this).find('.medecin').val();
    //récupère date sur la cards
    var lieu = $(this).find('.places').val();
    console.log(lieu);
    console.log(medecin);
    ajaxRequest('GET', '../PHP/request.php/RDV/?specialite=' + medecin + '&lieu=' + lieu, getDayRDV);
    console.log("je passe après le ajaxRequest");
});
  //récupère les dispos des médecins par jour puis par heure
  function getDayRDV(infos){
    ajaxRequest('GET', '../PHP/request.php/getDayRDV/?medecin=' + infos[0]['email_med'], getHourRDV);
  }
  function getHourRDV(infos){
    console.log(infos[0]['email_med']);
    for(let i=0;i<infos.length;i++){
      ajaxRequest('GET', '../PHP/request.php/getHourRDV/?medecin=' + infos[i]['email_med'] + '&jour=' + infos[i]['date_dispo'], displayCard_showMedDispo);
      //console.log(infos[i]['email_med']);
      //console.log(infos[i]['date_dispo']);
    }
  }
  //envoie la reprise de rdv dans la bdd
  $(document).on('submit', '.form-card', function(event) {
    event.preventDefault();
    //récupère médecin sur la cards
    var medecin = $(this).find('.medecin').val();
    //récupère date sur la cards
    var date = $(this).find('.date').val();
    //récupère l'horaire sur la cards
    var choixHoraire = $(this).find('.choixHoraire').val();
    //insère rdv pris dans la bdd
    ajaxRequest('POST', '../PHP/request.php/addRDV/', function () {
      //supprime le rdv dans la bdd
      ajaxRequest('DELETE','../PHP/request.php/addRDV/?' + 'medecin=' + medecin + '&date=' + date + '&heure=' + choixHoraire, function () {
        $('#card-body').html("<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
        "Vous avez bien pris votre rendez-vous! Merci." +
      "</div>");
      });
    }, 'medecin=' + medecin + '&date=' + date + '&heure=' + choixHoraire);
  
  });
  //montre les cartes 
  function displayCard_showMedDispo(infos){
    var optionsHTML = "";

  infos[2].forEach(function(heure) {
    optionsHTML += "<option value='" + heure['heure'] + "'>" + heure['heure'] + "</option>";
  });




  // Convertir la chaîne de caractères en objet Date
  var date = new Date(infos[1]);
  
  // Options de formatage pour la date
  var options = {
    year: 'numeric', // année (ex: "2024")
    month: 'long', // mois (ex: "janvier")
    day: 'numeric', // jour (ex: "15")
  };
  
  // Formater la date en français
  var dateFormatter = new Intl.DateTimeFormat('fr-FR', options);
  var dateFormatted = dateFormatter.format(date);
  
  $('#card_show_rdv').append("<div class='card mx-auto' style='width: 18rem; margin-top : 3vw;'>"
  + "<form class='form-card'>"
  + "<div class='card-body' >"
  +"    <h5 class='card-title'>" + dateFormatted + "</h5>"
  +    "<div class='mb-3' id='card-body'>"
        +"<label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>"
        +"<input class='date' type='hidden' name='horaire' value='"+ infos[1] + "'>"
        +"<select class='form-select choixHoraire' name='heure'>" + 
        optionsHTML + 
        "</select>" +
      "</div>  "+ 
                  "<ul class='list-group list-group-flush'>" +
                    "<li class='list-group-item'><b>Docteur : </b>" + infos[3][0]['nom_med'] + " " + infos[3][0]['prenom_med'] + "</li>" +
                    "<li class='list-group-item'><b>Specialité : </b>" + infos[3][0]['specialite'] + "</li>" +
                    "<input class='medecin' type='hidden' name='email_med' value='" + infos[3][0]['email_med'] + "'>" + 
                    "<li class='list-group-item'> <b>E-mail : </b>" + infos[3][0]['email_med'] + "</li>" + 
                    "<li class='list-group-item'> <b>Lieu : </b>" + infos[3][0]['code_postal_med'] + "</li>" + 
                  "</ul>" +
                  "<div class='card-body'>" + 
                    "<input class='btn btn-primary' type='submit' value='Prendre rendez-vous' name='valid'>" +
                  "</div>" + 
                "</form>" + 
              "</div>"
              + "</div>");
  }