
$('#viewRDV').on('click', (event) =>{
    event.preventDefault();
    document.getElementById("container").innerHTML = "<div id='card_show_rdv'></div>";
    document.getElementById("divViewRDV").innerHTML="";
    ajaxRequest('GET', '../PHP/request.php/getRDVpassed', getRDVpassed);
});
  function getRDVpassed(infos){
    for(let i=0;i<infos.length;i++){
         displayCard_showRDV(infos[i]);
    }
  }
  function displayCard_showRDV(infos){
    $('#card_show_rdv').append("<form class='form-card-reprendreRDV'><ul class='list-group list-group-flush'>" +
    "<li class='list-group-item'><b>" + infos['heure_rdv'] + "</b></li>" +
    "<li class='list-group-item'><b>Docteur : </b>" + infos['nom_med'] + " " + infos['prenom_med'] + "</li>" +
    "<li class='list-group-item'><b>Specialité : </b>" + infos['specialite'] + "</li>" +
    "<input class='medecin' type='hidden' name='email_med' value='" + infos['nom_med'] + "'>" + 
    "<li class='list-group-item'> <b>E-mail : </b>" + infos['email_med'] + "</li>" + 
    "<input class='places' type='hidden' name='places' value='" + infos['code_postal_med'] + "'>"+
    "<li > <b>Lieu : </b>" + infos['code_postal_med'] + "</li>" + 
  "</ul>" +
  "<div class='card-body'>" + 
    "<input class='btn-btn-primary' id='bouttonReprendreRDV' type='submit' value='Reprendre RDV' name='valid'>" +
  "</div></form>" );
  }