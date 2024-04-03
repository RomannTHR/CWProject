
$('#viewRDV').on('click', (event) =>{
    event.preventDefault();
    document.getElementById("container").innerHTML = "<div id='card_show_rdv'></div>";
    ajaxRequest('GET', '../PHP/request.php/getRDVpassed', getRDVpassed);
});
  function getRDVpassed(infos){
    for(let i=0;i<infos.length;i++){
         displayCard_showRDV(infos[i]);
    }
  }
  function displayCard_showRDV(infos){
    $('#card_show_rdv').append("<ul class='list-group list-group-flush'>" +
    "<li class='list-group-item'><b>Docteur : </b>" + infos['nom_med'] + " " + info['prenom_med'] + "</li>" +
    "<li class='list-group-item'><b>Specialité : </b>" + infos['specialite'] + "</li>" +
    "<input class='medecin' type='hidden' name='email_med' value='" + infos['email_med'] + "'>" + 
    "<li class='list-group-item'> <b>E-mail : </b>" + infos['email_med'] + "</li>" + 
    "<li class='list-group-item'> <b>Lieu : </b>" + infos['code_postal_med'] + "</li>" + 
  "</ul>" +
  "<div class='card-body'>" + 
    "<input class='btn btn-primary' type='submit' value='reprendre rendez-vous' name='valid'>" +
  "</div>" )
  }