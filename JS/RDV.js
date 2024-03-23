
$('#searchForm').on('submit', (event) =>{
  event.preventDefault();
  ajaxRequest('GET', '../PHP/request.php/RDV/?specialite=' + $('#inputNomSpe').val() + '&lieu=' + $('#inputLieu').val(), getDayRDV);
});




//Fonction pour afficher les rdv

function getDayRDV(infos){
  for(let i =0; i<infos.length;i++){
    ajaxRequest('GET', '../PHP/request.php/getDayRDV/?medecin=' + infos[i]['email_med'], getHourRDV);
  }
}

function getHourRDV(infos){
  for(let i=0;i<infos.length;i++){
    ajaxRequest('GET', '../PHP/request.php/getHourRDV/?medecin=' + infos[i]['email_med'] + '&jour=' + infos[i]['date_dispo'], displayCard);
  }
}





function displayCard(infos){
  console.log(infos);
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
  

  $('#card-body').append("<div class='card mx-auto' style='width: 18rem; margin-top : 3vw;'>"
  + "<img src='../Images/Allobobo.png' class='card-img-top' alt='...'>"
  + "<form action='RDV.php' method='post'>"
  + "<div class='card-body' >"
  +"    <h5 class='card-title'>" + dateFormatted + "</h5>"
  +    "<div class='mb-3' id='card-body'>"
        +"<label for='choixHoraire' class='form-label'>Choisissez un horaire :</label>"
        +"<input type='hidden' name='horaire' value='"+ infos[1] + "'>"
        +"<select class='form-select' id='choixHoraire' name='heure'>" + 
        optionsHTML + 
        "</select>" +
      "</div>  "+ 
                  "<ul class='list-group list-group-flush'>" +
                    "<li class='list-group-item'><b>Docteur : </b>" + infos[3][0]['nom_med'] + " " + infos[3][0]['prenom_med'] + "</li>" +
                    "<li class='list-group-item'><b>Specialité : </b>" + infos[3][0]['specialite'] + "</li>" +
                    "<input type='hidden' name='email_med' value='" + infos[3][0]['email_med'] + "'>" + 
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
